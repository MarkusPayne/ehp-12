@props([
   // 'targetModel' => $attributes->wire('model')->value(),
    // 'colorSelected' => null,
])
<div x-data="colorpicker" class="relative w-full"
     @click.outside.capture="isOpen = false">
    <div @keyup.escape.window="isOpen = false">

        <input type="text" {{$attributes }} x-modelable="current" class="hidden">
        <div class="flex h-10 mt-1 border border-gray-300 rounded-xs">
            <div class="flex flex-wrap flex-auto px-1" @click="isOpen = ! isOpen">

                <div class="flex items-center justify-center ">
                    <div class="px-2 py-1 m-1 text-sm border rounded-md"
                         :class="`bg-${selected.color} text-${selected.inverse}`" x-text="selected.name"></div>
                    <!--  <div @click.stop="remove(index,option)">
                        <x-icon.trash size="w-4 h-4" class="m-1" />
                    </div> -->
                </div>

                <div x-show="selected.length == 0">
                    <input type="text" placeholder="Select a Color" class="border-none">
                </div>
            </div>
            <div class="flex items-center w-8 ">
                <button type="button" @click="isOpen = !isOpen" x-cloak
                        class="w-6 h-6 text-gray-600 outline-hidden cursor-pointer focus:outline-hidden">
                    <x-icon.times x-show="isOpen"/>
                    <x-icon.plus x-show="!isOpen"/>
                </button>
            </div>
        </div>


        <div x-show="isOpen" x-cloak class="absolute z-10 w-full">
            <div @click.outside="isOpen = false"
                 class="z-50 flex flex-wrap w-full p-2 overflow-y-auto bg-white border border-t-0 border-gray-300 rounded-xs cursor-pointer max-h-72">
                <template x-for="(color, index) in colors" :key="index">
                    <div class="flex px-2">
                        <template x-if="current === color.color">
                            <div class="inline-flex w-8 h-8 m-2 border rounded-full cursor-pointer"
                                 :class="`bg-${color.color} text-${color.inverse}`"></div>
                        </template>

                        <template x-if="current != color.color">
                            <div @click="selectItem(index)" role="checkbox" tabindex="0" :aria-checked="current"
                                 class="inline-flex w-8 h-8 m-2 border rounded-full cursor-pointer focus:outline-hidden focus:shadow-outline"
                                 :class="`bg-${color.color} text-${color.inverse}`"></div>
                        </template>
                    </div>
                </template>
            </div>
        </div>
    </div>
</div>
@script
<script>

    Alpine.data('colorpicker', () => ({
        selected: false,
        isOpen: false,
        current: '',
        colors: [{
            color: 'red-500',
            inverse: 'white',
            name: 'red'
        }, {
            color: 'yellow-400',
            inverse: 'white',
            name: 'yellow'
        }, {
            color: 'blue-500',
            inverse: 'white',
            name: 'blue'
        }, {
            color: 'green-500',
            inverse: 'white',
            name: 'green'
        }, {
            color: 'white',
            inverse: 'black',
            name: 'white'
        }, {
            color: 'gray-500',
            inverse: 'white',
            name: 'gray'
        },


        ],
        init() {
            this.$watch("current", () => this.loadOptions());
            this.isOpen = false;

        },
        loadOptions() {
            this.selected = '';
            for (let i = 0; i < this.colors.length; i++) {
                if (this.colors[i].color === this.current) {
                    this.selected = this.colors[i]
                }
            }
        },
        selectItem(i) {
            this.isOpen = false;
            this.selected = this.colors[i];
            this.current = this.colors[i].color

            //   this.clear()
        },

        clear() {
            this.isOpen = false;
            this.selected = '';
        }


    }));
</script>

@endscript
