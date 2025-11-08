@props([
    'route' => false,
    'menuTitle',
])
<div x-cloak>
    <div
        class="hidden lg:block"
        x-data="{
        menuOpen: false,
        closeTimer: null,
        scheduleClose() {
            this.clearClose()
            this.closeTimer = setTimeout(() => (this.menuOpen = false), 500) // 200ms delay
        },
        clearClose() {
            this.menuOpen = true
            if (this.closeTimer) {
                clearTimeout(this.closeTimer)
                this.closeTimer = null
            }
        },
    }">
        <div x-menu x-model="menuOpen" class="relative flex items-center" {{ $attributes }} wire:ignore>
            <a
                x-menu:button
                x-on:mouseenter="clearClose()"
                x-on:mouseleave="scheduleClose()"
                {{ $attributes->class(['-mx-3 block rounded-lg px-3 py-2 text-base leading-7 font-medium text-zinc-500 hover:text-primary sm:mx-0 sm:text-sm dark:text-zinc-200','!font-semibold !text-primary' => request()->route()->getName() == $route,]) }}
            >
            <span class="flex items-center">
                {{ __($menuTitle) }}
                <x-icons icon="chevron-down" class="h-3 w-3"/>
            </span>
            </a>

            <x-menu.items x-on:mouseenter="clearClose()" x-on:mouseleave="scheduleClose()">
                {{ $slot }}
            </x-menu.items>
        </div>
    </div>

    <div
        class="block lg:hidden"
        x-data="{ expanded: false, 'activeClass': '{{request()->route()->getName() == $route}}',init() { this.expanded = this.activeClass }  }" {{ $attributes }}>
        <button @click="expanded = ! expanded">
        <span class="flex items-center "
              :class="activeClass && '!font-semibold !text-primary'"
        >
            {{ __($menuTitle) }}
            <x-icons icon="chevron-down" class="h-3 w-3"/>
        </span>
        </button>

        <div x-show="expanded" class="pl-3" x-collapse>
            {{ $slot }}
        </div>
    </div>

</div>
