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
        <div class="wrap">
            <h1>Репертуар</h1>
            <p class="lead">Спектакли, которые мы играем сейчас.</p><br>
            <div class="chips"><a class="chip on" href="?">Все</a><a class="chip" href="?genre=drama">Драма</a><a
                    class="chip" href="?genre=comedy">Комедия</a><a class="chip" href="?genre=kids">Детям</a></div>
            <div class="grid">


                @foreach($repertuar as $play)
                    <a class="card" href="/repertuar/{{$play->id}}">
                        <div class="ph w">
                            <img src="{{asset("storage/" . $play->images[0])}}" alt="{{$play->name}}">
                        </div>
                        <div class="b"><span class="tag">{{$play->genre}}, {{$play->age}}+</span>
                            <h3>{{$play->name}}</h3><span class="mut">{{$play->desc}}</span></div>
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
