<?php
include_once "resources/includes/Sidebar.php";

class ProfileView {
    public function renderProfile($userData) {
        $output = (new Sidebar)->AddSidebarToProfile();
        $output .= '<div class="content">';

        if ($userData !== null) {
            $output .= '<img src="assets/pictures/user.png" alt="User" style="max-width: 100px; height: auto;"><br>';
            $output .= "Имя пользователя: " . $userData['first_name'] . " " . $userData['last_name'] . "<br>"; 
            $output .= "Email: " . $userData['email'] . "<br>";
            // $output .= "Сменить пароль<br>";
            $output .= '</div>';
        } else {
            $output .= "Пользователь не найден.";
        }

        echo $output;
    }
}
?>