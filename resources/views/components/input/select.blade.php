@props([
    'placeholder' => null,
    'showEmpty' => true,
    'readonly' => false,
])


<select {{ $readonly ? 'readonly' : '' }}
        name="{{ $attributes->wire('model')->value() }}" id="{{ $attributes->wire('model')->value() }}"
    {{ $attributes->merge(['class' => 'pr-8 dark:text-gray-100 dark:bg-gray-500']) }} >

    @if ($placeholder)
        <option value=""> -- {{ __($placeholder) }} --</option>
    @else
        @if ($showEmpty)
            <option></option>
        @endif
    @endif

    {{ $slot }}
</select>
