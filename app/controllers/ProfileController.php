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

    public function index($page) {
        session_start();
        
        switch ($page) {
            case 'profile':
                $pageTitle = "Профиль";
                include 'resources/includes/header.php';
                $this->displayProfile();
                break;
            case 'changePasswordForm':
                $pageTitle = "Смена пароля";
                include 'resources/includes/header.php';
                $this->displayChangePasswordForm();
                break;
            case 'changePassword':
                $pageTitle = "Смена пароля";
                include 'resources/includes/header.php';
                $this->ChangePassword($userId, $newPassword, $Password1);
                break;
        }

        include 'resources/includes/footer.php';
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
        
        $this->view->renderProfile($userData);
    }

    public function displayChangePasswordForm() {
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            header("Location: /");
            exit;
        }
        $username = $_SESSION['username'];
        $userData = $this->model->getUserInfo($username);
        $userId = $userData['user_id'];

        $this->view->renderChangePasswordForm($userId);
    }

    public function ChangePassword($userId, $newPassword, $password1) {
        if ($newPassword !== $password1){
            $message = "Пароли не совпадают!";
        }
        if (strlen($newPassword) < 8) {
            $message = "Новый пароль слишком короткий. Пароль должен содержать минимум 8 символов.";
        }

        // Хешируем новый пароль перед сохранением
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Обновляем пароль пользователя в базе данных
        $success = $this->model->updateUserPassword($userId, $hashedPassword);

        if ($success) {
            $message = "Пароль успешно изменен.";
        } else {
            $message = "Произошла ошибка при изменении пароля. Пожалуйста, попробуйте еще раз.";
        }
        
        $this->view->renderChangePasswordForm($userId, $message);

    }
}