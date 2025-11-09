<div
    x-menu:items
    {{-- x-transition:enter.origin.top.right --}}
    x-anchor.bottom-start="document.getElementById($id('alpine-menu-button'))"
    {{ $attributes->merge(['class' => 'z-20 w-max min-w-54 divide-y divide-gray-200 border border-gray-200 bg-gray-100 py-1 shadow-xs outline-hidden dark:divide-gray-900 dark:border-gray-700 dark:bg-gray-800']) }}
    x-cloak>
    {{ $slot }}
</div>
