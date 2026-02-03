<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create new event</title>
    <style>
        body { font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input, textarea { width: 100%; padding: 8px; margin-top: 5px; }
        button { margin-top: 20px; padding: 10px 20px; background: green; color: white; border: none; cursor: pointer; }
        .nav { margin-bottom: 20px; }

        #workshop-template { display: none; }
    </style>
</head>
<body>

    <div class="nav">
        <a href="index.php">Back to the landing page</a>
    </div>

    <h1>Create the new event:</h1>

    <form action="index.php?page=create_event" method="POST" enctype="multipart/form-data">
        <label>Name of the new event:</label>
        <input type="text" name="title" required>

        <label>Description:</label>
        <textarea name="description" rows="5"></textarea>

        <label>Start date:</label>
        <input type="date" name="start_date" required>

        <label>End date:</label>
        <input type="date" name="end_date" required>

        <label>Image:</label>
        <input type="file" name="hero_image" accept="image/*">
        <br><br>

        <input type="hidden" name="organizer_id" value="1">
        <hr>

     <h3>2. Workshops</h3>
        <div id="workshop-list">
            </div>

        <button type="button" onclick="addWorkshop()" style="background: green; color: white; padding: 5px 15px; cursor: pointer; margin-top: 10px;">
            + Add Workshop
        </button>

        <br><br><hr>

        <button type="submit" style="background: #158752; color: white; padding: 15px 30px; font-size: 16px; cursor: pointer;">
            Create Event & Workshops
        </button>
    </form>

    <div id="workshop-template">
        <div class="workshop-item">
            <h4>Workshop</h4>
            
            <label>Workshop Title:</label>
            <input type="text" name="workshops[INDEX][title]" required>

            <label>Start Date:</label>
            <input type="date" name="workshops[INDEX][start_time]" required>

            <label>End Date:</label>
            <input type="date" name="workshops[INDEX][end_time]" required>
        </div>
    </div>

    <script>
        function addWorkshop() {
            // 1. Megnézzük, hányadik sornál tartunk (hogy tudjuk a sorszámot: 0, 1, 2...)
            var list = document.getElementById('workshop-list');
            var index = list.children.length;

            // 2. Kivesszük a sablon tartalmát
            var template = document.getElementById('workshop-template').innerHTML;

            // 3. Kicseréljük az 'INDEX' szót a számra (pl. workshops[0][title])
            // A /INDEX/g azt jelenti: mindenhol cserélje, ne csak az elsőnél
            var newHtml = template.replace(/INDEX/g, index);

            // 4. Beszúrjuk a listába
            list.insertAdjacentHTML('beforeend', newHtml);
        }

        // Indításkor rakjon ki egyet automatikusan
        addWorkshop();
    </script>

</body>
</html>