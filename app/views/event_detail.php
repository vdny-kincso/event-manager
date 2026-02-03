<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($event['title']); ?></title>
    <style>
        body { font-family: sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }
        .back-link { display: inline-block; margin-bottom: 20px; text-decoration: none; color: #333; }
        .hero { background: #eee; padding: 20px; border-radius: 8px; margin-bottom: 20px; }
        .meta { color: #666; font-style: italic; margin-bottom: 20px; }
        .actions { margin-top: 30px; border-top: 1px solid #ddd; padding-top: 20px; }
        .btn-edit { color: orange; text-decoration: none; font-weight: bold; margin-right: 15px; }
        .btn-delete { color: red; text-decoration: none; font-weight: bold; }
    </style>
</head>

<body>

    <a href="index.php" class="back-link">← Back to Events</a>

    <div class="hero">
        <h1><?php echo htmlspecialchars($event['title']); ?></h1>
        <p class="meta">
            Start: <?php echo htmlspecialchars($event['start_date']); ?> | 
            End: <?php echo htmlspecialchars($event['end_date']); ?>
        </p>
    </div>

    <div class="description">
        <h3>Description:</h3>
        <p><?php echo nl2br(htmlspecialchars($event['description'])); ?></p>
    </div>

    <?php if (!empty($event['hero_image'])): ?>
        <div style="margin-bottom: 20px;">
            <img src="uploads/<?php echo htmlspecialchars($event['hero_image']); ?>" 
                alt="Event Image" 
                style="max-width: 100%; height: auto; border-radius: 8px;">
        </div>
    <?php endif; ?>

    <hr>
    <h3>Workshops:</h3>
    
    <?php if (!empty($workshops)): ?>
        <ul style="list-style: none; padding: 0;">
            <?php foreach ($workshops as $workshop): ?>
                <li style="background: #f9f9f9; border: 1px solid #ddd; padding: 10px; margin-bottom: 10px; border-radius: 5px;">
                    
                    <strong style="font-size: 1.1em;">
                        <?php echo htmlspecialchars($workshop['title']); ?>
                    </strong>
                    <br>
                    
                    <span style="color: #666; font-size: 0.9em;">
                        <?php echo htmlspecialchars($workshop['start_time']); ?> 
                        - 
                        <?php echo htmlspecialchars($workshop['end_time']); ?>
                    </span>

                </li>
            <?php endforeach; ?>
        </ul>

    <?php else: ?>
        <p><i>No workshops yet.</i></p>
    <?php endif; ?>

    <?php if (isset($_SESSION['user_id']) && 
              isset($event['organizer_id']) && 
              $_SESSION['user_id'] == $event['organizer_id']): ?>
        
        <div style="margin-top: 10px;">
            <a href="index.php?page=add_workshop&event_id=<?php echo $event['id']; ?>" 
               style="background: #145d1e; color: white; padding: 8px 15px; text-decoration: none; border-radius: 4px;">
               + Add Workshop
            </a>
        </div>

    <?php endif; ?>

    <?php if (isset($_SESSION['user_id']) && 
              isset($event['organizer_id']) && 
              $_SESSION['user_id'] == $event['organizer_id']): ?>
        
        <div class="actions">
            <p>You are the owner of this event.</p>
            <a href="index.php?page=edit_event&id=<?php echo $event['id']; ?>" class="btn-edit">[Edit Event]</a>
            <a href="index.php?page=delete_event&id=<?php echo $event['id']; ?>" class="btn-delete">[Delete Event]</a>
        </div>

    <?php endif; ?>

    <hr>
    <h3>Registration</h3>

    <?php if (!isset($_SESSION['user_id'])): ?>
        <p>Please <a href="index.php?page=login">log in</a> to register for this event.</p>
    
    <?php elseif (isset($event['organizer_id']) && $_SESSION['user_id'] == $event['organizer_id']): ?>
        <p><i>You are the organizer of this event.</i></p>

   <?php elseif ($isRegistered): ?>
        <p style="color: green; font-weight: bold;">You are registered!</p>
        
        <a href="index.php?page=unregister_event&id=<?php echo $event['id']; ?>" 
           style="background: red; color: white; padding: 10px; text-decoration: none;">
           Cancel Registration
        </a>

    <?php else: ?>
        <a href="index.php?page=register_event&id=<?php echo $event['id']; ?>" 
           style="background: green; color: white; padding: 10px; text-decoration: none;">
           Register Now
        </a>

    <?php endif; ?>

    </body>
</html>
