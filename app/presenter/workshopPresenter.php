<?php

require_once __DIR__ . '/../model/Workshop.php';

class WorkshopPresenter {

    public function add(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $eventId = $_POST['event_id']; //hidden
            $title = $_POST['title'];
            $start = $_POST['start_time'];
            $end = $_POST['end_time'];

            $workshopModel = new Workshop();
            $workshopModel->createWorkshop($eventId, $title, $start, $end);

            header('Location: index.php?page=event_detail&id='.$eventId);
            exit;
        }

        if (isset($_GET['event_id'])){
            $eventId = $_GET['event_id'];
            require_once __DIR__ . '/../views/create_workshop.php';
        } else {
            header('Location: index.php');
        }
    }
}
