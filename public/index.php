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

// echo "<h1>Event Manager";

$db_obj = new DB();

$connection = $db_obj->connect();

// echo "<p style='color: green;'> Successfull connection</p>";

$sql = "SELECT * FROM users";

$todo = $connection->query($sql);

$users = $todo->fetchAll();

// echo "<pre>";
// print_r($users);
// echo "</pre>";
