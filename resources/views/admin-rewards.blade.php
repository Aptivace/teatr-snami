<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Награды — СНАМИ</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600&family=Newsreader:wght@500&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
<div class="app">
    <aside>
        <a class="logo" href="/">СНАМИ</a>
        <a href="/admin">Афиши</a>
        <a href="/admin/spectacles">Репертуар</a>
        <a href="/admin/members">Состав</a>
        <a href="/admin/rewards" class="on">Награды</a>
        <a href="/admin/reviews">Отзывы</a>
        <a href="/" target="_blank">Открыть сайт</a>

        <form action="/admin/logout" method="POST" style="display: inline;">
            @csrf
            <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer; padding: 0; font: inherit;">Выйти</button>
        </form>
    </aside>
    <main>
        <div class="top">
            <h1>Награды</h1>
            <a class="btn" href="{{ "/admin/rewards/create" }}">Добавить награду</a>
        </div>

        @if(session('success'))
            <div style="padding: 10px; background: #d4edda; color: #155724; margin-bottom: 20px; border-radius: 4px;">
                {{ session('success') }}
            </div>
        @endif

        <div class="tw">
            <table>
                <tr>
                    <th>Награда</th>
                    <th>Год</th>
                    <th>Спектакль</th>
                    <th></th>
                </tr>

                @forelse($rewards as $reward)
                    <tr>
                        <td>
                            <a href="{{ asset('storage/' . $reward->url) }}" target="_blank" style="color: inherit; text-decoration: underline;">
                                {{ $reward->name }}
                            </a>
                            <br><small>Фестиваль «{{ $reward->festival_name }}»</small>
                        </td>
                        <td>{{ $reward->year }}</td>
                        <td>{{ $reward->spectacle->name ?? 'Без привязки' }}</td>
                        <td>
                            <div class="acts">
                                <a class="btn s g" href="{{ "/admin/rewards/$reward->id/edit" }}">Изменить</a>
                                <form method="POST" action="{{ "/admin/rewards/$reward->id/remove" }}" onsubmit="return confirm('Удалить награду?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn s bad">Удалить</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align: center; color: #777;">Наград пока нет</td>
                    </tr>
                @endforelse
            </table>
        </div>
    </main>
</div>
</body>
</html>
