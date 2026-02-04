<?php

// Megnézzük, hogy hol fut a kód (localhost vagy webik?)
$host = $_SERVER['HTTP_HOST'];

if ($host == 'localhost' || $host == '127.0.0.1') {
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', ''); 
    define('DB_NAME', 'eventmanager'); 
    
    // A gépeden lévő mappa elérési útja:
    define('BASE_URL', 'http://localhost/semestral-project/public'); 

} else {
    //WEBIK
    define('DB_HOST', 'localhost'); 
    define('DB_USER', '63399433');
    define('DB_PASS', '3KmfUqI7'); 
    define('DB_NAME', 'stud_63399433');
    
    // A szerveres elérési út:
    define('BASE_URL', 'https://webik.ms.mff.cuni.cz/~63399433/semestral-project/public');
}

// Ezek közösek, maradhatnak itt:
define('ROOT_PATH', __DIR__ . '/../../');

?>