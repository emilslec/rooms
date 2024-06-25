<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
</head>

<body>
    <h1>Edit Post</h1>

    <form action="{{ route('rooms.store') }}" method="POST">
        @csrf
        @method('POST')

        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="" required>
        </div>

        <div>
            <label for="description">description:</label>
            <textarea id="description" name="description" required cols="80" rows="20"></textarea>
        </div>

        <div>
            <label for="limit">level:</label>
            <input type="number" id="level" name="level">
        </div>

        <div>
            <label for="limit">limit:</label>
            <input type="number" id="limit" name="limit">
        </div>

        <div>
            <label for="game">Game:</label>
            <select id="game" name="game_id">
                @foreach ($games as $game)
                <option value="{{ $game->id }}">
                    {{ $game->title }}
                </option>
                @endforeach
            </select>
        </div>

        <button type="submit">Update</button>
    </form>
</body>

</html>