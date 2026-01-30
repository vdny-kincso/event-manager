<?php

require_once '../app/model/Event.php';

class LandingPresenter
{
    public function render()
    {
        $eventModel = new Event();

        $events = $eventModel->getAllEvents();

        require_once __DIR__ . '/../views/landing.php';
    }
}