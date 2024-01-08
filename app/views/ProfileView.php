<?php

class ProfileView {
    public function renderProfile($userData) {
        $output = "";

        if ($userData !== null) {
            $output .= "Имя пользователя: " . $userData['first_name'] . " " . $userData['last_name'] . "<br>"; 
            $output .= "Email: " . $userData['email'] . "<br>";
            $output .= "Сменить пароль<br>";
            $output .= '
            <div>
                <section>
                    <h3>Управление пользователями:</h3>
                    <ul>
                        <li><a href="/newUserRegistration">Зарегистрировать нового пользователя</a></li>
                        <li>Добавить новую группу</li>
                        <li>Добавить новый предмет ???</li>
                    </ul>
                </section>
                <h3><a href="/editSchedule">Управление расписанием</a></h3>
                <h3><a href="/editTasks">Управление задачами</a></h3>
            </div>
            ';
        } else {
            $output .= "Пользователь не найден.";
        }

        echo $output;
    }
}
?>