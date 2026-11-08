<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Состав — Театр СНАМИ</title>
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
            <a href="/members" class="on">Состав</a>
            <a href="/reviews">Отзывы</a>
        </nav>
    </div>
</header>
<main>
    <section class="sec">
        <div class="wrap">
            <h1>Состав</h1>
            <p class="lead">Актёры, режиссёры и команда, которая делает спектакли.</p><br>
            <div class="grid" style="grid-template-columns:repeat(auto-fill,minmax(220px,1fr))">
                @foreach($members as $member)
                    <article class="person" data-member="m{{ $member->id }}" tabindex="0" role="button"
                             aria-label="Подробнее: {{ $member->name }}">
                        <div class="ph"><img src="{{ asset('storage/' . $member->image) }}" alt="{{ $member->name }}"></div>
                        <h3>{{ $member->name }}</h3><span class="mut">{{ $member->role }}</span>
                    </article>
                @endforeach
            </div>

            @foreach($members as $member)
                <dialog class="mdlg" id="m{{ $member->id }}" aria-label="{{ $member->name }}">
                    <button type="button" class="mdlg-close" aria-label="Закрыть">✕</button>
                    <img src="{{ asset('storage/' . $member->image) }}" alt="{{ $member->name }}" loading="lazy">
                    <div class="mdlg-body">
                        <h2>{{ $member->name }}</h2>
                        <span class="mut">{{ $member->role }}</span>
                        @if($member->desc)
                            <div class="desc">{{ \App\Support\Text::rich($member->desc) }}</div>
                        @endif
                    </div>
                </dialog>
            @endforeach
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
        document.querySelectorAll('[data-member]').forEach((card) => {
            const dlg = document.getElementById(card.dataset.member);
            const open = () => dlg.showModal();

            card.addEventListener('click', open);
            card.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    open();
                }
            });
        });

        document.querySelectorAll('dialog.mdlg').forEach((dlg) => {
            dlg.querySelector('.mdlg-close').addEventListener('click', () => dlg.close());
            // клик по затемнённому фону закрывает
            dlg.addEventListener('click', (e) => {
                if (e.target === dlg) dlg.close();
            });
        });
    })();
</script>
</body>
</html>
