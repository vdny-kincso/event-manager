<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Workshop</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* === ALAP VÁLTOZÓK === */
        :root {
            --primary-color: #2e7d32;
            --primary-hover: #1b5e20;
            --bg-color: #f8f9fa;
            --text-dark: #2c3e50;
            --text-light: #6c757d;
            --card-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        body { 
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            margin: 0;
            padding: 0;
            color: var(--text-dark);
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
            margin-bottom: 40px;
        }

        .logo { font-size: 1.5rem; font-weight: 700; color: var(--primary-color); }

        .nav-links { display: flex; gap: 20px; align-items: center; }
        .nav-links a { color: var(--text-dark); font-weight: 500; font-size: 0.95rem; }
        .nav-links a:hover { color: var(--primary-color); }
        
        .btn-nav {
            background-color: var(--primary-color);
            color: white !important;
            padding: 8px 20px;
            border-radius: 20px;
        }
        .btn-nav:hover { background-color: var(--primary-hover); }

        /* === FORM KONTÉNER === */
        .container {
            max-width: 500px; /* Keskenyebb, fókuszáltabb doboz */
            margin: 0 auto;
            padding: 0 20px 50px 20px;
        }

        .form-card {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
        }

        .form-title {
            margin-top: 0;
            margin-bottom: 30px;
            color: var(--primary-color);
            text-align: center;
            font-size: 1.8rem;
        }

        /* === INPUTOK === */
        .form-group { margin-bottom: 20px; }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--text-dark);
            font-size: 0.9rem;
        }

        input[type="text"],
        input[type="datetime-local"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            font-family: 'Inter', sans-serif;
            box-sizing: border-box; /* Hogy a padding ne növelje a szélességet */
            transition: border-color 0.3s;
        }

        input:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.1);
        }

        /* === GOMBOK === */
        .btn-save {
            width: 100%;
            padding: 14px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
            transition: background 0.3s;
        }

        .btn-save:hover { background-color: var(--primary-hover); }

        .btn-cancel {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: var(--text-light);
            font-weight: 500;
        }
        
        .btn-cancel:hover { color: var(--text-dark); text-decoration: underline; }

    </style>
</head>
<body>

    <nav class="navbar">
        <a href="index.php" class="logo">📅 EventManager</a>
        
        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="index.php?page=calendar">Calendar</a>

            <?php if (isset($_SESSION['user_id'])) : ?>
                <span style="color: #6c757d; font-size: 0.9rem;">Hi, <strong><?php echo $_SESSION['user_name']; ?></strong></span>
                <a href="index.php?page=create_event" class="btn-nav">Create Event +</a>
                <a href="index.php?page=logout" style="color: #d32f2f;">Log out</a>
            <?php else: ?>
                <a href="index.php?page=login" class="btn-nav">Sign In</a>
            <?php endif; ?>
        </div>
    </nav>

    <div class="container">
        <div class="form-card">
            <h2 class="form-title">Add New Workshop</h2>

            <form action="index.php?page=add_workshop" method="POST">
                
                <input type="hidden" name="event_id" value="<?php echo htmlspecialchars($eventId); ?>">

                <div class="form-group">
                    <label>Workshop Title</label>
                    <input type="text" name="title" required placeholder="e.g. Intro to Coding">
                </div>

                <div class="form-group">
                    <label>Start Time</label>
                    <input type="datetime-local" name="start_time" required>
                </div>

                <div class="form-group">
                    <label>End Time</label>
                    <input type="datetime-local" name="end_time" required>
                </div>

                <button type="submit" class="btn-save">Save Workshop</button>
                
                <a href="index.php?page=event_detail&id=<?php echo $eventId; ?>" class="btn-cancel">
                    Cancel and go back
                </a>
            </form>
        </div>
    </div>

</body>
</html>