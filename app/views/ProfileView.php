<?php
include_once "resources/includes/Sidebar.php";

class ProfileView {
    private $sidebar;
    public function __construct() {
        $this->sidebar = (new Sidebar)->AddSidebarToProfile();
    }

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
                $this->renderChangePasswordForm(...$args);
                break;
            case 'allUsers':
                $pageTitle = "Все пользователи";
                include 'resources/includes/header.php';
                $this->displayAllUsers($args[0]);
                break;
            case 'editUsers':
                $pageTitle = "Редактирование пользователей";
                include 'resources/includes/header.php';
                $this->displayAllUsersEditor(...$args);
                break;
            case 'newUserForm':
                $pageTitle = "Регистрация нового пользователя";
                include 'resources/includes/header.php';
                $this->displayNewUserForm(...$args);
                break;
            case 'displayEditUserForm':
                $pageTitle = "Редактирование пользователя";
                include 'resources/includes/header.php';
                $this->displayEditUserForm(...$args);
                break;
        }
        
        include 'resources/includes/footer.php';
    }
    public function renderProfile($userData) {
        $output = $this->sidebar;
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
        echo $this->sidebar . '
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
    
    public function displayAllUsers($users) {
        if ($users) {
            echo $this->sidebar . '
            <div class="content">
                <table border="1">
                    <tr>
                        <th>ID</th>
                        <th>Логин</th>
                        <th>Имя</th>
                        <th>Фамилия</th>
                        <th>Роль</th>
                    </tr>';
                foreach($users as $user) {
                    echo "<tr>";
                    echo "<td>" . $user['user_id'] . "</td>"; 
                    echo "<td>" . $user['email'] . "</td>";
                    echo "<td>" . $user['first_name'] . "</td>";
                    echo "<td>" . $user['last_name'] . "</td>";
                    echo "<td>" . $user['role_id'] . "</td>"; 
                    echo "</tr>";
                }
            echo '</table>
            <div>
            ';
        } else {
            echo $this->sidebar . '<div class="content">Нет данных для отображения<div>';
        }
    }
    
    public function displayAllUsersEditor($users, $message = '') {
        if ($users) {
            echo $this->sidebar . '
            <div class="content">'
            . $message .
                '<table border="1">
                    <tr>
                        <th>ID</th>
                        <th>Логин</th>
                        <th>Имя</th>
                        <th>Фамилия</th>
                        <th>Роль</th>
                        <th colspan="2">Действия</th>
                    </tr>';
                foreach($users as $user) {
                    echo "<tr>";
                    echo "<td>" . $user['user_id'] . "</td>"; 
                    echo "<td>" . $user['email'] . "</td>";
                    echo "<td>" . $user['first_name'] . "</td>";
                    echo "<td>" . $user['last_name'] . "</td>";
                    echo "<td>" . $user['role_id'] . "</td>";
                    echo "<td><a href='/?action=editUserForm&id=". $user['user_id'] . "'>Изменить</a></td>";
                    echo "<td><a href='/?action=deleteUser&id=". $user['user_id'] . "'>Удалить</a></td>";
                    echo "</tr>";
                }
            echo '</table>
            <div>
            ';
        } else {
            echo $this->sidebar . '<div class="content">Нет данных для отображения<div>';
        }
    }

    public function displayNewUserForm($roles, $message = '') {
        $output = (new Sidebar)->AddSidebarToProfile();
        echo $output . '
        <div class="content">'
        . $message .
        '<form action="addUser" method="post">
            <h2>Регистрация</h2>
            <label for="username">Логин:</label>
            <input type="email" id="username" name="username" required>
    
            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" required>

            <label for="role">Роль:</label>
            <select id="role" name="role" required>';
                foreach($roles as $role){
                    echo '<option value="' . $role['role_id'] . '">' . $role['role_name'] . '</option>';
                }    
        echo '</select>

            <label for="firstName">Имя:</label>
            <input type="text" id="firstName" name="firstName" required>

            <label for="lastName">Фамилия:</label>
            <input type="text" id="lastName" name="lastName" required>
    
            <input type="submit" value="Зарегистрировать">
        </form>
        </div>
        ';
    }

    public function displayEditUserForm($user) {
        $output = (new Sidebar)->AddSidebarToProfile();
        
        $output .= '
        <div class="content">
        <form action="editUser" method="post">
            <h2>Редактирование пользователя</h2>

            <label for="firstName">Имя:</label>
            <input type="text" id="firstName" name="firstName" value="' . htmlspecialchars($user['first_name']) . '" required>
    
            <label for="lastName">Фамилия:</label>
            <input type="text" id="lastName" name="lastName" value="' . htmlspecialchars($user['last_name']) . '" required>
    
            <input type="hidden" name="user_id" value="' . $user['user_id'] . '"> 
    
            <input type="submit" value="Сохранить">
        </form>
        </div>
        ';

        echo $output;
    }
}