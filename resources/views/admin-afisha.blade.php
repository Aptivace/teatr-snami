<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Афиши — СНАМИ</title>
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
        <div class="top"><h1>Афиши</h1><a class="btn" href="poster-form.html">Добавить афишу</a></div>
        <div class="tw">
            <table>
                <tr>
                    <th>Спектакль</th>
                    <th>Дата и время</th>
                    <th>Площадка</th>
                    <th>Статус</th>
                    <th></th>
                </tr>

                <tr>
                    <td>Название спектакля</td>
                    <td>12.10.2026, 19:00</td>
                    <td>Основная сцена</td>
                    <td><span class="b ok">Опубликована</span></td>
                    <td>
                        <div class="acts"><a class="btn s g" href="poster-form.html">Изменить</a>
                            <form method="POST" action="#" onsubmit="return confirm('Удалить афишу?')">
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
