<?php
class Router {

    public function route() {
        $uri = $_SERVER['REQUEST_URI'];

        include 'app/controllers/AuthenticateController.php';
        include 'app/controllers/ProfileController.php';
        include 'app/controllers/RegisterController.php';
        include 'app/controllers/ScheduleController.php';
        include 'app/controllers/TasksController.php';
        include "app/core/Database.php";
        include 'app/Entities/Users.php';

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
                        $controller->index('editClass',$_GET['id']);
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
                        $controller->index('editTask',$_GET['id']);
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
                $page = 'profile';
                $controller = new ProfileController($db->conn);
                $controller->index($page);
                break;

            case '/changePasswordForm':
                $page = 'changePasswordForm';
                $controller = new ProfileController($db->conn);
                $controller->index($page);
                break;

                case '/changePassword':
                    $page = 'changePasswordForm';
                    $controller = new ProfileController($db->conn);
                    $controller->ChangePassword($_POST['userId'], $_POST['password'], $_POST['password1']);
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
            
            case '/addNewSubject':
                $page = 'addNewSubject';
                $controller = new ScheduleController($db->conn);
                $controller->index($page);
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

            case '/newUserRegistration':
                $controller = new RegisterController($db->conn);
                $controller->index();
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