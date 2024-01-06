<?php
include_once 'app/models/RegisterModel.php';
include_once 'app/views/RegisterView.php';

class RegisterController {
    private $model;
    private $view;

    public function __construct($conn) {
        $this->model = new RegisterModel($conn);
        $this->view = new RegisterView();
    }

    public function index() {
        session_start();

        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            header("Location: /");
            exit;
        }

        $pageTitle = "Регистрация нового пользователя";
        include 'resources/includes/header.php';

        $this->register();

        include 'resources/includes/footer.php';
    }
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $role_id = $_POST['role'];
            $first_name = $_POST['firstName']; 
            $last_name = $_POST['lastName'];

            echo $this->model->registerUser($username, $password, $role_id, $first_name, $last_name);
        } else {
            $roles = $this->model->selectAllFromTable('Roles');
            $this->view->output($roles);
        }
    }
}

?>