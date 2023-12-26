<?php
$day = $_POST['day'];
$time = $_POST['time'];
$subject = $_POST['subject'];

// Загрузка текущего расписания
include 'schedule.php';

// Добавление нового занятия
$schedule[$day][$time] = $subject;

// Сортировка занятий по времени
ksort($schedule[$day]);

// Сохранение обновленного расписания
file_put_contents('schedule.php', '<?php $schedule = ' . var_export($schedule, true) . '; ?>');

// Перенаправление обратно на страницу редактирования
header('Location: edit_schedule.php');
exit;
