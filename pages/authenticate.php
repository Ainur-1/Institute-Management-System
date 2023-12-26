<?php
include "../db_config.php";
include '../controller/AuthenticateController.php';

include '../includes/header.php';

$controller = new AuthenticateController($conn);
$controller->authenticate();

include '../includes/footer.php';
?>