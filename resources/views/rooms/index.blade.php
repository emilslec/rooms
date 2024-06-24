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

        <!-- <h3> {{auth()->user()->name }} </h3> -->
</body>

</html>