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
}
?>