<?php
include_once 'app/models/ScheduleModel.php';
include_once 'app/views/ScheduleView.php';

class ScheduleController {
    private $model;
    private $view;

    private $dayOfWeekNames = [
        1 => 'Понедельник',
        2 => 'Вторник',
        3 => 'Среда',
        4 => 'Четверг',
        5 => 'Пятница',
        6 => 'Суббота',
        7 => 'Воскресенье'
    ];

    public function __construct($conn) {
        $this->model = new ScheduleModel($conn);
        $this->view = new ScheduleView();
    }

    public function index($page, $id = null) {
        switch ($page) {
            case 'schedule':
                $pageTitle = "Расписание занятий";
                include 'resources/includes/header.php';
                $this->displaySchedule();
                break;
            case 'editSchedule':
                $pageTitle = "Редактирование расписания";
                include 'resources/includes/header.php';
                $this->displayScheduleEditor();
                break;
            case 'addNewClass':
                $pageTitle = "Добваление нового занятия";
                include 'resources/includes/header.php';
                $this->displayAddClassForm();
                break;
            case 'addNewSubject':
                $pageTitle = "Добваление нового предмета";
                include 'resources/includes/header.php';
                $this->displayAddSubjectForm();
                break;
            case 'editClass':
                $pageTitle = "Редактирование занятия";
                include 'resources/includes/header.php';
                $this->displayClassEditForm($id);
                break;
        }

        include 'resources/includes/footer.php';
    }

    public function displaySchedule() {
        $schedule = $this->model->getSchedule();
        $this->view->renderSchedule($schedule, $this->dayOfWeekNames);
    }

    public function displayScheduleEditor() {
        $schedule = $this->model->getSchedule();
        $this->view->renderScheduleEditor($schedule, $this->dayOfWeekNames);
    }
    
    public function displayAddClassForm() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $subject_id = $_POST['subject'];
            $group_id = $_POST['group'];
            $teacher_id = $_POST['teacher'];
            $day_of_week = $_POST['day'];
            $class_time_id = $_POST['classStartTime'];

            $this->model->insertIntoSchedule($subject_id, $group_id, $teacher_id, $day_of_week, $class_time_id);
        } else {
            $subjects = $this->model->selectAllFromTable("Subjects");
            $groups = $this->model->selectAllFromTable("StudentGroups");
            $teachers = $this->model->selectAllFromTable("Teachers");
            $classTimes = $this->model->selectAllFromTable("ClassTimes"); 
            echo $this->view->renderAddNewClassForm($subjects, $groups, $this->dayOfWeekNames, $teachers, $classTimes);
        }
    }

    public function displayClassEditForm($id) {
        $class = $this->model->getClassFromId($id);
        $subjects = $this->model->selectAllFromTable("Subjects");
        $groups = $this->model->selectAllFromTable("StudentGroups");
        $teachers = $this->model->selectAllFromTable("Teachers");
        $classTimes = $this->model->selectAllFromTable("ClassTimes"); 

        $this->view->renderClassEditForm($class, $subjects, $groups, $this->dayOfWeekNames, $teachers, $classTimes);
    }

    public function displayAddSubjectForm() { 
        $this->view->renderClassSubjectForm();
    }

    

    public function deleteClass($schedule_id) {
        $this->model->deleteClass($schedule_id);
        header("Location: /editSchedule"); 
        exit();
    }
}
?>
