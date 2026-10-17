<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ isset($reward) ? 'Редактировать награду' : 'Новая награда' }} — СНАМИ</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600&family=Newsreader:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
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
            <h1>{{ isset($reward) ? 'Редактировать награду' : 'Новая награда' }}</h1>
            <a class="btn g" href="/admin/rewards">К списку</a>
        </div>

        {{-- Вывод ошибок валидации --}}
        @if ($errors->any())
            <div style="padding: 10px; background: #f8d7da; color: #721c24; margin-bottom: 20px; border-radius: 4px;">
                {{ $errors->first() }}
            </div>
        @endif

        {{-- Динамический action и метод --}}
        <form class="panel" method="POST" enctype="multipart/form-data"
              action="{{ isset($reward) ? "/admin/rewards/$reward->id" : '/admin/rewards' }}">
            @csrf
            @if(isset($reward))
                @method('PATCH')
            @endif

            <div class="f">
                <div class="full">
                    <label for="ti">Название награды</label>
                    <input id="ti" name="name" value="{{ old('name', $reward->name ?? '') }}" required>
                </div>
                <div>
                    <label for="y">Год</label>
                    <input id="y" type="number" name="year" value="{{ old('year', $reward->year ?? '') }}" required>
                </div>
                <div>
                    <label for="o">Фестиваль / организация</label>
                    <input id="o" name="festival_name" value="{{ old('festival_name', $reward->festival_name ?? '') }}" required>
                </div>
                <div class="full">
                    <label for="u">Файл диплома / сертификата <small>(изображение или PDF)</small></label>
                    <input id="u" type="file" name="url" accept=".jpeg,.png,.jpg,.pdf" {{ isset($reward) ? '' : 'required' }}>

                    @isset($reward->url)
                        <div style="margin-top: 8px;">
                            <a href="{{ asset('storage/' . $reward->url) }}" target="_blank" style="color: #007bff; text-decoration: underline;">
                                Посмотреть текущий файл
                            </a>
                        </div>
                    @endisset
                </div>
                <div class="full">
                    <label for="pl">Спектакль <small>(необязательно)</small></label>
                    <select id="pl" name="spectacle_id">
                        <option value="">Без привязки к спектаклю</option>
                        @foreach($spectacles as $spectacle)
                            <option value="{{ $spectacle->id }}" {{ old('spectacle_id', $reward->spectacle_id ?? '') == $spectacle->id ? 'selected' : '' }}>
                                {{ $spectacle->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button class="btn" type="submit">Сохранить награду</button>
        </form>
    </main>
</div>
</body>
</html>
