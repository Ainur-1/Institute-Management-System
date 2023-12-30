<?php
include "../../models/ProfileModel.php";
include "../../views/profile/profile_view.php";

class ProfileController {
    private $view;
    private $model;

    public function __construct($conn) {
        $this->model = new ProfileModel($conn);
        $this->view = new ProfileView();
    }

    public function displayInformation() {
        $userData = $this->model->getUserInfo('123');
        $this->view->output($userData);
    }

}
?>