<!DOCTYPE html>
<html lang="en">
<head>
    <title>Event Calendar</title>
    <style>
        body { font-family: sans-serif; background-color: #f4f4f4; padding: 20px; }
        
        .header { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            padding: 15px; 
            border-radius: 8px; 
            margin-bottom: 20px;
        }
        
        .btn { 
            text-decoration: none; 
            background: #124d13; 
            color: white; 
            padding: 10px 15px; 
            border-radius: 5px; 
        }

        table { width: 100%; border-collapse: collapse; background: white; table-layout: fixed; }
        th {color: black; padding: 10px; }
        td { border: 1px solid #ddd; height: 100px; vertical-align: top; padding: 5px; }
        td.empty { background: #eee; } 
    </style>
</head>
<body>

    <a href="index.php" style="display:block; margin-bottom:10px;">Back to the landing page</a>

    <div class="header">
        <a href="index.php?page=calendar&year=<?= $prevYear ?>&month=<?= $prevMonth ?>" class="btn">
            Previous
        </a>

        <h2><?= $monthName ?></h2>

        <a href="index.php?page=calendar&year=<?= $nextYear ?>&month=<?= $nextMonth ?>" class="btn">
            Next
        </a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th><th>Sun</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <?php
                //if not monday is the first day
                $emptyCells = $dayOfWeekFirstDay - 1; 
                for ($i=0; $i<$emptyCells; $i++) {
                    echo '<td class="empty"></td>';
                }

                $currentDayOfWeek = $dayOfWeekFirstDay; 

                for ($day=1; $day<=$daysInMonth; $day++): 
                ?>
                    <td>
                        <strong style="color: black;"><?= $day ?></strong>
                        <?php if (isset($calendarData[$day])): ?>
                            <?php foreach ($calendarData[$day] as $event): ?>
                                <a href="index.php?page=event_detail&id=<?= $event['id'] ?>" class="event-item">
                                    <?= htmlspecialchars($event['title']) ?>
                                </a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </td>

                    <?php
                    //end of the week
                    if ($currentDayOfWeek == 7) {
                        echo '</tr><tr>';
                        $currentDayOfWeek=1; 
                    } else {
                        $currentDayOfWeek++;
                    }
                    ?>
                
                <?php endfor; ?>

                <?php
                //free at the end
                if ($currentDayOfWeek != 1) { 
                    $remainingCells = 8-$currentDayOfWeek;
                    for ($i=0; $i<$remainingCells; $i++) {
                        echo '<td class="empty"></td>';
                    }
                }
                ?>
            </tr>
        </tbody>

    </table>

</body>
</html>