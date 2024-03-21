<?php

class Teachers {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function DeleteTeacher($user_id) {
        $sql = "DELETE FROM teachers WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Ошибка подготовки запроса для удаления связанных записей в таблице teachers: " . $this->conn->error);
        }

        $stmt->bind_param("i", $user_id);
        return $stmt->execute();
    }
}