<?php
class TasksView {
    public function renderTasks($tasks) {
        echo '
        <div class="schedule-container">
            <table border="1">
                <thead>
                    <tr>
                        <th>task_id</th>
                        <th>task_name</th>
                        <th>task_text</th>
                        <th>task_status</th>
                        <th>deadline</th>
                        <th>task_owner</th>
                        <th>task_assignee</th>
                        <th>creation_time</th>
                        <th>last_updated_time</th>
                    </tr>
                </thead>
                <tbody>';  
                    foreach ($tasks as $row) {
                        echo "<tr>";
                        echo "<th>" . $row['task_id'] . "</th>";
                        echo "<th>" . $row['task_name'] . "</th>";
                        echo "<th>" . $row['task_text'] . "</th>";
                        echo "<th>" . $row['task_status'] . "</th>";
                        echo "<th>" . $row['deadline'] . "</th>";
                        echo "<th>" . $row['task_owner'] . "</th>";
                        echo "<th>" . $row['task_assignee'] . "</th>";
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
        echo 'Добрый день, ' . $_SESSION['username'] . '!<br>У вас пока нет задач.';
    }
}
?>