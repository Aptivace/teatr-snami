<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Афиши — СНАМИ</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600&family=Newsreader:wght@500&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="{{asset("css/admin.css")}}">
</head>
<body>
<div class="app">
    <aside>
        <a class="logo" href="/">СНАМИ</a>
        <a href="/admin" class="on">Афиши</a>
        <a href="/admin/spectacles" >Репертуар</a>
        <a href="/admin/members">Состав</a>
        <a href="/admin/rewards">Награды</a>
        <a href="/admin/reviews">Отзывы</a>
        <a href="/" target="_blank">Открыть сайт</a>

        <form action="/admin/logout" method="POST" style="display: inline;">
            @csrf
            <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer; padding: 0; font: inherit;">Выйти</button>
        </form>
    </aside>
    <main>
        <div class="top"><h1>Афиши</h1><a class="btn" href="/admin/afishes/create">Добавить афишу</a></div>

        @if(session('success'))
            <div style="padding: 10px; background: #d4edda; color: #155724; margin-bottom: 20px; border-radius: 4px;">
                {{ session('success') }}
            </div>
        @endif

        <div class="tw">
            <table>
                <tr>
                    <th>Спектакль</th>
                    <th>Дата и время</th>
                    <th>Площадка</th>
                    <th>Статус</th>
                    <th></th>
                </tr>

                @forelse($afishes as $afisha)
                    <tr>
                        <td>{{ $afisha->spectacle->name ?? 'Без спектакля' }}</td>
                        <td>{{ \Carbon\Carbon::parse($afisha->date)->format('d.m.Y') }}, {{ $afisha->time }}</td>
                        <td>{{ $afisha->city }}, {{ $afisha->address }}</td>
                        <td>
                            @if($afisha->status === 'active')
                                <span class="b ok">Опубликована</span>
                            @else
                                <span class="b" style="background: #e2e8f0; color: #475569;">{{ $afisha->status }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="acts">
                                <a class="btn s g" href="{{"/admin/afishes/$afisha->id/edit"}}" >Изменить</a>
                                <form method="POST" action="{{"/admin/afishes/$afisha->id/remove"}}" onsubmit="return confirm('Удалить афишу?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn s bad">Удалить</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; color: #777;">Афиш пока нет</td>
                    </tr>
                @endforelse
            </table>
        </div>
    </main>
</div>
</body>
</html>
