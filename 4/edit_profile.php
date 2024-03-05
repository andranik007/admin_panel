<?php
session_start();

if (!isset($_SESSION['auth']) || !$_SESSION['auth']) {
    // Если пользователь не авторизован, перенаправляем на страницу входа
    header('Location: login_form.php');
    exit();
}

// Подключение к базе данных
$link = mysqli_connect("localhost", "admin", "admin", "test");

if (!$link) {
    die("Ошибка подключения: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $userId = mysqli_real_escape_string($link, $_GET['id']);
    НУ ЧЕ ПАРНИ, КАК ДЕЛА , КОГДА БУДЕМ СМОТРЕТЬ АНИМЕ ?
    СТАВЬТЕ ЛАЙКИ И ПОДПИСЫВАЙТЕСЬ НА КАНАЛ 
    С ВАМИ БЫЛ МИСТЕР МАКС ПОКА ПОКА 
    ВОАПВАПЩО ОВ

    $query = "SELECT * FROM users WHERE id = '$userId'";
    $result = mysqli_query($link, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $userData = mysqli_fetch_assoc($result);
    } else {
        die("Пользователь не найден");
    }
} else {
    die("Неверные параметры запроса");
}

// Закрываем соединение
mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование профиля</title>
    <style>
        /* Ваши стили CSS */
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

        .edit-profile-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
            margin: 50px 0; /* чтобы форма не прилипала к верху */
        }

        h1 {
            color: #e44d87; /* нежно-розовый цвет текста */
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
            color: #e44d87; /* нежно-розовый цвет текста */
        }

        input {
            width: calc(100% - 16px);
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #e44d87; /* нежно-розовая рамка */
            border-radius: 4px;
            font-size: 14px;
            color: #333;
        }

        input[type="submit"] {
            background-color: #e44d87; /* нежно-розовый цвет кнопки */
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #d33f6a; /* темно-нежно-розовый цвет кнопки при наведении */
        }

        .error-message {
            color: #e74c3c;
            margin-bottom: 10px;
        }

        a {
            text-decoration: none;
            color: #e44d87; /* Цвет ссылки */
            font-size: 16px;
        }

        a:hover {
            text-decoration: underline;
            color: #d33f6a; /* Цвет ссылки при наведении */
        }
    </style>
</head>
<body>
    <div class="edit-profile-container">
        <h1>Редактирование профиля</h1>
        <form action="update_profile.php" method="POST">
            <input type="hidden" name="user_id" value="<?php echo $userData['id']; ?>">
            
            <label for="login">Логин:</label>
            <input type="text" name="login" value="<?php echo $userData['login']; ?>" required>
            <br>

            <label for="fio">ФИО:</label>
            <input type="text" name="fio" value="<?php echo $userData['fio']; ?>" required>
            <br>

            <label for="birthdate">Дата рождения:</label>
            <input type="date" name="birthdate" value="<?php echo $userData['birthdate']; ?>" required>
            <br>

            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo $userData['email']; ?>" required>
            <br>

            <label for="country">Страна:</label>
            <input type="text" name="country" value="<?php echo $userData['country']; ?>" required>
            <br>

            <input type="submit" value="Сохранить изменения">
        </form>

        <a href="user_profile.php?login=<?php echo $userData['login']; ?>">Отмена</a>
    </div>
</body>
</html>
