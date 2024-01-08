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
            Users.first_name,
            Users.last_name,
            Schedule.day_of_week,
            ClassTimes.start_time,
            ClassTimes.end_time
        FROM 
            Schedule
        LEFT JOIN 
            Subjects ON Schedule.subject_id = Subjects.subject_id
        LEFT JOIN
            StudentGroups ON Schedule.group_id = StudentGroups.group_id
        LEFT JOIN 
            Teachers ON Schedule.teacher_id = Teachers.teacher_id
        LEFT JOIN 
            Users ON Teachers.user_id = Users.user_id
        LEFT JOIN
            ClassTimes ON Schedule.class_time_id = ClassTimes.class_time_id;
        ";
        
        return $this->executeSelectQuery($sql);
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