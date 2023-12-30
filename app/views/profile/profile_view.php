<?php

class ProfileView {
    public function output($userData) {
        $output = "";

        if ($userData !== null) {
            $output .= "Имя пользователя: " . $userData['username'] . "<br>"; 
            $output .= "Email: " . $userData['email'] . "<br>";
            $output .= '<a href="../../../resources/pages/register.php">Зарегистрировать нового пользователя</a><br>';
            $output .= "Сменить пароль<br>";
            $output .= '<a href="../../../resources/pages/schedule.php">Редактировать расписание</a><br>';
        } else {
            $output .= "Пользователь не найден.";
        }

        echo $output;
    }
}

?>
