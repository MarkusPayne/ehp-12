@props([
    'sortDir',
    'sortBy',
    'showExport' => false,
     'overlay' => true,
])
<div class="overflow-visible bg-white dark:bg-gray-800" x-data="{ showExport: @js($showExport) }">
    <div class="flex-col flex  sm:flex-row items-center justify-between pb-2 gap-x-4 ">
        <div class="min-w-15 grid grid-cols-12 w-full  sm:w-auto">
            <x-input.group for="perPage" size="12">
                <x-input.select wire:model.live="perPage">
                    @foreach($this->perPageOptions as $option)
                        <option value="{{$option}}"
                                wire:key="datatable-cnt-{{$option}}">{{$option}}</option>
                    @endforeach
                </x-input.select>
            </x-input.group>
        </div>
        <div class="flex items-center justify-between gap-x-4 grow w-full">
            {{ $extraHeading ?? null }}

            <div x-show="showExport">
                <x-icons icon="download" class="cursor-pointer text-primary-600" wire:click="export"/>
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
