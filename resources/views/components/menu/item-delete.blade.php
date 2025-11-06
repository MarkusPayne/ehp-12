<x-menu.close>
    <x-menu.item wire:confirm.prompt="Are you sure?\n\nType DELETE to confirm|DELETE" {{ $attributes }}>
        <x-icons icon="trash-can" class="h-4 w-4 text-red-600" {{ $attributes->whereStartsWith('class') }} />
        @if ($slot->isEmpty())
            Delete
        @else
            {{ $slot }}
        @endif
    </x-menu.item>
</x-menu.close>
