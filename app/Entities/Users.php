<?php
class Users {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getUsers() {
        $sql = "SELECT * FROM users";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Ошибка подготовки запроса: " . $this->conn->error);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserByEmail($email) {
        $email = mysqli_real_escape_string($this->conn, $email);
        $sql = "SELECT * FROM Users WHERE email=?";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Ошибка подготовки запроса: " . $this->conn->error);
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updateUserPassword($userId, $hashedPassword) {
        $sql = "UPDATE users SET password = ? WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Ошибка подготовки запроса: " . $this->conn->error);
        }   

        $stmt->bind_param("si", $hashedPassword, $userId);
        $success = $stmt->execute();

        return $success;
    }

    public function AddUser($email, $password, $role_id, $first_name, $last_name, $group_id = null) {
        try {
            $this->conn->begin_transaction();
            
            $user_id = $this->insertUser($first_name, $last_name, $email, $password, $role_id);
            if(!$user_id){
                throw new Exception("Ошибка при регистрации пользователя.");
            }
            if ($role_id == 1) {
                return "Добавление нового администратора запрещено!";
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