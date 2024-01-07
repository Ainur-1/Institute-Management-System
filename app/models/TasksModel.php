<?php
require_once "app/core/BaseModel.php";

class TasksModel extends BaseModel {
    public function __construct($conn) {
        parent::__construct($conn);
    }

    public function getTasks() {
        return $this->selectAllFromTable('Tasks');
    }
}
?>