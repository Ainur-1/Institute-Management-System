<?php
class BaseModel {
    protected $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function selectAllFromTable($table) {
        $sql = "SELECT * FROM `" . $table . "`";
        return $this->executeSelectQuery($sql);
    } 

    protected function executeSelectQuery($sql) {
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
?>