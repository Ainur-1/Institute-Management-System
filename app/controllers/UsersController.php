<?php
include_once 'app/models/UsersModel.php';
include_once 'app/views/UsersView.php';

class UsersController {
    private $model;
    private $view;

    public function __construct($conn) {
        $this->model = new UsersModel($conn);
        $this->view = new UsersView();
    }

    public function index($page, $id = null) {
        switch($page) {
            case 'editUsers':
                $pageTitle = "Все пользователи";
                include 'resources/includes/header.php';
                $this->displayUsers();
                break;
            case 'editUser':
                $pageTitle = "Редактирование пользователя";
                include 'resources/includes/header.php';
                $this->displayEditUserForm($id);
                break;
            case 'addUserForm':
                $pageTitle = "Добавление нового пользователя";
                include 'resources/includes/header.php';
                $this->displayAddUserForm();
                break;
        }

        include 'resources/includes/footer.php';
    }

    public function displayUsers() {
        $users = $this->model->selectAllFromTable('Users');
        $this->view->renderUsers($users);
    }

    public function displayEditUserForm($user_id) {
        $user = $this->model->getUserById($user_id);
        $roles = $this->model->selectAllFromTable('Roles');
        $this->view->renderEditUserForm($user, $roles);
    }

    public function displayAddUserForm() {
        $roles = $this->model->selectAllFromTable('Roles');
        $this->view->renderAddNewUserForm($roles);
    }

    public function addUser() {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role_id = $_POST['role'];
        $first_name = $_POST['firstName']; 
        $last_name = $_POST['lastName'];

        echo $this->model->registerUser($username, $password, $role_id, $first_name, $last_name);

        header("Location: /editUsers");
        exit();
    }

    public function deleteUser($user_id) {
        $this->model->deleteUser($user_id);
        header("Location: /editUsers"); 
        exit();
    }
}
?>