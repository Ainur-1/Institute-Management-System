<?php
include '../../models/UserModel.php';
include '../../views/newUserRegistration/register_view.php';

class RegisterController {
    private $model;
    private $view;

    public function __construct($db) {
        $this->model = new UserModel($db);
        $this->view = new RegisterView();
    }

    public function register() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $login = $_POST["login"];
            $password = password_hash($_POST["password"], PASSWORD_DEFAULT); 
            $email = $_POST["email"];
            $first_name = $_POST["first_name"];
            $last_name = $_POST["last_name"];
            $user_type = $_POST["user_type"];

            $this->model->registerUser($login, $password, $email, $first_name, $last_name, $user_type);
            echo "User registered successfully!";
        } else {
            echo $this->view->output();
        }
    }
}

?>