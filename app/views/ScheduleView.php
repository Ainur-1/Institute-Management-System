<?php
class ScheduleView {
    public function renderSchedule($schedule, $dayOfWeekNames) {
        echo '
        <div class="schedule-container">
            <table border="1">
                <thead>
                    <tr>
                        <th>Предмет</th>
                        <th>Группа</th>
                        <th>Преподаватель</th>
                        <th>День недели</th>
                        <th>Время</th>
                    </tr>
                </thead>
                <tbody>';  
                    foreach ($schedule as $row) {
                        echo "<tr>";
                        echo "<th>" . $row['subject_name'] . "</th>";
                        echo "<th>" . $row['group_name'] . "</th>";
                        echo "<th>" . $row['first_name'] . ' ' . $row['last_name'] . "</th>";
                        echo "<th>" . $row['day_of_week'] = $dayOfWeekNames[$row['day_of_week']] ?? 'Недопустимый день' . "</th>";
                        echo "<th>" . $row['start_time'] .  " - " . $row['end_time'] . "</th>";
                        echo "</tr>";
                    }; 
                echo ' </tbody>
            </table>
        </div>
        ';
    }

    public function renderScheduleEditForm($subjects, $groups, $dayOfWeekNames, $teachers, $classTimes) {
        echo '
        <div class="edit-container">
            <h2>Редактирование расписания</h2>
            <form action="" method="post">
        
                <label for="subject">Предмет:</label>
                <select name="subject" id="subject">';
                    foreach ($subjects as $subject) {
                        echo '<option value="' . $subject['subject_id'] . '">' . $subject['subject_name'] . '</option>';
                    }
            echo '</select>
        
                <label for="group">Группа:</label>
                <select name="group" id="group">';
                    foreach ($groups as $group) {
                        echo '<option value="' . $group['group_id'] . '">' . $group['group_name'] . '</option>';
                    }
            echo '</select>
        
                <label for="teacher">Преподаватель:</label>
                <select name="teacher" id="teacher">';
                    foreach ($teachers as $teacher) {
                        echo '<option value="' . $teacher['teacher_id'] . '">' . $teacher['first_name'] 
                            . ' ' . $teacher['last_name'] .'</option>';
                        }
            echo '</select>
        
                <label for="day">День недели:</label>
                <select name="day" id="day">';
                    foreach ($dayOfWeekNames as $num => $day) {
                        echo '<option value="' . $num . '">' . $day . '</option>';
                    }
            echo '</select>
                
                <label for="classStartTime">Время начала:</label>
                <select name="classStartTime" id="classStartTime">';
                    foreach ($classTimes as $classTime) {
                        echo '<option value="' . $classTime['class_time_id'] . '">' . $classTime['start_time'] . '</option>';
                    }
            echo '</select>
                <br>
                <input type="submit" value="Добавить">
            </form>
        </div>';
    }    
}
?>