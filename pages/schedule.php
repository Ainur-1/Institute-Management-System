<?php
include '../controller/ScheduleController.php';
include '../db_config.php';

include '../includes/header.php';

$controller = new ScheduleController($conn);
$controller->displaySchedule();

include '../includes/footer.php';
?>