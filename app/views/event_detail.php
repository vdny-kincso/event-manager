<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($event['title']); ?> - Details</title>
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
            line-height: 1.6;
        }

        a { text-decoration: none; transition: 0.3s; }
        ul { list-style: none; padding: 0; margin: 0; }

        /* === NAVBAR === */
        .navbar {
            background-color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
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

        /* === FŐ GRID ELRENDEZÉS === */
        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 2fr 1fr; /* Balra 2/3, Jobbra 1/3 */
            gap: 30px;
        }

        /* Ha mobilon nézzük, legyen 1 oszlop */
        @media (max-width: 768px) {
            .container { grid-template-columns: 1fr; }
        }

        /* === BAL OSZLOP (TARTALOM) === */
        .main-content {
            background: white;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
        }

        .hero-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
            display: block;
            background-color: #eee;
        }

        .content-body { padding: 30px; }

        .event-title {
            margin: 0 0 10px 0;
            font-size: 2rem;
            color: var(--primary-color);
        }

        .event-description {
            color: var(--text-dark);
            margin-bottom: 30px;
            white-space: pre-line; /* Hogy megmaradjanak a sortörések */
        }

        .section-header {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 15px;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
        }

        /* === WORKSHOP KÁRTYÁK === */
        .workshop-item {
            background: #f9f9f9;
            border-left: 4px solid var(--primary-color);
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 0 8px 8px 0;
            transition: transform 0.2s;
        }
        .workshop-item:hover { transform: translateX(5px); }

        .workshop-title { font-weight: 700; font-size: 1.1rem; display: block; }
        .workshop-time { color: var(--text-light); font-size: 0.9rem; margin-top: 5px; display: block; }

        /* === JOBB OSZLOP (SIDEBAR) === */
        .sidebar { display: flex; flex-direction: column; gap: 20px; }

        .info-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
        }

        .date-box {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            gap: 10px;
        }
        .icon { font-size: 1.5rem; }
        
        .status-badge {
            display: inline-block;
            background: #e8f5e9;
            color: var(--primary-color);
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 700;
            margin-bottom: 15px;
        }

        /* === GOMBOK === */
        .btn-action {
            display: block;
            width: 100%;
            text-align: center;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        .btn-primary { background: var(--primary-color); color: white; }
        .btn-primary:hover { background: var(--primary-hover); }

        .btn-outline { border: 2px solid var(--primary-color); color: var(--primary-color); }
        .btn-outline:hover { background: #e8f5e9; }

        .btn-danger { background: white; border: 1px solid #ffcdd2; color: #d32f2f; }
        .btn-danger:hover { background: #ffebee; }

        .organizer-menu h4 { margin-top: 0; color: #666; font-size: 0.9rem; text-transform: uppercase; }

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
            <?php else: ?>
                <a href="index.php?page=login" class="btn-nav">Sign In</a>
            <?php endif; ?>
        </div>
    </nav>

    <div class="container">
        
        <div class="main-content">
            
            <?php if (!empty($event['hero_image'])): ?>
                <img src="<?= BASE_URL ?>/uploads/<?= htmlspecialchars($event['hero_image']); ?>" alt="Event Image" class="hero-image">
            <?php else: ?>
                <div style="height: 100px; background: linear-gradient(to right, #e0e0e0, #f5f5f5);"></div>
            <?php endif; ?>

            <div class="content-body">
                <a href="index.php" style="color: #999; font-size: 0.9rem;">&larr; Back to all events</a>
                
                <h1 class="event-title"><?= htmlspecialchars($event['title']); ?></h1>
                
                <div class="section-header">About this event</div>
                <div class="event-description">
                    <?= nl2br(htmlspecialchars($event['description'])); ?>
                </div>

                <div class="section-header">Workshops & Agenda</div>
                <?php if (!empty($workshops)): ?>
                    <div class="workshop-list">
                        <?php foreach ($workshops as $workshop): ?>
                            <div class="workshop-item">
                                <span class="workshop-title"><?= htmlspecialchars($workshop['title']); ?></span>
                                <span class="workshop-time">⏰ <?= $workshop['start_time']; ?> - <?= $workshop['end_time']; ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p style="color: #999; font-style: italic;">No specific workshops announced yet.</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="sidebar">
            
            <div class="info-card">
                
                <div class="date-box">
                    <span class="icon">📅</span>
                    <div>
                        <strong style="display:block; color:#555;">Start Date</strong>
                        <span><?= htmlspecialchars($event['start_date']); ?></span>
                    </div>
                </div>
                <div class="date-box">
                    <span class="icon">🏁</span>
                    <div>
                        <strong style="display:block; color:#555;">End Date</strong>
                        <span><?= htmlspecialchars($event['end_date']); ?></span>
                    </div>
                </div>

                <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">

                <h3 style="margin-top:0;">Registration</h3>

                <?php if (!isset($_SESSION['user_id'])): ?>
                    <p style="color: #666; font-size: 0.9rem;">Join the community to register for this event.</p>
                    <a href="index.php?page=login" class="btn-action btn-primary">Log in to Register</a>

                <?php elseif (isset($event['organizer_id']) && $_SESSION['user_id'] == $event['organizer_id']): ?>
                    <div class="status-badge">👑 You are the Organizer</div>
                    <p style="font-size:0.9rem; color:#666;">Manage your event below.</p>

                <?php else: ?>
                    <?php if ($isRegistered): ?>
                        <div class="status-badge">✅ You are registered!</div>
                        <a href="index.php?page=event_register_page&id=<?= $event['id']; ?>" class="btn-action btn-outline">
                            Manage My Registration
                        </a>
                    <?php else: ?>
                        <a href="index.php?page=event_register_page&id=<?= $event['id']; ?>" class="btn-action btn-primary">
                            Register Now
                        </a>
                    <?php endif; ?>
                <?php endif; ?>

            </div>

            <?php if (isset($_SESSION['user_id']) && isset($event['organizer_id']) && $_SESSION['user_id'] == $event['organizer_id']): ?>
                <div class="info-card organizer-menu">
                    <h4>Organizer Tools</h4>
                    
                    <a href="index.php?page=add_workshop&event_id=<?= $event['id']; ?>" class="btn-action btn-outline">
                        + Add Workshop
                    </a>
                    <a href="index.php?page=edit_event&id=<?= $event['id']; ?>" class="btn-action btn-outline" style="color:#f57c00; border-color:#f57c00;">
                        ✏️ Edit Event Details
                    </a>
                    <a href="index.php?page=delete_event&id=<?= $event['id']; ?>" class="btn-action btn-danger" onclick="return confirm('Are you sure you want to delete this event? This cannot be undone.');">
                        🗑️ Delete Event
                    </a>
                </div>
            <?php endif; ?>

        </div>
    </div>

</body>
</html>