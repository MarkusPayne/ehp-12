<x-buttons
    {{
    $attributes->merge(['class' => 'text-gray-200 bg-red-800 hover:bg-red-700 active:bg-red-600 border-red-600'])
}}
>
    {{ $slot }}
</x-buttons>
