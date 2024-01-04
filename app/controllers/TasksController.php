<?php
include_once 'app/controllers/TasksController.php';
include_once 'app/views/TasksView.php';

class TasksController {

    private $view;

    public function __construct($conn) {
        $this->view = new TasksView();
    }

    public function index() {
        session_start();
        
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            header("Location: /");
            exit;
        }

        $pageTitle = "Задачи";

        include 'resources/includes/header.php';

        $this->view->output();
        echo $this->view->output();

        include 'resources/includes/footer.php';
    }
}