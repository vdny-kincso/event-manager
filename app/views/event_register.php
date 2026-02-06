<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration - <?php echo htmlspecialchars($event['title']); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* === ALAP VÁLTOZÓK === */
        :root {
            --primary-color: #2e7d32;
            --primary-hover: #1b5e20;
            --bg-color: #f8f9fa;
            --text-dark: #2c3e50;
            --card-shadow: 0 4px 12px rgba(0,0,0,0.08);
            --danger-color: #d32f2f;
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

        /* === FORM KONTÉNER === */
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 0 20px 50px 20px;
        }

        .form-card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
        }

        .header-section { margin-bottom: 20px; text-align: center; }
        .header-section h1 { margin: 10px 0; color: var(--primary-color); font-size: 1.5rem; }
        .header-section p { color: #666; margin-top: 5px; }

        .btn-back {
            display: inline-block;
            color: #666;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }
        .btn-back:hover { color: var(--primary-color); text-decoration: underline; }

        /* === WORKSHOP LISTA STÍLUS === */
        .workshop-item {
            display: flex;
            align-items: center; /* Függőleges középre igazítás */
            background-color: #fff;
            border: 1px solid #eee;
            padding: 15px;
            margin-bottom: 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .workshop-item:hover {
            border-color: var(--primary-color);
            background-color: #f1f8e9;
            transform: translateX(5px);
        }

        /* Checkbox testreszabása */
        .workshop-item input[type="checkbox"] {
            width: 20px;
            height: 20px;
            accent-color: var(--primary-color); /* Zöld pipa */
            margin-right: 15px;
            cursor: pointer;
        }

        .workshop-info strong { display: block; font-size: 1rem; color: var(--text-dark); }
        .workshop-info span { display: block; font-size: 0.85rem; color: #7f8c8d; margin-top: 2px; }

        /* === GOMBOK === */
        .btn-submit {
            background-color: var(--primary-color);
            color: white;
            padding: 15px;
            width: 100%;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            margin-top: 20px;
            transition: background 0.3s;
        }
        .btn-submit:hover { background-color: var(--primary-hover); }

        /* === VESZÉLY ZÓNA (UNREGISTER) === */
        .danger-zone {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px dashed #ffcdd2;
            text-align: center;
        }

        .btn-danger-outline {
            display: inline-block;
            color: var(--danger-color);
            border: 2px solid var(--danger-color);
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            margin-top: 10px;
            transition: 0.2s;
        }
        .btn-danger-outline:hover {
            background-color: #ffebee;
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
        
        <a href="index.php?page=event_detail&id=<?php echo $event['id']; ?>" class="btn-back">
            &larr; Back to Event Details
        </a>

        <div class="form-card">
            
            <div class="header-section">
                <h1>Registration</h1>
                <p>Event: <strong><?php echo htmlspecialchars($event['title']); ?></strong></p>
            </div>

            <form method="POST">
                
                <h3 style="font-size: 1rem; color: #555; margin-bottom: 15px;">Select Workshops</h3>

                <?php if (empty($workshops)): ?>
                    <div style="text-align: center; padding: 20px; background: #fafafa; border-radius: 8px; color: #777;">
                        <p>No specific workshops available.</p>
                        <p><i>Click "Confirm Registration" to register for the main event.</i></p>
                    </div>
                <?php else: ?>
                    
                    <div class="workshop-list">
                        <?php foreach ($workshops as $w): ?>
                            <label class="workshop-item">
                                <input type="checkbox" name="workshops[]" value="<?php echo $w['id']; ?>"
                                <?php if (in_array($w['id'], $myWorkshopIds)) echo "checked"; ?>> 
                                
                                <div class="workshop-info">
                                    <strong><?php echo htmlspecialchars($w['title']); ?></strong>
                                    <span>⏰ <?php echo $w['start_time']; ?> - <?php echo $w['end_time']; ?></span>
                                </div>
                            </label>
                        <?php endforeach; ?>
                    </div>

                <?php endif; ?>

                <button type="submit" class="btn-submit">
                    ✅ Confirm Registration
                </button>

            </form>

            <?php if ($eventModel->isRegistered($userId, $eventId)): ?>
                <div class="danger-zone">
                    <p style="color: #666; font-size: 0.9rem;">Changed your mind?</p>
                    <a href="index.php?page=unregister_event&id=<?php echo $event['id']; ?>" 
                       class="btn-danger-outline"
                       onclick="return confirm('Are you sure you want to cancel your registration?');">
                        🚫 Cancel Registration
                    </a>
                </div>
            <?php endif; ?>

        </div>
    </div>

</body>
</html>