<?php
require_once "app/core/BaseModel.php";

class ScheduleModel extends BaseModel {
    public function __construct($conn) {
        parent::__construct($conn);
    }

    public function getSchedule() {
        $sql = "
        SELECT
            Schedule.schedule_id,
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

    public function getClassFromId($schedule_id) {
        $sql = "SELECT * FROM Schedule WHERE schedule_id = ?";
        $stmt = $this->conn->prepare($sql);
    
        if(!$stmt){
            throw new Exception("Ошибка подготовки запроса: " . $this->conn->error);
        }
    
        $stmt->bind_param("i", $schedule_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if($result->num_rows === 0) {
            return null; 
        }
    
        $data = $result->fetch_assoc();
        $stmt->close();
        return $data;
    }

    public function getTeachersNames() {
        $sql = "
        SELECT
            Teachers.teacher_id,
            Users.first_name,
            Users.last_name
        FROM
            Teachers
        LEFT JOIN
            Users ON Teachers.user_id = Users.user_id;
        ";

        return $this->executeSelectQuery($sql);
    }

    public function updateClass($schedule_id, $subject_id, $group_id, $teacher_id, $day_of_week, $class_time_id) {	
        $sql = "
        UPDATE Schedule 
        SET
            subject_id = ?, 
            group_id = ?,
            teacher_id = ?, 
            day_of_week = ?, 
            class_time_id  = ?
        WHERE
            schedule_id = ?
        ";
        
        $stmt = $this->conn->prepare($sql);

        if(!$stmt){
            die("Ошибка подготовки запроса:" . $this->conn->error);
        }

        $stmt->bind_param("iiiiii", $subject_id, $group_id, $teacher_id, $day_of_week, $class_time_id, $schedule_id);

        if ($stmt->execute()) {
            echo "Запись успешно добавлена.";
        } else {
            die("Ошибка выполнения запроса: " . $stmt->error);
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

    public function deleteClass($schedule_id) {
        // Проверка соединения с базой данных
        if (!$this->conn) {
            die("Ошибка соединения с базой данных.");
        }
    
        // Проверка наличия записи с указанным schedule_id
        $checkSql = "SELECT COUNT(*) FROM `Schedule` WHERE `schedule_id` = ?";
        $checkStmt = $this->conn->prepare($checkSql);
        $checkStmt->bind_param("i", $schedule_id);
        $checkStmt->execute();
        $count = 0;
        $checkStmt->bind_result($count);
        $checkStmt->fetch();
        $checkStmt->close();
    
        if ($count == 0) {
            echo "Запись с ID {$schedule_id} не найдена.";
            return;
        }
    
        // Удаление записи
        $sql = "DELETE FROM `Schedule` WHERE `schedule_id` = ?";
        $stmt = $this->conn->prepare($sql);
    
        if (!$stmt) {
            die("Ошибка подготовки запроса: " . $this->conn->error);
        }
    
        $stmt->bind_param("i", $schedule_id);
    
        if ($stmt->execute()) {
            echo "Запись успешно удалена.";
        } else {
            echo "Ошибка выполнения запроса: " . $stmt->error;
        }
    
        $stmt->close();
    }
    
}
?>