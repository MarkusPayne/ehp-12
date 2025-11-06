@props([
    'sortDir',
    'sortBy',
    'showExport' => false,
     'overlay' => true,
])
<div class="overflow-visible bg-white dark:bg-gray-800" x-data="{ showExport: @js($showExport) }">
    {{-- <div wire:loading.delay.long class="absolute inset-0 bg-white opacity-50"> --}}
    {{-- <div wire:loading.flex class="flex justify-center items-center absolute inset-0"> --}}
    {{-- <x-icon.spinner class="text-primary-600"/> --}}
    {{-- </div> --}}
    {{-- </div> --}}

    <div class="flex items-center justify-between pb-2">
        <div>
            <x-input.select wire:model.live="perPage">
                @foreach($this->perPageOptions as $option)
                    <option value="{{$option}}"
                            wire:key="datatable-cnt-{{$option}}">{{$option}}</option>
                @endforeach

            </x-input.select>
        </div>
        <div class="flex items-center justify-between gap-x-4 pb-3">
            {{ $extraHeading ?? null }}

            <div x-show="showExport">
                <x-icons icon="download" class="cursor-pointer text-primary-600" wire:click="export" />
            </div>
        </div>
    </div>
    <div class="table w-full border-collapse dark:bg-gray-700">
        {{ $slot }}
    </div>
    <div class="grid grid-cols-1">
        <div class="col pt-10 dark:bg-gray-800 dark:text-gray-200">
            {{ $this->rows->links() }}
        </div>
    </div>

</div>
