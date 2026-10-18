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
            <h1>Отзывы</h1>
            <p class="lead">Что говорят зрители о наших спектаклях.</p><br>
            <div class="split">
                <div style="display:grid;gap:20px">

                    @foreach($reviews as $review)
                        <figure class="quote" style="margin:0"><p>{{$review->text}}</p>
                            <figcaption class="mut">{{$review->username}} · <a href="/repertuar/{{$review->spectacle->id}}">{{$review->spectacle->name}}</a> ·
                                {{$review->created_at->format('d.m.Y')}}
                            </figcaption>
                        </figure>
                    @endforeach
                    <div class="pg"></div>
                </div>
                <form class="quote" method="POST" action="/reviews">
                    @csrf

                    <h3>Оставить отзыв</h3>
                    <p class="mut">Отзыв появится на сайте после проверки.</p>
                    <label for="n">Ваше имя</label><input id="n" name="username" required value="">
                    <label for="p">Спектакль</label><select id="p" name="spectacle_id">
                        <option value="">Не выбран</option>
                        @foreach($repertuar as $play)
                            <option value="{{$play->id}}">{{$play->name}}</option>
                        @endforeach
                    </select>
                    <label for="t">Отзыв</label><textarea id="t" name="text" rows="5" required></textarea>
                    <button class="btn" type="submit">Отправить отзыв</button>
                </form>
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
