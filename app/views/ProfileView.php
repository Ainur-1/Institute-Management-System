<?php
include_once "resources/includes/Sidebar.php";

class ProfileView {

    public function index($page, ...$args) {
        switch ($page) {
            case 'profile':
                $pageTitle = "Профиль";
                include 'resources/includes/header.php';
                $this->renderProfile($args[0]);
                break;
            case 'changePasswordForm':
                $pageTitle = "Смена пароля";
                include 'resources/includes/header.php';
                $this->renderChangePasswordForm($args[0], $args[1]);
                break;
            case 'allUsers':
                $pageTitle = "Все пользователи";
                include 'resources/includes/header.php';
                // $this->displayAllUsers();
                break;
        }
        
        include 'resources/includes/footer.php';
    }
    public function renderProfile($userData) {
        $output = (new Sidebar)->AddSidebarToProfile();
        $output .= '<div class="content">';

        if ($userData !== null) {
            $output .= '<img src="assets/pictures/user.png" alt="User" style="max-width: 100px; height: auto;"><br>';
            $output .= "Имя пользователя: " . $userData['first_name'] . " " . $userData['last_name'] . "<br>"; 
            $output .= "Email: " . $userData['email'] . "<br>";
            $output .= '<a href="/changePasswordForm" class="button">Сменить пароль</a>';
            $output .= '</div>';
        } else {
            $output .= "Пользователь не найден.";
        }

        echo $output;
    }

    public function renderChangePasswordForm($userId, $message = '') {
        $output = (new Sidebar)->AddSidebarToProfile();
        echo $output . '
        <div class="content">';
        echo $message . '
            <form action="changePassword" method="post">
                <h2>Смена пароля</h2>
                <label for="password">Новый пароль:</label>
                <input type="password" id="password" name="password" required>
    
                <label for="password1">Повторите пароль:</label>
                <input type="password" id="password1" name="password1" required>
    
                <input type="hidden" name="userId" value="' . $userId . '">
    
                <input type="submit" name="changePassword" value="Поменять пароль">
            </form>
        <div>
        ';
    }   
}