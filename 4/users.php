<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список пользователей</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8d7da; /* нежно-розовый фон */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            position: relative;
            
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url("47d2091e-8689-402a-b360-d7a2b7bb364b.png"); /* путь к изображению круга */
            background-size: 80px; /* размер кругов */
            background-position: 20px 20px; /* расстояние между кругами */
            opacity: 0.4; /* прозрачность кругов */
            pointer-events: none; /* чтобы круги не мешали взаимодействию с содержимым страницы */
            z-index: -1; /* поместить круги под содержимым страницы */
            filter: blur(6px); /* размытие фона */
        }

        #kitten {
            width: 150px; /* Задайте желаемую ширину котенка */
            border-radius: 50%; /* Округлите края для создания эффекта круглой формы */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px; /* Добавленный отступ снизу */
            position: relative;
            top: -150px;
        }

        .users-container {
            background-color: #ffffff; /* белый фон контейнера */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
            margin: 0 auto; /* Центрирование контейнера */
            position: relative;
            top: -100px;
        }

        h1 {
            color: #e44d87; /* мягкий розовый цвет текста заголовка */
        }

        a {
            display: block;
            margin: 10px 0;
            padding: 10px;
            color: #e44d87; /* цвет ссылки */
            text-decoration: none;
            font-size: 16px;
            border: 1px solid #e44d87; /* рамка вокруг каждой ссылки */
            border-radius: 4px; /* закругленные углы рамки */
        }

        a:hover {
            text-decoration: underline; /* подчеркивание при наведении на ссылку */
        }

        .back-button {
            margin-top: 20px; /* Отступ сверху */
            background-color: #e44d87; /* нежно-розовый цвет кнопки */
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .back-button:hover {
            background-color: #d33f6a; /* темно-нежно-розовый цвет кнопки при наведении */
        }
    </style>
</head>
<body>
    <!-- Код стилей и скриптов не изменяется -->
    <img id="kitten" src="cats.png" alt="White Kitten">

    <div class="users-container">
        <h1>Список пользователей</h1>
        <?php
        // Подключение к базе данных
        $link = mysqli_connect("localhost", "admin", "admin", "test");

        if (!$link) {
            die("Ошибка подключения: " . mysqli_connect_error());
        }

        // Получение списка пользователей
        $query = "SELECT login FROM users";
        $result = mysqli_query($link, $query);

        if (!$result) {
            die("Ошибка получения списка пользователей: " . mysqli_error($link));
        }

        // Выводим список пользователей в виде блоков с ссылками
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<a href='user_profile.php?login={$row['login']}'>{$row['login']}</a>";
        }

        // Закрываем соединение
        mysqli_close($link);
        ?>
        
        <!-- Кнопка "Назад" -->
        <a href="profile.php" style="border: none"><button class="back-button">В профиль</button></a>
    </div>
</body>
</html>
