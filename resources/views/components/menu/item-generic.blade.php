@props([
    'icon' => 'eye'
])
<x-menu.close>
    <x-menu.item {{ $attributes }}>
        <x-icons icon="{{$icon}}" {{$attributes->whereStartsWith('class')}}/>
        {{$slot}}
    </x-menu.item>
</x-menu.close>
