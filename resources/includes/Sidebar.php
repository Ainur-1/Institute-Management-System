<?php

class Sidebar {
     public function AddSidebarToProfile() {
        return '
            <div class="sidebar">
                <h3>Управление пользователями</h3>
                <a href="/newUserRegistration" class="button">Зарегистрировать нового пользователя</a>
            </div>
        ';
    }
    public function AddSidebarToSchedule() {
        return '
            <div class="sidebar">
                <h3>Управление расписанием</h3>
                <a href="/editSchedule" class="button">Редактирование расписания</a>
                <a href="/addNewClass" class="button">Добваить занятие</a>
                <a href="/addNewSubject" class="button">Добавить новый предмет</a>
            </div>
        ';
    }

    public function AddSidebarToTasks() {
        return '
            <div class="sidebar">
                <h3>Управление задачами</h3>
                <a href="/editTasks" class="button">Редактирование задач</a>
                <a href="/addNewTask" class="button">Добваить задачу</a>
            </div>
        ';
    }
}