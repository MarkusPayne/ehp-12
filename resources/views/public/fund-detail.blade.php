<x-layouts.public>
    <x-page-header :image-url="asset('images/headers/header1.jpg')" title="Fund Details" />
    <x-page-section>
        <x-page-section-content :title="$fund?->name">
            {!! $fund?->overview !!}
        </x-page-section-content>
    </x-page-section>
    <x-page-section>graph</x-page-section>
</x-layouts.public>
