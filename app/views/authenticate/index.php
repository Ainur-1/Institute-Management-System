<?php
include "../../../db_config.php";
include '../../controllers/AuthenticateController.php';

$pageTitle = "Авторизация";
include '../../../resources/includes/header.php';

$controller = new AuthenticateController($conn);
$controller->authenticate();

include '../../../resources/includes/footer.php';
?>