<?php
include '../../../db_config.php';
include '../../controllers/RegisterController.php';

$pageTitle = "Регистрация нового пользователя";
include '../includes/header.php';
$controller = new RegisterController($conn);
$controller->register();

include '../includes/footer.php';
?>