<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Безопасность — СНАМИ</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600&family=Newsreader:wght@500&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="{{asset("css/admin.css")}}">
</head>
<body>
<div class="login">
    <div class="panel">
        @if ($enabled)
            <h1>Двухфакторная защита</h1><br>
            <p style="margin:0 0 18px">
                <span class="b ok">Включена</span>
            </p>
            <p style="margin:0 0 18px;color:var(--mut)">При входе потребуется код из приложения-аутентификатора.</p>
            <a class="btn" style="width:100%;display:block;text-align:center" href="/admin">В админ-панель</a>
        @else
            <form method="post" action="/admin/security">
                @csrf

                <h1>Включение 2FA</h1><br>
                <p style="margin:0 0 18px;color:var(--mut)">
                    Отсканируй QR-код в приложении (Aegis, 2FAS, Google Authenticator),
                    затем введи код, который оно покажет.
                </p>

                <div style="display:grid;place-items:center;border:1px solid var(--line);border-radius:8px;padding:12px;margin-bottom:14px;background:#fff">
                    {!! $svg !!}
                </div>

                <p style="margin:0 0 18px;text-align:center">
                    <small>Или введи ключ вручную:</small><br>
                    <code style="display:inline-block;margin-top:6px;padding:4px 8px;background:#faf7f4;border:1px solid var(--line);border-radius:6px;word-break:break-all;user-select:all">{{ $secret }}</code>
                </p>

                <label for="c">Код из приложения</label>
                <input id="c" type="text" name="code" inputmode="numeric" pattern="[0-9]{6}" maxlength="6"
                       autocomplete="one-time-code" placeholder="000000" required
                       style="font-size:1.3rem;letter-spacing:.35em;text-indent:.35em;text-align:center">

                @error('code')
                <div style="margin-bottom:14px"><span class="b bad">{{$message}}</span></div>
                @enderror

                <button class="btn" style="width:100%" type="submit">Включить</button>
            </form>

            <form method="post" action="/admin/logout" style="margin:12px 0 0">
                @csrf
                <button class="btn g" style="width:100%" type="submit">Выйти</button>
            </form>
        @endif
    </div>
</div>
</body>
</html>
