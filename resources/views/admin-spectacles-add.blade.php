<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Новый спектакль — СНАМИ</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600&family=Newsreader:wght@500&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
<div class="app">
    <aside>
        <a class="logo" href="posters.html">СНАМИ</a>
        <a href="posters.html">Афиши</a>
        <a href="plays.html" class="on">Репертуар</a>
        <a href="members.html">Состав</a>
        <a href="awards.html">Награды</a>
        <a href="reviews.html">Отзывы</a>
        <a href="../index.html" target="_blank">Открыть сайт</a>
        <a href="login.html">Выйти</a>
    </aside>
    <main>
        <div class="top"><h1>Новый спектакль</h1><a class="btn g" href="plays.html">К списку</a></div>
        <form class="panel" method="POST" enctype="multipart/form-data" action="#">

            <div class="f">
                <div class="full"><label for="ti">Название</label><input id="ti" name="title" value="" required></div>
                <div><label for="g">Жанр</label><input id="g" name="genre" value=""></div>
                <div><label for="di">Режиссёр</label><input id="di" name="director" value=""></div>
                <div><label for="du">Длительность, мин</label><input id="du" type="number" min="1" name="duration"
                                                                     value=""></div>
                <div><label for="ag">Возраст</label><select id="ag" name="age">
                        <option>0+</option>
                        <option>6+</option>
                        <option>12+</option>
                        <option>16+</option>
                        <option>18+</option>
                    </select></div>
                <div><label for="pe">Год премьеры</label><input id="pe" type="number" name="premiere_year" value="">
                </div>
                <div><label for="im">Изображение</label><input id="im" type="file" name="image" accept="image/*"></div>
                <div class="full"><label for="sh">Краткое описание</label><input id="sh" name="excerpt" maxlength="200"
                                                                                 value=""></div>
                <div class="full"><label for="ds">Полное описание</label><textarea id="ds"
                                                                                   name="description"></textarea></div>
                <div class="full"><label for="ca">В ролях <small>(Ctrl/Cmd — выбрать несколько)</small></label><select
                        id="ca" name="members[]" multiple size="6"></select></div>
            </div>
            <button class="btn" type="submit">Сохранить спектакль</button>
        </form>
    </main>
</div>
</body>
</html>
