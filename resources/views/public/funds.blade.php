<x-layouts.public>
    <x-page-header :image-url="asset('images/headers/header1.jpg')" title="Funds" />
    <x-page-section>
        <x-page-section-content title="Funds">
            @content('funds')
        </x-page-section-content>
    </x-page-section>
    <x-page-section>
        <livewire:public.fund-finder />
    </x-page-section>
</x-layouts.public>
