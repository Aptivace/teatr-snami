<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Репертуар — СНАМИ</title>
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
        <div class="top"><h1>Репертуар</h1><a class="btn" href="play-form.html">Добавить спектакль</a></div>
        <div class="tw">
            <table>
                <tr>
                    <th>Название</th>
                    <th>Жанр</th>
                    <th>Режиссёр</th>
                    <th>Возраст</th>
                    <th></th>
                </tr>
                <tr>
                    <td>Название спектакля</td>
                    <td>Драма</td>
                    <td>Имя Фамилия</td>
                    <td>16+</td>
                    <td>
                        <div class="acts"><a class="btn s g" href="play-form.html">Изменить</a>
                            <form method="POST" action="#" onsubmit="return confirm('Удалить спектакль?')">
                                <button class="btn s bad">Удалить</button>
                            </form>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </main>
</div>
</body>
</html>
