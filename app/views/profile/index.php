<?php
require_once "../../../db_config.php";
include '../../controllers/ProfileController.php';

$pageTitle = "Профиль";
include '../../../resources/includes/header.php';

$controller = new ProfileController($conn);
$controller->displayInformation();

include '../../../resources/includes/footer.php';
?>