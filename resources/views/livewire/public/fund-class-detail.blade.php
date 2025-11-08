<div>
    <x-page-header :image-url="asset('images/headers/header1.jpg')" title="Fund Details" />
    <x-page-section>
        <x-page-section-content :title="$this->fund?->name">
            {!! $this->fund?->overview !!}
        </x-page-section-content>
    </x-page-section>
    <x-page-section>graph</x-page-section>
</div>
