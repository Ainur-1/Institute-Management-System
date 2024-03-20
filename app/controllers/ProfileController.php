<?php
include_once "app/models/ProfileModel.php";
include_once "app/views/ProfileView.php";

class ProfileController {
    private $view;
    private $model;
    private $userData;

    public function __construct($conn) {
        session_start();
        
        $this->model = new ProfileModel($conn);
        $this->view = new ProfileView();

        $this->checkLoggedIn();
        $this->userData = $this->model->getUserInfo($_SESSION['username']);
        $this->setUserDataInSession();
    }

    private function checkLoggedIn() {
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            header("Location: /");
            exit;
        }
    }
    
    private function setUserDataInSession() {
        $_SESSION['first_name'] = $this->userData['first_name']; 
        $_SESSION['last_name'] = $this->userData['last_name'];
        $_SESSION['user_id'] = $this->userData['user_id'];
        $_SESSION['user_role'] = $this->userData['role_id'];
    }
    
    public function displayProfile() {   
        $this->view->index('profile', $this->userData);
    }
    
    public function displayAllUsers() {
        $this->view->index('allUsers', $this->model->getAllUsers());
    }

    public function displayAllUsersEditor() {
        $this->view->index('editUsers', $this->model->getAllUsers());
    }

    public function displayChangePasswordForm() {
        $this->view->index('changePasswordForm', $this->userData['user_id']);
    }

    public function displayNewUserForm() {
        $this->view->index('newUserForm', $this->model->getRoles());
    }

    public function ChangePassword($userId, $newPasswordFirst, $newPasswordSecond) {
        $message = '';

        if ($newPasswordFirst === $newPasswordSecond){
            if (strlen($newPasswordFirst) >= 8) {
                $hashedPassword = password_hash($newPasswordFirst, PASSWORD_DEFAULT);
                $success = $this->model->updateUserPassword($userId, $hashedPassword);

                if ($success) {
                    $message = "Пароль успешно изменен.";
                } else {
                    $message = "Произошла ошибка при изменении пароля. Пожалуйста, попробуйте еще раз.";
                }
            } else {
                $message = "Новый пароль слишком короткий. Пароль должен содержать минимум 8 символов.";
            }
        } else {
            $message = "Пароли не совпадают!";
        }

        $this->view->index('changePasswordForm', $userId, $message);
    }

    public function AddUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $role_id = $_POST['role'];
            $first_name = $_POST['firstName']; 
            $last_name = $_POST['lastName'];

            echo $this->model->AddUser($username, $password, $role_id, $first_name, $last_name);
        } else {
            echo 'Ошибка в заполнении формы!';
        }
    }
}