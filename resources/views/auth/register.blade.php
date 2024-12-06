<!DOCTYPE html>
<html lang="lv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reģistrēties - Viltnieku Portāls</title>
    <link rel="stylesheet" href="/css/register.css">
</head>

<body>
    <div class="register-container">
        <form method="POST" action="{{ route('register') }}" class="register-form" enctype="multipart/form-data">
            @csrf
            <h2>{{ __('content.register') }}</h2>
            <div class="form-group">
                <label for="name">{{ __('content.username') }}:</label>
                <input type="text" id="name" name="name" value="janis@gg">
            </div>
            <div class="form-group">
                <label for="password">{{ __('content.pw') }}:</label>
                <input type="password" id="password" name="password" value="12345678">
            </div>
            <div class="form-group">
                <label for="email">{{ __('content.email') }}:</label>
                <input type="email" id="email" name="email" value="janis@gmail">
            </div>
            <button type="submit" class="register-button">{{ __('content.register') }}</button>
        </form>
    </div>
</body>

</html>