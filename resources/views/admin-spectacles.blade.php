<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Репертуар — СНАМИ</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600&family=Newsreader:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
<div class="app">
    <aside>
        <a class="logo" href="/">СНАМИ</a>
        <a href="/admin">Афиши</a>
        <a href="/admin/spectacles" class="on">Репертуар</a>
        <a href="/admin/members">Состав</a>
        <a href="/admin/rewards">Награды</a>
        <a href="/admin/reviews">Отзывы</a>
        <a href="/" target="_blank">Открыть сайт</a>

        <!-- Форма выхода (Logout) в Laravel делается через POST запрос -->
        <form action="/admin/logout" method="POST" style="display: inline;">
            @csrf
            <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer; padding: 0; font: inherit;">Выйти</button>
        </form>
    </aside>
    <main>
        <div class="top">
            <h1>Репертуар</h1>
            <a class="btn" href="/admin/spectacles/create">Добавить спектакль</a>
        </div>

        @if(session('success'))
            <div style="padding: 10px; background: #d4edda; color: #155724; margin-bottom: 20px; border-radius: 4px;">
                {{ session('success') }}
            </div>
        @endif

        <div class="tw">
            <table>
                <tr>
                    <th>Название</th>
                    <th>Жанр</th>
                    <th>Режиссёр</th>
                    <th>Возраст</th>
                    <th></th>
                </tr>

                @forelse($plays as $play)
                    <tr>
                        <td>{{ $play->name }}</td>
                        <td>{{ $play->genre }}</td>
                        <td>{{ $play->director }}</td>
                        <td>{{ $play->age }}</td>
                        <td>
                            <div class="acts">
                                <a class="btn s g" href="{{ "/admin/spectacles/$play->id/edit" }}">Изменить</a>
                                <form method="POST" action="/admin/spectacles/{{$play->id}}/remove" onsubmit="return confirm('Удалить спектакль?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn s bad">Удалить</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; color: #777;">Спектаклей пока нет</td>
                    </tr>
                @endforelse
            </table>
        </div>
    </main>
</div>
</body>
</html>
