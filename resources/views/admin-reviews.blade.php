<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Отзывы — СНАМИ</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600&family=Newsreader:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
<div class="app">
    <aside>
        <a class="logo" href="/">СНАМИ</a>
        <a href="/admin" class="on">Афиши</a>
        <a href="/admin/spectacles">Репертуар</a>
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
            <h1>Отзывы</h1>
            <div class="acts">
                {{-- Кнопки фильтрации с динамическим классом подсвечивания активного фильтра --}}
                <a class="btn s {{ request('status', 'pending') === 'pending' ? '' : 'g' }}"
                   href="{{ '/admin/reviews?status=pending' }}">
                    На проверке
                </a>
                <a class="btn s {{ request('status') === 'approved' ? '' : 'g' }}"
                   href="{{ '/admin/reviews?status=approved' }}">
                    Принятые
                </a>
                <a class="btn s {{ request('status') === 'rejected' ? '' : 'g' }}"
                   href="{{ '/admin/reviews?status=rejected' }}">
                    Отклонённые
                </a>
            </div>
        </div>

        <div class="tw">
            <table>
                <thead>
                <tr>
                    <th>Автор</th>
                    <th>Отзыв</th>
                    <th>Спектакль</th>
                    <th>Статус</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @forelse($reviews as $review)
                    <tr>
                        <td>
                            {{ $review->username }}<br>
                            <small>{{ $review->created_at->format('d.m.Y') }}</small>
                        </td>
                        <td style="max-width:420px">
                            {{ $review->text }}
                        </td>
                        <td>
                            {{-- Вывод названия спектакля через связь в модели --}}
                            {{ $review->spectacle->name ?? '—' }}
                        </td>
                        <td>
                            @if($review->status === 'pending')
                                <span class="b wait">На проверке</span>
                            @elseif($review->status === 'approved')
                                <span class="b ok">Принят</span>
                            @elseif($review->status === 'rejected')
                                <span class="b bad">Отклонён</span>
                            @endif
                        </td>
                        <td>
                            <div class="acts">
                                {{-- Принятие отзыва --}}
                                @if($review->status !== 'approved')
                                    <form method="POST" action="{{ "/admin/reviews/$review->id" }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="approved">
                                        <button type="submit" class="btn s ok">Принять</button>
                                    </form>
                                @endif

                                {{-- Отклонение отзыва --}}
                                @if($review->status !== 'rejected')
                                    <form method="POST" action="{{ "/admin/reviews/$review->id" }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="btn s bad">Отклонить</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 20px;">
                            Отзывов не найдено
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </main>
</div>
</body>
</html>
