<?php
require_once __DIR__ . '/../core/DB.php';

class Workshop {

    public function createWorkshop($eventID, $title, $start, $end){
        $db = new DB();
        $conn = $db->connect();

        $sql = "INSERT INTO workshops (event_id, title, start_time, end_time) 
                VALUES (?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        return $stmt->execute([$eventID, $title, $start, $end]);
    }

    public function getAllWorkshopsById($eventID){
        $db = new DB();
        $conn = $db->connect();

        $sql = "SELECT * FROM workshops WHERE event_id = ? ORDER BY start_time ASC";

        $stmt = $conn->prepare($sql);
        $stmt->execute([$eventID]);

        return $stmt->fetchAll();
    }
    
    public function delete($id){
         $db = new DB();
         $conn = $db->connect();
         $sql = "DELETE FROM workshops WHERE id = ?";
         $stmt = $conn->prepare($sql);
         return $stmt->execute([$id]);
    }
}