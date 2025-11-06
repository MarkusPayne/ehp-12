@props([
    'event' => 'autocomplete-selected',
])

<div
    x-data="autocomplete({ event: '{{ $event }}' })"
    wire:model.live="autocompleteItems"
    x-modelable="items"
    class="relative w-full"
    @click.outside.capture="isTyped=false;"
>
    <div @keyup.escape.window="isTyped = false" @click.outside="isTyped = false">
        <div class="flex items-center">
            <input
                type="text"
                class="flex-1 transition duration-150 ease-in-out"
                placeholder="{{ __('Search ...') }}"
                wire:model.live.debounce.500ms="autocompleteSearch"
                x-model="search"
                x-on:input.debounce.400ms="isTyped = $event.target.value != ''"
                @focusin="open"
                autocomplete="off"
                @keydown.arrow-up="focusPrev"
                @keyup.enter="selectItem"
                @keydown.arrow-down="focusNext"
                aria-label="Search input"
            />
            <x-icon.times class="-ml-8 cursor-pointer text-red-500" @click="clear"></x-icon.times>
        </div>
        <div x-show="isTyped" x-cloak class="absolute z-10 w-full" wire:key="{{ time() }}">
            <ul
                class="z-50 max-h-72 w-full cursor-pointer overflow-y-auto rounded-xs border border-t-0 border-gray-300 bg-white"
            >
                <template x-for="(item, index) in items">
                    <li
                        class="px-2 py-1 text-sm"
                        :x-ref="index"
                        x-text="item.name"
                        :class="{ 'bg-gray-300': focus === index }"
                        @click="selectItem"
                        @mouseenter="setFocus(index)"
                    ></li>
                </template>
            </ul>
        </div>

        <input type="hidden" x-modelable="selectedItem" {{ $attributes->whereStartsWith('wire:model') }}>
    </div>
</div>
@script
<script>
    Alpine.data('autocomplete', (config) => ({
        ...config,
        selectedItem: null,
        items: [],
        search: '',
        focus: 0,
        isTyped: false,
        setFocus(focusIndex) {
            this.focus = focusIndex;
        },

        focusNext() {
            const nextFocusIndex = this.focus + 1;
            const isFocusWithinBound = nextFocusIndex < this.items.length;

            if (this.isTyped && isFocusWithinBound) {
                this.setFocus(nextFocusIndex);
            }
        },
        focusPrev() {
            const prevFocusIndex = this.focus - 1;
            const isFocusWithinBound = prevFocusIndex >= 0;

            if (this.isTyped && isFocusWithinBound) {
                this.setFocus(prevFocusIndex);
            }
        },
        selectItem() {
            this.isTyped = false;
            let item = this.items[this.focus];
            this.selectedItem = item.id;

            if (typeof item == 'undefined') return;

            this.$wire.dispatchSelf(this.event, { data: item });
            this.search = '';
            this.setFocus(0);
            document.activeElement.blur();
        },

        clear() {
            this.isTyped = false;
        },

        open() {
            this.isTyped = true;
            this.search = '';
        },
    }));
</script>
@endscript
