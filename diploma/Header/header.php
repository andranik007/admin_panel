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

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">



</head>
<body>
<?php
session_start();


$user = null; // Инициализируем переменную $user значением null

if (isset($_SESSION['user'])) {
    // Пользователь авторизован
    $user = $_SESSION['user'];
  
    // Проверка роли пользователя
    if ($user['role'] == 'admin') {
    }
} else {
    // Пользователь не авторизован
}

// Выход из сессии и перенаправление на страницу авторизации
if (isset($_GET['logout'])) {
  session_destroy();
  header("Location: login.php");
  exit;
}
?>



<style>
  .navbar {
    background-color: #FF9559; /* Оранжевый цвет фона */
  }

  .navbar .nav-link {
    color: #000000 !important; /* Черный цвет ссылок */
    font-size: 30px !important; /* Размер текста ссылок */
    width: 100% !important; /* Ширина ссылок */
    text-align: center  /* Черный цвет ссылок */
  }

  .navbar .nav-link:hover {
    color: #333333 !important; /* Цвет ссылки при наведении */
  }
</style>

<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container">
    <a class="navbar-brand" href="/diploma/main.php"><img class="d-block w-100" src="uploads/Logotip.png" alt="Первый слайд"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">Каталог</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Аренда</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/diploma/about Us.php">О нас</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/diploma/contacts.php">Контакты</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="/diploma/cart.php"><i class="bi bi-cart2"></i></a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-person"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="profil.php">Профиль</a>
                            <?php if ($user && $user['role'] == 'admin') { ?>
                                <a class="dropdown-item" href="admin_panel.php">Админ панель</a>
                            <?php } ?>
                        </div>
                    </li>
                </ul>



      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="/diploma/login.php">Вход</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>