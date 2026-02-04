<?php
session_start();

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

require_once '../app/core/DB.php';
require_once '../app/core/config.php';
require_once '../app/core/router.php';

$router = new Router();
$router->dispatch();

