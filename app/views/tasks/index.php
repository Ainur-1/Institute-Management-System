<?php
session_start();

include 'db_config.php';

$pageTitle = "Задачи";
include 'resources/includes/header.php';

echo 'Добрый день, ' . $_SESSION['username'] . '!<br>У вас пока нет задач.';

include 'resources/includes/footer.php';
?>