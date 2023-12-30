<?php
class ProfileView {
    public function output($userData) {
        if ($userData) {
            echo "Имя пользователя: " . $userData['username'] . "<br>"; 
            echo "Email: " . $userData['email'] . "<br>";
            echo "Зарегистрировать нового пользователя<br>";
            echo "Сменить пароль<br>";
            echo "Редактировать расписание<br>";
        } else {
            echo "Пользователь не найден.";
        }

    }
}
?>

