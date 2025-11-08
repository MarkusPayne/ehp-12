<div
    x-menu:items
    {{--    x-transition:enter.origin.top.right--}}
    x-anchor.bottom-start="document.getElementById($id('alpine-menu-button'))"

    {{ $attributes->merge(['class' => 'z-20 w-max min-w-54 divide-y divide-gray-100 rounded-md border border-gray-200 bg-white py-1 shadow-md outline-hidden dark:divide-gray-900 dark:border-gray-700 dark:bg-gray-800']) }}

    x-cloak
>
    {{ $slot }}
</div>
