<?php
session_start();

// Подключение к базе данных
$link = mysqli_connect("localhost", "admin", "admin", "test");

if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

// Проверка аутентификации админа
if (empty($_SESSION['auth']) || $_SESSION['status'] !== 'admin') {
    header('Location: login_form.php'); // Перенаправляем на страницу входа
    exit();
}

// Запрос для получения списка пользователей
$query = "SELECT login, statuses.name as status
          FROM users
          JOIN statuses ON users.status_id = statuses.id";

$result = mysqli_query($link, $query);

if (!$result) {
    die('Ошибка выполнения запроса');
}

// HTML для вывода таблицы
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Административная панель</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Список зарегистрированных пользователей</h2>

<table>
    <tr>
        <th>Логин</th>
        <th>Статус</th>
    </tr>

    <?php
    // Выводим данные в таблицу
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>{$row['login']}</td><td>{$row['status']}</td></tr>";
    }
    ?>

</table>

</body>
</html>
