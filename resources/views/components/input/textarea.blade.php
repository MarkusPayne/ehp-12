@props(['rows' => 3])
<div class="flex rounded-md shadow-xs grow">
    <textarea {{ $attributes }} rows="{{$rows}}"
              name="{{ $attributes->wire('model')->value() }}" id="{{ $attributes->wire('model')->value() }}"
              class="flex-1 transition duration-150 ease-in-out sm:text-sm sm:leading-5 grow"></textarea>
</div>
