<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class MigrateOldDatabase extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'data:migrate-old {--tables= : Comma separated list of tables or model class basenames to migrate (defaults to all App\Models)} {--truncate : Truncate target tables before inserting} {--dry : Dry run (no writes)}';

    /**
     * The console command description.
     */
    protected $description = 'Copy data from the OLD_DB_* connection (old_mysql) into the default database for all models in App\\Models, preserving primary key IDs.';

    public function handle(): int
    {
        $this->info('Starting old database migration');

        // Verify old connection is configured
        try {
            DB::connection('old_mysql')->getPdo();
        } catch (\Throwable $e) {
            $this->error('Unable to connect to old_mysql connection. Check your OLD_DB_* .env settings.');
            $this->line($e->getMessage());

            return self::FAILURE;
        }

        $tablesFilter = $this->option('tables');
        $truncate = (bool) $this->option('truncate');
        $dry = (bool) $this->option('dry');

        $models = $this->discoverModels();
        if (empty($models)) {
            $this->warn('No models discovered in App\\Models. Nothing to migrate.');

            return self::SUCCESS;
        }

        // Build mapping of model => table and primary key
        $map = [];
        foreach ($models as $class) {
            try {
                /** @var Model $instance */
                $instance = new $class;
            } catch (\Throwable $e) {
                continue; // skip non-instantiable
            }

            if (! $instance instanceof Model) {
                continue;
            }

            $table = $instance->getTable();
            $pk = $instance->getKeyName();
            $map[$class] = [
                'table' => $table,
                'pk' => $pk,
            ];
        }

        // Apply filter if provided (either by table name or model basename)
        if ($tablesFilter) {
            $want = collect(explode(',', $tablesFilter))
                ->map(fn ($s) => trim($s))
                ->filter()
                ->map(fn ($s) => Str::of($s)->lower()->value())
                ->all();

            $map = collect($map)
                ->filter(function ($meta, $class) use ($want) {
                    $base = Str::lower(class_basename($class));

                    return in_array(Str::lower($meta['table']), $want, true)
                        || in_array($base, $want, true);
                })
                ->all();
        }

        if (empty($map)) {
            $this->warn('No matching models/tables after applying --tables filter.');

            return self::SUCCESS;
        }

        // Disable foreign key checks on target (MySQL)
        if (! $dry) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
        }

        $totalInserted = 0;
        $this->withProgressBar($map, function ($meta) use (&$totalInserted, $truncate, $dry) {
            $table = $meta['table'];
            $pk = $meta['pk'];

            // Determine columns intersection between old and new
            $newCols = collect(Schema::getColumnListing($table));
            $oldCols = collect(Schema::connection('old_mysql')->getColumnListing($table));
            $columns = $newCols->intersect($oldCols)->values()->all();

            if (empty($columns)) {
                $this->output->writeln("\n[skip] {$table} has no intersecting columns between old and new.");

                return;
            }

            if ($truncate && ! $dry) {
                DB::table($table)->truncate();
            }

            // Stream old rows in chunks and insert
            $chunkSize = 1000;
            $inserted = 0;

            DB::connection('old_mysql')
                ->table($table)
                ->select($columns)
                ->when($pk, fn ($q) => $q->orderBy($pk))
                ->chunk($chunkSize, function ($rows) use ($table, $dry, &$inserted) {
                    $batch = [];
                    foreach ($rows as $row) {
                        $batch[] = (array) $row;
                    }

                    if (empty($batch)) {
                        return true;
                    }

                    if (! $dry) {
                        // Prefer plain insert; if duplicates exist, ignore them
                        try {
                            DB::table($table)->insert($batch);
                            $inserted += count($batch);
                        } catch (\Throwable $e) {
                            // Fall back to insertOrIgnore row-by-row to continue
                            foreach ($batch as $record) {
                                try {
                                    DB::table($table)->insertOrIgnore($record);
                                    $inserted++;
                                } catch (\Throwable $e2) {
                                    // give up on this record
                                }
                            }
                        }
                    }

                    return true;
                });

            $totalInserted += $inserted;
            $this->output->writeln("\n[table: {$table}] inserted: {$inserted}");
        });

        if (! $dry) {
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }

        $this->newLine();
        $this->info('Done. Total rows inserted (approx): '.$totalInserted);

        return self::SUCCESS;
    }

    /**
     * Discover concrete Eloquent models under App\\Models.
     *
     * @return list<class-string<\\Illuminate\\Database\\Eloquent\\Model>>
     */
    protected function discoverModels(): array
    {
        $dir = app_path('Models');
        if (! is_dir($dir)) {
            return [];
        }

        $files = File::allFiles($dir);
        $classes = [];

        foreach ($files as $file) {
            if ($file->getExtension() !== 'php') {
                continue;
            }

            $relative = Str::of($file->getPathname())
                ->after(app_path().DIRECTORY_SEPARATOR)
                ->before('.php')
                ->replace(DIRECTORY_SEPARATOR, '\\');

            $class = 'App\\'.(string) $relative;

            if (! class_exists($class)) {
                require_once $file->getPathname();
            }

            if (class_exists($class) && is_subclass_of($class, Model::class)) {
                $ref = new \ReflectionClass($class);
                if (! $ref->isAbstract()) {
                    $classes[] = $class;
                }
            }
        }

        // Ensure unique
        return array_values(array_unique($classes));
    }
}
