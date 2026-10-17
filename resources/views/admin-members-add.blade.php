<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ isset($member) ? 'Редактировать участника' : 'Новый участник' }} — СНАМИ</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600&family=Newsreader:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
<div class="app">
    <aside>
        <a class="logo" href="/">СНАМИ</a>
        <a href="/admin">Афиши</a>
        <a href="/admin/spectacles" >Репертуар</a>
        <a href="/admin/members" class="on">Состав</a>
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
            <h1>{{ isset($member) ? 'Редактировать участника' : 'Новый участник' }}</h1>
            <a class="btn g" href="/admin/members">К списку</a>
        </div>

        {{-- Вывод ошибок валидации --}}
        @if ($errors->any())
            <div style="padding: 10px; background: #f8d7da; color: #721c24; margin-bottom: 20px; border-radius: 4px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Динамический action и метод (POST для создания, PUT для обновления) --}}
        <form class="panel" method="POST" enctype="multipart/form-data"
              action="{{ isset($member) ? "/admin/members/$member->id/edit" : '/admin/members' }}">
            @csrf
            @if(isset($member))
                @method('PATCH')
            @endif

            <div class="f">
                <div>
                    <label for="n">Имя и фамилия</label>
                    <input id="n" name="name" value="{{ old('name', $member->name ?? '') }}" required>
                </div>
                <div>
                    <label for="r">Роль в театре</label>
                    <input id="r" name="role" placeholder="Актёр, режиссёр…" value="{{ old('role', $member->role ?? '') }}" required>
                </div>
                <div>
                    <label for="ph">Фото</label>
                    <input id="ph" type="file" name="image" accept="image/*" {{ isset($member) ? '' : 'required' }}>

                    {{-- Если аватарка уже есть, покажем её миниатюру при редактировании --}}
                    @isset($member->image)
                        <div style="margin-top: 8px;">
                            <img src="{{ asset('storage/' . $member->image) }}" alt="Фото" style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;">
                        </div>
                    @endisset

                </div>
                <div class="full">
                    <label for="b">Биография / Описание</label>
                    <textarea id="b" name="desc">{{ old('desc', $member->desc ?? '') }}</textarea>
                </div>
            </div>

            <button class="btn" type="submit">Сохранить участника</button>
        </form>
    </main>
</div>
</body>
</html>
