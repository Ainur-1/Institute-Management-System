<?php
require_once "app/core/BaseModel.php";

class ScheduleModel extends BaseModel {
    public function __construct($conn) {
        parent::__construct($conn);
    }

    public function getSchedule() {
        $sql = "
        SELECT 
            Subjects.subject_name,
            StudentGroups.group_name,
            Teachers.first_name,
            Teachers.last_name,
            Schedule.day_of_week,
            ClassTimes.start_time,
            ClassTimes.end_time
        FROM 
            Schedule
        LEFT JOIN 
            Subjects ON Schedule.subject_id = Subjects.subject_id
        LEFT JOIN
            StudentGroups ON StudentGroups.group_id = Schedule.group_id
        LEFT JOIN 
            Teachers ON Schedule.teacher_id = Teachers.teacher_id
        LEFT JOIN
            ClassTimes ON Schedule.class_time_id = ClassTimes.class_time_id;
        ";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Ошибка подготовки запроса: " . $this->conn->error);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $schedule = [];
            while ($row = $result->fetch_assoc()) {
                $schedule[] = $row;
            }
            return $schedule;
        } else {
            return null;
        }
    }

    public function insertIntoSchedule($subject_id, $group_id, $teacher_id, $day_of_week, $class_time_id) {	
        $sql = "
        INSERT INTO Schedule (
            subject_id, 
            group_id,
            teacher_id, 
            day_of_week, 
            class_time_id
            ) 
        VALUES (?, ?, ?, ?, ?)
        ";
        
        $stmt = $this->conn->prepare($sql);

        if(!$stmt){
            die("Ошибка подготовки запроса" . $this->conn->error);
        }

        $stmt->bind_param("iiiii", $subject_id, $group_id, $teacher_id, $day_of_week, $class_time_id);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo "Запись успешно добавлена.";
            } else {
                echo "Запись не добавлена (возможно, конфликт с существующими данными).";
            }
        } else {
            echo "Ошибка выполнения запроса: " . $stmt->error;
        }
    }
}
?>