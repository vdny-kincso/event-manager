<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - EventManager</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* === ALAP VÁLTOZÓK === */
        :root {
            --primary-color: #2e7d32;
            --primary-hover: #1b5e20;
            --bg-color: #f8f9fa;
            --text-dark: #2c3e50;
            --card-shadow: 0 4px 12px rgba(0,0,0,0.08);
            --error-bg: #ffebee;
            --error-text: #c62828;
        }

        body { 
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            margin: 0;
            padding: 0;
            color: var(--text-dark);
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        a { text-decoration: none; transition: 0.3s; }

        /* === NAVBAR === */
        .navbar {
            background-color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .logo { font-size: 1.5rem; font-weight: 700; color: var(--primary-color); }
        .nav-links { display: flex; gap: 20px; align-items: center; }
        .nav-links a { color: var(--text-dark); font-weight: 500; font-size: 0.95rem; }
        .nav-links a:hover { color: var(--primary-color); }

        /* === REGISZTRÁCIÓS KÁRTYA === */
        .login-container {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .auth-card {
            background: white;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            text-align: center;
        }

        .auth-card h1 { margin-top: 0; color: var(--primary-color); margin-bottom: 10px; }
        .auth-card p { color: #666; margin-bottom: 30px; font-size: 0.95rem; }

        /* === FORM ELEMEK === */
        .form-group { margin-bottom: 20px; text-align: left; }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--text-dark);
            font-size: 0.9rem;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            font-family: 'Inter', sans-serif;
            box-sizing: border-box;
            transition: border-color 0.2s;
        }

        input:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.1);
        }

        /* === GOMB === */
        .btn-register {
            width: 100%;
            padding: 14px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
        }
        .btn-register:hover { background-color: var(--primary-hover); }

        /* === HIBAÜZENET === */
        .error-msg {
            background-color: var(--error-bg);
            color: var(--error-text);
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.9rem;
            text-align: left;
            border: 1px solid #ffcdd2;
        }

        /* === LÁBLÉC LINKEK === */
        .auth-footer {
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 0.9rem;
            color: #666;
        }

        .auth-footer a { color: var(--primary-color); font-weight: 600; }
        .auth-footer a:hover { text-decoration: underline; }

    </style>
</head>
<body>

    <nav class="navbar">
        <a href="index.php" class="logo">📅 EventManager</a>
        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="index.php?page=login">Log In</a>
        </div>
    </nav>

    <div class="login-container">
        <div class="auth-card">
            <h1>Create Account</h1>
            <p>Join us to organize and attend amazing events.</p>

            <?php if (isset($error) && !empty($error)): ?>
                <div class="error-msg">
                    ⚠️ <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form action="" method="POST">
                
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="fullname" required placeholder="John Doe">
                </div>

                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" required placeholder="you@example.com">
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required placeholder="Create a strong password">
                </div>

                <button type="submit" class="btn-register">Sign Up</button>

            </form>

            <div class="auth-footer">
                <p>Already have an account? <a href="index.php?page=login">Log in here</a></p>
                <p><a href="index.php" style="color: #999; font-weight: normal;">&larr; Back to landing page</a></p>
            </div>
        </div>
    </div>

</body>
</html>