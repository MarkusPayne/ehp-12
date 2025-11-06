<?php

namespace App\Traits;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Livewire\Attributes\Url;

trait WithSearch
{
    public array $filters = [];

    #[Url]
    public array $search = [];

    public array $pivotTables = [];

    public string $tableSearchString = '';

    public array $tableSearchFields = [];

    public function clearSearch(): void
    {
        $this->reset('search');
        // $this->dispatch('date-reset')->self();
        // $this->dispatch('multiselect-reset')->self();
    }

    public function applySearch($query)
    {

        // deal with array values
        Arr::where(
            $this->filters,
            function ($value, $key) {
                if ($value == 'in') {
                    $type = Arr::get($this->search, $key);
                    if (is_array($type) && count($type) > 0) {
                        Arr::set($this->search, $key, implode(',', $type));
                    } else {
                        Arr::forget($this->search, $key);
                        $parentKey = Str::beforeLast($key, '.'); // Get the parent key
                        if (empty(Arr::get($this->search, $parentKey))) {
                            Arr::forget($this->search, $parentKey); // Forget the parent if it's empty
                        }

                    }
                }

                return true;
            }
        );

        foreach (Arr::dot($this->search) as $field => $value) {

            if (trim($value) != '') {

                switch ($this->filters[$field]) {
                    case 'like':
                        $terms = Str::of($value)->trim()->explode(' ')->unique();
                        foreach ($terms as $term) {
                            if (Str::of($term)->trim()->isNotEmpty()) {
                                $query->where($field, 'like', '%'.$term.'%');
                            }
                        }

                        break;
                    case 'text':
                        // this is for full text search but only works for full words
                        $terms = Str::of($value)->trim()->explode(' ')->unique();
                        foreach ($terms as $term) {
                            if (Str::of($term)->trim()->isNotEmpty()) {
                                // $query->whereFullText($field, $term);
                                $query->where($field, 'like', '%'.$term.'%');
                            }
                        }

                        break;
                    case 'match':
                        // Split the value into words and process them
                        $words = Str::of($value)
                           // ->replaceMatches('/[^a-zA-Z0-9\s]/', ' ')
                            ->replaceMatches('/[^a-zA-Z0-9\s&]/', ' ')
                            ->replaceMatches('/&/', '\&')
                            ->explode(' ')
                            ->filter()
                            ->unique();

                        // Separate words into two arrays based on length

                        $shortWords = $words->filter(fn ($word) => Str::length($word) <= 2 || Str::contains($word, '&'))->values();
                        //     $specialWords = $words->filter(fn ($word) => Str::length($word) > 2)->filter(fn ($word) => Str::contains($word, '&'))->values();
                        $longWords = $words->reject(fn ($word) => Str::contains($word, '&'))->filter(fn ($word) => Str::length($word) > 2)->values();

                        // Process long words for full-text search
                        $matchTerm = $longWords
                            ->map(fn ($value) => Str::of($value)->trim()->prepend('+')->append('*'))
                            ->join(' ');

                        // Apply the queries
                        if (Str::of($matchTerm)->trim()->isNotEmpty()) {
                            $query->whereFullText($field, $matchTerm, ['mode' => 'boolean']);
                        }

                        // Apply LIKE queries for short words
                        foreach ($shortWords as $shortWord) {
                            if (Str::of($shortWord)->trim()->isNotEmpty()) {
                                $query->whereLike($field, '%'.$shortWord.'%');
                            }
                        }
                        break;
                    case 'in':
                        $arr = explode(',', $value);
                        $query->whereIn($field, $arr);
                        Arr::set($this->search, $field, $arr);
                        break;
                    case 'pivot':
                        // @TODO replace with whereRelation
                        $query->whereHas(
                            $this->pivotTables[$field],
                            function ($q) use ($value, $field) {
                                $q->where($field, $value);
                            }
                        );
                        break;
                    case 'range':
                        $range = Str::of($value)->trim()->explode(' to ');
                        if (count($range) == 2) {
                            $query->whereDate($field, '<=', $range[1]);
                            $query->whereDate($field, '>=', $range[0]);
                        } else {
                            $query->whereDate($field, $range[0]);
                        }
                        break;
                    default:
                        if (Str::lower($value) == 'null') {
                            $query->whereNull($field);
                        } else {
                            $query->where($field, $this->filters[$field], $value);
                        }

                        break;
                }
            } else {
                Arr::forget($this->search, $field);
                $parentKey = Str::beforeLast($field, '.'); // Get the parent key
                if (empty(Arr::get($this->search, $parentKey))) {
                    Arr::forget($this->search, $parentKey); // Forget the parent if it's empty
                }
            }
        }

        return $query->when(
            $this->tableSearchString,
            function ($query, $string) {
                $query->where(
                    function ($query) use ($string) {
                        foreach ($this->tableSearchFields as $field) {
                            $terms = Str::of($string)->trim()->explode(' ');
                            foreach ($terms as $term) {
                                if (Str::of($term)->trim()->isNotEmpty()) {
                                    $query->orWhere($field, 'like', '%'.$term.'%');
                                }
                            }
                        }
                    }
                );
            }
        );
    }
}
