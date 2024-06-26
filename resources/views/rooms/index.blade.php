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
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <h2><a href="{{route('profile.edit')}}">
            {{ __('Profile') }}
        </a></h2>
    <form method="POST" action="{{ route('logout') }}">

        @csrf
        @method('POST')
        <h2><a href="{{route('logout')}}" onclick="event.preventDefault();
            this.closest('form').submit();">
                {{ __('Log Out') }}
            </a>
    </form>

    </h2> {{Auth()->user()->id}} {{Auth()->user()->name}}
    <a href="{{ route('rooms.lang', ['locale' => 'en']) }}">English</a>
    <a href="{{ route('rooms.lang', ['locale' => 'fr']) }}">French</a>
    <a href="{{ route('rooms.lang', ['locale' => 'lv']) }}">lv</a>
    <h1>{{ __('content.room') }}</h1>
    {{App::getLocale()}}
    {{Session::get('locale');}}
</body>

</html>