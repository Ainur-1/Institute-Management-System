<?php
class Router {

    public function route() {
        $uri = $_SERVER['REQUEST_URI'];

        include 'app/controllers/AuthenticateController.php';
        include 'app/controllers/ProfileController.php';
        include 'app/controllers/ScheduleController.php';
        include 'app/controllers/TasksController.php';
        include "app/core/Database.php";
        include 'app/Entities/Users.php';
        include 'app/Entities/Roles.php';

        $db = new Database();
        
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'deleteUser':
                    (new ProfileController($db->conn))->DeleteUser();
                    break;
                case 'editUserForm':                    
                    (new ProfileController($db->conn))->displayEditUserForm();
                    break;
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
                (new ProfileController($db->conn))->displayProfile();
                break;

            case '/changePasswordForm':
                (new ProfileController($db->conn))->displayChangePasswordForm();
                break;

            case '/changePassword':
                (new ProfileController($db->conn))->ChangePassword();
                break;

            case '/allUsers':
                (new ProfileController($db->conn))->displayAllUsers();
                break;
            
            case '/editUsers':
                (new ProfileController($db->conn))->displayAllUsersEditor();
                break;

            case '/newUser':
                (new ProfileController($db->conn))->displayNewUserForm();
                break;

            case '/addUser':
                (new ProfileController($db->conn))->AddUser();
                break;

            case '/editUser':
                (new ProfileController($db->conn))->EditUser();
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

            case '/editClass':
                (new ScheduleController($db->conn))->EditClass();
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

            default:
                // Ошибка 404
                header('HTTP/1.0 404 Not Found');
                echo 'Страница не найдена';
                break;
        }
    }
}
?>