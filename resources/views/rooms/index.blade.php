<html lang="lv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meklēt Istabu - Viltnieku Portāls</title>
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
</head>

<body>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif



    <div class="content">
        <div class="header">
            <h1>{{ __('content.rl') }}</h1>
            <div class="language-buttons">
                <button type="button" class="language-button"><a href="{{ route('rooms.lang', ['locale' => 'lv']) }}">LV</a></button>
                <button type="button" class="language-button"><a href="{{ route('rooms.lang', ['locale' => 'en']) }}">EN</a></button>
            </div>
        </div>
        <hr class="divider">
        <div class="search-form">
            <form method="GET" class="search-form" action="{{ route('rooms.index') }}">
                <div class="form-group">
                    <label for="game" value="{{request('game');}}">{{ __('content.fbg') }}:</label>
                    <select id="game" name="game">
                        @foreach ($games as $game)
                        <option value="{{$game->id}}">{{$game->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="level">{{ __('content.fbs') }}:</label>
                    <input type="text" id="level" name="level" value="{{request('level');}}">
                </div>
                <button type="submit" class="search-button">{{__('content.search')}}</button>
            </form>

            <div class="form-buttons">
                @can('create-room')
                <form method="GET" action="{{ route('rooms.create')}}">
                    <button type="submit" class="create-button">{{ __('content.create') }}</button>
                </form>
                @endcan
                <form method="GET" action="{{ route('profile.edit')}}">
                    @csrf
                    @method('GET')
                    <button type="submit" class="profile-button">{{ __('content.profile') }}</button>
                </form>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-button">
                        {{ __('content.logout') }}
                    </button>
                </form>
            </div>
        </div>


        <table class="results-table">
            <thead>
                <tr>
                    <th>{{__('content.room_name')}}</th>
                    <th>{{__('content.description')}}</th>
                    <th>{{__('content.game')}}</th>
                    <th>{{__('content.skill')}}</th>
                    <th>{{ __('content.pc') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="room-list">
                @foreach ($rooms as $room)
                <tr>
                    <td>{{$room->title}}</td>
                    <td>{{$room->description}}</td>
                    <td>{{$room->game->title}}</td>
                    <td>{{$room->level}}</td>
                    <td>{{$room->participantCount()}} / {{$room->limit}}</td>
                    <td>
                        @can('join-room', $room)
                        <form method="POST" action="{{ route('rooms.update', $room->id)}}">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="join-button">{{__('content.join')}}</button>
                        </form>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>