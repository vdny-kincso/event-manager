<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log in</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; max-width: 400px; margin: 0 auto; padding: 50px; text-align: center; }
        input { width: 100%; padding: 10px; margin: 10px 0; }
        button { padding: 10px 20px; background: green; color: white; border: none; cursor: pointer; }
    </style>
</head>

<body>
    <h1>Log in</h1>

    <form action="" method="POST">
        <label>Email adress:</label>
        <input type="email" name="email" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Log in</button>
    </form>

    <p>Don't have an account? <a href="index.php?page=register">Register!</p>
    <p><a href="index.php">Back to the landing page</a></p>

</body>
