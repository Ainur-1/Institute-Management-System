<?php
class TasksView {
    public function renderTasks($tasks) {
        echo '
        <div class="schedule-container">
            <table border="1">
                <thead>
                    <tr>
                        <th>Название</th>
                        <th>Описание</th>
                        <th>Статус</th>
                        <th>Крайний срок</th>
                        <th>Владелец</th>
                        <th>Исполнитель</th>
                        <th>Время создания</th>
                        <th>Время последнего обновления</th>
                    </tr>
                </thead>
                <tbody>';  
                    foreach ($tasks as $row) {
                        echo "<tr>";
                        echo "<td>" . $row['task_name'] . "</td>";
                        echo "<td>" . $row['task_text'] . "</td>";
                        echo "<td>" . $row['task_status'] . "</td>";
                        echo "<td>" . $row['deadline'] . "</td>";
                        echo "<td>" . $row['owner_first_name'] . " " . $row['owner_last_name'] . "</td>";
                        echo "<td>" . $row['assignee_first_name'] . " " . $row['assignee_last_name'] . "</td>";
                        echo "<td>" . $row['creation_time'] . "</td>";
                        echo "<td>" . $row['last_updated_time'] . "</td>";
                        echo "</tr>";
                    }; 
                echo ' </tbody>
            </table>
        </div>
        ';
    }

    public function renderNoTasksMessage() {
        echo 'Добрый день, ' . $_SESSION['first_name'] . ' ' . $_SESSION['last_name'] . '!<br>У вас пока нет задач.';
    }

    public function renderTasksEditor($tasks) {
        echo '
        <div class="schedule-container">
            <table border="1">
                <thead>
                    <tr>
                        <th>Название</th>
                        <th>Описание</th>
                        <th>Статус</th>
                        <th>Крайний срок</th>
                        <th>Владелец</th>
                        <th>Исполнитель</th>
                        <th>Время создания</th>
                        <th>Время последнего обновления</th>
                        <th colspan="2">Действия</th>
                    </tr>
                </thead>
                <tbody>';  
                    foreach ($tasks as $row) {
                        echo "<tr>";
                        echo "<td>" . $row['task_name'] . "</td>";
                        echo "<td>" . $row['task_text'] . "</td>";
                        echo "<td>" . $row['task_status'] . "</td>";
                        echo "<td>" . $row['deadline'] . "</td>";
                        echo "<td>" . $row['owner_first_name'] . " " . $row['owner_last_name'] . "</td>";
                        echo "<td>" . $row['assignee_first_name'] . " " . $row['assignee_last_name'] . "</td>";
                        echo "<td>" . $row['creation_time'] . "</td>";
                        echo "<td>" . $row['last_updated_time'] . "</td>";
                        echo "<td><a href='/?action=editTask&id=". $row['task_id'] . "'>Изменить</a></td>";
                        echo "<td><a href='/?action=deleteTask&id=". $row['task_id'] . "'>Удалить</a></td>";
                        echo "</tr>";
                    }; 
                    echo '<tr>
                            <td colspan="10"><a href="/addNewTask">Добавить новую задачу</a></td>
                        </tr>
                </tbody>
            </table>
        </div>
        ';
    }

    public function renderAddNewTaskForm($users) {
        echo '
        <div class="edit-container">
            <h2>Добваление новой задачи</h2>
            <form action="" method="post">
                <label for="task_name">Название:</label>
                <input type="text" name="task_name" id="task_name" required>';

            echo '<label for="task_text">Описание:</label>
                <input type="text" name="task_text" id="task_text" required>';

            echo '<label for="task_status">Статус:</label>
                <select name="task_status" id="task_name">';
                    foreach ($users as $group) {
                        echo '<option value="' . $group['group_id'] . '">' . $group['group_name'] . '</option>';
                    }
            echo '</select>

                <label for="deadline">Крайний срок:</label>
                <input  type="date" name="deadline" id="deadline">';

            echo '<label for="task_owner">Владелец:</label>
                <select name="task_owner" id="task_owner">';
                    foreach ($users as $user) {
                        echo '<option value="' . $user['user_id'] . '">' . $user['first_name'] . ' ' . $user['last_name'] . '</option>';
                    }
            echo '</select>

                <label for="task_assignee">Исполнитель:</label>
                <select name="task_assignee" id="task_assignee">';
                    foreach ($users as $user) {
                        echo '<option value="' . $user['user_id'] . '">' . $user['first_name'] . ' ' . $user['last_name'] . '</option>';
                    }
            echo '</select>
                <br>
                <input type="submit" name="add" value="Добавить">
            </form>
        </div>    
        ';
    }

    public function renderTaskEditForm($task, $tasks, $users) {
        echo '
        <div class="edit-container">
            <h2>Редактирование задачи</h2>
            <form action="" method="post">
                <label for="task_name">Название:</label>
                <input type="text" name="task_name" id="task_name" required>';

            echo '<label for="task_text">Описание:</label>
                <input type="text" name="task_text" id="task_text" required>';

            echo '<label for="task_status">Статус:</label>
                <select name="task_status" id="task_name">';
                    foreach ($users as $group) {
                        echo '<option value="' . $group['group_id'] . '">' . $group['group_name'] . '</option>';
                    }
            echo '</select>

                <label for="deadline">Крайний срок:</label>
                <input  type="date" name="deadline" id="deadline">';

            echo '<label for="task_owner">Владелец:</label>
                <select name="task_owner" id="task_owner">';
                    foreach ($users as $user) {
                        echo '<option value="' . $user['user_id'] . '">' . $user['first_name'] . ' ' . $user['last_name'] . '</option>';
                    }
            echo '</select>

                <label for="task_assignee">Исполнитель:</label>
                <select name="task_assignee" id="task_assignee">';
                    foreach ($users as $user) {
                        echo '<option value="' . $user['user_id'] . '">' . $user['first_name'] . ' ' . $user['last_name'] . '</option>';
                    }
            echo '</select>
                <br>
                <input type="submit" name="add" value="Добавить">
            </form>
        </div>    
        ';
    }
}
?>