<!DOCTYPE html>
<html lang="en">
<head>
    <title>Event Manager</title>
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            text-align: center; 
            margin-top: 50px; 
            background-color: #f4f4f4; 
        }
        h1 { color: #333; }
        
        /* menu */
        .nav { 
            margin-bottom: 30px; 
            background: white;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .nav a { 
            margin: 0 15px; 
            text-decoration: none; 
            color: green; 
            font-weight: bold; 
            font-size: 1.1em;
        }
        .nav a:hover { text-decoration: underline; }

        .event-box {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px; 
            padding: 20px;
            margin: 20px auto; 
            max-width: 600px; 
            box-shadow: 0 4px 6px rgba(0,0,0,0.1); 
            text-align: left; 
        }

        .event-box h2 {
            margin-top: 0;
            color: #2c3e50;
        }

        .event-box small {
            display: block;
            margin-top: 10px;
            color: #7f8c8d;
            font-style: italic;
        }
        </style>
</head>
<body>
    <div class="nav">
        <!-- <a href="index.php">Landing page</a> -->

        <?php if (isset($_SESSION['user_id'])) : ?>
            <span style="font-weight:bold; font-size: 1.8em; color:green;">Hello, <?php echo $_SESSION['user_name']; ?>!<br><br></span>
            <a href="index.php">Landing page</a>
            <a href="index.php?page=create_event">Create new event</a>
            <a href="index.php?page=logout">Log out</a>
        <?php else: ?>
            <a href="index.php">Landing page</a>
            <a href="index.php?page=login">Register</a>
            <a href="index.php?page=login">Log in</a>
        <?php endif; ?>
    </div>

    <hr>
    <h1>Welcome to the Event Manager</h1>
    <p>This is the landing page</p>
    <h1>Actual events:</h1>

    <?php foreach ($events as $event): ?>
        <div class="event-box">
            <h2><?php echo $event['title']; ?></h2>
            <p><?php echo $event['description']; ?></p>
            <small>Date: <?php echo $event['start_date']; ?></small>
        </div>
    <?php endforeach; ?>
    <?php if (empty($events)): ?>
        <p>No events at the moment.</p>
    <?php endif; ?>
</body>
</html>