<?php
class UsersView {
    public function renderUsers($users) {
        echo '
        <div class="schedule-container">
            <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Имя</th>
                        <th>Фамилия</th>
                        <th>Email</th>
                        <th>Роль</th>
                        <th>Дата регистрации</th>
                        <th colspan="2">Действия</th>
                    </tr>
                </thead>
                <tbody>';  
                    foreach ($users as $row) {
                        echo "<tr>";
                        echo "<td>" . $row['user_id'] . "</td>";
                        echo "<td>" . $row['first_name'] . "</td>";
                        echo "<td>" . $row['last_name'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['role_id'] . "</td>";
                        echo "<td>" . $row['registration_date'] . "</td>";
                        echo "<td><a href='/?action=editUser&id=". $row['user_id'] . "'>Изменить</a></td>";
                        echo "<td><a href='/?action=deleteUser&id=". $row['user_id'] . "'>Удалить</a></td>";
                        echo "</tr>";
                    }; 
                    echo '<tr>
                            <td colspan="10"><a href="/addUserForm">Добавить нового пользователя</a></td>
                        </tr>
                </tbody>
            </table>
        </div>
        ';
    }

    public function renderAddNewUserForm($roles) {
        echo '
        <h2>Добавление нового пользователя</h2>
        <form action="addUser" method="post">
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
    
            <input type="submit" name="register" value="Добавить">
        </form>

        ';
    }

    public function renderEditUserForm($user, $roles) {
        echo '
        <h2>Редактирование пользователя</h2>
        <form action="editUser" method="post">
            <input type="hidden" name="task_id" value="' . $user['user_id'] . '">

            <label for="username">Логин:</label>
            <input type="email" id="username" name="username" value ="' . $user['email'] . '" required>
    
            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" value ="' . $user['password'] . '" required>

            <label for="role">Роль:</label>
            <select id="role" name="role" required>';
                foreach($roles as $role) {
                    $selected = ($role['role_id'] == $user['role_id']) ? 'selected' : '';
                    echo '<option value="' . $role['role_id'] . '" ' . $selected . '>' . $role['role_name'] . '</option>';
                }    
        echo '</select>

            <label for="firstName">Имя:</label>
            <input type="text" id="firstName" name="firstName" value ="' . $user['first_name'] . '" required>

            <label for="lastName">Фамилия:</label>
            <input type="text" id="lastName" name="lastName" value ="' . $user['last_name'] . '" required>
    
            <input type="submit" name="register" value="Добавить">
        </form>

        ';
    }
}
?>