@props([
    'placeholder' => null,
    'options' => [],
])
<div class="relative w-full"

     x-data="multiselect(@js($options))"
     @click.outside.capture="open=false;"
     :id="$id('multiselect-input')"
     {{ $attributes->merge(['class' => 'hidden mt-1']) }}
     x-modelable="current"

>
    
    <div class="flex mt-1 border border-gray-300 rounded-xs">
        <div class="flex flex-wrap flex-auto px-1 min-h-10" x-on:click="open = ! open">

            <template x-for="(selectedOption) in current">
                <div class="flex items-center justify-center py-1 pl-2 m-1 text-sm border border-gray-300 rounded-md ">
                    <div x-text="options[selectedOption]"></div>

                    <div x-on:click.stop="remove(selectedOption)">
                        <x-icons icon="circle-minus" class="mx-2 h-3 w-3 cursor-pointer text-red-600" />
                    </div>
                </div>
            </template>
        </div>

        <div class="flex items-center w-8 ">
            <button type="button" x-on:click="open = !open" x-cloak
                    class="w-6 h-6 text-gray-600 outline-hidden cursor-pointer focus:outline-hidden">
                <x-icons icon="circle-x" x-show="open" class="text-red-600" />
                <x-icons icon="circle-plus" x-show="!open" class="text-green-600" />
            </button>
        </div>
    </div>

    <div x-show.transition.origin.top="open"
         class="absolute z-50 w-full bg-white rounded-xs shadow-xs max-h-64 overflow-y-scroll">
        <template x-for="(option,optionId) in options" :key="optionId">
            <div class="border-b border-gray-200 cursor-pointer " x-on:click="select(optionId);">
                <div x-bind:class="{ 'bg-green-200': isSelected(optionId) }"
                     class="relative flex items-center w-full p-2 pl-2 border-l-2 border-transparent">
                    <div class="flex items-center w-full">
                        <div class="mx-2" x-text="option"></div>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>




