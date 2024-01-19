<?php
class GroupsView {
    public function renderGrooups(){
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
                    //foreach ($schedule as $row) {
                    //    echo "<tr>";
                    //    echo "<td>" . $row['subject_name'] . "</td>";
                    //    echo "<td>" . $row['group_name'] . "</td>";
                    //    echo "<td>" . $row['first_name'] . ' ' . $row['last_name'] . "</td>";
                    //    echo "<td>" . $row['day_of_week'] = $dayOfWeekNames[$row['day_of_week']] ?? 'Недопустимый день' . "</td>";
                    //    echo "<td>" . $row['start_time'] .  " - " . $row['end_time'] . "</td>";
                    //    echo "<td><a href='/?action=editClass&id=". $row['schedule_id'] . "'>Изменить</a></td>";
                    //    echo "<td><a href='/?action=deleteClass&id=". $row['schedule_id'] . "'>Удалить</a></td>";
                    //    echo "</tr>";
                    //};
                    echo '<tr>
                            <td colspan="10"><a href="/addNewClass">Добавить новое занятие</a></td>
                        </tr> 
                </tbody>
            </table>
        </div>
        ';   
    }
}
?>