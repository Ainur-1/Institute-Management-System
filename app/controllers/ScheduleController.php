<?php
include_once 'app/models/ScheduleModel.php';
include_once 'app/views/ScheduleView.php';

class ScheduleController {
    private $model;
    private $view;

    public function __construct($conn) {
        $this->model = new ScheduleModel($conn);
        $this->view = new ScheduleView();
    }

    public function index($page) {
        $pageTitle = "Расписание занятий";
        include 'resources/includes/header.php';

        switch ($page) {
            case 'schedule':
                $this->displaySchedule();
                break;
            case 'editSchedule':
                $this->displayScheduleEditor();
                break;    
        }

        include 'resources/includes/footer.php';
    }

    public function displaySchedule() {
        $schedule = $this->model->getSchedule();
        echo $this->view->output($schedule);
    }

    public function displayScheduleEditor() {
        $schedule = $this->model->getSchedule();
        echo $this->view->output1($schedule);
    }
}
?>
