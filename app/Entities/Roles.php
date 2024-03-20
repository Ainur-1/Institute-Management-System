<?php

class Roles {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getRoles() {
        $sql = "SELECT * FROM roles";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Ошибка подготовки запроса: " . $this->conn->error);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}