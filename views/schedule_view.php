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
        $output .= '<div><button onclick="window.location.href=\'edit_schedule.php\'">Редактировать</button></div>';

        return $output;
    }
}
?>
