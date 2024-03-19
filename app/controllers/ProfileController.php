<?php
include_once "app/models/ProfileModel.php";
include_once "app/views/ProfileView.php";

class ProfileController {
    private $view;
    private $model;

    public function __construct($conn) {
        $this->model = new ProfileModel($conn);
        $this->view = new ProfileView();
    }

    public function displayProfile() {
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            header("Location: /");
            exit;
        }

        $username = $_SESSION['username'];
        $userData = $this->model->getUserInfo($username);

        $_SESSION['first_name'] = $userData['first_name']; 
        $_SESSION['last_name'] = $userData['last_name'];
        
        $this->view->index('profile', $userData);
    }

    public function displayChangePasswordForm() {
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            header("Location: /");
            exit;
        }
        $username = $_SESSION['username'];
        $userData = $this->model->getUserInfo($username);
        $userId = $userData['user_id'];

        $this->view->index('changePasswordForm', $userId);
    }

    public function ChangePassword($userId, $newPasswordFirst, $newPasswordSecond) {
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

        $this->view->index('profile', $userId, $message);
    }

    public function displayAllUsers(){
        
    }
}