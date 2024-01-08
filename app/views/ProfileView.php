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
                    </ul>
                </section>
            
                <section>
                    <h3>Управление расписанием:</h3>
                    <ul>
                        <li><a href="/editSchedule">Добавить новое занятие</a></li>
                        <li>Добавить новый предмет</li>
                    </ul>
                </section>
            
                <section>
                    <h3><a href="/editTasks">Управление задачами</a></h3>
                </section>
            </div>
            ';
        } else {
            $output .= "Пользователь не найден.";
        }

        echo $output;
    }
}
?>