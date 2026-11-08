<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$play->name}} — Театр СНАМИ</title>
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
            <a href="/afisha" >Афиша</a>
            <a href="/repertuar" class="on">Репертуар</a>
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
                    <div><span>Длительность</span>{{$play->duration_text}}</div>
                    <div><span>Возраст</span>{{$play->age}}+</div>
                </div>
                <div class="desc">{{ \App\Support\Text::rich($play->desc) }}</div>
                <a class="btn" href="#dates">Ближайшие показы</a>
            </div>
        </div>
    </section>

    @php $gallery = collect($play->images)->slice(1)->values(); @endphp

    @if($gallery->isNotEmpty())
        <section class="sec alt">
            <div class="wrap">
                <h2>Фотографии</h2>
                <div class="gallery">
                    @foreach($gallery as $i => $img)
                        <button type="button" class="gallery-item" aria-label="Открыть фото {{ $i + 1 }}">
                            <img src="{{ asset('storage/' . $img) }}" alt="{{ $play->name }}, фото {{ $i + 1 }}" loading="lazy">
                        </button>
                    @endforeach
                </div>
            </div>
        </section>

        <dialog id="lightbox" class="lightbox">
            <button type="button" class="lb-close" aria-label="Закрыть">✕</button>
            <button type="button" class="lb-nav lb-prev" aria-label="Назад">‹</button>
            <img id="lb-img" alt="">
            <button type="button" class="lb-nav lb-next" aria-label="Вперёд">›</button>
            <div class="lb-count" id="lb-count"></div>
        </dialog>
    @endif
    <section class="sec">
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
    <section class="sec alt">
        <div class="wrap split">
            <div id="dates"><h2>Ближайшие показы</h2>
                @foreach($afishes as $afisha)
                    <a class="date" href="/afisha/{{$afisha->id}}">
                        <div class="d">{{ \Carbon\Carbon::parse($afisha->date)->translatedFormat('d M') }}</div>
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

<script>
    (() => {
        const dlg = document.getElementById('lightbox');
        if (!dlg) return;

        const items = [...document.querySelectorAll('.gallery-item')];
        const img = document.getElementById('lb-img');
        const counter = document.getElementById('lb-count');
        let cur = 0;

        const show = (i) => {
            cur = (i + items.length) % items.length;
            const src = items[cur].querySelector('img');
            img.src = src.src;
            img.alt = src.alt;
            counter.textContent = `${cur + 1} / ${items.length}`;
        };

        items.forEach((btn, i) => btn.addEventListener('click', () => {
            show(i);
            dlg.showModal();
        }));

        dlg.querySelector('.lb-close').addEventListener('click', () => dlg.close());
        dlg.querySelector('.lb-prev').addEventListener('click', () => show(cur - 1));
        dlg.querySelector('.lb-next').addEventListener('click', () => show(cur + 1));

        // клик по тёмному фону закрывает
        dlg.addEventListener('click', (e) => {
            if (e.target === dlg) dlg.close();
        });

        // стрелки на клавиатуре (Esc закрывает сам dialog)
        dlg.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') show(cur - 1);
            if (e.key === 'ArrowRight') show(cur + 1);
        });

        // свайп на телефоне
        let x0 = null;
        dlg.addEventListener('touchstart', (e) => { x0 = e.touches[0].clientX; }, {passive: true});
        dlg.addEventListener('touchend', (e) => {
            if (x0 === null) return;
            const dx = e.changedTouches[0].clientX - x0;
            if (Math.abs(dx) > 50) show(cur + (dx < 0 ? 1 : -1));
            x0 = null;
        });
    })();
</script>
</body>
</html>
