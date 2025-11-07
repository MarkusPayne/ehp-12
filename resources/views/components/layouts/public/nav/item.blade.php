@props([
    "route" => false,
    "routeParameters" => null,
])
<a
    @if ($route)
        href="{{ route($route, $routeParameters) }}"
    @endif
    {{ $attributes->class(["-mx-3 block rounded-lg px-3 py-2 text-base leading-7 font-medium text-zinc-500 dark:text-zinc-200 hover:text-primary sm:mx-0 sm:text-sm","primary-active" => request()->route()->getName() == $route,]) }}
    {{-- wire:current="primary-active" --}}
>
    {{ $slot }}
</a>
