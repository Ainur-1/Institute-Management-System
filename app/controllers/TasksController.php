<?php
include_once 'app/models/TasksModel.php';
include_once 'app/views/TasksView.php';

class TasksController {
    private $model;
    private $view;
    private $statuses = [
        'Pending',         // Ожидание
        'In Progress',     // В процессе
        'Completed',       // Завершено
        'On Hold',         // В ожидании
        'Cancelled',       // Отменено
    ];

    public function __construct($conn) {
        $this->model = new TasksModel($conn);
        $this->view = new TasksView();
    }

    public function index($page, $id = null) {
        session_start();
        
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            header("Location: /");
            exit;
        }

        switch ($page) {
            case 'tasks':
                $pageTitle = "Задачи";
                include 'resources/includes/header.php';
                $this->displayTasks();
                break;
            case 'editTasks':
                $pageTitle = "Редактирование задач";
                include 'resources/includes/header.php';
                $this->displayTasksEditor();
                break;
            case 'addNewTask':
                $pageTitle = "Добваление новой задачи";
                include 'resources/includes/header.php';
                $this->displayAddTaskForm();
                break;
            case 'editTask':
                $pageTitle = "Редактирование занятия";
                include 'resources/includes/header.php';
                $this->displayTaskEditForm($id);
                break; 
        }

        include 'resources/includes/footer.php';
    }

    private function displayTasks() {
        $tasks = $this->model->getTasks();
        $hasUserTasks = false;
        foreach ($tasks as $row) {
            if ($row['owner_first_name'] == $_SESSION['first_name'] && $row['owner_last_name'] == $_SESSION['last_name']) {
                $hasUserTasks = true; 
            }
        }
        if ($tasks && $hasUserTasks) {
            $this->view->renderTasks($tasks);
        } else {
            $this->view->renderNoTasksMessage();
        }
    }

    private function displayTasksEditor() {
        $tasks = $this->model->getTasks();
        $this->view->renderTasksEditor($tasks);
    }

    public function displayAddTaskForm() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $task_name = $_POST['task_name'];
            $task_text = $_POST['task_text'];
            $task_status = $_POST['task_status'];
            $deadline = $_POST['deadline'];
            $task_owner = $_POST['task_owner'];
            $task_assignee = $_POST['task_assignee'];

            $this->model->insertIntoTasks($task_name, $task_text, $task_status, $deadline, $task_owner, $task_assignee);
        } else {
            $users = $this->model->selectAllFromTable("Users");
            echo $this->view->renderAddNewTaskForm($users, $this->statuses);
        }
    }
    
    public function displayTaskEditForm($id) {
        $task = $this->model->getTaskFromId($id);
        $users = $this->model->selectAllFromTable("Users");

        $this->view->renderTaskEditForm($task, $this->statuses, $users);
    }
    
    public function deleteTask($task_id) {
        $this->model->deleteTask($task_id);
        header("Location: /editTasks"); 
        exit();
    }

    public function EditTask() {
        $task_id = $_POST['task_id'];
        $task_name = $_POST['task_name'];
        $task_text = $_POST['task_text'];
        $task_status = $_POST['task_status'];
        $deadline = $_POST['deadline'];
        $task_owner = $_POST['task_owner'];
        $task_assignee = $_POST['task_assignee'];

        $this->model->UpdateTask($task_id, $task_name, $task_text, $task_status, $deadline, $task_owner, $task_assignee);
        
        header("Location: /editTasks"); 
        exit();
    }
}