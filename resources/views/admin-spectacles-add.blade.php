<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ isset($play) ? 'Редактировать спектакль' : 'Новый спектакль' }} — СНАМИ</title>
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
            <h1>{{ isset($play) ? 'Редактировать спектакль' : 'Новый спектакль' }}</h1>
            <a class="btn g" href="/admin/spectacles">К списку</a>
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
              action="{{ isset($play) ? "/admin/spectacles/$play->id" : '/admin/spectacles' }}">
            @csrf
            @if(isset($play))
                @method('PATCH')
            @endif

            <div class="f">
                <div class="full">
                    <label for="ti">Название</label>
                    <input id="ti" name="title" value="{{ old('name', $play->title ?? '') }}" required>
                </div>
                <div>
                    <label for="g">Жанр</label>
                    <input id="g" name="genre" value="{{ old('genre', $play->genre ?? '') }}">
                </div>
                <div>
                    <label for="di">Режиссёр</label>
                    <input id="di" name="director" value="{{ old('director', $play->director ?? '') }}">
                </div>
                <div>
                    <label for="du">Длительность, мин</label>
                    <input id="du" type="number" min="1" name="duration" value="{{ old('duration', $play->duration ?? '') }}">
                </div>
                <div>
                    <label for="ag">Возраст</label>
                    <select id="ag" name="age">
                        @foreach(['0+', '6+', '12+', '16+', '18+'] as $ageOption)
                            <option value="{{ $ageOption }}" {{ old('age', $play->age ?? '') == $ageOption ? 'selected' : '' }}>
                                {{ $ageOption }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="pe">Год премьеры</label>
                    <input id="pe" type="number" name="premiere_year" value="{{ old('premiere_year', $play->premiere_year ?? '') }}">
                </div>
                <div>
                    <label for="im">Изображение</label>
                    <input id="im" type="file" name="image" accept="image/*">
                </div>
                <div class="full">
                    <label for="sh">Краткое описание</label>
                    <input id="sh" name="excerpt" maxlength="200" value="{{ old('excerpt', $play->excerpt ?? '') }}">
                </div>
                <div class="full">
                    <label for="ds">Полное описание</label>
                    <textarea id="ds" name="description">{{ old('description', $play->description ?? '') }}</textarea>
                </div>
                <div class="full">
                    <label for="ca">В ролях <small>(Ctrl/Cmd — выбрать несколько)</small></label>
                    <select id="ca" name="members[]" multiple size="6">
                        {{-- Пример генерации выпадающего списка участников (если передаешь $members из контроллера) --}}
                        @isset($members)
                            @foreach($members as $member)
                                <option value="{{ $member->id }}"
                                    {{ (isset($play) && $play->members->contains($member->id)) ? 'selected' : '' }}>
                                    {{ $member->name }}
                                </option>
                            @endforeach
                        @endisset
                    </select>
                </div>
            </div>
            <button class="btn" type="submit">Сохранить спектакль</button>
        </form>
    </main>
</div>
</body>
</html>
