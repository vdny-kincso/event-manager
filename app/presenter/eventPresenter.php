<?php
require_once __DIR__ . '/../model/Event.php';
require_once __DIR__ . '/WorkshopPresenter.php';

class EventPresenter {

    public function create(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $title = $_POST['title'];
            $desc = $_POST['description'];
            $start = $_POST['start_date'];
            $end = $_POST['end_date'];
            $currentUserId = $_SESSION['user_id'];

            $imagePath = null;
            if (isset($_FILES['hero_image']) && $_FILES['hero_image']['error']===0){
                $fileName = time() . '_' . basename($_FILES['hero_image']['name']);
                $targetFile = __DIR__.'/../../public/uploads/'.$fileName;
                if (move_uploaded_file($_FILES['hero_image']['tmp_name'], $targetFile)){
                    $imagePath = $fileName;
                }
            }

            $eventModel = new Event();
            $eventId = $eventModel->createEvent($title, $desc, $start, $end, $imagePath, $currentUserId);

            // WORKSHOPOK MENTÉSE LÉTREHOZÁSKOR
            if (isset($_POST['workshops']) && is_array($_POST['workshops'])) {
                require_once __DIR__ . '/../model/Workshop.php';
                $workshopModel = new Workshop();

                foreach ($_POST['workshops'] as $wData) {
                    if (!empty($wData['title'])) {
                        $workshopModel->createWorkshop(
                            $eventId,
                            $wData['title'],
                            $wData['start_time'], 
                            $wData['end_time']
                        );
                    }
                }
            }
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
        } else {
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

            if (!$event){
                header('Location: index.php');
                exit;
            }
            require_once __DIR__ . '/../views/event_edit.php';
        } else {
            header('Location: index.php');
            exit;
        }
    }

    public function detail() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $eventModel = new Event();
            $event = $eventModel->getEventById($id);

            if (!$event) { header('Location: index.php'); exit; }

            // Workshopok lekérése
            require_once __DIR__ . '/../model/Workshop.php';
            $workshopModel = new Workshop();
            $workshops = $workshopModel->getAllWorkshopsById($id);

            $isRegistered = false; 
            if (isset($_SESSION['user_id'])) {
                $isRegistered = $eventModel->isRegistered($_SESSION['user_id'], $id);
            }

            require_once __DIR__ . '/../views/event_detail.php';
        }
    }

    //workshops and event registration managemnet here
    public function register_page() {

        if (!isset($_SESSION['user_id']) || !isset($_GET['id'])) {
            header('Location: index.php?page=login');
            exit;
        }

        $eventId = $_GET['id'];
        $userId = $_SESSION['user_id'];
        
        $eventModel = new Event();
        require_once __DIR__ . '/../model/Workshop.php';
        $workshopModel = new Workshop();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            //event registration must
            $eventModel->registerUser($userId, $eventId);

            //workshops selected
            $selectedWS = isset($_POST['workshops']) ? $_POST['workshops'] : [];
            
            //all of them for deleting
            $allWorkshops = $workshopModel->getAllWorkshopsById($eventId);

            foreach ($allWorkshops as $w) {
                if (in_array($w['id'], $selectedWS)) {
                    //selected - save
                    $workshopModel->registerUser($userId, $w['id']);
                } else {
                    //not selected - delete
                    $workshopModel->cancelRegistration($userId, $w['id']);
                }
            }

            //send back to detail page
            header('Location: index.php?page=event_detail&id=' . $eventId);
            exit;
        }

        //GET
        $event = $eventModel->getEventById($eventId);
        
        if (!$event) {
            header('Location: index.php');
            exit;
        }

        $workshops = $workshopModel->getAllWorkshopsById($eventId);

        //for seeing the selected ones
        $myWorkshopIds = [];
        foreach ($workshops as $w) {
            if ($workshopModel->isRegistered($userId, $w['id'])) {
                $myWorkshopIds[] = $w['id'];
            }
        }

        require_once __DIR__ . '/../views/event_register.php';
    }
    
    public function register(){
        if (isset($_SESSION['user_id']) && isset($_GET['id'])) {
            $model = new Event();
            $model->registerUser($_SESSION['user_id'], $_GET['id']);
        }
        header('Location: index.php?page=event_detail&id=' . $_GET['id']);
        exit;
    }

    public function unregister() {
        if (isset($_SESSION['user_id']) && isset($_GET['id'])) {
            $model = new Event();
            $model->cancelRegistration($_SESSION['user_id'], $_GET['id']);
        }
        header('Location: index.php?page=event_detail&id=' . $_GET['id']);
        exit;
    }

    public function calendar(){
        $eventModel = new Event();

        $year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');
        $month = isset($_GET['month']) ? (int)$_GET['month'] : date('m');

        $firstDayOfMonth = new DateTime("$year-$month-01");
        $daysInMonth = $firstDayOfMonth->format('t');
        $monthName = $firstDayOfMonth->format('F Y');
        $dayOfWeekFirstDay = $firstDayOfMonth->format('N');

        $lastDayOfMonth = new DateTime("$year-$month-$daysInMonth");

        $prevDate = clone $firstDayOfMonth;
        $prevDate->modify('-1 month');
        $prevYear = $prevDate->format('Y');
        $prevMonth = $prevDate->format('m');

        $nextDate = clone $firstDayOfMonth;
        $nextDate->modify('+1 month');
        $nextYear = $nextDate->format('Y');
        $nextMonth = $nextDate->format('m');

        //events - all events that month
        $startDateStr = $firstDayOfMonth->format('Y-m-d');
        $endDateStr = $lastDayOfMonth->format('Y-m-d');
        $events = $eventModel->getEventsByDateRange($startDateStr, $endDateStr);

        $calendarData = [];
        for ($day=1; $day<=$daysInMonth; $day++) {
            $calendarData[$day] = []; 
        }

        foreach ($events as $event) {
            $eventStart=new DateTime($event['start_date']);
            $eventEnd=new DateTime($event['end_date']);

            //going on all days in the month and see if the event is still going
            for ($day=1; $day<=$daysInMonth; $day++) {
                $currentDayStr= "$year-$month-" . str_pad($day, 2, '0', STR_PAD_LEFT);
                $currentDayDate= new DateTime($currentDayStr);

                if ($currentDayDate >= $eventStart && $currentDayDate <= $eventEnd) {
                    $calendarData[$day][] = $event;
                }
            }
        }

        require_once __DIR__ . '/../views/calendar.php';
    }
}