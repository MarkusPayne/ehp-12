<x-menu.close>
    <x-menu.item {{ $attributes }}>
        <x-icons icon="paper-plane-top" class="text-primary-600" {{ $attributes->whereStartsWith('class') }} />
        @if ($slot->isEmpty())
            Add
        @else
            {{ $slot }}
        @endif
    </x-menu.item>
</x-menu.close>
