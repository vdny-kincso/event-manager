<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Event</title>
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
            max-width: 800px;
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
        h3 { border-bottom: 2px solid #eee; padding-bottom: 10px; margin-top: 30px; color: var(--text-dark); }

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
        input[type="time"],
        textarea,
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            font-family: 'Inter', sans-serif;
            box-sizing: border-box;
        }

        input:focus, textarea:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.1);
        }

        /* Két oszlopos elrendezés a dátumoknak */
        .row {
            display: flex;
            gap: 20px;
        }
        .col { flex: 1; }

        /* === WORKSHOP DOBOZ === */
        .workshop-item {
            background: #f9f9f9;
            border: 1px solid #eee;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 15px;
            position: relative;
        }
        
        .workshop-item h4 { margin-top: 0; color: #666; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px; }

        /* === GOMBOK === */
        .btn-add {
            background-color: #e8f5e9;
            color: var(--primary-color);
            border: 2px dashed var(--primary-color);
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }
        .btn-add:hover { background-color: #c8e6c9; }

        .btn-submit {
            background-color: var(--primary-color);
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            width: 100%;
            margin-top: 20px;
            transition: background 0.2s;
        }
        .btn-submit:hover { background-color: var(--primary-hover); }

        /* Rejtett template */
        #workshop-template { display: none; }

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
            <h1>Create New Event</h1>

            <form action="index.php?page=create_event" method="POST" enctype="multipart/form-data">
                
                <input type="hidden" name="organizer_id" value="<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1; ?>">

                <div class="form-group">
                    <label>Event Title</label>
                    <input type="text" name="title" required placeholder="e.g. Annual Tech Conference 2026">
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" rows="5" placeholder="What is this event about?"></textarea>
                </div>

                <div class="row">
                    <div class="col form-group">
                        <label>Start Date</label>
                        <input type="date" name="start_date" required>
                    </div>
                    <div class="col form-group">
                        <label>End Date</label>
                        <input type="date" name="end_date" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Hero Image</label>
                    <input type="file" name="hero_image" accept="image/*" style="padding: 10px; background: #fafafa;">
                </div>

                <h3>Workshops & Sessions</h3>
                <p style="color: #666; font-size: 0.9rem; margin-bottom: 15px;">Add specific sessions or workshops that happen during the event.</p>
                
                <div id="workshop-list">
                    </div>

                <button type="button" onclick="addWorkshop()" class="btn-add">
                    + Add Workshop
                </button>

                <hr style="margin-top: 30px; border: 0; border-top: 1px solid #eee;">

                <button type="submit" class="btn-submit">
                    🚀 Create Event
                </button>
            </form>
        </div>
    </div>

    <div id="workshop-template">
        <div class="workshop-item">
            <h4>Workshop Details</h4>
            
            <div class="form-group">
                <label>Workshop Title</label>
                <input type="text" name="workshops[INDEX][title]" required placeholder="e.g. Morning Yoga Session">
            </div>

            <div class="row">
                <div class="col form-group">
                    <label>Start Time</label>
                    <input type="time" name="workshops[INDEX][start_time]" required>
                </div>
                <div class="col form-group">
                    <label>End Time</label>
                    <input type="time" name="workshops[INDEX][end_time]" required>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addWorkshop() {
            // Megkeressük a listát és megszámoljuk hány elem van benne
            var list = document.getElementById('workshop-list');
            var index = list.children.length;

            // Lekérjük a sablont (template)
            var template = document.getElementById('workshop-template').innerHTML;

            // Kicseréljük az INDEX szót a sorszámra (hogy a tömb jó legyen PHP-ban)
            var newHtml = template.replace(/INDEX/g, index);

            // Beszúrjuk a lista végére
            list.insertAdjacentHTML('beforeend', newHtml);
        }

        // Opcionális: Ha azt akarod, hogy alapból legyen ott egy üres workshop, vedd ki a kommentjelet:
        // addWorkshop();
    </script>

</body>
</html>