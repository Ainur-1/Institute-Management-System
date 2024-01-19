<?php
require_once "app/core/Module.php";
require_once "app/models/GroupsModel.php";
require_once "app/views/GroupsView.php";

class GroupsController extends Module {
    private $model;
    private $view;

    public function __construct($conn) {
        $this->model = new GroupsModel($conn);
        $this->view = new GroupsView();
    }
    public function index($page, $id = null) {
        session_start();
        
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            header("Location: /");
            exit;
        }

        switch ($page) {
            case 'groups':
                $pageTitle = "Группы";
                include 'resources/includes/header.php';
                $this->displayModule();
                break;
            case 'addGroup':
                $pageTitle = "Добваление новой группы";
                include 'resources/includes/header.php';
                $this->displayElementAddForm();
                break;
            case 'editTask':
                $pageTitle = "Редактирование группы";
                include 'resources/includes/header.php';
                $this->displayElementEditorForm($id);
                break; 
        }

        include 'resources/includes/footer.php';
    }

    public function displayModule() {
        $this->view->renderGrooups();
    }
    public function displayElementEditorForm($id) {}
    public function displayElementAddForm() {}
    public function AddElement() {}
    public function UpdateElement() {}
    public function DeleteElement() {}
}
?>