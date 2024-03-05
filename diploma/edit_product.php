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
        // Запрос для получения брендов из базы данных
        $stmt = $db->query("SELECT id, name FROM brands");
        $brands = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Запрос для получения категорий из базы данных
        $stmt = $db->query("SELECT id, name FROM categories");
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Ошибка подключения: " . $e->getMessage();
        exit;
    }
    

// Проверка, была ли отправлена форма для обновления товара
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $category_id = $_POST["category"];
    $brand_id = $_POST["brand"];

    try {
        // Подготовка и выполнение запроса на обновление информации о товаре,
        // включая категорию и бренд
        $stmt = $db->prepare("UPDATE products SET name = :name, price = :price, description = :description, category_id = :category_id, brand_id = :brand_id WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':category_id', $category_id); // Добавлено сохранение категории
        $stmt->bindParam(':brand_id', $brand_id); // Добавлено сохранение бренда
        $stmt->execute();

        // Перенаправление на страницу просмотра товаров после успешного обновления
        header("Location: admin_panel.php");
        exit;
    } catch(PDOException $e) {
        echo "Ошибка обновления товара: " . $e->getMessage();
        exit;
    }
}

// Получение идентификатора товара из запроса
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Запрос на получение информации о товаре по его идентификатору
        $stmt = $db->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        // Проверка, найден ли товар с указанным идентификатором
        if (!$product) {
            echo "Товар не найден.";
            exit;
        }
    } catch(PDOException $e) {
        echo "Ошибка запроса: " . $e->getMessage();
        exit;
    }
} else {
    // Если идентификатор товара не указан в запросе, выводим сообщение об ошибке
    echo "Ошибка: Идентификатор товара не указан.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать товар</title>
    <!-- Подключение стилей Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
</head>
<body>
<div class="container">
    <h2 class="mt-5">Редактировать товар</h2>
    <form method="post" action="edit_product.php?id=<?php echo $product['id']; ?>" class="mt-4">
        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
        <div class="mb-3">
            <label for="name" class="form-label">Название:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $product['name']; ?>">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Цена:</label>
            <input type="text" class="form-control" id="price" name="price" value="<?php echo $product['price']; ?>">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Описание:</label>
            <textarea class="form-control" id="description" name="description"><?php echo $product['description']; ?></textarea>
        </div>
        <!-- Выпадающий список для выбора категории -->
<!-- Выпадающий список для выбора категории -->
<div class="mb-3">
    <label for="category" class="form-label">Категория</label>
    <select class="form-select" id="category" name="category" required>
        <option value="" selected disabled>Выберите категорию</option>
        <!-- PHP-код для заполнения выпадающего списка категорий -->
        <?php foreach ($categories as $category): ?>
            <option value="<?php echo $category['id']; ?>" <?php if ($category['id'] == $product['category_id']) echo 'selected'; ?>><?php echo $category['name']; ?></option>
        <?php endforeach; ?>
    </select>
</div>

<!-- Выпадающий список для выбора бренда -->
<div class="mb-3">
    <label for="brand" class="form-label">Бренд</label>
    <select class="form-select" id="brand" name="brand" required>
        <option value="" selected disabled>Выберите бренд</option>
        <!-- PHP-код для заполнения выпадающего списка брендов -->
        <?php foreach ($brands as $brand): ?>
            <option value="<?php echo $brand['id']; ?>" <?php if ($brand['id'] == $product['brand_id']) echo 'selected'; ?>><?php echo $brand['name']; ?></option>
        <?php endforeach; ?>
    </select>
</div>


        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        <a href="/diploma/admin_panel.php" class="btn btn-success">Назад</a>
    </form>
</div>
<!-- Подключение скриптов Bootstrap и jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
