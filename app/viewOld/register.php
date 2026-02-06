<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <style>
        body { font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif ; max-width: 400px; margin: 0 auto; padding: 50px; text-align: center; }
        input { width: 100%; padding: 10px; margin: 10px 0; }
        button { padding: 10px 20px; background: green; color: white; border: none; cursor: pointer; }
        .error { color: red; }
    </style>
</head>

<body>
    <h1>Registration</h1>

    <form action="" method="POST">
        <label>Full name:</label>
        <input type="text" name="fullname" required placeholder="Your Name">

        <label>Email adress:</label>
        <input type="email" name="email" required placeholder="yourEmail@adress.com">

        <label>Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Register</button>

        <p>Already have an account? <a href="index.php?page=login">Log in</a></p>
        <p><a href="index.php">Back to the landing page</p>
    </form>
</body>
