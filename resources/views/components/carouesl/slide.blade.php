@props(['imageUrl' => 'a'])

<li {{ $attributes->class(['glide__slide  !h-[50vh] ']) }}>
    <div style="background-image: url('{{$imageUrl}}')"
         class="h-full bg-cover bg-center text-white flex items-center ">
        <div class="lg:w-7xl lg:mx-auto flex items-center -mt-20 p-3 lg:px-8">
            <div class="text-white max-w-sm lg:max-w-3xl">
               {{$slot}}
            </div>
        </div>
    </div>
</li>
