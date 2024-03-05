<?php
// Проверка, передан ли логин в URL
if (isset($_GET['login'])) {
    $selectedLogin = $_GET['login'];

    // Подключение к базе данных
    $link = mysqli_connect("localhost", "admin", "admin", "test");

    if (!$link) {
        die("Ошибка подключения: " . mysqli_connect_error());
    }

    // Получение данных выбранного пользователя
    $query = "SELECT login, fio, birthdate, email, country, registration_date FROM users WHERE login='$selectedLogin'";
    $result = mysqli_query($link, $query);

    if (!$result) {
        die("Ошибка получения данных пользователя: " . mysqli_error($link));
    }

    // Проверяем, найдены ли данные пользователя
    if (mysqli_num_rows($result) > 0) {
        $userData = mysqli_fetch_assoc($result);

        // Вычисление полного возраста пользователя
        $birthdate = new DateTime($userData['birthdate']);
        $currentDate = new DateTime();
        $age = $currentDate->diff($birthdate)->y;
    } else {
        die("Пользователь не найден");
    }

    // Закрываем соединение
    mysqli_close($link);
} else {
    // Если логин не передан, перенаправляем на страницу с пользователями
    header('Location: users.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль пользователя</title>
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

        .profile-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center; /* Выравнивание по центру */
            margin: 50px 0; /* чтобы форма не прилипала к верху */
        }

        h1 {
            color: #e44d87; /* нежно-розовый цвет текста */
        }

        p {
            margin: 10px 0; /* добавляем отступы для параграфов */
        }
        button {
            margin-top: 20px; /* Отступ сверху */
            background-color: #e44d87; /* нежно-розовый цвет кнопки */
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #d33f6a; /* темно-нежно-розовый цвет кнопки при наведении */
        }
    </style>
</head>
<body>
    <div>
        <!-- Код стилей и скриптов не изменяется -->
        <img id="kitten" src="cats.png" alt="White Kitten">
    </div>
        
    <div class="profile-container">
        <?php if (isset($userData)) : ?>
            <h1>Профиль пользователя</h1>
            <p><strong>Логин:</strong> <?php echo $userData['login']; ?></p>
            <p><strong>ФИО:</strong> <?php echo $userData['fio']; ?></p>
            <p><strong>Возраст:</strong> <?php echo $age; ?></p>
            <p><strong>Email:</strong> <?php echo $userData['email']; ?></p>
            <p><strong>Страна:</strong> <?php echo $userData['country']; ?></p>
            <p><strong>Дата регистрации:</strong> <?php echo $userData['registration_date']; ?></p>
        <?php else : ?>
            <p>Пользователь не найден</p>
        <?php endif; ?>
    </div>

    <div>
        <a href="users.php"><button>Назад</button></a>
    </div>
</body>
</html>

