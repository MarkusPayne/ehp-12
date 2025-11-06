<div class="lg:hidden" role="dialog" aria-modal="true">
    <!-- Background backdrop, show/hide based on slide-over state. -->
    <div x-show="open" x-transition.opacity class="fixed inset-y-0 right-0 w-full max-w-lg"></div>
    <div
        x-show="open"
        x-transition:enter="transition duration-200 ease-out"
        x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition duration-200 ease-in"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-gray-900 px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10"
    >
        <div class="flex items-center justify-between">
            <a href="#" class="-m-1.5 p-1.5">
                <span class="sr-only">{{config('app.name')}}</span>
                <x-app-logo-light />
            </a>
            <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-400" x-on:click="open = ! open">
                <span class="sr-only">Close menu</span>
                <svg
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    aria-hidden="true"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="pt-6">
            <div class="">
                <div class="space-y-2 py-4 dark">
                    <x-layouts.public.menu-items/>
                </div>
            </div>
        </div>
    </div>
</div>
