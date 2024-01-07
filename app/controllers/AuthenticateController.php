<?php
include_once 'app/models/AuthenticateModel.php';
include_once 'app/views/AuthenticateView.php';

class AuthenticateController
{
    private $model;
    private $view;

    public function __construct($conn)
    {
        $this->model = new AuthenticateModel($conn);
        $this->view = new AuthenticateView();
    }

    public function index () {
        $pageTitle = "Авторизация";
        include 'resources/includes/header.php';

        $this->authenticate();

        include 'resources/includes/footer.php';
    }
    public function authenticate() {
        session_start();

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $result = $this->model->authenticateUser($username, $password);

            if ($result === true) {
                $_SESSION['logged_in'] = true;
                $_SESSION['username'] = $username;
                
                header("Location: /profile");
                exit;
            } else {
                echo $result;
            }
        } else {
            echo $this->view->renderAuthForm();
        }
    }
}
?>