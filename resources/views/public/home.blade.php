<x-layouts.public>
    <x-carouesl>
        <x-carouesl.slide :image-url="asset('images/slider-home-1.jpg')">
            @content('home-slide1')
        </x-carouesl.slide>
        <x-carouesl.slide :image-url="asset('images/slider-home-3.jpg')">
            @content('home-slide3')
        </x-carouesl.slide>
    </x-carouesl>
    <x-page-section>
        <div
            class="grid grid-cols-1 md:grid-cols-12 md:gap-10 lg:gap-20 gap-y-20">
            <div class="md:col-span-8">
                <x-page-section-content title="Welcome">
                    @content('home-left')
                </x-page-section-content>
            </div>
            <div class="md:col-span-4">
                <x-page-section-content title="GET STARTED">
                    @content('home-right')
                </x-page-section-content>
            </div>
        </div>
    </x-page-section>

</x-layouts.public>
