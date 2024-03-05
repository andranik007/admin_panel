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

// Обработка данных из формы
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];

    // Добавление данных в базу данных
    $stmt = $db->prepare("INSERT INTO brands (name) VALUES (:name)");
    $stmt->execute(['name' => $name]);
    header("Location: admin_panel_brends.php");
}
?>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
</head>
<body>
<div class="container">
    <h2 class="mt-5">Добавление бренда</h2>
    <form method="post" action="add_brends.php" class="mt-4">
        <div class="mb-3">
            <label for="name" class="form-label">Название бренда</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <button type="submit" class="btn btn-primary">Добавить</button>
        <a href="/diploma/admin_panel.php" class="btn btn-success">Назад</a>
    </form>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>