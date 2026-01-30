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
            case 'events':
                echo "<h1>Events here...</h1>";
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
            default:
                echo "<h1>404 - Page not found :( </h1>";
                break;
        }
    }
}

