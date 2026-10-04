<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Новая награда — СНАМИ</title>
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
        <a href="members.html">Состав</a>
        <a href="awards.html" class="on">Награды</a>
        <a href="reviews.html">Отзывы</a>
        <a href="../index.html" target="_blank">Открыть сайт</a>
        <a href="login.html">Выйти</a>
    </aside>
    <main>
        <div class="top"><h1>Новая награда</h1><a class="btn g" href="awards.html">К списку</a></div>
        <form class="panel" method="POST" enctype="multipart/form-data" action="#">

            <div class="f">
                <div class="full"><label for="ti">Название награды</label><input id="ti" name="title" value="" required>
                </div>
                <div><label for="y">Год</label><input id="y" type="number" name="year" value=""></div>
                <div><label for="o">Фестиваль / организация</label><input id="o" name="organization" value=""></div>
                <div class="full"><label for="pl">Спектакль <small>(необязательно)</small></label>
                    <select id="pl" name="play_id">
                        <option value="">Без привязки к спектаклю</option>
                    </select></div>
                <div class="full"><label for="d">Описание</label><textarea id="d" name="description"></textarea></div>
                <div><label for="im">Изображение</label><input id="im" type="file" name="image" accept="image/*"></div>
            </div>
            <button class="btn" type="submit">Сохранить награду</button>
        </form>
    </main>
</div>
</body>
</html>
