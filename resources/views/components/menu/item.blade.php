<button
    type="button"
    x-menu:item
    {{-- x-bind:class="{ --}}
    {{-- 'bg-slate-100 text-gray-900': $menuItem.isActive, --}}
    {{-- 'text-gray-600': ! $menuItem.isActive, --}}
    {{-- 'opacity-50 cursor-not-allowed': $menuItem.isDisabled, --}}
    {{-- }" --}}
    class="flex w-full min-w-min grow items-center gap-2 px-3 py-2 text-left text-sm transition-colors hover:bg-slate-50 disabled:text-gray-500 dark:text-gray-200 dark:hover:bg-slate-700 dark:disabled:text-gray-400"
    {{ $attributes }}
>
    {{ $slot }}
</button>
