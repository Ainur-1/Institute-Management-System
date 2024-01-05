<?php
class ScheduleModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
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

    public function selectAllFromTable($table) {
        $sql = "SELECT * FROM `" . $table . "`";
        $result = $this->conn->query($sql);

        if (!$result) {
            die("Ошибка выполнения запроса: " . $this->conn->error);
        }

        if ($result->num_rows > 0) {
            $tableData = [];
            while ($row = $result->fetch_assoc()) {
                $tableData[] = $row;
            }
            return $tableData;
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