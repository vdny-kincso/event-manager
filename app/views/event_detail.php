<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($event['title']); ?></title>
    <style>
    body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            margin-top: 50px; 
            background-color: #f4f4f4; 
        }
    </style>

</head>

    <p>
        <a href="index.php">Back to Events</a>
    </p>

    <h1><?php echo htmlspecialchars($event['title']); ?></h1>
    <p>
        Start: <?php echo htmlspecialchars($event['start_date']); ?><br>
        End: <?php echo htmlspecialchars($event['end_date']); ?>
    </p>

    <h3>Description:</h3>
    <p><?php echo nl2br(htmlspecialchars($event['description'])); ?></p>

    <?php if (!empty($event['hero_image'])): ?>
        <p>
            <img src="uploads/<?php echo htmlspecialchars($event['hero_image']); ?>" alt="Event Image" style="max-width: 400px;">
        </p>
    <?php endif; ?>

    <hr>

    <h3>Workshops:</h3>
    
    <?php if (!empty($workshops)): ?>
        <ul>
            <?php foreach ($workshops as $workshop): ?>
                <li>
                    <strong><?php echo htmlspecialchars($workshop['title']); ?></strong>
                    <br>
                    Time: <?php echo $workshop['start_time']; ?> - <?php echo $workshop['end_time']; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No workshops.</p>
    <?php endif; ?>

    <?php if (isset($_SESSION['user_id']) && isset($event['organizer_id']) && $_SESSION['user_id'] == $event['organizer_id']): ?>
        <hr>
        <h3>Organizer Actions:</h3>
        <ul>
            <li><a href="index.php?page=add_workshop&event_id=<?php echo $event['id']; ?>">Add Workshop</a></li>
            <li><a href="index.php?page=edit_event&id=<?php echo $event['id']; ?>">Edit Event</a></li>
            <li><a href="index.php?page=delete_event&id=<?php echo $event['id']; ?>">Delete Event</a></li>
        </ul>
    <?php endif; ?>

    <hr>

    <h3>Registration</h3>

    <?php if (!isset($_SESSION['user_id'])): ?>
        <p>Please <a href="index.php?page=login">log in</a> to register.</p>
    
    <?php elseif (isset($event['organizer_id']) && $_SESSION['user_id'] == $event['organizer_id']): ?>
        <p>You are the organizer.</p>

    <?php else: ?>
        <p>
            <a href="index.php?page=event_register_page&id=<?php echo $event['id']; ?>">
                <?php if ($isRegistered): ?>
                    Edit Registration and workshops
                <?php else: ?>
                    Register for Event
                <?php endif; ?>
            </a>
        </p>

        <?php if ($isRegistered): ?>
            <p>Status: You are registered.</p>
        <?php endif; ?>

    <?php endif; ?>

</body>
</html>