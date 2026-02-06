<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Workshop</title>
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            margin-top: 50px; 
            background-color: #f4f4f4; 
        }
    </style>
</head>
<body style="font-family: sans-serif; max-width: 600px; margin: 20px auto;">

    <h2>Add New Workshop</h2>

    <form action="index.php?page=add_workshop" method="POST">
        
        <input type="hidden" name="event_id" value="<?php echo htmlspecialchars($eventId); ?>">

        <label>Workshop Title:</label><br>
        <input type="text" name="title" required style="width: 100%;"><br><br>

        <label>Start Time:</label><br>
        <input type="date" name="start_time" required><br><br>

        <label>End Time:</label><br>
        <input type="date" name="end_time" required><br><br>

        <button type="submit" style="background: green; color: white; padding: 10px;">Save Workshop</button>
        
        <a href="index.php?page=event_detail&id=<?php echo $eventId; ?>" style="margin-left: 20px;">Cancel</a>
    </form>

</body>
</html>