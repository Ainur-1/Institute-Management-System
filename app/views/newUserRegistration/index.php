<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: app/views/authenticate/index.php");
    exit;
}

include 'db_config.php';
include 'app/controllers/RegisterController.php';

$pageTitle = "Регистрация нового пользователя";
include 'app/resources/includes/header.php';

$controller = new RegisterController($conn);
$controller->register();

include 'app/resources/includes/footer.php';
?>