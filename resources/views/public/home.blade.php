<x-layouts.public >
    <x-carouesl>
        <x-carouesl.slide :image-url="asset('images/slider-home-1.jpg')">
            {!! $content->where('name','home-slide1')->first()->content !!}
        </x-carouesl.slide>
        <x-carouesl.slide :image-url="asset('images/slider-home-3.jpg')">
            {!! $content->where('name','home-slide3')->first()->content !!}
        </x-carouesl.slide>
    </x-carouesl>

    <x-page-section>
        <div
            class="grid grid-cols-1 md:grid-cols-12 md:gap-10 lg:gap-20 gap-y-20">
            <div class="md:col-span-8">
                <x-page-section-content title="Welcome">
                    {!! $content->where('name','home-left')->first()->content !!}
                </x-page-section-content>
            </div>
            <div class="md:col-span-4">
                <x-page-section-content title="GET STARTED">
                    {!! $content->where('name','home-right')->first()->content !!}
                </x-page-section-content>
            </div>
        </div>
    </x-page-section>

</x-layouts.public>
