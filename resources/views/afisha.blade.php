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
            <h1>Афиша</h1><br>
            <div class="chips"><a class="chip on" href="?">Все</a><a class="chip" href="?month=10">Октябрь</a><a
                    class="chip" href="?month=11">Ноябрь</a><a class="chip" href="?month=12">Декабрь</a></div>


            <a class="date" href="afisha-item.html">
                <div class="d">12 окт</div>
                <div class="i"><b>Название спектакля</b><span
                        class="mut">Пятница, 19:00 · Основная сцена · от 800 ₽</span></div>
                <span class="btn">Подробнее</span></a>

            <a class="date" href="afisha-item.html">
                <div class="d">12 окт</div>
                <div class="i"><b>Название спектакля</b><span
                        class="mut">Пятница, 19:00 · Основная сцена · от 800 ₽</span></div>
                <span class="btn">Подробнее</span></a>

            <a class="date" href="afisha-item.html">
                <div class="d">12 окт</div>
                <div class="i"><b>Название спектакля</b><span
                        class="mut">Пятница, 19:00 · Основная сцена · от 800 ₽</span></div>
                <span class="btn">Подробнее</span></a>

            <a class="date" href="afisha-item.html">
                <div class="d">12 окт</div>
                <div class="i"><b>Название спектакля</b><span
                        class="mut">Пятница, 19:00 · Основная сцена · от 800 ₽</span></div>
                <span class="btn">Подробнее</span></a>

            <a class="date" href="afisha-item.html">
                <div class="d">12 окт</div>
                <div class="i"><b>Название спектакля</b><span
                        class="mut">Пятница, 19:00 · Основная сцена · от 800 ₽</span></div>
                <span class="btn">Подробнее</span></a>


            <div class="pg"></div>
        </div>
    </section>

    <section class="sec alt">
        <div class="wrap">
            <div class="sec-h"><h2>Недавние события</h2><a href="reviews.html">Отзывы зрителей</a></div>
            <div class="grid">
                <a class="card past" href="afisha-item.html">
                    <div class="ph w"></div>
                    <div class="b"><span class="tag">Состоялось 28 сентября</span>
                        <h3>Название спектакля</h3><span class="mut">Основная сцена</span></div>
                </a>
                <a class="card past" href="afisha-item.html">
                    <div class="ph w"></div>
                    <div class="b"><span class="tag">Состоялось 21 сентября</span>
                        <h3>Название спектакля</h3><span class="mut">Малая сцена</span></div>
                </a>
                <a class="card past" href="afisha-item.html">
                    <div class="ph w"></div>
                    <div class="b"><span class="tag">Состоялось 14 сентября</span>
                        <h3>Название спектакля</h3><span class="mut">Основная сцена</span></div>
                </a>
                <a class="card past" href="afisha-item.html">
                    <div class="ph w"></div>
                    <div class="b"><span class="tag">Состоялось 7 сентября</span>
                        <h3>Название спектакля</h3><span class="mut">Основная сцена</span></div>
                </a>
            </div>
        </div>
    </section>
</main>
<footer>
    <div class="wrap">
        <div class="g">
            <div><a class="logo" href="/">Театр СНАМИ</a>
                <p>Театральный союз. Играем живые спектакли для тех, кто любит театр.</p></div>
            <div><a href="/afisha">Афиша</a><a href="/repertuar">Репертуар</a><a href="/members">Состав</a><a
                    href="/reviews">Отзывы</a></div>
            <div><a href="tel:+70000000000">+7 000 000-00-00</a><a
                    href="mailto:info@snami.example">info@snami.example</a></div>
        </div>
        <small>© 2026 Театр СНАМИ</small>
    </div>
</footer>
</body>
</html>
