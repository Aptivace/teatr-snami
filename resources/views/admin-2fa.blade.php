<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Подтверждение входа — СНАМИ</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600&family=Newsreader:wght@500&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="{{asset("css/admin.css")}}">
</head>
<body>
<div class="login">
    <form class="panel" method="post" action="/admin/2fa">
        @csrf

        <h1>Подтверждение входа</h1><br>
        <p style="margin:0 0 18px;color:var(--mut)">Введи шестизначный код из приложения-аутентификатора.</p>

        <label for="c">Код</label>
        <input id="c" type="text" name="code" inputmode="numeric" pattern="[0-9]{6}" maxlength="6"
               autocomplete="one-time-code" placeholder="000000" required autofocus
               style="font-size:1.3rem;letter-spacing:.35em;text-indent:.35em;text-align:center">

        @error('code')
        <div style="margin-bottom:14px"><span class="b bad">{{$message}}</span></div>
        @enderror

        <button class="btn" style="width:100%" type="submit">Войти</button>
        <p style="margin:16px 0 0;text-align:center"><small><a href="/admin">Вернуться ко входу</a></small></p>
    </form>
</div>
</body>
</html>
