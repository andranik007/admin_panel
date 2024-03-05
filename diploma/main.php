<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="assets/css/cont.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body>
<header> <?php include 'Header/header.php'; ?> </header>



<div class="container mt-4">
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="uploads/Вел1.jpg" alt="Первый слайд">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="uploads/Вел2.jpg" alt="Второй слайд">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="uploads/Вел6.jpg" alt="Третий слайд">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Предыдущий</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Следующий</span>
    </a>
  </div>
</div>
<br>



<div class="container-fluid mt-8">
  <div class="row">
    <?php
   
    // Подключение к базе данных
    $link = mysqli_connect("localhost", "root", "", "vel");

    // Проверка соединения
    if ($link === false) {
      die("Ошибка подключения: " . mysqli_connect_error());
    }

    // SQL запрос для получения товаров из базы данных
    $sql = "SELECT * FROM products";
    $result = mysqli_query($link, $sql);

    // Отображение товаров в карточках
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<div class='col-md-2'>";
      echo "<div class='card' style='margin-bottom: 20px;'>";
      echo "<img src='{$row['img']}' class='card-img-top' alt='{$row['name']}'>";
      echo "<div class='card-body'>";
      echo "<h5 class='card-title'>{$row['name']}</h5>";
      echo "<p class='card-text'>Цена: {$row['price']}</p>";
      echo "<form method='post' action='add_to_cart.php'>";
      echo "<div class='input-group'>";
      echo "<input type='hidden' name='product_id' value='{$row['id']}'>";
      echo "<button type='submit' class='btn btn-primary'>Добавить в корзину</button>";
      echo "<a href='product_details.php?id={$row['id']}' class='btn btn-secondary'>Подробнее</a>";
      echo "</div>";
      echo "</form>";
      echo "</div></div></div>";
    }

    // Закрытие соединения с базой данных
    mysqli_close($link);
    ?>
  </div>
</div>








<!-- <footer class="bg-dark text-white py-1 fixed-bottom">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <p>2005 - 2024 &copy; Velo-shop.ru</p>
      </div>
      <div class="col-md-6">
        <p class="text-md-right">Интернет-магазин брендовых велосипедов и аксессуаров.</p>
      </div>
    </div>
  </div>
</footer> -->


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>