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
            ClassTimes.end_time,
            Schedule.is_deleted
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
        $sql = "UPDATE `Schedule` SET `is_deleted` = true WHERE `schedule_id` = ?";
        $stmt = $this->conn->prepare($sql);
    
        if (!$stmt) {
            die("Ошибка подготовки запроса: " . $this->conn->error);
        }
    
        $stmt->bind_param("i", $schedule_id);
    
        if ($stmt->execute()) {
            echo "Запись успешно помечена как удаленная.";
        } else {
            echo "Ошибка выполнения запроса: " . $stmt->error;
        }
    
        $stmt->close();
    }

    public function selectAllTeachers(){
        $sql = '
        SELECT 
	        users.user_id,
            teachers.teacher_id,
            users.first_name,
            users.last_name
        FROM users
        RIGHT JOIN teachers ON users.user_id = teachers.user_id;
        ';
        return $this->executeSelectQuery($sql);
    }
    
    public function UpdateClass($class_id, $group_id, $teacher_id, $day_of_week, $subject_id, $class_time_id) {   
        $sql = "
            UPDATE 
                schedule 
            SET 
                group_id = ?,
                teacher_id = ?,
                day_of_week = ?,
                subject_id = ?,
                class_time_id = ?
            WHERE 
                schedule_id = ?
            ";
        $stmt = $this->conn->prepare($sql);
    
        if (!$stmt) {
            die("Ошибка подготовки запроса: " . $this->conn->error);
        }   
    
        $stmt->bind_param("iiiiii", $group_id, $teacher_id, $day_of_week, $subject_id, $class_time_id, $class_id);
        $success = $stmt->execute();
    
        return $success;
    }

    public function AddSubject($subject_name) {
        $sql = 'INSERT INTO Subjects (subject_name) VALUES (?)';
        $stmt = $this->conn->prepare($sql);
    
        if (!$stmt) {
            throw new Exception("Ошибка подготовки запроса для Subjects: " . $this->conn->error);
        }
    
        $stmt->bind_param("s", $subject_name);
    
        if ($stmt->execute() && $stmt->affected_rows > 0) {
            return $stmt->insert_id;
        }
        return false;
    }    
}