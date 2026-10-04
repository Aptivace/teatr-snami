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
            <div class="ph"></div>
            <div>
                <span class="tag">12 октября, пятница, 19:00</span><br><br>
                <h1 style="font-size:clamp(2rem,5vw,3.4rem)">Название спектакля</h1>
                <div class="facts">
                    <div><span>Площадка</span>Основная сцена, адрес</div>
                    <div><span>Стоимость</span>от 800 ₽</div>
                    <div><span>Длительность</span>2 часа, с антрактом</div>
                    <div><span>Возраст</span>16+</div>
                </div>
                <p>Описание показа: что увидит зритель, особенности вечера, состав исполнителей.</p>
                <div style="display:flex;gap:12px;flex-wrap:wrap"><a class="btn" href="#">Купить билет</a><a
                        class="btn ghost" href="play.html">О спектакле</a></div>
            </div>
        </div>
    </section>
    <section class="sec alt">
        <div class="wrap">
            <h2>Другие даты</h2>
            <a class="date" href="afisha-item.html">
                <div class="d">19 окт</div>
                <div class="i"><b>Название спектакля</b><span class="mut">Пятница, 19:00</span></div>
                <span class="btn">Подробнее</span></a>
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
