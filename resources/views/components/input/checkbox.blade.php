@props([
    'disabled' => false,
    'readonly' => false,
])
<div class="flex items-center">
    <input {{ $disabled ? 'disabled' : '' }} {{ $readonly ? 'readonly' : '' }} {{ $attributes }} type="checkbox"
           name="{{ $attributes->wire('model')->value() }}" id="{{ $attributes->wire('model')->value() }}"
           class="block py-2 transition duration-150 ease-in-out " />
</div>
