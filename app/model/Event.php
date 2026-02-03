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

    public function createEvent($title, $description, $start_date, $end_date, $hero_image, $organizer_id){
        $db = new DB();
        $connection = $db->connect();

        $sql = "INSERT INTO events (title, description, start_date, end_date, hero_image, organizer_id) 
            VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->execute([$title, $description, $start_date, $end_date, $hero_image, $organizer_id]);

        return $connection->lastInsertId();
    }

    public function deleteEvent($id){
        $db = new DB();
        $connection = $db->connect();

        $sql = "DELETE FROM events WHERE id = ?";

        $stmt = $connection->prepare($sql);

        return $stmt->execute([$id]);
    }

    public function getEventById($id){
        $db = new DB();
        $connection = $db->connect();

        $sql = "SELECT* FROM events WHERE id = ?";

        $stmt = $connection->prepare($sql);

        $stmt->execute([$id]);

        return $stmt->fetch();
    }

    public function updateEvent($id, $title, $desc, $start, $end){
        $db = new DB();
        $connection = $db->connect();

        $sql = "UPDATE events SET title=?, description=?, start_date=?, end_date=? WHERE id=?";

        $stmt = $connection->prepare($sql);

        return $stmt->execute([$title, $desc, $start, $end, $id]);
    }

    public function registerUser($userId, $eventId) {
        $db = new DB();
        $conn = $db->connect();
        $sql = "INSERT IGNORE INTO registrations (user_id, event_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([$userId, $eventId]);
    }

    public function cancelRegistration($userId, $eventId) {
        $db = new DB();
        $conn = $db->connect();
        $sql = "DELETE FROM registrations WHERE user_id = ? AND event_id = ?";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([$userId, $eventId]);
    }

    public function isRegistered($userId, $eventId) {
        $db = new DB();
        $conn = $db->connect();
        $sql = "SELECT * FROM registrations WHERE user_id = ? AND event_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userId, $eventId]);
        
        return $stmt->fetch() ? true : false;
    }
}
