<?php
// Начало сессии
session_start();

// Проверка авторизации
if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== true) {
    // Если пользователь не авторизован, перенаправляем на страницу логина
    header('Location: login_form.php');
    exit();
}

// Подключение к базе данных через PDO
try {
    $pdo = new PDO("mysql:host=localhost;dbname=test", "admin", "admin");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения: " . $e->getMessage());
}

// Получение данных пользователя из базы данных
$login = $_SESSION['login'];
$query = "SELECT login, fio, birthdate, email, country, registration_date FROM users WHERE login=:login";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':login', $login, PDO::PARAM_STR);
$stmt->execute();
$userData = $stmt->fetch(PDO::FETCH_ASSOC);

// Вычисление полного возраста пользователя
$birthdate = new DateTime($userData['birthdate']);
$currentDate = new DateTime();
$age = $currentDate->diff($birthdate)->y;

// Обработка формы редактирования
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Проверяем, была ли отправлена форма редактирования
    if (isset($_POST['edit_mode'])) {
        // Устанавливаем флаг редактирования в сессии
        $_SESSION['edit_mode'] = true;
    } else {
        // Обрабатываем обновление данных, если форма была отправлена
        $newFio = htmlspecialchars($_POST['new_fio']);
        $newBirthdate = htmlspecialchars($_POST['new_birthdate']);
        $newEmail = htmlspecialchars($_POST['new_email']);
        $newCountry = htmlspecialchars($_POST['new_country']);

        // Обновление данных пользователя в базе данных
        $updateQuery = "UPDATE users SET fio=:newFio, birthdate=:newBirthdate, email=:newEmail, country=:newCountry WHERE login=:login";
        $updateStmt = $pdo->prepare($updateQuery);
        $updateStmt->bindParam(':newFio', $newFio, PDO::PARAM_STR);
        $updateStmt->bindParam(':newBirthdate', $newBirthdate, PDO::PARAM_STR);
        $updateStmt->bindParam(':newEmail', $newEmail, PDO::PARAM_STR);
        $updateStmt->bindParam(':newCountry', $newCountry, PDO::PARAM_STR);
        $updateStmt->bindParam(':login', $login, PDO::PARAM_STR);
        $updateStmt->execute();

        // Обновление данных в сессии
        $_SESSION['fio'] = $newFio;
        $_SESSION['birthdate'] = $newBirthdate;
        $_SESSION['email'] = $newEmail;
        $_SESSION['country'] = $newCountry;

        // Сбрасываем флаг редактирования в сессии
        unset($_SESSION['edit_mode']);

        // Перезагрузка страницы после редактирования
        header("Location: profile.php");
        exit();
    }
}

// Закрытие соединения с базой данных
$pdo = null;
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <!-- Остальные метатеги и стили остаются без изменений -->
</head>
<body>
    <div class="profile-container">
        <h1>Профиль пользователя</h1>
        <?php if (isset($_SESSION['edit_mode']) && $_SESSION['edit_mode']) : ?>
            <!-- Форма редактирования профиля -->
            <form action="profile.php" method="POST">
                <label for="new_fio">Новое ФИО:</label>
                <input type="text" name="new_fio" value="<?php echo isset($_SESSION['fio']) ? $_SESSION['fio'] : $userData['fio']; ?>" required>

                <label for="new_birthdate">Новая дата рождения:</label>
                <input type="date" name="new_birthdate" value="<?php echo isset($_SESSION['birthdate']) ? $_SESSION['birthdate'] : $userData['birthdate']; ?>" required>

                <label for="new_email">Новый Email:</label>
                <input type="email" name="new_email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : $userData['email']; ?>" required>

                <label for="new_country">Новая страна:</label>
                <input type="text" name="new_country" value="<?php echo isset($_SESSION['country']) ? $_SESSION['country'] : $userData['country']; ?>" required>

                <input type="submit" value="Сохранить изменения">
            </form>
        <?php else : ?>
            <!-- Отображение данных профиля -->
            <p><strong>Логин:</strong> <?php echo $userData['login']; ?></p>
            <p><strong>ФИО:</strong> <?php echo $userData['fio']; ?></p>
            <p><strong>Возраст:</strong> <?php echo $age; ?></p>
            <p><strong>Email:</strong> <?php echo $userData['email']; ?></p>
            <p><strong>Страна:</strong> <?php echo $userData['country']; ?></p>
            <p><strong>Дата регистрации:</strong> <?php echo $userData['registration_date']; ?></p>
        <?php endif; ?>

        <!-- Форма редактирования и кнопка "Редактировать" -->
        <?php if (!isset($_SESSION['edit_mode']) || !$_SESSION['edit_mode']) : ?>
            <form action="profile.php" method="POST">
                <input type="hidden" name="edit_mode" value="1">
                <input type="submit" value="Редактировать">
            </form>
        <?php endif; ?>

        <!-- Кнопка смены пароля -->
        <a href="deleteAccount.php" class="deleteAccount-button">Удалить аккаунт</a>
        
        <!-- Кнопка смены пароля -->
        <a href="changePassword.php" class="changePassword-button">Изменить пароль</a>

        <!-- Кнопка выхода -->
        <form action="logout.php" method="post">
            <input type="submit" value="Выйти">
        </form>
    </div>

    <!-- Кнопка "Пользователи" -->
    <a href="users.php" class="users-button">Пользователи</a>

    <!-- Код стилей и скриптов не изменяется -->
    <img id="kitten" src="cats.png" alt="White Kitten">
</body>
</html>
