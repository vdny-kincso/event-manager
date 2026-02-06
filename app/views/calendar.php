<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Calendar</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* === ALAP VÁLTOZÓK (Ugyanaz, mint a Landing oldalon) === */
        :root {
            --primary-color: #2e7d32;
            --secondary-color: #4caf50;
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

        /* === NAVBAR (MENÜ) === */
        .navbar {
            background-color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 30px;
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
        .btn-nav:hover { background-color: var(--secondary-color); }

        /* === NAPTÁR KONTÉNER === */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px 50px 20px;
        }

        /* === FEJLÉC ÉS LAPOZÓK === */
        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
        }

        .calendar-header h2 {
            margin: 0;
            font-size: 1.8rem;
            color: var(--text-dark);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-control {
            background-color: #e8f5e9;
            color: var(--primary-color);
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
        }
        .btn-control:hover {
            background-color: var(--primary-color);
            color: white;
        }

        /* === TÁBLÁZAT STÍLUS === */
        .calendar-wrapper {
            background: white;
            border-radius: 12px;
            overflow: hidden; /* Lekerekítés a sarkokon */
            box-shadow: var(--card-shadow);
        }

        table { 
            width: 100%; 
            border-collapse: collapse; 
            table-layout: fixed; 
        }

        /* Napok nevei (Hétfő, Kedd...) */
        thead th {
            background-color: var(--primary-color);
            color: white;
            padding: 15px;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 1px;
        }

        /* Cella stílus */
        td { 
            border: 1px solid #f0f0f0; 
            height: 140px; /* Magasabb cellák */
            vertical-align: top; 
            padding: 10px;
            transition: background 0.2s;
        }

        td:hover { background-color: #fafafa; }

        td.empty { background-color: #f9f9f9; /* Zebracsíkos hatás az üres helyeken */ }

        .day-number {
            font-size: 1.1rem;
            font-weight: 700;
            color: #ccc;
            margin-bottom: 5px;
            display: block;
        }
        
        /* Ha mai nap van (opcionális stílus) */
        /* td.today .day-number { color: var(--primary-color); } */

        /* === ESEMÉNY "CHIP" === */
        .event-item {
            display: block;
            background-color: #e8f5e9; /* Halvány zöld háttér */
            color: var(--primary-color); /* Sötét zöld szöveg */
            padding: 4px 8px;
            margin-bottom: 4px;
            border-radius: 4px;
            font-size: 0.85rem;
            font-weight: 600;
            border-left: 3px solid var(--primary-color); /* Bal oldali csík */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis; /* Ha hosszú, ... lesz a vége */
            transition: transform 0.2s;
        }

        .event-item:hover {
            transform: translateX(3px); /* Kicsit elmozdul jobbra */
            background-color: var(--primary-color);
            color: white;
        }

    </style>
</head>
<body>

    <nav class="navbar">
        <a href="index.php" class="logo">📅 EventManager</a>
        
        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="index.php?page=calendar" style="color: var(--primary-color);">Calendar</a> <?php if (isset($_SESSION['user_id'])) : ?>
                <span style="color: #6c757d; font-size: 0.9rem;">Hi, <strong><?php echo $_SESSION['user_name']; ?></strong></span>
                <a href="index.php?page=create_event" class="btn-nav">Create Event +</a>
                <a href="index.php?page=logout" style="color: #d32f2f;">Log out</a>
            <?php else: ?>
                <a href="index.php?page=login" class="btn-nav">Sign In</a>
            <?php endif; ?>
        </div>
    </nav>

    <div class="container">

        <div class="calendar-header">
            <a href="index.php?page=calendar&year=<?= $prevYear ?>&month=<?= $prevMonth ?>" class="btn-control">
                &laquo; Previous
            </a>

            <h2><?= $monthName ?></h2>

            <a href="index.php?page=calendar&year=<?= $nextYear ?>&month=<?= $nextMonth ?>" class="btn-control">
                Next &raquo;
            </a>
        </div>

        <div class="calendar-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th><th>Sun</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <?php
                        // 1. Üres cellák az elején
                        $emptyCells = $dayOfWeekFirstDay - 1; 
                        for ($i = 0; $i < $emptyCells; $i++) {
                            echo '<td class="empty"></td>';
                        }

                        $currentDayOfWeek = $dayOfWeekFirstDay; 

                        // 2. Napok generálása
                        for ($day = 1; $day <= $daysInMonth; $day++): 
                        ?>
                            <td>
                                <span class="day-number"><?= $day ?></span>
                                
                                <?php if (isset($calendarData[$day])): ?>
                                    <?php foreach ($calendarData[$day] as $event): ?>
                                        <a href="index.php?page=event_detail&id=<?= $event['id'] ?>" class="event-item" title="<?= htmlspecialchars($event['title']) ?>">
                                            <?= htmlspecialchars($event['title']) ?>
                                        </a>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </td>

                            <?php
                            // 3. Sortörés vasárnapnál
                            if ($currentDayOfWeek == 7) {
                                echo '</tr><tr>';
                                $currentDayOfWeek = 1; 
                            } else {
                                $currentDayOfWeek++;
                            }
                            ?>
                        
                        <?php endfor; ?>

                        <?php
                        // 4. Üres cellák a végén
                        if ($currentDayOfWeek != 1) { 
                            $remainingCells = 8 - $currentDayOfWeek;
                            for ($i = 0; $i < $remainingCells; $i++) {
                                echo '<td class="empty"></td>';
                            }
                        }
                        ?>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <p style="text-align: center; color: #999; margin-top: 20px; font-size: 0.9rem;">
            Click on an event to see details.
        </p>

    </div>

</body>
</html>