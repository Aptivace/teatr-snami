<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Отзывы — СНАМИ</title>
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
        <a href="awards.html">Награды</a>
        <a href="reviews.html" class="on">Отзывы</a>
        <a href="../index.html" target="_blank">Открыть сайт</a>
        <a href="login.html">Выйти</a>
    </aside>
    <main>
        <div class="top"><h1>Отзывы</h1>
            <div class="acts"><a class="btn s" href="?status=pending">На проверке</a><a class="btn s g"
                                                                                        href="?status=approved">Принятые</a><a
                    class="btn s g" href="?status=rejected">Отклонённые</a></div>
        </div>
        <div class="tw">
            <table>
                <tr>
                    <th>Автор</th>
                    <th>Отзыв</th>
                    <th>Спектакль</th>
                    <th>Статус</th>
                    <th></th>
                </tr>

                <tr>
                    <td>Имя зрителя<br><small>01.10.2026</small></td>
                    <td style="max-width:420px">Текст отзыва зрителя.</td>
                    <td>Название спектакля</td>
                    <td><span class="b wait">На проверке</span></td>
                    <td>
                        <div class="acts">
                            <form method="POST" action="#">
                                <button class="btn s ok">Принять</button>
                            </form>
                            <form method="POST" action="#">
                                <button class="btn s bad">Отклонить</button>
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
