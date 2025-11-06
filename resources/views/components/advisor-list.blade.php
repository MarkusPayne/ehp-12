@props([
    'advisor' ,

])
<div>
    <h6 class="uppercase">{{ $advisor->name }}</h6>
    <p>{{ $advisor->title }}<br/>
        Tel: <a href="tel:+{{ $advisor->phone }}">{{ $advisor->phone }}</a><br/>
        <a href="mailto:1{{ $advisor->email }}">{{ $advisor->email }}</a>
    </p>
</div>

