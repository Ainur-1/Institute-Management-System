<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ../authenticate/index.php");
    exit;
}

include '../../../db_config.php';
include '../../controllers/RegisterController.php';

$pageTitle = "Регистрация нового пользователя";
include '../../../resources/includes/header.php';

$controller = new RegisterController($conn);
$controller->register();

include '../../../resources/includes/footer.php';
?>