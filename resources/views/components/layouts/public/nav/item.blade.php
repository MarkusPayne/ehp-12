@props([
    "route" => false,
    "routeParameters" => null,
    'section' => null
])
<div x-data="{menuSection: '{{$section}}', 'activeClass': '{{request()->route()->getName() == $route}}' }">
    <a
        @if ($route && $route != request()->route()->getName() )
            href="{{ route($route, $routeParameters) }}"
        @endif
        {{ $attributes->class(["-mx-3 block rounded-lg px-3 py-2 text-base leading-7 font-medium text-zinc-500 hover:text-primary sm:mx-0 sm:text-sm dark:text-zinc-200"]) }}
        :class="(activeClass && (!menuSection || menuSection == activeSection )) && '!font-semibold !text-primary'"
    >
        {{ __($slot->toHtml() ?? "") }}
    </a>
</div>
