<nav class="flex items-center justify-between max-w-7xl mx-auto p-3 lg:px-8" aria-label="Global">
    <div class="flex lg:flex-1">
        <a href="{{ route('home') }}" class="-m-1.5 p-1.5">
            <span class="sr-only">{{config('app.name')}}</span>
            <x-app-logo class="h-10!" />
        </a>
    </div>
    <div class="flex lg:hidden">
        <button
            type="button"
            class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-400"
            @click="open = ! open"
        >
            <span class="sr-only">Open main menu</span>
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
    <div class="hidden lg:flex lg:gap-x-4">
       <x-layouts.public.menu-items/>

    </div>

</nav>
