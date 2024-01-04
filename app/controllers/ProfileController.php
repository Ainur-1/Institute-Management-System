<?php
include_once "app/models/ProfileModel.php";
include_once "app/views/ProfileView.php";

class ProfileController {
    private $view;
    private $model;

    public function __construct($conn) {
        $this->model = new ProfileModel($conn);
        $this->view = new ProfileView();
    }

    public function index() {
        session_start();

        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            header("Location: /");
            exit;
        }

        $SESSION_username = $_SESSION['username'];

        $pageTitle = "Профиль";
        include 'resources/includes/header.php';

        $this->displayInformation($SESSION_username);

        include 'resources/includes/footer.php';
    }

    public function displayInformation($username) {
        $userData = $this->model->getUserInfo($username);
        $this->view->output($userData);
    }

}
?>