<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ../authenticate/index.php");
    exit;
}

$SESSION_username = $_SESSION['username'];
include "../../../db_config.php";
include '../../controllers/ProfileController.php';

$pageTitle = "Профиль";
include '../../../resources/includes/header.php';

$controller = new ProfileController($conn);
$controller->displayInformation($SESSION_username);

include '../../../resources/includes/footer.php';
?>