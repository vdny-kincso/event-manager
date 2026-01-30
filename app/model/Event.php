<?php

use Dba\Connection;

require_once '../app/core/DB.php';

class Event {
    public function getAllEvents(){
        $db = new DB();
        $connection = $db->connect();

        $sql = "SELECT * FROM events ORDER BY start_date ASC";

        $stmt = $connection->query($sql);
        return $stmt->fetchAll();
    }

    public function createEvent($title, $description, $start_date, $end_date, $organizer_id){
        $db = new DB();
        $connection = $db->connect();

        $sql = "INSERT INTO events (title, description, start_date, end_date, organizer_id) 
            VALUES (?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->execute([$title, $description, $start_date, $end_date, $organizer_id]);
    }
}
