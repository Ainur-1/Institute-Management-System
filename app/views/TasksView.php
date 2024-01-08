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
                        echo "<td>Изменить</td>";
                        echo "<td>Удалить</td>";
                        echo "</tr>";
                    }; 
                    echo '<tr>
                            <td colspan="10">Добавить новую задачу</td>
                        </tr>
                </tbody>
            </table>
        </div>
        ';
    }
}
?>