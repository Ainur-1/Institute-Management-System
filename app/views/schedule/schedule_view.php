<?php
class ScheduleView {
    public function output($schedule) {
        $output = '<div class="schedule-container">';
        $output .= '<table class="schedule-table">';
        
        foreach ($schedule as $day => $lessons) {
            $output .= '<tr>';
            $output .= '<th colspan="2">' . $day . '</th>';
            $output .= '</tr>';

            foreach ($lessons as $time => $subject) {
                $output .= '<tr>';
                $output .= '<td>' . $time . '</td>';
                $output .= '<td>' . $subject . '</td>';
                $output .= '</tr>';
            }
        }

        $output .= '</table>';
        $output .= '</div>';

        return $output;
    }

    public function output1($schedule) {
        return '
        <div class="edit-container">
            <h2>Редактирование расписания</h2>
            <form action="" method="post">
                <label for="day">День недели:</label>
                <select name="day" id="day">
                    <?php foreach ($schedule as $day => $lessons): ?>
                        <option value="<?= $day ?>">
                            <?= $day ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="time">Время:</label>
                <input type="text" name="time" id="time" placeholder="Пример: 09:00 - 10:30">

                <label for="subject">Предмет:</label>
                <input type="text" name="subject" id="subject" placeholder="Пример: Математика">

                <input type="submit" value="Добавить">
            </form>
        </div>
        ';
    }

    public function output2($schedule) {
        $formHtml = <<<'HTML'
        <div class="edit-container">
            <h2>Редактирование расписания</h2>
            <form action="" method="post">
                <label for="day">День недели:</label>
                <select name="day" id="day">
                    <?php foreach ($schedule as $day => $lessons): ?>
                        <option value="<?= $day ?>">
                            <?= $day ?>
                        </option>
                    <?php endforeach; ?>
                </select>
    
                <label for="time">Время:</label>
                <input type="text" name="time" id="time" placeholder="Пример: 09:00 - 10:30">
    
                <label for="subject">Предмет:</label>
                <input type="text" name="subject" id="subject" placeholder="Пример: Математика">
    
                <input type="submit" value="Добавить">
            </form>
        </div>
        HTML;
    
        return $formHtml;
    }
    
}
?>
