<?php

class Sidebar {
    public function AddSidebarToProfile() {
        if ($_SESSION['user_role'] === 1) {
            return '
            <div class="sidebar">
                <h3>Управление пользователями</h3>
                <a href="/newUserRegistration" class="button">Зарегистрировать нового пользователя</a>
                <a href="/allUsers" class="button">Все пользователи</a>
            </div>
            ';
        } else return '';   
    }
    public function AddSidebarToSchedule() {
        if ($_SESSION['user_role'] === 1) {
            return '
                <div class="sidebar">
                    <h3>Управление расписанием</h3>
                    <a href="/editSchedule" class="button">Редактирование расписания</a>
                    <a href="/addNewClass" class="button">Добваить занятие</a>
                    <a href="/addNewSubject" class="button">Добавить новый предмет</a>
                </div>
            ';
        } else return '';   
    }

    public function AddSidebarToTasks() {
        if ($_SESSION['user_role'] === 1) {
            return '
                <div class="sidebar">
                    <h3>Управление задачами</h3>
                    <a href="/editTasks" class="button">Редактирование задач</a>
                    <a href="/addNewTask" class="button">Добваить задачу</a>
                </div>
            ';
        } else return '';   
    }
}