<?php
class BaseModel {
    protected $conn;

    public function __construct($conn) {
        $this->conn = $conn;
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