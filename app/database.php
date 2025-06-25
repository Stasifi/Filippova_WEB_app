<?php
// нет обработки ошибок подключения
$db = new SQLite3('database.db');

// создание таблицы пользователей с уязвимым дизайном
$db->exec("
    CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT NOT NULL,
        password TEXT NOT NULL
    )
");

//соединение не закрывается должным образом
?>