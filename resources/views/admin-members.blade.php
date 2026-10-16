<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Состав — СНАМИ</title>
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

        <form action="/admin/logout" method="POST" style="display: inline;">
            @csrf
            <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer; padding: 0; font: inherit;">Выйти</button>
        </form>
    </aside>
    <main>
        <div class="top">
            <h1>Состав</h1>
            <a class="btn" href="/admin/members/create">Добавить участника</a>
        </div>

        {{-- Уведомление об успешном действии --}}
        @if(session('success'))
            <div style="padding: 10px; background: #d4edda; color: #155724; margin-bottom: 20px; border-radius: 4px;">
                {{ session('success') }}
            </div>
        @endif

        <div class="tw">
            <table>
                <tr>
                    <th>Фото</th>
                    <th>Имя</th>
                    <th>Роль в театре</th>
                    <th></th>
                </tr>

                @forelse($members as $member)
                    <tr>
                        <td>
                            @if($member->image)
                                <img src="{{ asset('storage/' . $member->image) }}" alt="" style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;">
                            @else
                                <span>—</span>
                            @endif
                        </td>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->role }}</td>
                        <td>
                            <div class="acts">
                                <a class="btn s g" href="{{ route('admin.members.edit', $member) }}">Изменить</a>
                                <form method="POST" action="{{ route('admin.members.destroy', $member) }}" onsubmit="return confirm('Удалить участника?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn s bad">Удалить</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align: center; color: #777;">В составе пока никого нет</td>
                    </tr>
                @endforelse
            </table>
        </div>
    </main>
</div>
</body>
</html>
