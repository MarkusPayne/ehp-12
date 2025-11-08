@php use App\Facades\PublicContentService; @endphp
<x-layouts.public>
    <x-page-header :image-url="asset('images/headers/header3.jpg')" title="About"/>
    <x-page-section id="about-firm">
        <x-page-section-content title="Firm">
            @content('about-firm')
        </x-page-section-content>
    </x-page-section>
    <x-page-section id="about-process">
        <x-page-section-content title="Process">
            @content('about-process')
        </x-page-section-content>
    </x-page-section>
    <x-page-section id="about-management-team">
        <x-page-section-content title="Management Team">
            <div class="grid grid-cols-1  gap-y-5">
                @foreach(PublicContentService::getTeam() as $member)
                    <div>
                        <h5>{{$member->name}}</h5>
                        <h6>{{$member->title}}</h6>
                        <div class="pt-2">
                            {!! $member->bio !!}
                        </div>
                    </div>
                @endforeach
            </div>
        </x-page-section-content>
    </x-page-section>
    <x-page-section id="about-careers">
        <x-page-section-content title="Careers">
            @content('about-careers')
        </x-page-section-content>
    </x-page-section>
</x-layouts.public>
