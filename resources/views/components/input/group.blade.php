@props([
    'label' => false,
    'for' => false,
    'error' => false,
    'helpText' => false,
    'inline' => false,
    'size' => '6',
])
@php
    $size = match((int) $size) {
        1 => 'md:col-span-1 lg:col-span-1',
        2 => 'md:col-span-2  lg:col-span-2',
        3 => 'md:col-span-3 lg:col-span-3',
        4 => 'md:col-span-4 lg:col-span-4',
        5 => 'md:col-span-5',
       6 => 'md:col-span-6',
        7 => 'md:col-span-7',
        8 => 'md:col-span-8',
        9 => 'md:col-span-9',
        10 => 'md:col-span-10',
        11 => 'md:col-span-11',
        12 => 'md:col-span-12',
        default => 'md:col-span-6',
    };

@endphp
@if ($inline)
    <div {{ $attributes->merge(['class' => $size . ' md:flex-col justify-center py-2']) }}>
        <div class="items-center md:flex">
            @if ($label)
                <label @if($for) for="{{ $for }}"
                       @endif class="block pr-3 text-sm font-medium text-gray-500 dark:text-gray-100 grow">
                    {!! $label !!}:
                </label>
            @endif

            <div class="flex flex-initial mt-1 sm:mt-0 items-center">
                {{ $slot }}
            </div>
        </div>
        <x-input.error :error="$error" :inline="$inline" />
        @if ($helpText)
            <p class="mt-2 text-sm text-right text-gray-500 dark:text-gray-100 ">{{ $helpText }}</p>
        @endif
    </div>
@else
    <div {{ $attributes->merge(['class' => 'col-span-12 '.$size]) }}>
        <label @if($for) for="{{ $for }}"
               @endif class="block text-sm font-semibold text-gray-500 dark:text-gray-100 ">{!! $label !!}</label>

        <div class="relative mt-1 mb-3 rounded-md lg:mb-0">
            {{ $slot }}


            <x-input.error :error="$error" />


            @if ($helpText)
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-100 ">{{ $helpText }}</p>
            @endif
        </div>
    </div>
@endif
