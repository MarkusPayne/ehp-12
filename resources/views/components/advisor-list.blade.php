@props([
    'advisors' ,
    'locationId' => null,
    'location' => ''
])


@if($advisors->where('location_id', $locationId)->isNotEmpty())
    <div>
        <h4 class="uppercase">{{$location}}</h4>
        <div class="hr-blue "></div>

        @foreach ($advisors->where('location_id', $locationId) as $advisor)
            <h6 class="uppercase">{{ $advisor->name }}</h6>
            <p>{{ $advisor->title }}<br/>
                Tel: <a href="tel:+{{ $advisor->phone }}">{{ $advisor->phone }}</a><br/>
                <a href="mailto:1{{ $advisor->email }}">{{ $advisor->email }}</a>
            </p>
        @endforeach

    </div>
@endif
