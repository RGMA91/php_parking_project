<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Booking Menu</h1>
    <div id="menu"></div>
    <form method="post" action="/booking_handler.php">

        <?php
        require_once __DIR__ . '/../src/controller/ParkingController.php';

        $parkingController = new ParkingController();
        $parkingList = $parkingController->getParkingList();

        if (!empty($parkingList)) {
            echo '<label for="parking_select">Select Parking:</label>';
            echo '<select id="parking_select" name="parking_id">';
            foreach ($parkingList as $parking) {
                echo '<option value="' . htmlspecialchars($parking->id) . '">' . htmlspecialchars($parking->name) . '</option>';
            }
            echo '</select>';
        } else {
            echo '<p>No parking locations available.</p>';
        }
        ?>

        <label for="entry-time">Enter after:</label>
        <input type="datetime-local" id="meeting-time" name="meeting-time" value="2025-08-29T19:30"
            min="2025-08-29T00:00" max="2026-08-29T00:00" />

        <label for="entry-time">Exit before:</label>
        <input type="datetime-local" id="meeting-time" name="meeting-time" value="2025-08-30T19:30"
            min="2025-08-29T00:00" max="2026-08-29T00:00" />

        <button type="submit">Book</button>
    </form>
    <script src="/js/functions.js"></script>
</body>

</html>