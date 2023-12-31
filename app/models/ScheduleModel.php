<?php
class ScheduleModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getSchedule() {
        return [
            'Понедельник' => [
                '09:00 - 10:30' => 'Математика',
                '11:00 - 12:30' => 'Физика',
            ],
            // ... Расписание для других дней
        ];
    }

    public function loadSchedule() {
        // ждет своего часа :)
    }

    public function editSchedule() {
        // ждет своего часа :)
    }

    public function saveSchedule() {
        $day = $_POST['day'];
        $time = $_POST['time'];
        $subject = $_POST['subject'];

        // Добавление нового занятия
        $schedule[$day][$time] = $subject;

        // Сортировка занятий по времени
        ksort($schedule[$day]);

        // Сохранение обновленного расписания
        file_put_contents('schedule.php', '<?php $schedule = ' . var_export($schedule, true) . '; ?>');

        // Перенаправление обратно на страницу редактирования
        header('Location: editSchedule/index.php');
        exit;
    }
}
?>