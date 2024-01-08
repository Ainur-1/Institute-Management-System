<?php
require_once "app/core/BaseModel.php";

class TasksModel extends BaseModel {
    public function __construct($conn) {
        parent::__construct($conn);
    }

    public function getTasks() {
        $sql = "
            SELECT
                Tasks.task_id,
                Tasks.task_name,
                Tasks.task_text,
                Tasks.task_status,
                Tasks.deadline,
                owner.first_name AS owner_first_name,
                owner.last_name AS owner_last_name,
                assignee.first_name AS assignee_first_name,
                assignee.last_name AS assignee_last_name,
                Tasks.creation_time,
                Tasks.last_updated_time
            FROM Tasks
            LEFT JOIN
                Users AS owner ON Tasks.task_owner = owner.user_id
            LEFT JOIN
                Users AS assignee ON Tasks.task_assignee = assignee.user_id;
        ";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Ошибка подготовки запроса: " . $this->conn->error);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $schedule = [];
            while ($row = $result->fetch_assoc()) {
                $schedule[] = $row;
            }
            return $schedule;
        } else {
            return null;
        }
    }
}
?>