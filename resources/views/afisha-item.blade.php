<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $afisha->spectacle->name ?? 'Спектакль' }} — Театр СНАМИ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600&family=Newsreader:ital,wght@0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
</head>
<body>
<header>
    <div class="wrap bar">
        <a class="logo" href="{{ url('/') }}">Театр "СНАМи"</a>
        <input type="checkbox" id="nv"><label for="nv" class="burger" aria-label="Меню">☰</label>
        <nav>
            <a href="{{ '/afisha' }}" class="on">Афиша</a>
            <a href="{{ '/repertuar' }}">Репертуар</a>
            <a href="{{ '/members' }}">Состав</a>
            <a href="{{ '/reviews' }}">Отзывы</a>
        </nav>
    </div>
</header>
<main>
    <section class="sec">
        <div class="wrap split">
            {{-- Постер спектакля (с проверкой на наличие картинки) --}}
            <div class="ph">
                <img src="{{asset('storage/' . $afisha->spectacle->images[0])}}" alt="{{$afisha->spectacle->name}}">

            </div>
            <div>
                {{-- Дата и время показа (например: 12 октября, пятница, 19:00) --}}
                <span class="tag">
                    {{ $afisha->date->translatedFormat('d F, l') }}, {{ $afisha->time }}
                </span><br><br>

                <h1 style="font-size:clamp(2rem,5vw,3.4rem)">
                    {{ $afisha->spectacle->name ?? 'Название спектакля' }}
                </h1>

                <div class="facts">
                    <div><span>Площадка</span>{{ $afisha->address }}</div>
                    <div><span>Стоимость</span>{{ $afisha->price > 0 ? "от {$afisha->price} ₽" : 'вход свободный' }}</div>
                    <div><span>Длительность</span>{{ $afisha->spectacle->duration_text}}</div>
                    <div><span>Возраст</span>{{ $afisha->spectacle->age }}+</div>
                    <div><span>Адрес</span>{{ $afisha->city }}</div>
                </div>

                <div class="desc">
                    {{ App\Support\Text::rich($afisha->desc ?? $afisha->spectacle->desc) }}
                </div>

                <div style="display:flex;gap:12px;flex-wrap:wrap">
                    @if($afisha->ticket_url)
                        <a class="btn" href="{{ $afisha->ticket_url }}" target="_blank">Купить билет</a>
                    @endif

                    @if($afisha->spectacle)
                        <a class="btn ghost" href="{{ "/repertuar/{$afisha->spectacle->id}" }}">О спектакле</a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- Блок «Другие даты» (показы этого же спектакля в другие дни) --}}
    @if(isset($otherDates) && $otherDates->isNotEmpty())
        <section class="sec alt">
            <div class="wrap">
                <h2>Другие даты</h2>
                @foreach($otherDates as $other)
                    <a class="date" href="{{ "/afisha/$other->id" }}">
                        <div class="d">{{ \Carbon\Carbon::parse($other->date)->translatedFormat('d M') }}</div>
                        <div class="i">
                            <b>{{ $other->spectacle->name }}</b>
                            <span class="mut">{{ \Carbon\Carbon::parse($other->date)->translatedFormat('l') }}, {{ $other->time }} </span>
                        </div>
                        <span class="btn">Подробнее</span>
                    </a>
                @endforeach
            </div>
        </section>
    @endif
</main>
<footer>
    <div class="wrap">
        <div class="g">
            <div><a class="logo" href="/">Театр "СНАМи"</a>
                <p>Театральный союз. Играем живые спектакли для тех, кто любит театр.</p></div>
            <div><a href="/afisha">Афиша</a><a href="/repertuar">Репертуар</a><a href="/members">Состав</a><a
                    href="/reviews">Отзывы</a></div>
            <div><a href="tel:+79172393436">+7 917 239-34-36</a><a
                    href="mailto:teatrsnami@gmail.com">teatrsnami@gmail.com</a></div>

        </div>
        <small>© 2026 Театр СНАМи</small>
    </div>
</footer>
</body>
</html>
