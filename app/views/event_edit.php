<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Event</title>
    <style>
    body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            margin-top: 50px; 
            background-color: #f4f4f4; 
        }
    </style>
</head>

<body>
    <div class="nav">
        <a href = "index.php"> Back to the landing page</a>
    </div>
    <h1>Edit Event</h1>

    <form action="" method="POST">
        <label>Title:</label>
        <input type="text" name="title" value="<?php echo $event['title']; ?>" required><br><br>
        
        <label>Description:</label>
        <textarea name="description" rows="5"><?php echo $event['description']; ?></textarea><br>

        <label>Start date:</label>
        <input type="date" name="start_date" value="<?php echo $event['start_date']; ?>" required><br>

        <label>End date:</label>
        <input type="date" name="end_date" value="<?php echo $event['end_date']; ?>" required><br>

        <input type="hidden" name="id" value="<?php echo $event['id']; ?>">

        <button type="submit">Save changes</button>
    </form>
</body>
