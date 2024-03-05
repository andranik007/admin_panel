<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/css/reg_log.css">
    <title>Регистрация</title>
</head>
<body>
<div class="form-container">
    <h2>Регистрация</h2>
    <form action="registration.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="login" placeholder="Логин" required><br>
        <input type="password" name="password" placeholder="Пароль" required><br>
        <input type="password" name="confirm_password" placeholder="Подтвердите пароль" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="file" name="avatar" accept="img" required><br><br>
        <button type="submit">Зарегистрироваться</button>

    <p>У вас уже есть аккаунт? <a href="login.php">Авторизируйтесь</a>!</p>
    </div>
</body>
</html>


<?php
session_start();

$link = mysqli_connect("localhost", "root", "", "vel");

if (!$link) {
    die("Ошибка подключения: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_POST['email'];

    // Хешируем пароль перед сохранением в базе данных
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Проверяем, был ли загружен файл аватарки
    if (!empty($_FILES['avatar']['name'])) {
        $avatar_name = $_FILES['avatar']['name'];
        $avatar_tmp_name = $_FILES['avatar']['tmp_name'];
        $avatar_size = $_FILES['avatar']['size'];
        $avatar_type = $_FILES['avatar']['type'];
        $avatar_error = $_FILES['avatar']['error'];

        // Папка для сохранения загруженных файлов
        $upload_dir = 'uploads/';

        // Генерация уникального имени файла для избежания конфликтов
        $avatar_path = $upload_dir . uniqid() . '_' . $avatar_name;

        // Перемещаем загруженный файл в указанную директорию
        if (move_uploaded_file($avatar_tmp_name, $avatar_path)) {
            // Файл успешно загружен, можно продолжить с регистрацией

            // Теперь сохраняем путь к загруженному файлу в базе данных
            $insert_query = "INSERT INTO users (login, password, email, role, avatar) VALUES ('$login', '$hashed_password', '$email', 'USER', '$avatar_path')";

            if (mysqli_query($link, $insert_query)) {
                header("Location: /ИС-4 Ханахян А.А/diploma/main.php");
                exit;
            } else {
                echo "Ошибка при регистрации: " . mysqli_error($link);
            }
        } else {
            echo "Ошибка при загрузке файла.";
        }
    } else {
        // Если аватарка не была загружена, продолжаем без нее
        $insert_query = "INSERT INTO users (login, password, email, role) VALUES ('$login', '$hashed_password', '$email', 'USER')";

        if (mysqli_query($link, $insert_query)) {
            header("Location: /ИС-4 Ханахян А.А/diploma/main.php");
            exit;
        } else {
            echo "Ошибка при регистрации: " . mysqli_error($link);
        }
    }

    mysqli_close($link);
}
?>

