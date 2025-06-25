<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Уязвимость: XSS через неэкранированный вывод
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Добро пожаловать</title>
    <style>
        body { font-family: Arial; max-width: 500px; margin: 0 auto; padding: 20px; }
    </style>
</head>
<body>
    <h1>Привет, <?= $username ?>!</h1>
    <p>Вы успешно авторизовались в системе.</p>
    <p><a href="logout.php">Выйти</a></p>
    
    <!-- Уязвимость: отображение кук пользователю -->
    <div style="margin-top: 50px; font-size: 0.8em;">
        <h3>Техническая информация:</h3>
        <p>ID сессии: <?= session_id() ?></p>
        <p>Куки пользователя: <?= $_COOKIE['user'] ?? 'не установлено' ?></p>
    </div>
</body>
</html>