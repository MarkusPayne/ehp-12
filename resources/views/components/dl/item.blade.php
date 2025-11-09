<div {{ $attributes->class(['px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0']) }}>
    <dt class="text-sm font-medium text-gray-700">{{ __($label) }}</dt>
    <dd class="mt-1 text-sm text-gray-700 sm:col-span-2 sm:mt-0">
        {{ __($slot->toHtml() ?? '') }}
    </dd>
    <div class="col-span-3 text-xs">{{ $note ?? '' }}</div>
</div>
