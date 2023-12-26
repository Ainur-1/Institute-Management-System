<?php
include '../model/UserModel.php';
include '../view/login_view.php';

class AuthenticateController
{
    private $model;
    private $view;

    public function __construct($conn)
    {
        $this->model = new UserModel($conn);
        $this->view = new LoginView();
    }

    public function authenticate() {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $result = $this->model->authenticateUser($username, $password);
            echo $result;
        } else {
            echo $this->view->output();
        }
    }
}
?>