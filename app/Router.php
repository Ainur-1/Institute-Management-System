<?php
class Router {
    public function route() {
        $uri = $_SERVER['REQUEST_URI'];

        switch ($uri) {
            case '/':
                require 'app/views/authenticate/index.php';
                break;
            case '/profile':
                require 'app/views/profile/index.php';
                break;
            case '/schedule':
                require 'app/views/schedule/index.php';
                break;
            case '/tasks':
                require 'app/views/tasks/index.php';
                break;
            case '/newUserRegistration':
                require 'app/views/newUserRegistration/index.php';
                break;
            case '/editSchedule':
                require 'app/views/editSchedule/index.php';
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