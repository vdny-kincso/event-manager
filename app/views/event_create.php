<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create new event</title>
    <style>
        body { font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input, textarea { width: 100%; padding: 8px; margin-top: 5px; }
        button { margin-top: 20px; padding: 10px 20px; background: green; color: white; border: none; cursor: pointer; }
        .nav { margin-bottom: 20px; }
    </style>
</head>
<body>

    <div class="nav">
        <a href="index.php">Back to the landing page</a>
    </div>

    <h1>Create the new event:</h1>

    <form action="" method="POST">
        <label>Name of the new event:</label>
        <input type="text" name="title" required>

        <label>Description:</label>
        <textarea name="description" rows="5"></textarea>

        <label>Start date:</label>
        <input type="date" name="start_date" required>

        <label>End date:</label>
        <input type="date" name="end_date" required>

        <input type="hidden" name="organizer_id" value="1">

        <button type="submit">Save</button>
    </form>

</body>
