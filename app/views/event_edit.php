<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* === ALAP VÁLTOZÓK === */
        :root {
            --primary-color: #2e7d32;
            --primary-hover: #1b5e20;
            --bg-color: #f8f9fa;
            --text-dark: #2c3e50;
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

        /* === FŐ KONTÉNER === */
        .container {
            max-width: 600px; /* Szerkesztéshez elég a keskenyebb doboz */
            margin: 0 auto;
            padding: 0 20px 50px 20px;
        }

        .form-card {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
        }

        h1 { margin-top: 0; color: var(--primary-color); text-align: center; margin-bottom: 30px; }

        /* === FORM ELEMEK === */
        .form-group { margin-bottom: 20px; }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--text-dark);
        }

        input[type="text"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            font-family: 'Inter', sans-serif;
            box-sizing: border-box;
            transition: border-color 0.2s;
        }

        input:focus, textarea:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.1);
        }

        /* Két oszlopos elrendezés */
        .row { display: flex; gap: 20px; }
        .col { flex: 1; }

        /* === GOMBOK === */
        .btn-save {
            background-color: var(--primary-color);
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
            transition: background 0.2s;
        }
        .btn-save:hover { background-color: var(--primary-hover); }

        .btn-cancel {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #6c757d;
            font-weight: 500;
        }
        .btn-cancel:hover { color: var(--text-dark); text-decoration: underline; }

        /* Mobil nézet */
        @media (max-width: 600px) {
            .row { flex-direction: column; gap: 0; }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <a href="index.php" class="logo">📅 EventManager</a>
        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="index.php?page=calendar">Calendar</a>
            <?php if (isset($_SESSION['user_id'])) : ?>
                <span style="color: #666; font-size: 0.9rem;">Hi, <strong><?= $_SESSION['user_name']; ?></strong></span>
                <a href="index.php?page=logout" style="color: #d32f2f;">Log out</a>
            <?php endif; ?>
        </div>
    </nav>

    <div class="container">
        <div class="form-card">
            <h1>Edit Event</h1>

            <form action="index.php?page=edit_event&id=<?php echo $event['id']; ?>" method="POST">
                
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" value="<?php echo htmlspecialchars($event['title']); ?>" required>
                </div>
                
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" rows="6"><?php echo htmlspecialchars($event['description']); ?></textarea>
                </div>

                <div class="row">
                    <div class="col form-group">
                        <label>Start Date</label>
                        <input type="date" name="start_date" value="<?php echo $event['start_date']; ?>" required>
                    </div>
                    
                    <div class="col form-group">
                        <label>End Date</label>
                        <input type="date" name="end_date" value="<?php echo $event['end_date']; ?>" required>
                    </div>
                </div>

                <input type="hidden" name="id" value="<?php echo $event['id']; ?>">

                <button type="submit" class="btn-save">Save Changes</button>
                
                <a href="index.php?page=event_detail&id=<?php echo $event['id']; ?>" class="btn-cancel">
                    Cancel and go back
                </a>

            </form>
        </div>
    </div>

</body>
</html>