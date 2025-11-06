<?php

namespace App\Livewire;

use App\Exports\DataTableExport;
use App\Jobs\NotifyUserOfCompletedExport;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Isolate;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Maatwebsite\Excel\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

// php artisan make:livewire TableName --stub=datatable

// @TODO refactor this to use a trait?
class DataTable extends Component
{
    use WithoutUrlPagination, WithPagination;

    public ?int $perPage = 10;

    public string $sortBy = 'id';

    public string $sortDir = 'DESC';

    // @TODO make this required in classes that extend
    public string $tableName = 'data-table';

    // public string $cacheKey;
    public array $perPageOptions = [5, 10, 25, 50, 100];

    public array $selectedRows = [];

    public $selectAll = false;

    public bool $cursor = false;

    // @TODO move this to export trait
    public ?array $tableExportHeadings = null;

    #[Computed]
    public function cacheKey(): string
    {
        // return $this->cacheKey = $this->tableName.'.'.auth()->id().'.';
        return $this->tableName.'.'.auth()->id().'.';
    }

    // @TODO test this, maybe updated evet to unset rows
    // #[Computed(persist: true)]
    /**
     * Retrieve and paginate the table rows.
     */
    #[Computed]
    public function rows(): CursorPaginator|LengthAwarePaginator
    {
        $this->retrieveSelectionsFromCache();
        $query = $this->tableQuery();

        return $this->sortAndPaginate($query);
    }

    /**
     * Handle updates to the per-page setting.
     *
     * This method updates the cache with the current per-page value,
     * resets the pagination to the first page, and clears any existing rows.
     */
    public function updatedPerPage(): void
    {
        Cache::put($this->cacheKey.'perPage', $this->perPage);
        $this->resetPage();
        $this->resetRows();
    }

    /**
     * Handles the page updating event and resets the rows.
     *
     * @param  mixed  $page  The current page being updated.
     */
    public function updatingPage($page): void
    {
        $this->resetRows();
    }

    /**
     * Updates the sorting criteria and caches the value.
     * Resets the currently loaded rows after updating.
     */
    public function updatedSortBy(): void
    {
        Cache::put($this->cacheKey.'sortBy', $this->sortBy);
        $this->resetRows();
    }

    /**
     * Update and cache the sort direction, then reset the rows.
     */
    public function updatedSortDir(): void
    {
        Cache::put($this->cacheKey.'sortDir', $this->sortDir);
        $this->resetRows();
    }

    /**
     * Reload the table data by resetting the rows.
     */
    #[On('reload-table')]
    public function reload(): void
    {
        $this->resetRows();
    }

    /**
     * Resets the search input, pagination, and row data for the current view.
     */
    #[On('reset-search')]
    public function resetSearch(): void
    {
        $this->reset('search');
        $this->resetPage();
        $this->resetRows();
    }

    /**
     * Retrieve the base query builder instance for the table.
     *
     * @return Builder The query builder instance.
     */
    public function tableQuery(): Builder
    {

        // @TODO refactor this to handle null
        return Model::query();
    }

    /**
     * Retrieve pagination and sorting selections from the cache and set them to the current instance.
     * If the cache does not contain the values, the existing values will be stored and reused.
     */
    private function retrieveSelectionsFromCache(): void
    {
        $this->perPage = Cache::rememberForever($this->cacheKey.'perPage', function () {
            return $this->perPage;
        });
        $this->sortBy = Cache::rememberForever($this->cacheKey.'sortBy', function () {
            return $this->sortBy;
        });
        $this->sortDir = Cache::rememberForever($this->cacheKey.'sortDir', function () {
            return $this->sortDir;
        });
    }

    /**
     * Sorts the query results by the specified column and direction,
     * then paginates the results based on the given page size.
     */
    #[Isolate]
    private function sortAndPaginate(Builder $query): CursorPaginator|LengthAwarePaginator
    {
        if ($this->cursor) {
            return $query->orderBy($this->sortBy, $this->sortDir)->cursorPaginate($this->perPage);
        }

        return $query->orderBy($this->sortBy, $this->sortDir)->paginate($this->perPage);
    }

    /**
     * Resets the selected rows and selection state.
     *
     * This method clears the array of selected rows and sets
     * the select-all checkbox to false. It also unsets the
     * paginated rows property to force a reload.
     */
    public function resetRows(): void
    {
        $this->selectedRows = [];
        $this->selectAll = false;
        unset($this->rows);
    }

    /**
     * Handles the export functionality for a table.
     *
     * If table export headings are defined, a precise export will be processed.
     * Otherwise, it performs a query on the table, orders the result based on the specified column and direction,
     * and downloads the table data as an Excel file.
     */
    // @TODO move this to trait?
    #[On('export-table')]
    public function export(): Response|BinaryFileResponse
    {
        $query = $this->tableQuery()->orderBy($this->sortBy, $this->sortDir);
        $name = Str::afterLast($this->tableName, '.').'.xlsx';

        return $query->downloadExcel($name, Excel::XLSX, true);
    }

    // @TODO this does not work, can not serialize PDO

    /**
     * Handles the exact export functionality for a table.
     *
     * Executes a query on the table and utilizes defined headings for the export.
     * A `DataTableExport` instance is created, with the ability to map data using a specific callback.
     * The method generates and downloads an Excel file with the provided structure.
     * Additionally, supports queuing a job to notify the user once the export is completed.
     */
    #[On('export-table-exact')]
    public function exportExact(): Response|BinaryFileResponse
    {

        $query = $this->tableQuery()->orderBy($this->sortBy, $this->sortDir); // ->orderBy($this->sortBy, $this->sortDir);
        $name = Str::afterLast($this->tableName, '.').'.xlsx';
        $export = new DataTableExport($query, $this->tableExportHeadings);
        $export->setMapCallback([$this::class, 'mapCallback']);

        return $export->download($name, Excel::XLSX);

        //        $export->store($name)->chain([
        //            new NotifyUserOfCompletedExport(auth()->user(), $name),
        //        ]);
        //        $this->notify('Job queued, you will be emailed once complete', 'Success!', 'success');
        //
        //
    }

    /**
     * Maps a given row to an array format.
     *
     * This method converts the provided row's data into an array structure,
     * enabling easy processing or transformation of the row's contents.
     */
    public static function mapCallback($row): array
    {
        return $row->toArray();
    }
}
