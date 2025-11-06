@props(['model'])
<div x-data="signature" class="flex-col" x-modelable="currentSignature" wire:ignore {{ $attributes }} >
    <div class="flex items-center justify-center pb-3" x-bind="clear">
        <span class="pr-2 text-sm text-gray-700 cursor-pointer">Clear</span>
        <x-icon.times />
    </div>
    <canvas class="bg-gray-100 border" x-ref="pad" x-bind="pad" width="400" height="200"
            :id="$id('signature-input')"></canvas>
</div>

