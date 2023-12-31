<?php
class RegisterView {
    public function output() {
        return '
        <form action="" method="post">
            <h2>Регистрация</h2>
            <label for="username">Логин:</label>
            <input type="text" id="username" name="username" required>
    
            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" required>
    
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="role">Роль:</label>
            <select id="role" name="role" required onchange="showGroupField(this.value)">
                <option value="Студент">Студент</option>
                <option value="Преподаватель">Преподаватель</option>
            </select>

            <div id="groupField" style="display:none;">
                <label for="group">Группа:</label>
                <input type="text" id="group" name="group">
            </div>

            <label for="firstName">Имя:</label>
            <input type="text" id="firstName" name="firstName" required>

            <label for="lastName">Фамилия:</label>
            <input type="text" id="lastName" name="lastName" required>
    
            <input type="submit" name="register" value="Зарегистрировать">
        </form>

        <script>
            function showGroupField(roleValue) {
                const groupField = document.getElementById("groupField");
                if (roleValue === "Студент") {
                    groupField.style.display = "block";
                } else {
                    groupField.style.display = "none";
                }
            }
        </script>
        ';
    }
}
?>