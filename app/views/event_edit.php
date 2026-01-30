<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Event</title>
    <style>
        body { font-family: sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input, textarea { width: 100%; padding: 8px; margin-top: 5px; }
        button { margin-top: 20px; padding: 10px 20px; background: orange; color: white; border: none; cursor: pointer; }
        .nav { margin-bottom: 20px; }
    </style>
</head>

<body>
    <div class="nav">
        <a href = "index.php"> Back to the landing page</a>
    </div>
    <h1>Edit Event</h1>

    <form action="" method="POST">
        <label>Title:</label>
        <input type="text" name="title" value="<?php echo $event['title']; ?>" required>
        
        <label>Description:</label>
        <textarea name="description" rows="5"><?php echo $event['description']; ?></textarea>

        <label>Start date:</label>
        <input type="date" name="start_date" value="<?php echo $event['start_date']; ?>" required>

        <label>End date:</label>
        <input type="date" name="end_date" value="<?php echo $event['end_date']; ?>" required>

        <input type="hidden" name="id" value="<?php echo $event['id']; ?>">

        <button type="submit">Save changes</button>
    </form>
</body>
