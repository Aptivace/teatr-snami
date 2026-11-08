<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Афиша — Театр СНАМИ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600&family=Newsreader:ital,wght@0,400;0,500;0,600;1,400&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
</head>
<body>
<header>
    <div class="wrap bar">
        <a class="logo" href="/">Театр "СНАМи"</a>
        <input type="checkbox" id="nv"><label for="nv" class="burger" aria-label="Меню">☰</label>
        <nav>
            <a href="/afisha" class="on">Афиша</a>
            <a href="/repertuar">Репертуар</a>
            <a href="/members">Состав</a>
            <a href="/reviews">Отзывы</a>
        </nav>
    </div>
</header>
<main>
    <section class="sec">
        <div class="wrap">
            <h1>Афиша</h1><br>
            <div class="chips">
                @if(count($availableMonths) > 0)
                    <a class="chip {{ !request('month') ? 'on' : '' }}" href="/afisha">Все</a>

                    @foreach($availableMonths as $monthNumber)
                        @php
                            // Получаем название месяца на русском языке через Carbon
                            $monthName = \Carbon\Carbon::create()->month($monthNumber)->translatedFormat('F');
                        @endphp
                        <a class="chip {{ request('month') == $monthNumber ? 'on' : '' }}"
                           href="{{ "/afisha/?month=$monthNumber" }}">
                            {{ ucfirst($monthName) }}
                        </a>
                    @endforeach
                @endif
            </div>

            {{-- Вывод актуальных афиш --}}
            @forelse($pending_afishes as $afisha)
                <a class="date" href="{{ "/afisha/$afisha->id" }}">
                    <div class="d">
                        {{ \Carbon\Carbon::parse($afisha->date)->translatedFormat('d M') }}
                    </div>
                    <div class="i">
                        <b>{{ $afisha->spectacle->name }}</b>
                        <span class="mut">
                            {{ \Carbon\Carbon::parse($afisha->date)->translatedFormat('l') }}, {{ $afisha->time }} · {{ $afisha->city }} · {{ $afisha->price }} ₽
                        </span>
                    </div>
                    <span class="btn">Подробнее</span>
                </a>
            @empty
                <p>На ближайшее время афиш нет.</p>
            @endforelse

            <div class="pg"></div>
        </div>
    </section>

    <section class="sec alt">
        <div class="wrap">
            <div class="sec-h">
                <h2>Недавние события</h2>
                <a href="/reviews">Отзывы зрителей</a>
            </div>
            <div class="grid">
                {{-- Вывод прошедших афиш --}}
                @forelse($expired_afishes as $expired)
                    <a class="card past" href="{{ "/afisha/$expired->id" }}">
                        <div class="ph w">
                            <img src="{{asset('storage/' . $expired->spectacle->images[0])}}"
                                 alt="{{$expired->spectacle->name}}">
                        </div>
                        <div class="b">
                            <span
                                class="tag">Состоялось {{ \Carbon\Carbon::parse($expired->date)->translatedFormat('d F') }}</span>
                            <h3>{{ $expired->spectacle->title ?? 'Название спектакля' }}</h3>
                            <span class="mut">{{ $expired->address }}</span>
                        </div>
                    </a>
                @empty
                    <p>Прошедших событий пока нет.</p>
                @endforelse
            </div>
        </div>
    </section>
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
