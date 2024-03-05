<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vel";

try {
    // Подключение к базе данных
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Ошибка подключения: " . $e->getMessage();
    exit;
}

// Получение идентификатора бренда из запроса
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Запрос на получение информации о бренде по его идентификатору
        $stmt = $db->prepare("SELECT * FROM brands WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $brand = $stmt->fetch(PDO::FETCH_ASSOC);

        // Проверка, найден ли бренд с указанным идентификатором
        if (!$brand) {
            echo "Бренд не найден.";
            exit;
        }
    } catch(PDOException $e) {
        echo "Ошибка запроса: " . $e->getMessage();
        exit;
    }
} else {
    // Если идентификатор бренда не указан в запросе, выводим сообщение об ошибке
    echo "Ошибка: Идентификатор бренда не указан.";
    exit;
}

// Проверка, была ли отправлена форма для обновления бренда
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы
    $id = $_POST['id'];
    $name = $_POST['name'];

    try {
        // Подготовка и выполнение запроса на обновление информации о бренде
        $stmt = $db->prepare("UPDATE brands SET name = :name WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->execute();

        // Перенаправление на страницу просмотра брендов после успешного обновления
        header("Location: admin_panel_brends.php");
        exit;
    } catch(PDOException $e) {
        echo "Ошибка обновления бренда: " . $e->getMessage();
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать бренд</title>
    <!-- Подключение стилей Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
</head>
<body>
<div class="container">
    <h2 class="mt-5">Редактировать бренд</h2>
    <form method="post" action="edit_brends.php?id=<?php echo $brand['id']; ?>" class="mt-4">
        <input type="hidden" name="id" value="<?php echo $brand['id']; ?>">
        <div class="mb-3">
            <label for="name" class="form-label">Название бренда:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $brand['name']; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        <a href="/diploma/admin_panel_brends.php" class="btn btn-success">Назад</a>
    </form>
</div>
<!-- Подключение скриптов Bootstrap и jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
