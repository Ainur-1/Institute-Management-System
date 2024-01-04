<?php

// Ваш пароль для хэширования
$password = '123';

// Генерация хэша
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Вывод хэшированного пароля на консоль
echo "Hashed Password: " . $hashedPassword . "\n";

?>
