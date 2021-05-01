<ul>
    @foreach ($locations as $location)
        <li>{{$location->id}} {{$location->title}}</li>
    @endforeach
</ul>
