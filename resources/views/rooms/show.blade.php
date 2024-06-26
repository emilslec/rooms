<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$room->title}}</title>
</head>

<body>
    <h1>Show room</h1>
    <h2 class="no-underline"><a href="{{ route('rooms.index') }}">b ak </a></h2>
    <div>
        <h2>{{ $room->title }}</h2>
        <p>{{ $room->description }}</p>
        <p>{{ $room->level }}</p>
        <p>{{ $room->limit }}</p>
        <h3>pepl</h3>
        <ul>
            @foreach($users as $user)
            <li>
                <p>{{ $user->name }} // {{ $user->email }} </p>
            </li>
            @endforeach
        </ul>
        @can('leave-room', $room)
        <h3>masage</h3>
        <ul style="border: 2px solid #000; /* Border width, style, and color */
    padding: 20px;">
            @foreach($messages as $message)
            <li>
                <p>
                    {{ $message->created_at->format("H:i:s") }} / {{ $message->content }} -- {{$message->user->name}}

                    <img width=50 src="{{ asset('storage/' . $message->user->path) }}" alt="Image">
                </p>
            </li>
            @endforeach
        </ul>

        <form method="POST" action="{{ route('messages.store', ['id' => $room->id]) }}">
            @csrf
            @method('POST')
            <label for="title">Ziņa:</label>
            <input type="text" id="content" name="content" value="" required>
            <button type="submit">send</button>
        </form>
        @endcan

        @can('join-room', $room)
        <form method="POST" action="{{ route('rooms.update', $room->id)}}">
            @csrf
            @method('PUT')
            <button type="submit">jopin rom</button>
        </form>
        @endcan

        @can('leave-room', $room)
        <form method="POST" action="{{ route('rooms.destroy', $room->id)}}">
            @csrf
            @method('DELETE')
            <button type="submit">leave rom</button>
        </form>
        @endcan
        <h3> {{auth()->user()->id }} {{Auth()->user()->latestParticipant}} </h3>
    </div>
</body>

</html>