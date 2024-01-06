<?php
require_once "app/core/BaseModel.php";

class RegisterModel  extends BaseModel {
    public function __construct($conn) {
        parent::__construct($conn);
    }

    public function registerUser($email, $password, $role_id, $first_name, $last_name) {
        try {
            $this->conn->begin_transaction();
            
            $user_id = $this->insertUser($email, $password, $role_id);
            if(!$user_id){
                throw new Exception("Ошибка при регистрации пользователя.");
            }

            $this->insertTeacher($user_id, $first_name, $last_name);
            $this->conn->commit();
            return "Пользователь и преподаватель успешно зарегистрированы.";
        } catch (Exception $e) {
            $this->conn->rollback();
            return $e->getMessage();
        }
        }

    private function insertUser($email, $password, $role_id) {
        $sql = "INSERT INTO Users (email, password, role_id) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
    
        if (!$stmt) {
            throw new Exception("Ошибка подготовки запроса для Users: " . $this->conn->error);
        }
    
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("ssi", $email, $hashedPassword, $role_id);
    
        if ($stmt->execute() && $stmt->affected_rows > 0) {
            // Получение последнего вставленного user_id
            return $stmt->insert_id;
        }
        return false;
    }

    private function insertTeacher($user_id, $first_name, $last_name) {
        $sql = "INSERT INTO Teachers (user_id, first_name, last_name) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Ошибка подготовки запроса для Teachers: " . $this->conn->error);
        }

        $stmt->bind_param("iss", $user_id, $first_name, $last_name);
        if (!$stmt->execute() || $stmt->affected_rows < 0) {
            throw new Exception("Ошибка при добавлении преподавателя: " . $stmt->error);
        }
    }
}
?>