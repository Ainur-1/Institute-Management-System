<?php

class Subjects {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function selectAllFromTable($table) {
        $sql = "SELECT * FROM `" . $table . "`";
        return $this->executeSelectQuery($sql);
    } 
    public function InsertNewSubject($subjectName) {
        $sql = "INSERT INTO Subjects (subject_name) VALUES (?)";
        $stmt = $this->conn->prepare($sql);
    
        if (!$stmt) {
            throw new Exception("Ошибка подготовки запроса для Users: " . $this->conn->error);
        }

        $stmt->bind_param("s", $subjectName);
    
        if ($stmt->execute() && $stmt->affected_rows > 0) {
            // Получение последнего вставленного user_id
            return $stmt->insert_id;
        }
        return false;
    }

    private function executeSelectQuery($sql) {
        try {
            $stmt = $this->conn->prepare($sql);

            if (!$stmt) {
                throw new Exception("Ошибка подготовки запроса: " . $this->conn->error);
            }

            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $data = [];
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                return $data;
            } else {
                return null;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}