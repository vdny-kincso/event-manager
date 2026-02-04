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

    public function registerUser($userId, $workshopId) {
        $db = new DB();
        $conn = $db->connect();
        $sql = "INSERT IGNORE INTO workshop_registrations (user_id, workshop_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([$userId, $workshopId]);
    }

    public function cancelRegistration($userId, $workshopId) {
        $db = new DB();
        $conn = $db->connect();
        $sql = "DELETE FROM workshop_registrations WHERE user_id = ? AND workshop_id = ?";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([$userId, $workshopId]);
    }

    public function isRegistered($userId, $workshopId) {
        $db = new DB();
        $conn = $db->connect();
        $sql = "SELECT * FROM workshop_registrations WHERE user_id = ? AND workshop_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userId, $workshopId]);
        
        return $stmt->fetch() ? true : false;
    }

    public function getEventIdByWorkshopId($workshopId) {
        $db = new DB();
        $conn = $db->connect();
        $sql = "SELECT event_id FROM workshops WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$workshopId]);
        $result = $stmt->fetch();
        return $result ? $result['event_id'] : null;
    }
}