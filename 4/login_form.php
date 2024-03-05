<?php
// Начало сессии
session_start();

// Подключение к базе данных
$link = mysqli_connect("localhost", "admin", "admin", "test");

if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

// Авторизация пользователя
if (!empty($_POST['login_auth']) && !empty($_POST['password_auth'])) {
    $loginAuth = mysqli_real_escape_string($link, $_POST['login_auth']);
    $passwordAuth = mysqli_real_escape_string($link, $_POST['password_auth']);

    $checkUserQuery = "SELECT * FROM users WHERE login='$loginAuth'";
    $checkUserResult = mysqli_query($link, $checkUserQuery);

    if (mysqli_num_rows($checkUserResult) > 0) {
        $userData = mysqli_fetch_assoc($checkUserResult);
        $salt = $userData['salt'];
        $saltedPassword = md5($salt . $passwordAuth);

        // Проверка соответствия хеша из базы введенному паролю
        if ($saltedPassword === $userData['password']) {
            // Авторизация успешна
            $_SESSION['auth'] = true;
            $_SESSION['user_id'] = $userData['id'];
            $_SESSION['login'] = $userData['login'];

            // Перенаправление на страницу профиля
            header('Location: profile.php');
            exit();
        } else {
            echo "<p><b>Неверный логин или пароль.</b></p>";
        }
    } else {
        echo "<p><b>Неверный логин или пароль.</b></p>";
    }
}

mysqli_close($link);
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
</head>
<body>

<!-- Форма для авторизации -->
<form action="" method="POST">
    <label for="login_auth">Логин:</label>
    <input type="text" name="login_auth" required>
    <br>

    <label for="password_auth">Пароль:</label>
    <input type="password" name="password_auth" required>
    <br>

    <input type="submit" value="Войти">
</form>

<a href="registet.php">Регистрация</a>

<img id="kitten" src="cats.png" alt="White Kitten">

</body>
</html>

<style>
/* Добавленные стили для котенка */
#kitten {
    position: absolute;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 150px; /* Задайте желаемую ширину котенка */
    border-radius: 50%; /* Округлите края для создания эффекта круглой формы */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

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

form {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 300px;
    text-align: center;
    margin: 50px 0; /* чтобы форма не прилипала к верху */
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
p {
    background-color: white;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    color: #e44d87;
}
a {
    text-decoration: none;
    color: #e44d87; /* Цвет ссылки */
    font-size: 30px;
}

a:hover {
    text-decoration: underline;
    color: #d33f6a; /* Цвет ссылки при наведении */
}
</style>
