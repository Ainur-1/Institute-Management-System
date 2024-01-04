<?php
include_once 'app/models/UserModel.php';
include_once 'app/views/RegisterView.php';

class RegisterController {
    private $model;
    private $view;

    public function __construct($db) {
        $this->model = new UserModel($db);
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
            $email = $_POST['email'];

            $this->model->registerUser($username, $password, $email);
            echo "User registered successfully!";
        } else {
            echo $this->view->output();
        }
    }
}

?>