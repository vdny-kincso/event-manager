<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Manager</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* === ALAPBEÁLLÍTÁSOK === */
        :root {
            --primary-color: #2e7d32; /* Sötétzöld */
            --secondary-color: #4caf50; /* Világoszöld */
            --bg-color: #f8f9fa;
            --text-dark: #2c3e50;
            --text-light: #6c757d;
            --card-shadow: 0 4px 6px rgba(0,0,0,0.1);
            --hover-shadow: 0 10px 15px rgba(0,0,0,0.15);
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

        /* === MODERN MENÜ (NAVBAR) === */
        .navbar {
            background-color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between; /* Balra és jobbra tolja a tartalmat */
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: sticky; /* Oda ragad a tetejére görgetéskor */
            top: 0;
            z-index: 1000;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .nav-links {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .nav-links a {
            color: var(--text-dark);
            font-weight: 500;
            font-size: 0.95rem;
        }

        .nav-links a:hover { color: var(--primary-color); }

        .btn-nav {
            background-color: var(--primary-color);
            color: white !important;
            padding: 8px 20px;
            border-radius: 20px;
        }
        .btn-nav:hover { background-color: var(--secondary-color); }

        /* === HERO SZEKCIÓ (Nagy Fejléc) === */
        .hero {
            background: linear-gradient(135deg, #2e7d32 0%, #81c784 100%);
            color: white;
            text-align: center;
            padding: 60px 20px;
            margin-bottom: 40px;
        }
        
        .hero h1 { margin: 0; font-size: 2.5rem; font-weight: 800; }
        .hero p { font-size: 1.1rem; opacity: 0.9; margin-top: 10px; }

        /* === ESEMÉNYEK RÁCS (GRID) === */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .section-title {
            text-align: center;
            margin-bottom: 30px;
            font-size: 1.8rem;
            color: var(--text-dark);
        }

        .events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); /* Reszponzív oszlopok */
            gap: 25px;
            padding-bottom: 50px;
        }

        /* === ESEMÉNY KÁRTYA === */
        .event-card {
            background: white;
            border-radius: 12px;
            overflow: hidden; /* Hogy a kép sarka is kerek legyen */
            box-shadow: var(--card-shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid #eee;
            display: flex;
            flex-direction: column;
        }

        .event-card:hover {
            transform: translateY(-5px); /* Kicsit "felugrik" */
            box-shadow: var(--hover-shadow);
        }

        .card-body { padding: 20px; flex-grow: 1; }

        .event-title {
            font-size: 1.25rem;
            margin: 0 0 10px 0;
            font-weight: 700;
        }
        .event-title a { color: var(--text-dark); }
        .event-title a:hover { color: var(--primary-color); }

        .event-date {
            display: inline-block;
            background-color: #e8f5e9;
            color: var(--primary-color);
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .card-actions {
            padding: 15px 20px;
            background-color: #f8f9fa;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: flex-end; /* Jobbra igazítás */
            gap: 10px;
        }

        .btn-edit { color: #f57c00; font-weight: 600; font-size: 0.9rem; }
        .btn-delete { color: #d32f2f; font-weight: 600; font-size: 0.9rem; }
        .btn-edit:hover, .btn-delete:hover { text-decoration: underline; }

        .empty-state { text-align: center; color: var(--text-light); padding: 50px; }
    </style>
</head>
<body>

    <nav class="navbar">
        <a href="index.php" class="logo">📅 EventManager</a>
        
        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="index.php?page=calendar">Calendar</a>

            <?php if (isset($_SESSION['user_id'])) : ?>
                <span style="color: var(--text-light); font-size: 0.9rem;">Hi, <strong><?php echo $_SESSION['user_name']; ?></strong></span>
                <a href="index.php?page=create_event" class="btn-nav">Create Event +</a>
                <a href="index.php?page=logout" style="color: #d32f2f;">Log out</a>
            <?php else: ?>
                <a href="index.php?page=login" class="btn-nav">Sign In / Register</a>
            <?php endif; ?>
        </div>
    </nav>

    <header class="hero">
        <div class="container">
            <h1>Welcome to Event Manager</h1>
            <p>Discover amazing events or create your own today.</p>
        </div>
    </header>

    <main class="container">
        <h2 class="section-title">Upcoming Events</h2>

        <?php if (empty($events)): ?>
            <div class="empty-state">
                <h3>No events found 😔</h3>
                <p>Be the first to create one!</p>
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <a href="index.php?page=create_event" class="btn-nav">Create Event</a>
                <?php endif; ?>
            </div>
        <?php else: ?>
            
            <div class="events-grid">
                <?php foreach ($events as $event): ?>
                    <article class="event-card">
                        <div class="card-body">
                            <div class="event-date">
                                📅 <?php echo date('M d, Y', strtotime($event['start_date'])); ?>
                            </div>
                            <h3 class="event-title">
                                <a href="index.php?page=event_detail&id=<?php echo $event['id']; ?>">
                                    <?php echo htmlspecialchars($event['title']); ?>
                                </a>
                            </h3>
                            </div>

                        <?php if (isset($_SESSION['user_id']) && 
                                isset($event['organizer_id']) && 
                                $_SESSION['user_id'] == $event['organizer_id']): 
                        ?>
                            <div class="card-actions">
                                <a href="index.php?page=edit_event&id=<?php echo $event['id']; ?>" class="btn-edit">
                                    ✏️ Edit
                                </a>
                                <a href="index.php?page=delete_event&id=<?php echo $event['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure?')">
                                    🗑️ Delete
                                </a>
                            </div>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>

        <?php endif; ?>
    </main>

</body>
</html>