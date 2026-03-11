# NDBI046 Repository
# Event Manager - Semestral Project

This project is a semantic web application developed for the Web Applications course. It is a comprehensive Event Management System built using native PHP and the MVC (Model-View-Controller) architectural pattern. It allows users to browse events, register for them, and enables organizers to manage events and workshops.

## Features

* **MVC Architecture:** Clean separation of concerns (Models, Views, Presenters).
* **User Authentication:** Secure Login and Registration system.
* **Event Management:**
    * Create, Edit, and Delete events.
    * Image upload functionality for event covers.
    * Smart path handling for images (Linux/Windows compatibility).
* **Workshop Management:** Organizers can add multiple workshops with specific time slots to events.
* **Registration System:** Users can register for events and select specific workshops to attend.
* **Environment Detection:** The application automatically detects if it is running on `localhost` or the production server (Webik) and adjusts database configurations accordingly.

---

## Screenshots

### 1. Landing Page
The main page displaying the list of active events with their cover images and details.
<img width="1862" height="722" alt="landing_page2" src="https://github.com/user-attachments/assets/78bd0f3c-11b8-48c5-94fb-cae3516b5ea9" />



### 2. Registration & Detail Page
The detailed view of an event where users can register and select workshops.
<img width="1900" height="771" alt="registartion_page2" src="https://github.com/user-attachments/assets/697b6dad-5be4-4103-bde5-094b8a917030" />

### 3. Calendar
A calendar where the user can see all the events organized. 
<img width="1835" height="952" alt="calendar" src="https://github.com/user-attachments/assets/c0dae8ad-d68c-43b6-90b1-ea95a62d7ffa" />


---

## Installation Instructions

Follow these steps to set up the project on your local machine.

### Prerequisites
* PHP 7.4 or higher
* MySQL / MariaDB
* Apache Web Server (e.g., XAMPP, WAMP, or MAMP)

### Step 1: Clone the Repository
Clone this repository to your web server's root directory (e.g., `htdocs` in XAMPP or `/var/www/html`).

git clone

### Step 2: Initialize the Database
Create a new database in MySQL.Import the provided database.sql file located in the root of this repository.

Using phpMyAdmin:
* Open phpMyAdmin.
* Select your new database.
* Click "Import".
*Choose the database.sql file and click "Go".

### Step 3: Configuration
The project uses a smart configuration file (app/core/config.php) that handles different environments. You only need to check the localhost section.

Open app/core/config.php.
Ensure the database credentials match your local setup:

### Step 4: Run the Application
Open your browser and navigate to the project URL: http://localhost/semestral-project/public/index.php

## Project Structure
semestral-project/
├── app/
│   ├── core/           # Router and Database configuration
│   ├── model/          # Database interaction logic (Event, User, Workshop)
│   ├── presenter/      # Application logic and controllers
│   └── views/          # HTML templates and forms
├── public/
│   ├── uploads/        # Stores uploaded event images
│   └── index.php       # Entry point of the application
├── docs/               # Documentation assets (screenshots)
├── database.sql        # Database export for initialization
