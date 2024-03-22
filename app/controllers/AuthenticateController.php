<?php
include_once 'app/models/AuthenticateModel.php';
include_once 'app/views/AuthenticateView.php';

class AuthenticateController
{
    private $model;
    private $view;
    private $userData;
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
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
                $this->userData = (new Users($this->conn))->getUserByEmail($username);

                $this->setUserDataInSession($username);
                
                header("Location: /profile");
                exit;
            } else {
                echo $result;
            }
        } else {
            echo $this->view->renderAuthForm();
        }
    }

    private function setUserDataInSession($username) {
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;

        $_SESSION['first_name'] = $this->userData['first_name']; 
        $_SESSION['last_name'] = $this->userData['last_name'];
        $_SESSION['user_id'] = $this->userData['user_id'];
        $_SESSION['user_role'] = $this->userData['role_id'];
    }
}
