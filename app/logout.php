<?php
session_start();

// Уязвимость: неполное удаление сессии
session_unset();
session_destroy();

// Уязвимость: куки удаляются неправильно
setcookie('user', '', time() - 3600);

header('Location: login.php');
exit();
?>