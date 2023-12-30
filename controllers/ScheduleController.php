<?php
include '../model/ScheduleModel.php';
include '../view/schedule_view.php';

class ScheduleController {
    private $model;
    private $view;

    public function __construct($conn) {
        $this->model = new ScheduleModel($conn);
        $this->view = new ScheduleView();
    }

    public function displaySchedule() {
        $schedule = $this->model->getSchedule();
        echo $this->view->output($schedule);

    }
}
?>
