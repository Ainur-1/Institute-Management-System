<?php
class AuthenticateModel {

    private $conn;
    private $user;

    public function __construct($conn) {
        $this->conn = $conn;
        $this->user = new User($this->conn);
    }

    public function registerUser($email, $password, $role_id, $first_name, $last_name) {
        // Начать транзакцию
        $this->conn->begin_transaction();
    
        $sqlUser = "
        INSERT INTO Users (
            email,
            password,
            role_id
            ) 
        VALUES (?, ?, ?)
        ";
    
        $stmtUser = $this->conn->prepare($sqlUser);
    
        if (!$stmtUser) {
            die("Ошибка подготовки запроса для Users: " . $this->conn->error);
        }
    
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmtUser->bind_param("ssi", $email, $hashedPassword, $role_id);
    
        if ($stmtUser->execute() && $stmtUser->affected_rows > 0) {
            // Получение последнего вставленного user_id
            $lastUserId = $stmtUser->insert_id;
    
            // Вставка в таблицу Teachers
            $sqlTeacher = "
            INSERT INTO Teachers (
                user_id,
                first_name,
                last_name
            )
            VALUES (?, ?, ?)
            ";
    
            $stmtTeacher = $this->conn->prepare($sqlTeacher);
    
            if (!$stmtTeacher) {
                die("Ошибка подготовки запроса для Teachers: " . $this->conn->error);
            }
    
            $stmtTeacher->bind_param("iss", $lastUserId, $first_name, $last_name);
    
            if ($stmtTeacher->execute() && $stmtTeacher->affected_rows > 0) {
                // Фиксация транзакции
                $this->conn->commit();
                echo "Пользователь и преподаватель успешно зарегистрированы.";
            } else {
                // Откат транзакции в случае ошибки
                $this->conn->rollback();
                echo "Произошла ошибка при добавлении преподавателя: " . $stmtTeacher->error;
            }
        } else {
            // Откат транзакции в случае ошибки
            $this->conn->rollback();
            echo "Ошибка выполнения запроса для Users: " . $stmtUser->error;
        }
    }
    
    public function authenticateUser($username, $password) {
        $user = $this->user->getUserByEmail($username);

        if ($user) {
            $hashed_password = $user['password'];

            if (password_verify($password, $hashed_password)) {
                return true;
            } else {
                return "Неправильный пароль!";
            }
        } else {
            return "Пользователь не найден!";
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
}
?>