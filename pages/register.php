<?php
include '../controller/RegisterController.php';
include '../db_config.php';

include '../includes/header.php';
$controller = new RegisterController($conn);
$controller->register();

include '../includes/footer.php';
?>