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
</head>
<body>




<style>



.price {
  font-weight: bold;
  color: #ff0000; /* Красный цвет */
  /* Другие стили, если нужно */
}





.wrapper_inner {
    justify-content: center;
    align-items: center;
}

.tizers_block {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    max-width: 100%; /* Максимальная ширина блока равна ширине страницы */
    padding: 0 20px; /* Добавляем отступы по бокам */
    box-sizing: border-box; /* Учитываем отступы внутри блока */
}

.tizers_block .item {
    width: calc(20% - 20px);
    margin-bottom: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

.tizers_block .item .img i {
    font-size: 48px;
    width: 48px;
    height: 36px;
    margin-bottom: 10px;
}

.tizers_block .item .title {
    font-size: 14px;
}
</style>
<header> <?php include 'Header/header.php'; ?> </header>

<?php
// Подключение к базе данных
$link = mysqli_connect("localhost", "root", "", "vel");

// Проверка соединения
if ($link === false) {
  die("Ошибка подключения: " . mysqli_connect_error());
}

// Получение ID товара из параметров запроса
$product_id = $_GET['id'];

// SQL запрос для получения информации о товаре по его ID
$sql = "SELECT * FROM products WHERE id = '$product_id'";
$result = mysqli_query($link, $sql);

// Проверка наличия товара
if (mysqli_num_rows($result) > 0) {
  // Отображение информации о товаре
  $row = mysqli_fetch_assoc($result);
  echo "<div class='container1' style='display: flex; margin-left: 150px; margin-top: 10px;'>";
  echo "<div class='row'>";
  echo "<div class='col-md-6'>";
  echo "<h2>{$row['name']}</h2>";
  echo "<img style='display: flex; margin-top: 15px;' src='{$row['img']}' alt='{$row['name']}' class='img-fluid' style='width: 600px; height: 389px;'>";
  echo "<p style='display: flex; margin-top: 20px;'>Описание: {$row['description']}</p>";
  echo "</div>";
  echo "<div class='col-md-6' style='margin-top: 30px; text-align: center;'>";
  echo "<p style='font-size: 22px;'>Цена: <span class='price'>{$row['price']} руб.</span></p>";
  echo "<form method='post' action='add_to_cart.php'>";
  echo "<input type='hidden' name='product_id' value='{$row['id']}'>";
  echo "<button type='submit' class='btn btn-primary'>Добавить в корзину</button>";
  echo "</form>";
  echo "</div>";
  echo "</div>";
  echo "</div>";
} else {
  echo "Товар не найден.";
}


$sql_comments = "SELECT comments.comment_text, users.login FROM comments JOIN users ON comments.user_id = users.id WHERE comments.product_id = '$product_id'";
$result_comments = mysqli_query($link, $sql_comments);





// Закрытие соединения с базой данных
mysqli_close($link);
?>

<div class="wrapper_inner">
    <div class="tizers_block">
        <div id="bx_1373509569_410" class="item">
                <div class="img"><i class="bi bi-wallet2"></i></div>
                <div class="title">Наличный и безналичный расчет</div>
        </div>
        <div id="bx_1373509569_411" class="item">
                <div class="img"><i class="bi bi-truck"></i></div>
                <div class="title">Доставка по всей России</div>
        </div>
        <div id="bx_1373509569_412" class="item">
            <div class="img"><i class="bi bi-arrow-counterclockwise"></i></div>
            <div class="title">Возврат товара в течение 30 дней</div>
        </div>
        <div id="bx_1373509569_413" class="item">
                <div class="img"><i class="bi bi-shield-check"></i></div>
                <div class="title">Официальная гарантия от 1 года</div>
        </div>
        <div id="bx_1373509569_414" class="item">
                <div class="img"><i class="bi bi-telephone"></i></div>
                <div class="title">Бесплатный звонок 8 800 555-17-04</div>
        </div>
    </div>
</div>

<?php

echo "<div class='container mt-5'>";
echo "<h3>Отзывы о товаре</h3>";
echo "<ul>";
while ($comment_row = mysqli_fetch_assoc($result_comments)) {
  echo "<i class='bi bi-person'></i><b>{$comment_row['login']}:</b> {$comment_row['comment_text']}<br>";
}
echo "</ul>";
echo "</div>";?>

<div class="container mt-5">
    <h3>Оставьте свой отзыв о товаре</h3>
    <form id="comment_form" action="comments.php" method="post">
        <div class="form-group">
            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
            <label for="comment_text">Отзыв</label>
            <textarea class="form-control" id="comment_text" name="comment_text" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
</div>




<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>