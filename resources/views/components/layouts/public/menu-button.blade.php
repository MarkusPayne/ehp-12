<div
    {{ $attributes->class(['primary-background secondary-border sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b-1 px-4 shadow-xs sm:gap-x-6 sm:px-6 lg:px-8']) }}
>
    <div class="flex-none" :class="{ 'hidden': clipboard }">
        <button type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden" @click="openSidebar = true">
            <span class="sr-only">Open sidebar</span>
            <svg
                class="h-6 w-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                aria-hidden="true"
            >
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>
    </div>
    <div class="flex flex-1 items-center justify-center">
        <a wire:navigate href="{{ route('home') }}">
            <x-app-logo class="h-8! w-auto! lg:hidden" />
        </a>
    </div>
    <div class="flex flex-none gap-x-4 self-stretch lg:gap-x-6">
        <div class="flex items-center gap-x-4 lg:gap-x-6">
            <!-- Separator -->
            <div class="hidden lg:block lg:h-6 lg:w-px lg:bg-gray-900/10" aria-hidden="true"></div>

            <x-menu>
                <x-menu.button class="flex items-center rounded-xs p-1">
                   lang

                    <span
                        class="hidden text-gray-700 hover:text-gray-900 lg:flex lg:items-center dark:text-gray-300 dark:hover:text-gray-100"
                    >
                        <span class="ml-4 text-sm leading-6 font-semibold" aria-hidden="true">
                           lang
                        </span>
                        <svg class="ml-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path
                                fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </span>
                </x-menu.button>


            </x-menu>
        </div>
    </div>
</div>
