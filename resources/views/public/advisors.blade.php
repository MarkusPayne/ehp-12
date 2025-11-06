<x-layouts.public>
    <x-page-header :image-url="asset('images/headers/header2.jpg')" title="Advisors"/>
    <x-page-section>
        <x-page-section-content title="Client Services">
            {!! $content->where('name', 'advisors-client')->first()->content !!}
        </x-page-section-content>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <x-advisor-list :$advisors location="Toronto" locationId="1"/>
            <x-advisor-list :$advisors location="Vancouver" locationId="2"/>
            <x-advisor-list :$advisors location="Montréal" locationId="3"/>
        </div>
    </x-page-section>
    <x-page-section>
        <x-page-section-content title="Document Search">
            {!! $content->where('name', 'advisors-document')->first()->content !!}
        </x-page-section-content>
        <livewire:public.document-search-table/>
    </x-page-section>
</x-layouts.public>
