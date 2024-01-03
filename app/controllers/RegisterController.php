<?php
include 'app/models/UserModel.php';
include 'app/views/newUserRegistration/register_view.php';

class RegisterController {
    private $model;
    private $view;

    public function __construct($db) {
        $this->model = new UserModel($db);
        $this->view = new RegisterView();
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