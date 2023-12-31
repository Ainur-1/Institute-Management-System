<?php
include "../../db_config.php";
include '../../controllers/ScheduleController.php';

$pageTitle = "Редактирование расписания";
include '../../../resources/includes/header.php';

$controller = new ScheduleController($conn);
$controller->displayScheduleEditor();

include '../../../resources/includes/footer.php';
?>