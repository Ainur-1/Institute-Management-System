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
                        echo "<td>" . $row['subject_name'] . "</td>";
                        echo "<td>" . $row['group_name'] . "</td>";
                        echo "<td>" . $row['first_name'] . ' ' . $row['last_name'] . "</td>";
                        echo "<td>" . $row['day_of_week'] = $dayOfWeekNames[$row['day_of_week']] ?? 'Недопустимый день' . "</td>";
                        echo "<td>" . $row['start_time'] .  " - " . $row['end_time'] . "</td>";
                        echo "</tr>";
                    }; 
                echo ' </tbody>
            </table>
        </div>
        ';
    }

    public function renderScheduleEditor($schedule, $dayOfWeekNames){
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
                        <th colspan="2">Действия</th>
                    </tr>
                </thead>
                <tbody>';  
                    foreach ($schedule as $row) {
                        echo "<tr>";
                        echo "<td>" . $row['subject_name'] . "</td>";
                        echo "<td>" . $row['group_name'] . "</td>";
                        echo "<td>" . $row['first_name'] . ' ' . $row['last_name'] . "</td>";
                        echo "<td>" . $row['day_of_week'] = $dayOfWeekNames[$row['day_of_week']] ?? 'Недопустимый день' . "</td>";
                        echo "<td>" . $row['start_time'] .  " - " . $row['end_time'] . "</td>";
                        echo "<td><a href='/?action=editClass&id=". $row['schedule_id'] . "'>Изменить</a></td>";
                        echo "<td><a href='/?action=deleteClass&id=". $row['schedule_id'] . "'>Удалить</a></td>";
                        echo "</tr>";
                    };
                    echo '<tr>
                            <td colspan="10"><a href="/addNewClass">Добавить новое занятие</a></td>
                        </tr> 
                </tbody>
            </table>
        </div>
        ';   
    }

    public function renderAddNewClassForm($subjects, $groups, $dayOfWeekNames, $teachers, $classTimes) {
        echo '
        <div class="edit-container">
            <h2>Добваление нового занятия</h2>
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
    
    public function renderClassEditForm($class, $subjects, $groups, $dayOfWeekNames, $teachers, $classTimes) {
        echo '
        <div class="edit-container">
            <h2>Редактирование занятия</h2>
            <form action="updateClass" method="post">
                <input type="hidden" name="schedule_id" value="' . $class['schedule_id'] . '">
        
                <label for="subject_id">Предмет:</label>
                <select name="subject_id" id="subject_id">';
                    foreach ($subjects as $subject) {
                        $selected = ($subject['subject_id'] == $class['subject_id']) ? 'selected' : '';
                        echo '<option value="' . $subject['subject_id'] . '" ' . $selected . '>' . $subject['subject_name'] . '</option>';
                    }
            echo '</select>
        
                <label for="group_id">Группа:</label>
                <select name="group_id" id="group_id">';
                    foreach ($groups as $group) {
                        $selected = ($group['group_id'] == $class['group_id']) ? 'selected' : '';
                        echo '<option value="' . $group['group_id'] . '" ' . $selected . '>' 
                            . $group['group_name'] . '</option>';
                    }
            echo '</select>
        
                <label for="teacher_id">Преподаватель:</label>
                <select name="teacher_id" id="teacher_id">';
                    foreach ($teachers as $teacher) {
                        $selected = ($teacher['teacher_id'] == $class['teacher_id']) ? 'selected' : '';
                        echo '<option value="' . $teacher['teacher_id'] . '" ' . $selected . '>' 
                            . $teacher['first_name'] . ' ' . $teacher['last_name'] .'</option>';
                        }
            echo '</select>
        
                <label for="day_of_week">День недели:</label>
                <select name="day_of_week" id="day_of_week">';
                    foreach ($dayOfWeekNames as $num => $day) {
                        $selected = ($num == $class['day_of_week']) ? 'selected' : '';
                        echo '<option value="' . $num . '" ' . $selected . '>' . $day . '</option>';
                    }
            echo '</select>
                
                <label for="class_time_id">Время начала:</label>
                <select name="class_time_id" id="class_time_id">';
                    foreach ($classTimes as $classTime) {
                        $selected = ($classTime['class_time_id'] == $class['class_time_id']) ? 'selected' : '';
                        echo '<option value="' . $classTime['class_time_id'] . '" ' . $selected . '>' . $classTime['start_time'] . '</option>';
                    }
            echo '</select>
                <br>
                <input type="submit" value="Сохранить">
            </form>
        </div>';
    }
}
?>