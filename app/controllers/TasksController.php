<?php
include_once 'app/models/TasksModel.php';
include_once 'app/views/TasksView.php';

class TasksController {
    private $model;
    private $view;

    public function __construct($conn) {
        $this->model = new TasksModel($conn);
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

        $this->displayTasks();

        include 'resources/includes/footer.php';
    }

    private function displayTasks() {
        $tasks = $this->model->getTasks();
        if ($tasks) {
            $this->view->renderTasks($tasks);
        } else {
            $this->view->renderNoTasksMessage();
        }
    }
}