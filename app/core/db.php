<?php

require_once 'config.php';

class DB {
    public function connect(){
        $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4";
        
        try{
            $pdo = new PDO($dsn, DB_USER, DB_PASS);
            $pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
            return $pdo;

        }catch (PDOException $e){
            die("Database problems: ".$e->getMessage());
        }
    }
}
