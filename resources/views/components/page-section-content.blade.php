@props([
    'title' => null
])

<div {{ $attributes }}>
    @if($title)
        <div>
            <h4 class="uppercase">{{__($title)}}</h4>
            <div class="hr-blue"></div>
        </div>
    @endif
    <div>
        {{ $slot ?? '' }}
    </div>
</div>
