<?php

namespace App\Traits\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use RuntimeException;

trait SelectOptions
{
    /**
     * The name of the options table.
     */
    public static string $optionsTableName = '';

    public static string $optionsTableCacheKey = '';

    public static ?string $orderByRaw = null;

    /**
     * Determines whether to use caching for options.
     */
    protected static bool $useOptionsCache = true;

    /**
     * Determines whether to use active status.
     */
    public static bool $activeStatus = false;

    protected static function bootSelectOptions(): void
    {
        static::saved(function () {
            static::forgetOptionsCache();
        });
    }

    public static function setActiveStatus(bool $use): void
    {
        static::$activeStatus = $use;
    }

    public static function getActiveStatus(): bool
    {
        return static::$activeStatus;
    }

    /**
     * Sets the options table name.
     *
     * @param  string  $name  The name of the options table.
     */
    public static function setOptionsTableName(string $name): void
    {
        static::$optionsTableName = $name;
    }

    /**
     * Retrieves the options table name.
     *
     * @return string The name of the options table.
     */
    public static function getOptionsTableName(): string
    {
        return static::$optionsTableName;
    }

    /**
     * Set whether to use caching for options.
     */
    public static function setOptionsCacheStatus(bool $useOptionsCache): void
    {
        static::$useOptionsCache = $useOptionsCache;
    }

    /**
     * Get whether caching is used for options.
     */
    public static function getOptionsCacheStatus(): bool
    {
        return static::$useOptionsCache;
    }

    // add get and set methods for $optionsTableCacheKey
    public static function getOptionsTableCacheKey(): string
    {
        return static::$optionsTableCacheKey;
    }

    public static function setOptionsTableCacheKey(string $key): void
    {
        static::$optionsTableCacheKey = static::$optionsTableName.'.Options.'.$key;
    }

    public static function forgetOptionsCache(): void
    {
        Cache::forget(static::$optionsTableCacheKey);
    }

    /**
     * Get the table name of the model using this trait
     */
    protected static function getTableName(): string
    {
        return class_basename(static::class);

        //        static $instance = null;
        //
        //        if ($instance === null) {
        //            $instance = new static();
        //        }
        //
        //        return $instance->getTable();
    }

    /**
     * Gets the options from the options table.
     *
     * @param  array  $parameters  The parameters to filter the options.
     * @return Collection The collection of options.
     */
    public static function getOptions(array $parameters = []): Collection
    {
        // Set the options table name to the table of the current class.
        static::setOptionsTableName(static::getTableName());
        static::setOptionsTableCacheKey($parameters['cacheKey'] ?? '');
        // Prepare parameters used for getting options.
        $parameters = static::prepareParameters($parameters);

        // This makes it possible to use array elements as variables for the rest of the function.
        extract($parameters);

        // Sets the options cache status using the useOptionsCache parameter
        static::setOptionsCacheStatus($parameters['useOptionsCache']);

        // If cache is enabled and cache has options table options, try getting options from cache.
        if (static::$useOptionsCache && cache()->has(static::$optionsTableCacheKey)) {
            try {
                return cache()->get(static::$optionsTableCacheKey);
            } catch (NotFoundExceptionInterface|ContainerExceptionInterface $e) {
                // In case of exception while retrieving from cache, throw a runtime exception.
                throw new RuntimeException('Error retrieving cached options: '.$e->getMessage(), $e->getCode(), $e);
            }
        }

        // Apply filters to the query
        $query = static::applyFilters($parameters['filters']);

        // Get and format options from the query
        $options = static::getOptionQuery($query, $parameters['key'], $parameters['sortBy'])->get()->unique($parameters['key'])->pluck($parameters['value'], $parameters['key']);

        // If cache is enabled, remember the options in the cache and return them
        if (static::$useOptionsCache) {
            return Cache::remember(
                static::$optionsTableCacheKey,
                $parameters['cacheDuration'],
                function () use ($options) {
                    return $options;
                }
            );
        }

        // if cache is not enabled, simply return the options
        return $options;
    }

    /**
     * Prepare parameters by merging with default ones.
     */
    protected static function prepareParameters(array $parameters): array
    {

        $default = [
            'key' => 'id',
            'value' => 'name',
            'filters' => [],
            'cacheDuration' => 300,
            'sortBy' => 'name',
            'useOptionsCache' => true,
        ];

        return array_merge($default, $parameters);
    }

    /**
     * Get options by ID from the database table.
     */
    public function getOptionsById(string $key = 'id', string $value = 'name', array $filters = []): Collection
    {
        $query = static::applyFilters($filters);

        return $this->getOptionQuery($query, $key, $value)->orderBy($key)->get()->unique($key)->pluck($value, $key);
    }

    /**
     * Apply filters to the query.
     */
    protected static function applyFilters(array $filters): Builder
    {
        //        $query = (new static)->query();

        $query = static::query();

        if (static::getActiveStatus()) {
            $query->where('active', 1);
        }

        foreach ($filters as $filter) {
            if (isset($filter['pivot'])) {
                $query->whereHas($filter['pivot'], function ($query) use ($filter) {
                    if (! empty($filter['value'])) {
                        if (is_array($filter['value'])) {
                            $query->whereIn($filter['field'], $filter['value']);

                        } else {
                            $query->where($filter['field'], $filter['type'], $filter['value']);
                        }

                    }

                });
            } else {
                $query->where($filter['field'], $filter['type'], $filter['value']);
            }

        }

        return $query;
    }

    /**
     * Get the option query.
     */
    protected static function getOptionQuery(Builder $query, string $key, string $value): Builder
    {
        if (static::$orderByRaw) {
            return $query->orderByRaw(static::$orderByRaw);
        }

        return $query->orderBy($value);
    }
}
