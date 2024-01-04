<?php
class TasksView {
    public function output() {
        $output = 'Добрый день, ' . $_SESSION['username'] . '!<br>У вас пока нет задач.';
        return $output;
    }
}
?>