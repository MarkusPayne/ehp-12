@props([
    'title' > ''
])

<div {{ $attributes }}>
    <div>
        <h4 class="uppercase">{{__($title)}}</h4>
        <div class="hr-blue"></div>
    </div>
    <div>
        {{ $slot ?? '' }}
    </div>
</div>
