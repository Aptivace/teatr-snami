<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Новая афиша — СНАМИ</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600&family=Newsreader:wght@500&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
<div class="app">
    <aside>
        <a class="logo" href="posters.html">СНАМИ</a>
        <a href="posters.html" class="on">Афиши</a>
        <a href="plays.html">Репертуар</a>
        <a href="members.html">Состав</a>
        <a href="awards.html">Награды</a>
        <a href="reviews.html">Отзывы</a>
        <a href="../index.html" target="_blank">Открыть сайт</a>
        <a href="login.html">Выйти</a>
    </aside>
    <main>
        <div class="top"><h1>Новая афиша</h1><a class="btn g" href="posters.html">К списку</a></div>
        <form class="panel" method="POST" enctype="multipart/form-data" action="#">

            <div class="f">
                <div class="full"><label for="play">Спектакль</label><select id="play" name="play_id" required>
                        <option value="">Выберите спектакль</option>
                    </select></div>
                <div><label for="d">Дата</label><input id="d" type="date" name="date" value="" required></div>
                <div><label for="t">Время</label><input id="t" type="time" name="time" value="" required></div>
                <div><label for="v">Площадка</label><input id="v" name="venue" value=""></div>
                <div><label for="pr">Цена от, ₽</label><input id="pr" type="number" min="0" name="price" value=""></div>
                <div class="full"><label for="u">Ссылка на покупку билетов</label><input id="u" type="url"
                                                                                         name="ticket_url" value="">
                </div>
                <div class="full"><label for="ds">Описание показа</label><textarea id="ds"
                                                                                   name="description"></textarea></div>
                <div><label for="im">Изображение <small>(если не задано, берётся со спектакля)</small></label><input
                        id="im" type="file" name="image" accept="image/*"></div>
                <div><label for="st">Статус</label><select id="st" name="status">
                        <option value="published">Опубликована</option>
                        <option value="draft">Черновик</option>
                    </select></div>
            </div>
            <button class="btn" type="submit">Сохранить афишу</button>
        </form>
    </main>
</div>
</body>
</html>
