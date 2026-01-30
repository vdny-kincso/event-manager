<?php
require_once __DIR__ . '/../model/Event.php';

class eventPresenter{

    public function create(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $title = $_POST['title'];
            $desc = $_POST['description'];
            $start = $_POST['start_date'];
            $end = $_POST['end_date'];
            // $organizer_id = $_POST['organizer_id'];

            $currentUserId = $_SESSION['user_id'];

            $eventModel = new Event();
            $eventModel->createEvent($title, $desc, $start, $end, $currentUserId);

            header('Location: index.php');
            exit;
        }

        require_once __DIR__ . '/../views/event_create.php';
    }

    public function delete(){
        if (isset($_GET['id'])){
            $id = $_GET['id'];

            $eventModel = new Event();
            $eventModel->deleteEvent($id);

            header('Location: index.php');
            exit;
        }else {
            header('Location: index.php');
            exit;
        }
    }

    public function edit(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];
            $title = $_POST['title'];
            $desc = $_POST['description'];
            $start = $_POST['start_date'];
            $end = $_POST['end_date'];

            $eventModel = new Event();
            $eventModel->updateEvent($id, $title, $desc, $start, $end);

            header('Location: index.php');
            exit;
        }

        if (isset($_GET['id'])){
            $id = $_GET['id'];

            $eventModel = new Event();
            $event = $eventModel->getEventById($id);

            // var_dump($event); database
            // die();

            if (!$event){
                header('Location: index.php');
                exit;
            }

            require_once __DIR__ . '/../views/event_edit.php';
        }else {
            header('Location: index.php');
            exit;
        }
    }
}