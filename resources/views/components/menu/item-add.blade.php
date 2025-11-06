<x-menu.close>
    <x-menu.item {{ $attributes }}>

        <x-icons icon="circle-plus" class=" text-green-500" {{$attributes->whereStartsWith('class')}}/>
        @if ($slot->isEmpty())
            Add
        @else
            {{ $slot }}
        @endif
    </x-menu.item>
</x-menu.close>
