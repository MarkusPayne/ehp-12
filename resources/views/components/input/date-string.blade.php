@props([
'leadingAddOn' => false,
'type' => 'text',
])

<div class="flex rounded-md shadow-xs">
    @if ($leadingAddOn)
    <span
        class="inline-flex items-center px-3 text-gray-500 border border-r-0 border-gray-300 rounded-l-md bg-gray-50 sm:text-sm">
        {{ $leadingAddOn }}
    </span>
    @endif

    <input type="{{$type}}" autocomplete="off" {{ $attributes->merge(['class' => 'flex-1 border-gray-300 block w-full
    transition duration-150 ease-in-out ' . ($leadingAddOn ? ' rounded-none rounded-r-md' : '')]) }}
    wire:change="$emitSelf('saveValue')" />
</div>
