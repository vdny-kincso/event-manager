<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registration</title>
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            margin-top: 50px; 
            background-color: #f4f4f4; 
        }
    </style>
</head>

    <p>
        <a href="index.php?page=event_detail&id=<?php echo $event['id']; ?>">← Back to Event Detail</a>
    </p>

    <h1>Registration for: <?php echo htmlspecialchars($event['title']); ?></h1>
    <p>Select the workshops you want to attend:</p>

    <form method="POST" style="border: 1px solid #ccc; padding: 20px; border-radius: 5px;">
        
        <?php if (empty($workshops)): ?>
            <p><i>No workshops available. Click Save to register for the main event.</i></p>
        <?php else: ?>

            <?php foreach ($workshops as $w): ?>
                <div style="margin-bottom: 10px;">
                    <label style="cursor: pointer;">
                        <input type="checkbox" name="workshops[]" value="<?php echo $w['id']; ?>"
                        <?php if (in_array($w['id'], $myWorkshopIds)) echo "checked"; ?>
                        > 
                        
                        <strong><?php echo htmlspecialchars($w['title']); ?></strong> 
                        (<?php echo $w['start_time']; ?> - <?php echo $w['end_time']; ?>)
                    </label>
                </div>
            <?php endforeach; ?>

        <?php endif; ?>

        <br>
        <button type="submit" style="background: green; color: white; padding: 10px 20px; cursor: pointer; font-size: 16px;">
            Save / Update Registration
        </button>

    </form>

    <?php if ($eventModel->isRegistered($userId, $eventId)): ?>
        
        <div style="margin-top: 30px; border-top: 1px solid #eee; padding-top: 20px;">
            <p>Do you want to cancel your registration completely?</p>
            
            <a href="index.php?page=unregister_event&id=<?php echo $event['id']; ?>" 
               style="color: red; font-weight: bold; text-decoration: none; border: 1px solid red; padding: 10px;">
               Unregister from Event
            </a>
        </div>

    <?php endif; ?>

</body>
</html>