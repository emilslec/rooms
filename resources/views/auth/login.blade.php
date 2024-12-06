<!DOCTYPE html>
<html lang="lv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pieteikties - Viltnieku Portāls</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="login-container">
        <div class="language-buttons">
            <button type="button" class="language-button"><a href="{{ route('rooms.lang', ['locale' => 'lv']) }}">LV</a></button>
            <button type="button" class="language-button"><a href="{{ route('rooms.lang', ['locale' => 'en']) }}">EN</a></button>
        </div>
        <form method="POST" class="login-form" action="{{ route('login') }}">
            @csrf
            <h2>{{ __('content.login') }}</h2>
            <div class="form-group">
                <label for="username">{{ __('content.email') }}:</label>
                <input type="email" id="email" name="email" value="a@aa">
            </div>
            <div class="form-group">
                <label for="password">{{ __('content.pw') }}:</label>
                <input type="password" id="password" name="password" value="******">
            </div>
            <button type="submit" class="login-button">{{ __('content.join') }}</button>
            <hr>
            <button type="submit" class="register-button"><a href='/register'>{{ __('content.register') }}</a></button>
        </form>
    </div>
</body>

</html>