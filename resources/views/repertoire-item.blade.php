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
    <link rel="stylesheet" href={{asset("css/site.css")}}>
</head>
<body>
<header>
    <div class="wrap bar">
        <a class="logo" href="/">СНАМИ</a>
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
        <div class="wrap split">
            <div class="ph">
                <img src="{{asset('storage/' . $play->images[0])}}" alt="{{$play->name}}">
            </div>
            <div>
                <span class="tag">{{$play->genre}}, {{$play->age}}+</span><br><br>
                <h1 style="font-size:clamp(2rem,5vw,3.4rem)">{{$play->name}}</h1>
                <div class="facts">
                    <div><span>Режиссёр</span>{{$play->director}}</div>
                    <div><span>Жанр</span>{{$play->genre}}</div>
                    <div><span>Длительность</span>{{$play->duration}}</div>
                    <div><span>Возраст</span>{{$play->age}}+</div>
                </div>
                <p>{{$play->desc}}</p>
                <a class="btn" href="#dates">Ближайшие показы</a>
            </div>
        </div>
    </section>
    <section class="sec alt">
        <div class="wrap">
            <h2>В ролях</h2>
            <div class="grid" style="grid-template-columns:repeat(auto-fill,minmax(160px,1fr))">
                @foreach($actors as $actor)
                    <article class="person">

                        <div class="ph sq"><img src="{{asset('storage/' . $actor->image)}}" alt="{{$actor->name}}"></div>
                        <h3 style="font-size:1.15rem">{{$actor->name}}</h3><span class="mut">{{$actor->role}}</span></article>
                @endforeach
            </div>
        </div>
    </section>
    <section class="sec">
        <div class="wrap split">
            <div id="dates"><h2>Ближайшие показы</h2>
                @foreach($afishes as $afisha)
                    <a class="date" href="/afisha/{{$afisha->id}}">
                        <div class="d">12 окт</div>
                        <div class="i"><b>{{$afisha->time}}</b><span class="mut">{{$afisha->city}}</span></div>
                        <span class="btn">Билеты</span></a>
                @endforeach

            </div>
            <div><h2>Награды спектакля</h2>
                @foreach($rewards as $reward)
                    <a href="{{asset('storage/' . $reward->url)}}" target="_blank">
                        <div class="award"><b>{{$reward->name}}</b><span class="mut">{{$reward->year}}, {{$reward->festival_name}}»</span></div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
</main>
<footer>
    <div class="wrap">
        <div class="g">
            <div><a class="logo" href="index.html">Театр СНАМИ</a>
                <p>Театральный союз. Играем живые спектакли для тех, кто любит театр.</p></div>
            <div><a href="afisha.html">Афиша</a><a href="repertoire.html">Репертуар</a><a href="team.html">Состав</a><a
                    href="reviews.html">Отзывы</a></div>
            <div><a href="tel:+70000000000">+7 000 000-00-00</a><a
                    href="mailto:info@snami.example">info@snami.example</a></div>
        </div>
        <small>© 2026 Театр СНАМИ</small>
    </div>
</footer>
</body>
</html>
