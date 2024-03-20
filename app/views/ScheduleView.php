<?php
include_once "resources/includes/Sidebar.php";

class ScheduleView {
    public function renderSchedule($schedule, $dayOfWeekNames) {
        $output = (new Sidebar)->AddSidebarToSchedule();
        echo $output . '
        <div class="schedule-container content">
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
        $output = (new Sidebar)->AddSidebarToSchedule();
        echo $output . '
        <div class="schedule-container content">
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
                    echo ' 
                </tbody>
            </table>
        </div>
        ';   
    }

    public function renderAddNewClassForm($subjects, $groups, $dayOfWeekNames, $teachers, $classTimes) {
        $output = (new Sidebar)->AddSidebarToSchedule();
        echo $output . '
        <div class="edit-container content">
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
        $output = (new Sidebar)->AddSidebarToSchedule();
        echo $output . '
        <div class="edit-container content">
            <form action="editClass" method="post">
                <h2>Редактирование занятия</h2>
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
                <input type="hidden" name="class_id" value="' . $class['schedule_id'] . '">
                <input type="submit" value="Изменить">
            </form>
        </div>';
    }

    public function renderAddSubjectForm() {
        $output = (new Sidebar)->AddSidebarToSchedule();
        echo $output . '
        <div class="edit-container content">
            <h2>Добваление нового предмета</h2>
            <form action="addSubject" method="post">
        
                <label for="subject">Предмет:</label>
                <input type="text" id="subject" name="subject" required>
                
                <input type="submit" name="submit" value="Добавить">
            </form>
        </div>
        ';
    }
}