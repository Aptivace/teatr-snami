<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ isset($afisha) ? 'Редактировать афишу' : 'Новая афиша' }} — СНАМИ</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600&family=Newsreader:wght@500&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="{{asset("css/admin.css")}}">
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
            <h1>{{ isset($afisha) ? 'Редактировать афишу' : 'Новая афиша' }}</h1>
            <a class="btn g" href="/admin">К списку</a>
        </div>

        @if ($errors->any())
            <div style="padding: 10px; background: #f8d7da; color: #721c24; margin-bottom: 20px; border-radius: 4px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="panel" method="POST" action="{{ isset($afisha) ? "/admin/afishes/$afisha->id" : "/admin/afishes" }}">
            @csrf
            @if(isset($afisha))
                @method('PATCH')
            @endif

            <div class="f">
                <div class="full">
                    <label for="play">Спектакль</label>
                    <select id="play" name="spectacle_id" required>
                        <option value="">Выберите спектакль</option>
                        @foreach($spectacles as $spectacle)
                            <option value="{{ $spectacle->id }}" {{ old('spectacle_id', $afisha->spectacle_id ?? '') == $spectacle->id ? 'selected' : '' }}>
                                {{ $spectacle->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="d">Дата</label>
                    <input id="d" type="date" name="date" value="{{ old('date', $afisha->date ?? '') }}" required>
                </div>
                <div>
                    <label for="t">Время</label>
                    <input id="t" type="time" name="time" value="{{ old('time', $afisha->time ?? '') }}" required>
                </div>
                <div>
                    <label for="v">Площадка</label>
                    <input id="v" name="address" value="{{ old('address', $afisha->address ?? '') }}" required>
                </div>
                <div>
                    <label for="pr">Цена от, ₽</label>
                    <input id="pr" type="number" min="0" name="price" value="{{ old('price', $afisha->price ?? '') }}" required>
                </div>
                <div>
                    <label for="city">Город</label>
                    <input id="city" name="city" value="{{ old('city', $afisha->city ?? '') }}" required>
                </div>
                <div>
                    <label for="st">Статус</label>
                    <select id="st" name="status">
                        <option value="active" {{ old('status', $afisha->status ?? '') == 'active' ? 'selected' : '' }}>Опубликована</option>
                        <option value="pending" {{ old('status', $afisha->status ?? '') == 'pending' ? 'selected' : '' }}>Черновик</option>
                        <option value="cancelled" {{ old('status', $afisha->status ?? '') == 'cancelled' ? 'selected' : '' }}>Отменена</option>
                        <option value="completed" {{ old('status', $afisha->status ?? '') == 'completed' ? 'selected' : '' }}>Завершена</option>
                    </select>
                </div>
                <div class="full">
                    <label for="ds">Описание показа</label>
                    <textarea id="ds" name="desc">{{ old('desc', $afisha->desc ?? '') }}</textarea>
                </div>
            </div>
            <button class="btn" type="submit">Сохранить афишу</button>
        </form>
    </main>
</div>
</body>
</html>
