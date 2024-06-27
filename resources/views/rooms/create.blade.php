</html>
<!DOCTYPE html>
<html lang="lv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Izveidošana - Viltnieku Portāls</title>
    <link rel="stylesheet" href="/css/create.css">
</head>

<body>
    <div class="content">
        <h1>Izveidot istabu</h1>
        <form action="{{ route('rooms.store') }}" method="POST" class="create-room-form">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="game">Spēle:</label>
                <select id="game" name="game_id">
                    @foreach ($games as $game)
                    <option value="{{ $game->id }}">
                        {{ $game->title }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="title">Nosaukums:</label>
                <input type="text" id="title" name="title" value="">
            </div>
            <div class="form-group">
                <label for="level">Prasmes līmenis:</label>
                <input type="text" id="level" name="level" value="Klejotāju">
            </div>
            <div class="form-group">
                <label for="description">Apraksts:</label>
                <textarea id="description" name="description" rows="4">Sveiki! Meklēju divus draugus!</textarea>
            </div>
            <div class="form-group">
                <label for="limit">Maksimālais cilvēku skaits:</label>
                <input type="number" id="limit" name="limit" min="1" value="4">
            </div>
            <button type="submit" class="create-button">Izveidot</button>
        </form>
    </div>
</body>

</html>