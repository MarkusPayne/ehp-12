<x-buttons
    {{
    $attributes->merge([
        'type' => 'button',
        'class' => 'text-gray-200 bg-primary-700 hover:bg-primary-500 active:bg-primary-600 disabled:opacity-50 border-primary-600',
    ])
}}
>
    {{ $slot }}
</x-buttons>
