<x-menu.close>
    <x-menu.item {{ $attributes }}>

        <x-icons icon="arrow-up-right-from-square" class="text-blue-600" {{$attributes->whereStartsWith('class')}}/>
        @if ($slot->isEmpty())
            Preview
        @else
            {{ $slot }}
        @endif
    </x-menu.item>
</x-menu.close>
