<!DOCTYPE html>
<html lang="lv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Istaba - {{$room->title}}</title>
    <link rel="stylesheet" href="/css/room.css">
</head>

<body>
    <div class="content">
        <div class="chat-container">
            <div class="chat-header">
                <h1>{{$room->title}}</h1>
                <p>{{$room->description}}</p>
            </div>
            <div class="header">{{ __('content.chat') }}:</div>
            <div class="chat-box">
                @foreach ($messages as $message)
                <div class="message">
                    <img src="{{ asset('storage/' . $message->user->path) }}" alt="bilde" class="profile-pic">
                    <div class="message-content">
                        <p><strong>{{$message->user->name}}</strong> {{$message->content}}</p>
                        <span class="timestamp">{{ $message->created_at->format("H:i") }}</span>
                    </div>
                </div>
                @endforeach
            </div>
            <form method="POST" action="{{ route('messages.store', ['id' => $room->id]) }}">
                @csrf
                @method('POST')
                <input type="text" id="content" name="content" value="" placeholder="Ievadiet ziņu..." class="input-box" required>
                <button type="submit" class="send-button">{{ __('content.send') }}</button>
            </form>
        </div>
        <div class="sidebar">
            <div class="user-list-header">
                <span>{{ __('content.ur') }}</span>
                <span class="user-count">({{$room->participantCount()}} / {{$room->limit}})</span>
            </div>
            <div class="user-list">
                @foreach ($users as $user)
                <div class="user-item">
                    <img src="{{ asset('storage/' . $user->path) }}" alt="bilde" class="profile-pic-small">
                    <p>{{$user->name}}</p>
                    @can ('admin')
                    <form action="{{route('rooms.kick', ['id' => $user->id])}}">
                        <button type="submit" class="ban-button">&times;</button>
                    </form>
                    @endcan
                </div>
                @endforeach
            </div>
            @can ('admin')
            <div class="admin-buttons">
                <form action="{{route('rooms.delete', ['id' => $room->id])}}">
                    <button class="delete-room-button">{{ __('content.dr') }}</button>
                </form>

            </div>
            @endcan
            @can('leave-room', $room)
            <form method="POST" action="{{ route('rooms.destroy', $room->id)}}">
                @csrf
                @method('DELETE')
                <button type="submit" class="exit-button">{{ __('content.leave') }}</button>
            </form>
            @endcan
        </div>
    </div>
</body>

</html>