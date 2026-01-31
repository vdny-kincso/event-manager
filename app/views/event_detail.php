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

    <hr>
    <h3>Workshops:</h3>
    <p><i>Workshops coming soon...</i></p>

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
