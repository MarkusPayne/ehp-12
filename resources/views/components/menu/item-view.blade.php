<x-menu.close>
    <x-menu.item {{ $attributes }}>

        <x-icons icon="eye" class=" text-green-600" {{$attributes->whereStartsWith('class')}}/>
        @if ($slot->isEmpty())
            View
        @else
            {{ $slot }}
        @endif
    </x-menu.item>
</x-menu.close>
