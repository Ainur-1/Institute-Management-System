<?php
class RegisterView {
    public function output() {
        return '
        <form action="" method="post">
            <h2>Регистрация</h2>
            <label for="login">Логин:</label>
            <input type="text" id="login" name="login" required><br>

            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>

            <label for="first_name">Имя:</label>
            <input type="text" id="first_name" name="first_name" required><br>

            <label for="last_name">Фамилия:</label>
            <input type="text" id="last_name" name="last_name" required><br>

            <label for="user_type">Тип пользователя:</label>
            <select id="user_type" name="user_type" required>
                <option value="student">Студент</option>
                <option value="teacher">Преподаватель</option>
            </select><br>
    
            <input type="submit" value="Зарегистрировать пользователя">
        </form>
        ';
    }
}
?>