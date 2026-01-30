<?php

require_once '../app/core/config.php';

try{
    $connection = new PDO("mysql:host=".DB_HOST, DB_USER, DB_PASS);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Server connection: OK.<br>";

    $sql = "CREATE DATABASE IF NOT EXISTS `".DB_NAME."`CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
    $connection->exec($sql);

    echo "Database DONE<br>";

    $connection->exec("USE `".DB_NAME."`");

    //users table
    $sql_users = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        fullname VARCHAR(100) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $connection->exec($sql_users);
    echo "Users tábla OK.<br>";

    //events table
    $sql_events = "CREATE TABLE IF NOT EXISTS events (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(64) NOT NULL,
        description TEXT,
        start_date DATE NOT NULL,
        end_date DATE NOT NULL,
        hero_image VARCHAR(255),
        organizer_id INT NOT NULL,
        FOREIGN KEY (organizer_id) REFERENCES users(id) ON DELETE CASCADE
    )";
    $connection->exec($sql_events);
    echo "Events tábla OK.<br>";

    //workshops
    $sql_workshops = "CREATE TABLE IF NOT EXISTS workshops (
        id INT AUTO_INCREMENT PRIMARY KEY,
        event_id INT NOT NULL,
        name VARCHAR(255) NOT NULL,
        FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE
    )";
    $connection->exec($sql_workshops);
    echo "Workshops tábla OK.<br>";

    //registartion
    $sql_registrations = "CREATE TABLE IF NOT EXISTS registrations (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        event_id INT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE,
        UNIQUE(user_id, event_id)
    )";
    $connection->exec($sql_registrations);
    echo "Registrations tábla OK.<br>";

    //workshop registartions
    $sql_wr = "CREATE TABLE IF NOT EXISTS workshop_registrations (
        registration_id INT NOT NULL,
        workshop_id INT NOT NULL,
        FOREIGN KEY (registration_id) REFERENCES registrations(id) ON DELETE CASCADE,
        FOREIGN KEY (workshop_id) REFERENCES workshops(id) ON DELETE CASCADE,
        PRIMARY KEY (registration_id, workshop_id)
    )";
    $connection->exec($sql_wr);
    echo "Workshop Registrations tábla OK.<br>";

    echo "<hr><h2 style='color:green'>Minden sikerült! ✅</h2>";
    echo "A rendszer telepítése kész. Töröld le ezt a fájlt, ha már nincs rá szükség.";

}catch (PDOException $e){
    echo "<h2 style='color:red'>Error:</h2>";
    echo $e->getMessage();
}