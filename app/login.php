<?php
if (isset($_GET['registered'])) {
    $message = "Регистрация успешна! Теперь вы можете войти.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $db = new SQLite3('database.db');
    // sql инъекция
    $user = $db->querySingle("SELECT * FROM users WHERE username = '$username' AND password = '$password'", true);
    
    if ($user) {
        session_start();
        // слабая сессия
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        
        // небезопасные куки
        setcookie('user', $user['username'], time() + 3600);
        
        header('Location: welcome.php');
        exit();
    } else {
        $error = "Неверные учетные данные";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Авторизация</title>
    <style>
        body { font-family: Arial; max-width: 500px; margin: 0 auto; padding: 20px; }
        .error { color: red; }
        .success { color: green; }
        input { display: block; margin-bottom: 10px; padding: 5px; width: 100%; }
    </style>
</head>
<body>
    <h1>Авторизация</h1>
    <?php if (isset($message)): ?>
        <p class="success"><?= $message ?></p>
    <?php endif; ?>
    <?php if (isset($error)): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Имя пользователя" required>
        <input type="password" name="password" placeholder="Пароль" required>
        <button type="submit">Войти</button>
    </form>
    <p>Нет аккаунта? <a href="register.php">Зарегистрироваться</a></p>
</body>
</html>