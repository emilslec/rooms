<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$room->title}}</title>
</head>

<body>
    <h1>Show room</h1>
    <div>
        <h2>{{ $room->title }}</h2>
        <p>{{ $room->description }}</p>
        <p>{{ $room->level }}</p>
        <h3>pepl</h3>
        <ul>
            @foreach($users as $user)
            <li>
                <p>{{ $user->name }} // {{ $user->email }} </p>
            </li>
            @endforeach
        </ul>

        <h3>masage</h3>
        <ul>
            @foreach($messages as $message)
            <li>
                <p>{{ $message->created_at }} // {{ $message->content }} </p>
            </li>
            @endforeach
        </ul>

        @can('join-room', $room)
        <form method="GET" action="{{ route('rooms.update', $room->id)}}">
            <button type="submit">jopin rom</button>
        </form>
        @endcan
        <h3> {{auth()->user()->name }} </h3>
    </div>
</body>

</html>