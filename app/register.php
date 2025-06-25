<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // нет валидации ввода
    $db = new SQLite3('database.db');
    
    // sql инъекция
    $result = $db->querySingle("SELECT username FROM users WHERE username = '$username'");
    
    if ($result) {
        $error = "Пользователь уже существует";
    } else {
        // пароль не хешируется
        $db->exec("INSERT INTO users (username, password) VALUES ('$username', '$password')");
        header('Location: login.php?registered=1');
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Регистрация</title>
    <style>
        body { font-family: Arial; max-width: 500px; margin: 0 auto; padding: 20px; }
        .error { color: red; }
        input { display: block; margin-bottom: 10px; padding: 5px; width: 100%; }
    </style>
</head>
<body>
    <h1>Регистрация</h1>
    <?php if (isset($error)): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Имя пользователя" required>
        <input type="password" name="password" placeholder="Пароль" required>
        <button type="submit">Зарегистрироваться</button>
    </form>
    <p>Уже есть аккаунт? <a href="login.php">Войти</a></p>
</body>
</html>