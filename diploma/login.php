<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/css/reg_log.css">
    <title>Авторизация</title>
</head>
<body>
<div class="form-container">
    <h2>Авторизация</h2>
    <form action="login.php" method="POST">
        <input type="text" name="login" placeholder="Логин" required><br>
        <input type="password" name="password" placeholder="Пароль" required><br>
        <button type="submit">Войти</button>
    </form>
    <p>У вас нет аккаунта? <a href="registration.php">Зарегистрируйтесь</a>!</p>
</div>
</body>
</html>



<?php
session_start();

// Создание соединения с базой данных
$link = mysqli_connect("localhost", "root", "", "vel");

if (!$link) {
    die("Ошибка подключения: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $result = mysqli_query($link, "SELECT * FROM users WHERE login='$login'");
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        if (password_verify($password, $row['password'])) {
            $_SESSION['user'] = [
                'id' => $row['id'],
                'login' => $row['login'],
                'role' => $row['role']
            ];
            header("Location: main.php");
            exit(); // После перенаправления следует завершить выполнение скрипта
        } else {
            echo "<script>alert('Неверный логин или пароль');</script>";
        }
    } else {
        echo "<script>alert('Неверный логин или пароль');</script>";
    }
}

// Закрытие соединения с базой данных
mysqli_close($link);
?>