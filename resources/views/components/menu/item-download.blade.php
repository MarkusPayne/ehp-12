<x-menu.close>
    <x-menu.item {{ $attributes }}>

        <x-icons icon="folder-arrow-down" class=" text-gray-600" {{$attributes->whereStartsWith('class')}}/>
        @if ($slot->isEmpty())
            Add
        @else
            {{ $slot }}
        @endif
    </x-menu.item>
</x-menu.close>
