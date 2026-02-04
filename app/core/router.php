<?php

class Router{
    public function dispatch(){
        if (isset($_GET['page'])){
            $page = $_GET['page'];
        } else 
            $page = 'home';

        switch ($page){
            case 'home':
                require_once '../app/presenter/landing.php';
                $presenterLanding = new LandingPresenter();
                $presenterLanding->render();
                break;
            case 'create_event':
                require_once '../app/presenter/eventPresenter.php';
                $eventPresenter = new eventPresenter();
                $eventPresenter->create();
                break;
            case 'register_event':
                require_once '../app/presenter/eventPresenter.php';
                $eventPresenter = new eventPresenter();
                $eventPresenter->register();
                break;
            case 'unregister_event':
                require_once '../app/presenter/eventPresenter.php';
                $eventPresenter = new EventPresenter();
                $eventPresenter->unregister(); 
                break;
            case 'register':
                require_once '../app/presenter/userPresenter.php';
                $userPresenter = new userPresenter();
                $userPresenter->register();
                break;
            case 'login':
                require_once '../app/presenter/userPresenter.php';
                $userPresenter = new userPresenter();
                $userPresenter->login();
                break;
            case 'logout':
                require_once '../app/presenter/userPresenter.php';
                $userPresenter = new userPresenter();
                $userPresenter->logout();
                break;
            case 'delete_event':
                require_once '../app/presenter/eventPresenter.php';
                $eventPresenter = new eventPresenter();
                $eventPresenter->delete();
                break;
            case 'edit_event':
                require_once '../app/presenter/eventPresenter.php';
                $eventPresenter = new eventPresenter();
                $eventPresenter->edit();
                break;
            case 'event_detail':
                require_once '../app/presenter/EventPresenter.php';
                $eventPresenter = new EventPresenter();
                $eventPresenter->detail();
                break;
            case 'add_workshop':
                require_once '../app/presenter/WorkshopPresenter.php';
                $workshopPresenter = new workshopPresenter();
                $workshopPresenter->add();
                break;
            case 'register_workshop':
                require_once __DIR__ . '/../presenter/eventPresenter.php';
                $presenter = new eventPresenter();
                $presenter->register_workshop();
                break;
            case 'unregister_workshop':
                require_once __DIR__ . '/../presenter/eventPresenter.php';
                $presenter = new eventPresenter();
                $presenter->unregister_workshop();
                break;
            case 'event_register_page':
                require_once __DIR__ . '/../presenter/eventPresenter.php';
                $presenter = new eventPresenter();
                $presenter->register_page(); 
                break;
            default:
                echo "<h1>404 - Page not found :( </h1>";
                break;
        }
    }
}

