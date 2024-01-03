<?php
include 'db_config.php';
include 'app/controllers/ScheduleController.php';

$pageTitle = "Расписание занятий";
include 'resources/includes/header.php';

$controller = new ScheduleController($conn);
$controller->displaySchedule();

include 'resources/includes/footer.php';
?>