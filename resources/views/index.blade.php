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
                <p class="lead">СНАМИ — театральный союз актёров и режиссёров. Мы играем камерные и большие спектакли и
                    любим, когда зал дышит вместе со сценой.</p>
                <div class="acts"><a class="btn" href="afisha.html">Выбрать спектакль</a><a class="btn ghost"
                                                                                            href="repertoire.html">Весь
                        репертуар</a></div>
            </div>
            <div class="ph"><!-- <img src="storage/hero.jpg" alt="Сцена театра СНАМИ"> --></div>
        </div>
    </section>

    <section class="sec alt">
        <div class="wrap">
            <div class="sec-h"><h2>Ближайшие показы</h2><a href="afisha.html">Вся афиша</a></div>

            <a class="date" href="afisha-item.html">
                <div class="d">12 окт</div>
                <div class="i"><b>Название спектакля</b><span class="mut">Пятница, 19:00 · Основная сцена</span></div>
                <span class="btn">Билеты</span></a>
            <a class="date" href="afisha-item.html">
                <div class="d">19 окт</div>
                <div class="i"><b>Название спектакля</b><span class="mut">Пятница, 19:00 · Малая сцена</span></div>
                <span class="btn">Билеты</span></a>
            <a class="date" href="afisha-item.html">
                <div class="d">26 окт</div>
                <div class="i"><b>Название спектакля</b><span class="mut">Пятница, 18:30 · Основная сцена</span></div>
                <span class="btn">Билеты</span></a>

        </div>
    </section>

    <section class="sec">
        <div class="wrap">
            <div class="sec-h"><h2>Репертуар</h2><a href="repertoire.html">Все спектакли</a></div>
            <div class="grid">


                <a class="card" href="play.html">
                    <div class="ph w"></div>
                    <div class="b"><span class="tag">Драма, 16+</span>
                        <h3>Название спектакля</h3><span class="mut">Режиссёр: Имя Фамилия</span></div>
                </a>

                <a class="card" href="play.html">
                    <div class="ph w"></div>
                    <div class="b"><span class="tag">Драма, 16+</span>
                        <h3>Название спектакля</h3><span class="mut">Режиссёр: Имя Фамилия</span></div>
                </a>

                <a class="card" href="play.html">
                    <div class="ph w"></div>
                    <div class="b"><span class="tag">Драма, 16+</span>
                        <h3>Название спектакля</h3><span class="mut">Режиссёр: Имя Фамилия</span></div>
                </a>

            </div>
        </div>
    </section>

    <section class="sec alt">
        <div class="wrap split">
            <div><h2>О театре</h2>
                <p class="lead">Мы работаем с живым словом и честной игрой. В труппе — актёры разных поколений, а в
                    репертуаре — классика, современная драматургия и экспериментальные постановки.</p><a
                    class="btn ghost" href="team.html">Познакомиться с труппой</a></div>
            <div>
                <h3>Награды</h3>

                <div class="award"><b>Название награды</b><span
                        class="mut">2025, фестиваль «Название» · «Спектакль»</span></div>
                <br>
                <div class="award"><b>Название награды</b><span class="mut">2024, фестиваль «Название»</span></div>
            </div>
        </div>
    </section>

    <section class="sec">
        <div class="wrap">
            <div class="sec-h"><h2>Говорят зрители</h2><a href="reviews.html">Все отзывы</a></div>
            <div class="grid">

                <figure class="quote" style="margin:0"><p>Текст отзыва зрителя о спектакле — несколько живых
                        предложений.</p>
                    <figcaption class="mut">Имя зрителя</figcaption>
                </figure>

                <figure class="quote" style="margin:0"><p>Текст отзыва зрителя о спектакле — несколько живых
                        предложений.</p>
                    <figcaption class="mut">Имя зрителя</figcaption>
                </figure>

                <figure class="quote" style="margin:0"><p>Текст отзыва зрителя о спектакле — несколько живых
                        предложений.</p>
                    <figcaption class="mut">Имя зрителя</figcaption>
                </figure>

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
