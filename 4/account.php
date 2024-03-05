<!-- account.php -->
<!DOCTYPE html>
<html lang="ru">
<head>
    <!-- Ваши стили и метатеги -->
</head>
<body>
    <div class="profile-container">
        <h1>Профиль пользователя</h1>

        <?php
        // Предполагается, что $userData будет предварительно определена в вашем коде до этого момента
        if(isset($userData)) {
        ?>
        <!-- Форма редактирования -->
        <form action="process_profile_edit.php" method="post">
            <label for="fio">ФИО:</label>
            <input type="text" id="fio" name="fio" value="<?php echo $userData['fio']; ?>" required>

            <label for="birthdate">Дата рождения:</label>
            <input type="date" id="birthdate" name="birthdate" value="<?php echo $userData['birthdate']; ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $userData['email']; ?>" required>

            <label for="country">Страна:</label>
            <select id="country" name="country" required>
                <option value="russia" <?php echo ($userData['country'] === 'russia') ? 'selected' : ''; ?>>Россия</option>
                <option value="usa" <?php echo ($userData['country'] === 'usa') ? 'selected' : ''; ?>>США</option>
                <!-- Добавьте другие варианты стран по вашему выбору -->
            </select>

            <input type="submit" value="Сохранить изменения">
        </form>
        <?php
        } else {
            echo "<p>Данные пользователя не найдены.</p>";
        }
        ?>
    </div>
</body>
</html>

<style>
    /* Ваши стили CSS */
    /* ... */
</style>



    <style>
        /* Ваши стили CSS */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8d7da; /* нежно-розовый фон */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            position: relative;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url("47d2091e-8689-402a-b360-d7a2b7bb364b.png"); /* путь к изображению круга */
            background-size: 80px; /* размер кругов */
            background-position: 20px 20px; /* расстояние между кругами */
            opacity: 0.4; /* прозрачность кругов */
            pointer-events: none; /* чтобы круги не мешали взаимодействию с содержимым страницы */
            z-index: -1; /* поместить круги под содержимым страницы */
            filter: blur(6px); /* размытие фона */
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
            margin: 50px 0; /* чтобы форма не прилипала к верху */
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
            color: #e44d87; /* нежно-розовый цвет текста */
        }

        input {
            width: calc(100% - 16px);
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #e44d87; /* нежно-розовая рамка */
            border-radius: 4px;
            font-size: 14px;
            color: #333;
        }

        input[type="submit"] {
            background-color: #e44d87; /* нежно-розовый цвет кнопки */
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #d33f6a; /* темно-нежно-розовый цвет кнопки при наведении */
        }

        .error-message {
            color: #e74c3c;
            margin-bottom: 10px;
        }

        p {
            background-color: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            color: #e44d87;
        }

        select {
            width: calc(100% - 16px);
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #e44d87;
            border-radius: 4px;
            font-size: 14px;
            color: #333;
        }
    </style>