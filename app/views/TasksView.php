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
                        echo "<th>" . $row['task_name'] . "</th>";
                        echo "<th>" . $row['task_text'] . "</th>";
                        echo "<th>" . $row['task_status'] . "</th>";
                        echo "<th>" . $row['deadline'] . "</th>";
                        echo "<th>" . $row['owner_first_name'] . " " . $row['owner_last_name'] . "</th>";
                        echo "<th>" . $row['assignee_first_name'] . " " . $row['assignee_last_name'] . "</th>";
                        echo "<th>" . $row['creation_time'] . "</th>";
                        echo "<th>" . $row['last_updated_time'] . "</th>";
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
}
?>