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

$stmt = $db->query("SELECT * FROM brands");
$brands = $stmt->fetchAll();
?>

<head>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

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

<header> <?php include 'Header/header.php'; ?> </header>

<body>
<div class="container-fluid">
        <h2 class="text-center mt-5">Admin Panel</h2>

        <h2 class="text-center mt-5">Все Бренды</h2>

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
                <a href="/diploma/add_brends.php" class="btn btn-success">Добавить бренд</a>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($brands as $brands): ?>
                            <tr>
                                <td><?php echo $brands['id']; ?></td>
                                <td><?php echo $brands['name']; ?></td>
                                <td>
                                    <!-- Кнопка для удаления товара -->
                                    <form method="post" action="delete_brends.php">
                                        <input type="hidden" name="id" value="<?php echo $brands['id']; ?>">
                                        <button type="submit" class="btn btn-danger">Удалить</button>
                                    </form>
                                    <!-- Кнопка для редактирования товара -->
                                    <form method="get" action="edit_brends.php" style="display: inline;">
                    <input type="hidden" name="id" value="<?php echo $brands['id']; ?>">
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
