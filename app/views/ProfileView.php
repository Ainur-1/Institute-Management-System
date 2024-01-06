<?php

class ProfileView {
    public function output($userData) {
        $output = "";

        if ($userData !== null) {
            $output .= "Имя пользователя: " . $userData['username'] . "<br>"; 
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
                    <h3>Управление задачами:</h3>
                    <ul>
                        <li>Добавить новую задачу</li>
                    </ul>
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