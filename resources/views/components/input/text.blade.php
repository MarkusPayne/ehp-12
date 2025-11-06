@props([
    'leadingAddOn' => false,
    'type' => 'text',
    'editable' => false,
    'readonly' => false,
])


<div class="flex items-center grow">
    @if ($leadingAddOn)
        <span
            class="inline-flex items-center px-3 text-gray-500 border border-r-0 border-gray-300 rounded-l-md bg-gray-50 sm:text-sm">
                {{ $leadingAddOn }}
            </span>
    @endif

    <input autofocus {{ $readonly ? 'readonly' : '' }} type="{{ $type }}" autocomplete="off"
           name="{{ $attributes->wire('model')->value() }}" id="{{ $attributes->wire('model')->value() }}"
        {{ $attributes->merge([
            'class' => 'flex-1 transition duration-150 ease-in-out is-invalid dark:text-gray-100 dark:bg-gray-500',
            'text-right' => $type == 'number',
            'rounded-none rounded-r-md' => $leadingAddOn,
        ]) }}
    />


    {{ $after ?? '' }}

</div>
