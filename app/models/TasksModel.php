<?php
require_once "app/core/BaseModel.php";

class TasksModel extends BaseModel {
    public function __construct($conn) {
        parent::__construct($conn);
    }

    public function getTasks() {
        $sql = "
        SELECT
            Tasks.task_id,
            Tasks.task_name,
            Tasks.task_text,
            TaskStatuses.status_name,
            Tasks.deadline,
            owner.first_name AS owner_first_name,
            owner.last_name AS owner_last_name,
            assignee.first_name AS assignee_first_name,
            assignee.last_name AS assignee_last_name,
            Tasks.creation_time,
            Tasks.last_updated_time
        FROM 
            Tasks
        LEFT JOIN
            TaskStatuses ON Tasks.task_status_id = TaskStatuses.status_id
        LEFT JOIN
            Users AS owner ON Tasks.task_owner = owner.user_id
        LEFT JOIN
            Users AS assignee ON Tasks.task_assignee = assignee.user_id;
        ";
        
        return $this->executeSelectQuery($sql);
    }

    public function getTaskFromId($task_id) {
        $sql = "SELECT * FROM `Tasks` WHERE `task_id` = ?";
        $stmt = $this->conn->prepare($sql);
    
        if(!$stmt){
            throw new Exception("Ошибка подготовки запроса: " . $this->conn->error);
        }
    
        $stmt->bind_param("i", $task_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if($result->num_rows === 0) {
            return null; 
        }
    
        $data = $result->fetch_assoc();
        $stmt->close();
        return $data;
    }

    public function updateTask($task_id, $task_name, $task_text, $deadline, $task_owner, $task_assignee, $task_status_id) {
        $sql = "
        UPDATE Tasks 
        SET 
            task_name = ?, 
            task_text = ?, 
            task_status_id = ?, 
            deadline = ?, 
            task_owner = ?, 
            task_assignee = ?, 
            last_updated_time = NOW() 
        WHERE 
            task_id = ?
        ";
        $stmt = $this->conn->prepare($sql);
        
        if(!$stmt){
            die("Ошибка подготовки запроса:" . $this->conn->error);
        }
        
        $stmt->bind_param("ssisiii", $task_name, $task_text, $task_status_id, $deadline, $task_owner, $task_assignee, $task_id);
        
        if ($stmt->execute()) {
            echo "Запись успешно обновлена.";
        } else {
            die("Ошибка выполнения запроса: " . $stmt->error);
        }
    }
    
    public function insertIntoTasks($task_name, $task_text, $deadline, $task_owner, $task_assignee, $task_status_id = 1) {	
        $sql = "
        INSERT INTO Tasks (
            task_name,
            task_text,
            task_status_id,
            deadline,
            task_owner,
            task_assignee,
            creation_time,
            last_updated_time
        ) 
        VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())
        ";
        
        $stmt = $this->conn->prepare($sql);

        if(!$stmt){
            die("Ошибка подготовки запроса" . $this->conn->error);
        }

        $stmt->bind_param("ssisii", $task_name, $task_text, $task_status_id, $deadline, $task_owner, $task_assignee);

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

    public function deleteTask($task_id) {
        // Проверка соединения с базой данных
        if (!$this->conn) {
            die("Ошибка соединения с базой данных.");
        }
    
        // Проверка наличия записи с указанным task_id
        $checkSql = "SELECT COUNT(*) FROM `Tasks` WHERE `task_id` = ?";
        $checkStmt = $this->conn->prepare($checkSql);
        $checkStmt->bind_param("i", $task_id);
        $checkStmt->execute();
        $count = 0;
        $checkStmt->bind_result($count);
        $checkStmt->fetch();
        $checkStmt->close();
    
        if ($count == 0) {
            echo "Запись с ID {$task_id} не найдена.";
            return;
        }
    
        // Удаление записи
        $sql = "DELETE FROM `Tasks` WHERE `task_id` = ?";
        $stmt = $this->conn->prepare($sql);
    
        if (!$stmt) {
            die("Ошибка подготовки запроса: " . $this->conn->error);
        }
    
        $stmt->bind_param("i", $task_id);
    
        if ($stmt->execute()) {
            echo "Запись успешно удалена.";
        } else {
            echo "Ошибка выполнения запроса: " . $stmt->error;
        }
    
        $stmt->close();
    }
}
?>