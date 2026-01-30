<?php
require_once __DIR__ . '/../model/Event.php';

class eventPresenter{

    public function create(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $title = $_POST['title'];
            $desc = $_POST['description'];
            $start = $_POST['start_date'];
            $end = $_POST['end_date'];
            $organizer_id = $_POST['organizer_id'];

            $eventModel = new Event();
            $eventModel->createEvent($title, $desc, $start, $end, $organizer_id);

            header('Location: index.php');
            exit;
        }

        require_once __DIR__ . '/../views/event_create.php';
    }
}