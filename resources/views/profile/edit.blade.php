<!DOCTYPE html>
<html lang="lv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profils - Viltnieku Portāls</title>
    <link rel="stylesheet" href="/css/profile.css">
</head>

<body>
    <div class="profile-container">
        <h1>Profils</h1>
        <hr class="divider">
        <div class="profile-picture">
            <img alt="Profila bilde" id="profile-img" src="{{asset('storage/' . Auth()->user()->path)}}">
            <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <input type="file" id="profile-pic-input" name="image"><br>
                <button type="submit" class="save-button change-pic-button">Mainīt profila bildi</button>
            </form>
        </div>
        <form method="post" action="{{ route('profile.update') }}" class="profile-form">
            @csrf
            @method('patch')
            <div class="form-group">
                <label for="name">Lietotājvārds:</label>
                <input type="text" id="name" name="name" value="{{auth()->user()->name}}">
            </div>
            <div class="form-group">
                <label for="email">E-pasts:</label>
                <input type="email" id="email" name="email" value="{{auth()->user()->email}}">
            </div>
            <button type="submit" class="save-button">Saglabāt izmaiņas</button>
        </form>
    </div>
</body>

</html>