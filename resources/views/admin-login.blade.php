<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Вход — СНАМИ</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600&family=Newsreader:wght@500&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="{{asset("css/admin.css")}}">
</head>
<body>
<div class="login">
    <form class="panel" method="post" action="/admin/login">
        @csrf

        <h1>Вход в админ-панель</h1><br>
        <label for="e">Email</label><input id="e" type="email" name="email" value="{{old("email")}}" required autofocus>
        <label for="p">Пароль</label><input id="p" type="password" name="password" required>
        <label style="font-weight:400"><input type="checkbox" {{old("remember") ? 'checked' : ''}} name="remember"> Запомнить меня</label><br>
        @error('email')
        <span>{{$message}}</span>
        @enderror
        <button class="btn" style="width:100%" type="submit">Войти</button>
    </form>
</div>
</body>
</html>
