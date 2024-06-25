<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Blog page</title>
</head>

<body>

    <h1>Welcome to the prumumes</h1>

    @foreach ($rooms as $room)
    <h2 class="no-underline"><a href="{{ route('rooms.show', $room->id) }}">{{ $room->title }}</a></h2>
    <p>{{ $room->description }}</>

        @endforeach

        @can('create-room')
    <form method="GET" action="{{ route('rooms.create')}}">
        @csrf
        @method('GET')
        <button type="submit">Create rom</button>
    </form>
    @endcan
    <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <input type="file" name="image">
        <button type="submit">Upload</button>
    </form>
    <img width=100 src="{{asset('storage/' . Auth()->user()->path)}}" alt="Image">


</body>

</html>