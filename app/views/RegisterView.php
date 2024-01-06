<?php
class RegisterView {
    public function output($roles) {
        echo '
        <form action="" method="post">
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
    
            <input type="submit" name="register" value="Зарегистрировать">
        </form>

        ';
    }
}
?>