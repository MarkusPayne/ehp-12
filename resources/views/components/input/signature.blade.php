@props([
    'model',
])
<div x-data="signature" class="flex-col" x-modelable="currentSignature" wire:ignore {{ $attributes }}>
    <div class="flex items-center justify-center pb-3" x-bind="clear">
        <span class="cursor-pointer pr-2 text-sm text-gray-700">Clear</span>

        <x-icons icon="x" />
    </div>
    <canvas class="border bg-gray-100" x-ref="pad" x-bind="pad" width="400" height="200" :id="$id('signature-input')"></canvas>
</div>
