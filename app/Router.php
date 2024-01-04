<?php
class Router {
    public function route() {
        $uri = $_SERVER['REQUEST_URI'];

        include "db_config.php";
        include 'app/controllers/AuthenticateController.php';
        include 'app/controllers/ProfileController.php';
        include 'app/controllers/RegisterController.php';
        include 'app/controllers/ScheduleController.php';
        include 'app/controllers/TasksController.php';
        
        switch ($uri) {
            case '/':
                $controller = new AuthenticateController($conn);
                $controller->index();
                break;

            case '/profile':
                $controller = new ProfileController($conn);
                $controller->index();
                break;

            case '/schedule':
                $page = 'schedule';
                $controller = new ScheduleController($conn);
                $controller->index($page);
                break;

            case '/tasks':
                $controller = new TasksController($conn);
                $controller->index();
                break;

            case '/newUserRegistration':
                $controller = new RegisterController($conn);
                $controller->index();
                break;

            case '/editSchedule':
                $page = 'editSchedule';
                $controller = new ScheduleController($conn);
                $controller->index($page);
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