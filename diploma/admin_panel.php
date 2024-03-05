

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
$stmt = $db->query("SELECT * FROM products");
$stmt = $db->query("
    SELECT 
        p.id, 
        p.name, 
        p.price, 
        p.description, 
        p.img, 
        c.name AS category_name, 
        b.name AS brand_name 
    FROM products p 
    INNER JOIN categories c ON p.category_id = c.id 
    INNER JOIN brands b ON p.brand_id = b.id
");
$products = $stmt->fetchAll();



?>

<head>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<header> <?php include 'Header/header.php'; ?> </header>

    <style>

</head>

<style>
    .dropdown-menu .dropdown-item {
        color: #770000;
    }
    .dropdown-menu .dropdown-item:hover {
        background-color: #f2f2f2;
    }

   
</style>
<body>
    <div class="container-fluid">
        <h2 class="text-center mt-5">Admin Panel</h2>

        <h2 class="text-center mt-5">Все товары</h2>

        <div class="row mt-3">
            <div class="col-auto">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                        Просмотр
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="admin_panel_users.php">Просмотреть зарегистрированных пользователей</a></li>
                        <li><a class="dropdown-item" href="admin_panel.php">Просмотреть товары</a></li>
                        <li><a class="dropdown-item" href="admin_panel_brends.php">Просмотреть бренды</a></li>
                        <li><a class="dropdown-item" href="admin_panel_category.php">Просмотреть категории</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-auto ml-auto">
                <a href="/diploma/add_products.php" class="btn btn-success">Добавить товар</a>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col">
                <table class="table table-bordered" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название</th>
                            <th>Цена</th>
                            <th>Описание</th>
                            <th>Изображение</th>
                            <th>Категория</th>
                            <th>Бренд</th>
                            <th>Управление</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?php echo $product['id']; ?></td>
                                <td><?php echo $product['name']; ?></td>
                                <td><?php echo $product['price']; ?></td>
                                <td><?php echo $product['description']; ?></td>
                                <td><img src="<?php echo $product['img']; ?>" style="width: 110px; height: 100px;"></td>
                                <td><?php echo $product['category_name']; ?></td>
                <td><?php echo $product['brand_name']; ?></td>
                                <td>
                                    <!-- Кнопка для удаления товара -->
                                    <form method="post" action="delete_product.php">
                                        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                                        <button type="submit" class="btn btn-danger">Удалить</button>
                                    </form>
                                    <!-- Кнопка для редактирования товара -->
                                    <form method="get" action="edit_product.php" style="display: inline;">
                    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                    <button type="submit" class="btn btn-primary">Редактировать</button>
                </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
