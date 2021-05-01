<!DOCTYPE html>
<html>
<head>
    <title>Impfungen</title>
</head>
<body>
<ul>
    @foreach($vaccinations as $vaccination)
        <li><a href="vaccinations/{{$vaccination->id}}">
                {{$vaccination->date}}</a></li>
    @endforeach
</ul>
</body>
</html>

