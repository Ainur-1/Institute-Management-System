<?php

class Students {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function DeleteStudent($user_id) {
        $sql = "DELETE FROM students WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Ошибка подготовки запроса для удаления связанных записей в таблице students: " . $this->conn->error);
        }

        $stmt->bind_param("i", $user_id);
        return $stmt->execute();
    }
}