<x-layouts.public>
    <x-page-header :image-url="asset('images/headers/header2.jpg')" title="Advisors"/>
    <x-page-section>
        <x-page-section-content title="Client Services">
            @content('advisors-client')
        </x-page-section-content>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach(\App\Facades\PublicContentService::getLocations() as $location)
                <x-page-section-content :title="$location->name">
                    @foreach($location->advisors as $advisor)
                        <x-advisor-list :$advisor/>
                    @endforeach
                </x-page-section-content>
            @endforeach
        </div>
    </x-page-section>
    <x-page-section>
        <x-page-section-content title="Document Search">
            @content('advisors-document')
        </x-page-section-content>
        <livewire:public.document-search-table/>
    </x-page-section>
</x-layouts.public>
