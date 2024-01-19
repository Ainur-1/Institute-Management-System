<?php

class ProfileView {
    public function renderProfile($userData) {
        $output = "";

        if ($userData !== null) {
            $output .= "<h3>Добрый день, " . $userData['first_name'] . " " . $userData['last_name'] . "!</h3><br>"; 
            $output .= '
            <div>
                <h4><a href="/editUsers">Управление пользователями</a></h4>
                <h4><a href="/groups">Управление группами</a></h4>
                <h4>Управление учебными дисциплинами</h4>
                <h4><a href="/editSchedule">Управление расписанием</a></h4>
                <h4><a href="/editTasks">Управление задачами</a></h4>
            </div>
            ';
        } else {
            $output .= "Пользователь не найден.";
        }

        echo $output;
    }
}
?>