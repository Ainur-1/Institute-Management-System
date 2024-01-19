<?php
class Router {

    public function route() {
        $uri = $_SERVER['REQUEST_URI'];

        include 'app/controllers/AuthenticateController.php';
        include 'app/controllers/ProfileController.php';
        include 'app/controllers/ScheduleController.php';
        include 'app/controllers/TasksController.php';
        include 'app/controllers/UsersController.php';
        include "app/core/Database.php";
        include 'app/core/User.php';

        $db = new Database();
        
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'deleteClass':
                    if (isset($_GET['id'])) {
                        $controller = new ScheduleController($db->conn);
                        $controller->deleteClass($_GET['id']);
                    }
                    break;
                case 'editClass':
                    if (isset($_GET['id'])) {
                        $controller = new ScheduleController($db->conn);
                        $controller->index('editClass', $_GET['id']);
                    }
                    break;
                case 'deleteTask':
                    if (isset($_GET['id'])) {
                        $controller = new TasksController($db->conn);
                        $controller->deleteTask($_GET['id']);
                    }
                    break;
                case 'editTask':
                    if (isset($_GET['id'])) {
                        $controller = new TasksController($db->conn);
                        $controller->index('editTask', $_GET['id']);
                    }
                    break;
                case 'deleteUser':
                    if (isset($_GET['id'])) {
                        $controller = new UsersController($db->conn);
                        $controller->deleteUser($_GET['id']);
                    }
                    break;
                case 'editUser':
                    if (isset($_GET['id'])) {
                        $controller = new UsersController($db->conn);
                        $controller->index('editUser', $_GET['id']);
                    }
                    break;
            }
        }

        switch ($uri) {
            case '/':
                $controller = new AuthenticateController($db->conn);
                $controller->index();
                break;

            case '/profile':
                $controller = new ProfileController($db->conn);
                $controller->index();
                break;

            case '/schedule':
                $page = 'schedule';
                $controller = new ScheduleController($db->conn);
                $controller->index($page);
                break;

            case '/editSchedule':
                $page = 'editSchedule';
                $controller = new ScheduleController($db->conn);
                $controller->index($page);
                break;
            
            case '/addNewClass':
                $page = 'addNewClass';
                $controller = new ScheduleController($db->conn);
                $controller->index($page);
                break;
            
            case '/updateClass':
                $controller = new ScheduleController($db->conn);
                $controller->updateClass();
                break;

            case '/tasks':
                $page = 'tasks';
                $controller = new TasksController($db->conn);
                $controller->index($page);
                break;

            case '/editTasks':
                $page = 'editTasks';
                $controller = new TasksController($db->conn);
                $controller->index($page);
                break;
            
            case '/addNewTask':
                $page = 'addNewTask';
                $controller = new TasksController($db->conn);
                $controller->index($page);
                break;
            
            case '/updateTask':
                $controller = new TasksController($db->conn);
                $controller->updateTask();
                break;
            
            case '/editUsers':
                $page = 'editUsers';
                $controller = new UsersController($db->conn);
                $controller->index($page);
                break;
            
            case '/addUserForm':
                $page = 'addUserForm';
                $controller = new UsersController($db->conn);
                $controller->index($page);
                break;
            
            case '/addUser':
                $controller = new UsersController($db->conn);
                $controller->addUser();
                break;

            default:
                // Ошибка 404
                header('HTTP/1.0 404 Not Found');
                echo 'Страница не найдена';
                break;
        }
    }
}
?>