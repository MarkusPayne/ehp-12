<x-layouts.public >
    <x-page-header :image-url="asset('images/headers/header3.jpg')" title="About"/>
    <x-page-section>
        <x-page-section-content title="Firm">
            {!! $content->where('name','about-firm')->first()->content !!}
        </x-page-section-content>
    </x-page-section>
    <x-page-section>
        <x-page-section-content title="Process">
            {!! $content->where('name','about-process')->first()->content !!}
        </x-page-section-content>
    </x-page-section>
    <x-page-section>
        <x-page-section-content title="Management Team">
            <div class="grid grid-cols-1  gap-y-5">
                @foreach($team as $member)
                    <div >
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
    <x-page-section>
        <x-page-section-content title="Careers">
            {!! $content->where('name','about-careers')->first()->content !!}
        </x-page-section-content>
    </x-page-section>
</x-layouts.public>
