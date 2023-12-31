<?php

class ProfileView {
    public function output($userData) {
        $output = "";

        if ($userData !== null) {
            $output .= "Имя пользователя: " . $userData['username'] . "<br>"; 
            $output .= "Email: " . $userData['email'] . "<br>";
            $output .= "Сменить пароль<br>";
            $output .= '<div>
                    <a href="../newUserRegistration/index.php">Зарегистрировать нового пользователя</a><br>
                    <a href="../editSchedule/index.php">Редактировать расписание</a><br>
                </div>';
        } else {
            $output .= "Пользователь не найден.";
        }

        echo $output;
    }
}
?>