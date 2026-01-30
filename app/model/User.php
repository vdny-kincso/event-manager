<?php

require_once '../app/core/DB.php';

class User{
    public function register($email, $password, $fullname){
        $db = new DB();
        $connection = $db->connect();

        $secretPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (email, password, fullname) VALUES (?,?,?)";

        $stmt = $connection->prepare($sql);

        try {
            $stmt->execute([$email, $secretPassword, $fullname]);
            return true; 
        } catch (PDOException $e) {
            return false; 
        }
    }

    public function login($email, $password){
        $db = new DB();
        $connection = $db->connect();

        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $connection->prepare($sql);
        $stmt->execute([$email]);

        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])){
            return $user;
        } else {
            return false;
        }
    }
}