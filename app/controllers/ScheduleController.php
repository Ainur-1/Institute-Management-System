<?php
include '../../models/ScheduleModel.php';
include '../../views/schedule/schedule_view.php';

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

    public function displayScheduleEditor() {
        $schedule = $this->model->getSchedule();
        echo $this->view->output2($schedule);
    }
}
?>
