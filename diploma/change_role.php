<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vel";

try {
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Ошибка подключения: " . $e->getMessage();
    exit;
}

// Получение ID и роли пользователя из формы
$id = $_POST['id'];
$role = $_POST['role'];

// Обновление роли пользователя в базе данных
$stmt = $db->prepare("UPDATE users SET role = :role WHERE id = :id");
$stmt->execute(['role' => $role, 'id' => $id]);

// Перенаправление на страницу просмотра пользователей
header("Location: admin_panel_users.php");
exit;
?>