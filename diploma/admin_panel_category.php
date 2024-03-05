<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="assets/css/cont.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<header> <?php include 'Header/header.php'; ?> </header>
        
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

$stmt = $db->query("SELECT * FROM categories");
$categories = $stmt->fetchAll();
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
                <a href="/diploma/add_category.php" class="btn btn-success">Добавить котегорию</a>
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
                        <?php foreach ($categories as $categories): ?>
                            <tr>
                                <td><?php echo $categories['id']; ?></td>
                                <td><?php echo $categories['name']; ?></td>
                                <td>
                                    <!-- Кнопка для удаления товара -->
                                    <form method="post" action="delete_category.php">
                                        <input type="hidden" name="id" value="<?php echo $categories['id']; ?>">
                                        <button type="submit" class="btn btn-danger">Удалить</button>
                                    </form>
                                    <!-- Кнопка для редактирования товара -->
                                    <form method="get" action="edit_category.php" style="display: inline;">
                    <input type="hidden" name="id" value="<?php echo $categories['id']; ?>">
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
