<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ isset($spectacle) ? 'Редактировать спектакль' : 'Новый спектакль' }} — СНАМИ</title>
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
            <h1>{{ isset($spectacle) ? 'Редактировать спектакль' : 'Новый спектакль' }}</h1>
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

        {{-- Динамический action и метод (POST для создания, PATCH для обновления) --}}
        <form class="panel" method="POST" enctype="multipart/form-data"
              action="{{ isset($spectacle) ? "/admin/spectacles/{$spectacle->id}" : '/admin/spectacles' }}">
            @csrf
            @if(isset($spectacle))
                @method('PATCH')
            @endif

            <div class="f">
                <div class="full">
                    <label for="ti">Название *</label>
                    <input id="ti" name="name" value="{{ old('name', $spectacle->name ?? '') }}" required>
                </div>
                <div>
                    <label for="g">Жанр *</label>
                    <input id="g" name="genre" value="{{ old('genre', $spectacle->genre ?? '') }}" required>
                </div>
                <div>
                    <label for="di">Режиссёр *</label>
                    <input id="di" name="director" value="{{ old('director', $spectacle->director ?? '') }}">
                </div>
                <div>
                    <label for="du">Длительность, мин *</label>
                    <input id="du" type="number" min="1" name="duration" value="{{ old('duration', $spectacle->duration ?? '') }}" required>
                </div>
                <div>
                    <label for="ag">Возраст (например, 16+) *</label>
                    <input id="ag" name="age" value="{{ old('age', $spectacle->age ?? '') }}" required>
                </div>
                <div>
                    <label for="im">Изображения *<small>(можно выбрать несколько)</small></label>
                    <input id="im" type="file" name="images[]" accept="image/*" multiple required>
                </div>
                <div class="full">
                    <label for="ds">Описание *</label>
                    <textarea id="ds" name="desc" rows="5" required>{{ old('desc', $spectacle->desc ?? '') }}</textarea>
                </div>
                <div class="full">
                    <label for="ds">Краткое описание (карточка репертуара)</label>
                    <textarea id="ds" name="short_desc" rows="5" required>{{ old('desc', $spectacle->short_desc ?? '') }}</textarea>
                </div>
                <div class="full">
                    <label for="ca">В ролях *<small>(Ctrl/Cmd — выбрать несколько)</small></label>
                    <select id="ca" name="members[]" multiple size="6">
                        @isset($members)
                            @foreach($members as $member)
                                <option value="{{ $member->id }}"
                                    {{ (isset($spectacle) && $spectacle->members->contains($member->id)) || (is_array(old('members')) && in_array($member->id, old('members'))) ? 'selected' : '' }}>
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
