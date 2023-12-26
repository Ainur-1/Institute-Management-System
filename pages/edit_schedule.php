<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <script src="../js/main.js" defer></script>
    <title>My Website</title>
</head>

<body>
    <?php include '../includes/header.php'; ?>
    <main>
        <div class="edit-container">
            <h2>Редактирование расписания</h2>
            <form action="save_schedule.php" method="post">
                <label for="day">День недели:</label>
                <select name="day" id="day">
                    <?php foreach ($schedule as $day => $lessons): ?>
                        <option value="<?= $day ?>">
                            <?= $day ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="time">Время:</label>
                <input type="text" name="time" id="time" placeholder="Пример: 09:00 - 10:30">

                <label for="subject">Предмет:</label>
                <input type="text" name="subject" id="subject" placeholder="Пример: Математика">

                <input type="submit" value="Добавить">
            </form>
        </div>
    </main>
    <?php include '../includes/footer.php'; ?>
</body>

</html>