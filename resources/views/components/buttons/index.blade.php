@props([
    'disabled' => false,
    'readonly' => false,
])
<button
    {{-- type="submit" --}}
    wire:loading.attr="disabled"
    @disabled($disabled)
    {{
        $attributes->merge([
            'type' => 'button',
            'class' => 'flex items-center py-2 px-4 border rounded-xs text-sm tracking-wide font-semibold focus:outline-hidden focus:border-blue-300 focus:shadow-outline-blue transition duration-150 ease-in-out' . ($attributes->get('disabled') ? ' opacity-75 cursor-not-allowed' : ''),
        ])
    }}
>
    {{ $slot }}
</button>
