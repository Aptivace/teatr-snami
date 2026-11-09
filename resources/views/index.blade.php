<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Главная — Театр СНАМИ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600&family=Newsreader:ital,wght@0,400;0,500;0,600;1,400&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href={{asset("css/site.css")}}>
</head>
<body>
<header>
    <div class="wrap bar">
        <a class="logo" href="/">Театр "СНАМи"</a>
        <input type="checkbox" id="nv"><label for="nv" class="burger" aria-label="Меню">☰</label>
        <nav>
            <a href="/afisha">Афиша</a>
            <a href="/repertuar">Репертуар</a>
            <a href="/members">Состав</a>
            <a href="/reviews">Отзывы</a>
        </nav>
    </div>
</header>
<main>
    <section class="hero">
        <div class="wrap g">
            <div>
                <h1>Театр, который говорит с вами</h1>
                <p class="lead">"СНАМи" — театральный союз актёров и режиссёров. Мы играем камерные и большие спектакли и
                    любим, когда зал дышит вместе со сценой.</p>
                <div class="acts"><a class="btn" href="/afisha">Выбрать спектакль</a><a class="btn ghost"
                                                                                        href="/repertuar">Весь
                        репертуар</a></div>
            </div>
            <img src="{{asset("assets/silueti.png")}}" alt="Театр СНАМи">
        </div>
    </section>

    <section class="sec alt">
        <div class="wrap">
            <div class="sec-h"><h2>Ближайшие показы</h2><a href="/afisha">Вся афиша</a></div>

            @foreach($afishes as $afisha)
                <a class="date" href="/afisha/{{$afisha->id}}">
                    <div class="d">{{ \Carbon\Carbon::parse($afisha->date)->translatedFormat('d M') }}</div>
                    <div class="i"><b>{{$afisha->spectacle->name}}</b><span class="mut">{{$afisha->city}}, {{$afisha->time}} · {{$afisha->address}}</span>
                    </div>
                    <span class="btn">Билеты</span></a>
            @endforeach

        </div>
    </section>

    <section class="sec">
        <div class="wrap">
            <div class="sec-h"><h2>Репертуар</h2><a href="/repertuar">Все спектакли</a></div>
            <div class="grid">


                @foreach($repertuar as $play)
                    <a class="card" href="/repertuar/{{$play->id}}">
                        <div class="ph w">
                            <img src="{{asset('storage/' . $play->images[1])}}" alt="">
                        </div>
                        <div class="b"><span class="tag">{{$play->genre}}, {{$play->age}}+</span>
                            <h3>{{$play->name}}</h3><span class="mut">Режиссёр: {{$play->director}}</span></div>
                    </a>
                @endforeach

            </div>
        </div>
    </section>

    <section class="sec alt">
        <div class="wrap split">
            <div><h2>О театре</h2>
                <p class="lead">Мы работаем с живым словом и честной игрой. В труппе — актёры разных поколений, а в
                    репертуаре — классика, современная драматургия и экспериментальные постановки.</p><a
                    class="btn ghost" href="/members">Познакомиться с труппой</a></div>
            <div>
                <h3>Награды</h3>

                @foreach($rewards->take(3) as $reward)
                    <div class="award"><b>{{ $reward->name }}</b><span
                            class="mut">{{ $reward->year }}, {{ $reward->festival_name }}{{ $reward->spectacle ? " · «{$reward->spectacle->name}»" : '' }}</span>
                    </div>
                @endforeach

                @if($rewards->count() > 3)
                    <details class="awards-more">
                        <summary>Показать все ({{ $rewards->count() }})</summary>
                        @foreach($rewards->slice(3) as $reward)
                            <div class="award"><b>{{ $reward->name }}</b><span
                                    class="mut">{{ $reward->year }}, {{ $reward->festival_name }}{{ $reward->spectacle ? " · «{$reward->spectacle->name}»" : '' }}</span>
                            </div>
                        @endforeach
                    </details>
                @endif


            </div>
        </div>
    </section>

    <section class="sec">
        <div class="wrap">
            <div class="sec-h"><h2>Говорят зрители</h2><a href="/reviews">Все отзывы</a></div>
            <div class="grid">

                @foreach($reviews as $review)
                    <figure class="quote" style="margin:0"><p>{{$review->text}}</p>
                        <figcaption class="mut">{{$review->username}}</figcaption>
                    </figure>
                @endforeach


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
