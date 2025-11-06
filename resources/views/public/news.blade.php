<x-layouts.public>

    <x-page-header :image-url="asset('images/headers/header12.jpg')" title="News"/>
    <x-page-section>
        <x-page-section-content title="News">
            <div
                class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-10  lg:mx-0 lg:max-w-none lg:grid-cols-3 divide-y divide-gray-200">
                @foreach($news as $article)
                    <article class="flex max-w-xl flex-col items-start justify-between pb-10">
                        <div class="flex items-center gap-x-4 text-sm">
                            <time datetime="{{ $article->news_date->format('Y-m-d') }}"
                                  class="text-gray-600">{{ $article->news_date->format('M d, Y') }}</time>
                        </div>
                        <div class="group relative grow">
                            <h4 class="mt-3 text-sm/6 font-semibold text-primary group-hover:text-gray-600">
                                <a href="#">
                                    {{ $article->title}}
                                </a>
                            </h4>
                            <h6 class="mt-3 text-lg/6 font-semibold text-gray-700 group-hover:text-gray-600 pb-3">
                                {{ $article->sub_title}}
                            </h6>
                            {!! $article->blurb !!}
                        </div>
                        <div class="relative mt-8 flex items-center gap-x-4 justify-self-end">
                            <a href="@if($article->news_type_id == 3){{ Storage::url($article->link) }}@else {{ $article->link }}@endif"
                               class="border border-secondary p-2 text-secondary hover:bg-secondary hover:text-zinc-200 rounded-sm"
                               target="_blank">@if($article->news_type_id != 1)
                                    Read More
                                @else
                                    Watch Video
                                @endif
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </x-page-section-content>
    </x-page-section>




</x-layouts.public>
