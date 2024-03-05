<?php
session_start();

// Подключение к базе данных
$link = mysqli_connect("localhost", "root", "", "vel");

// Проверка соединения
if ($link === false) {
    die("Ошибка подключения: " . mysqli_connect_error());
}

// Проверяем, был ли отправлен комментарий
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $product_id = $_POST['product_id'];
    $user_id = $_SESSION['user_id']; // Предполагается, что у вас есть система аутентификации
    $comment_text = $_POST['comment_text'];

    // Подготавливаем SQL запрос
    $sql = "INSERT INTO comments (product_id, user_id, comment_text) VALUES (?, ?, ?)";

    // Подготавливаем запрос
    if ($stmt = mysqli_prepare($link, $sql)) {
        // Привязываем переменные к параметрам запроса
        mysqli_stmt_bind_param($stmt, "iis", $product_id, $user_id, $comment_text);

        // Выполняем запрос
        if (mysqli_stmt_execute($stmt)) {
            // Комментарий успешно добавлен
            echo "<script>alert('Комментарий успешно добавлен.'); window.location.href = 'product_details.php?id=$product_id';</script>";
            exit; // Важно завершить выполнение скрипта после вывода JavaScript
        } else {
            // В случае ошибки выводим сообщение об ошибке
            echo "Ошибка при добавлении комментария: " . mysqli_error($link);
        }

        // Закрываем запрос
        mysqli_stmt_close($stmt);
    }
}

// Закрываем соединение с базой данных
mysqli_close($link);
?>
