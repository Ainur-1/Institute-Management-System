<?php
require_once "app/core/BaseModel.php";

class UsersModel extends BaseModel {
    public function __construct($conn) {
        parent::__construct($conn);
    }

    public function registerUser($email, $password, $role_id, $first_name, $last_name, $group_id = null) {
        try {
            $this->conn->begin_transaction();
            
            $user_id = $this->insertUser($first_name, $last_name, $email, $password, $role_id);
            if(!$user_id){
                throw new Exception("Ошибка при регистрации пользователя.");
            }
            if ($role_id == 2) {
                $this->insertTeacher($user_id);
                $this->conn->commit();
                return "Преподаватель успешно зарегистрирован.";
            }
            if ($role_id == 3) {
                $this->insertStudents($user_id, $group_id);
                $this->conn->commit();
                return "Студент успешно зарегистрирован.";
            }
        } catch (Exception $e) {
            $this->conn->rollback();
            return $e->getMessage();
        }
    }

    public function deleteUser($user_id) {
        {
            // Проверка соединения с базой данных
            if (!$this->conn) {
                die("Ошибка соединения с базой данных.");
            }
        
            // Проверка наличия записи с указанным user_id
            $checkSql = "SELECT COUNT(*) FROM `Users` WHERE `user_id` = ?";
            $checkStmt = $this->conn->prepare($checkSql);
            $checkStmt->bind_param("i", $user_id);
            $checkStmt->execute();
            $count = 0;
            $checkStmt->bind_result($count);
            $checkStmt->fetch();
            $checkStmt->close();
        
            if ($count == 0) {
                echo "Запись с ID {$user_id} не найдена.";
                return;
            }
        
            // Удаление записи
            $sql = "DELETE FROM `Users` WHERE `user_id` = ?";
            $stmt = $this->conn->prepare($sql);
        
            if (!$stmt) {
                die("Ошибка подготовки запроса: " . $this->conn->error);
            }
        
            $stmt->bind_param("i", $user_id);
        
            if ($stmt->execute()) {
                echo "Запись успешно удалена.";
            } else {
                echo "Ошибка выполнения запроса: " . $stmt->error;
            }
        
            $stmt->close();
        }
    }

    public function getUserById($user_id) {
        $sql = "SELECT * FROM `Users` WHERE `user_id` = ?";
        $stmt = $this->conn->prepare($sql);
    
        if(!$stmt){
            throw new Exception("Ошибка подготовки запроса: " . $this->conn->error);
        }
    
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if($result->num_rows === 0) {
            return null; 
        }
    
        $data = $result->fetch_assoc();
        $stmt->close();
        return $data;
    }

    private function insertUser($first_name, $last_name, $email, $password, $role_id) {
        $sql = "INSERT INTO Users (first_name, last_name, email, password, role_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
    
        if (!$stmt) {
            throw new Exception("Ошибка подготовки запроса для Users: " . $this->conn->error);
        }
    
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("ssssi", $first_name, $last_name, $email, $hashedPassword, $role_id);
    
        if ($stmt->execute() && $stmt->affected_rows > 0) {
            // Получение последнего вставленного user_id
            return $stmt->insert_id;
        }
        return false;
    }

    private function insertTeacher($user_id) {
        $sql = "INSERT INTO Teachers (user_id) VALUES (?)";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Ошибка подготовки запроса для Teachers: " . $this->conn->error);
        }

        $stmt->bind_param("i", $user_id);
        if (!$stmt->execute() || $stmt->affected_rows < 0) {
            throw new Exception("Ошибка при добавлении новой строки в таблицу Teachers: " . $stmt->error);
        }
    }

    private function insertStudents($user_id, $group_id) {
        $sql = "INSERT INTO Students (user_id, group_id) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Ошибка подготовки запроса для Students: " . $this->conn->error);
        }

        $stmt->bind_param("ii", $user_id, $group_id);
        if (!$stmt->execute() || $stmt->affected_rows < 0) {
            throw new Exception("Ошибка при добавлении новой строки в таблицу Students: " . $stmt->error);
        }
    }
}
?>