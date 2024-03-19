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
}