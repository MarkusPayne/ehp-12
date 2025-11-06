<div
        x-data="carousel"
        class=""

        {{ $attributes }}>
    <div x-ref="glide" class="glide block relative">

        <div class="glide__track" data-glide-el="track">

            <ul class="glide__slides h-50vh">
                {{$slot}}
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
