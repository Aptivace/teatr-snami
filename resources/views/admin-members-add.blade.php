<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Новый участник — СНАМИ</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600&family=Newsreader:wght@500&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
<div class="app">
    <aside>
        <a class="logo" href="posters.html">СНАМИ</a>
        <a href="posters.html">Афиши</a>
        <a href="plays.html">Репертуар</a>
        <a href="members.html" class="on">Состав</a>
        <a href="awards.html">Награды</a>
        <a href="reviews.html">Отзывы</a>
        <a href="../index.html" target="_blank">Открыть сайт</a>
        <a href="login.html">Выйти</a>
    </aside>
    <main>
        <div class="top"><h1>Новый участник</h1><a class="btn g" href="members.html">К списку</a></div>
        <form class="panel" method="POST" enctype="multipart/form-data" action="#">

            <div class="f">
                <div><label for="n">Имя и фамилия</label><input id="n" name="name" value="" required></div>
                <div><label for="r">Роль в театре</label><input id="r" name="role" placeholder="Актёр, режиссёр…"
                                                                value=""></div>
                <div><label for="ph">Фото</label><input id="ph" type="file" name="photo" accept="image/*"></div>
                <div><label for="o">Порядок на странице</label><input id="o" type="number" name="sort" value=""></div>
                <div class="full"><label for="b">Биография</label><textarea id="b" name="bio"></textarea></div>
            </div>
            <button class="btn" type="submit">Сохранить участника</button>
        </form>
    </main>
</div>
</body>
</html>
