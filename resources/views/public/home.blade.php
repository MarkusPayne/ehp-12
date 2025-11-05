<x-layouts.public :title="__('Dashboard')">


    <div
        x-data="carousel"
        class="-mx-6 lg:-mx-8 -mt-6 lg:-mt-8"
    >
        <div x-ref="glide" class="glide block relative">

            <div class="glide__track" data-glide-el="track">
                <ul class="glide__slides h-50vh">
                    <li class="glide__slide  !h-[50vh] ">
                        <div style="background-image: url('{{ asset('images/slider-home-1.jpg') }}')"
                             class="h-full bg-cover bg-center text-white flex items-center ">
                            <div class="max-w-sm lg:max-w-3xl mx-30 lg:mx-44 text-white ">
                                {!! $content->where('name','home-slide1')->first()->content !!}
                            </div>
                        </div>
                    </li>
                    {{--                    <li class="glide__slide  !h-[50vh] ">--}}
                    {{--                        <div style="background-image: url('{{ asset('images/slider-home-2.jpg') }}')" class="h-full bg-cover bg-center text-white flex items-center ">--}}
                    {{--                            <div class="max-w-2xl mx-44 ">--}}
                    {{--                                {!! $content->where('name','home-slide2')->first()->content !!}--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </li>--}}
                    <li class="glide__slide  !h-[50vh] ">
                        <div style="background-image: url('{{ asset('images/slider-home-3.jpg') }}')"
                             class="h-full bg-cover bg-center text-white flex items-center ">
                            <div class="max-w-sm lg:max-w-3xl mx-30 lg:mx-44 text-white ">
                                {!! $content->where('name','home-slide3')->first()->content !!}
                            </div>
                        </div>
                    </li>
                </ul>
            </div>


            <!-- Bullets -->
            <div class="glide__bullets flex w-full items-center justify-center gap-1" data-glide-el="controls[nav]">
                <button class="glide__bullet !h-1 !w-15 !rounded-none bg-gray-200 transition-colors"
                        data-glide-dir="=0"></button>
                <button class="glide__bullet !h-1 !w-15 !rounded-none bg-gray-200 transition-colors"
                        data-glide-dir="=1"></button>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-4 p-10">
        <div class="col-span-12 sm:col-span-8">
            {!! $content->where('name','home-left')->first()->content !!}
        </div>
        <div class="col-span-12 sm:col-span-4">
            <h4 class="text-uppercase">{{ __('GET STARTED') }}</h4>
            <div class="hr-blue"></div>
            {!! $content->where('name','home-right')->first()->content !!}
        </div>


    </div>

</x-layouts.public>
