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
    <form method="post" action="/booking/create">
        <?php
        require_once __DIR__ . '/../src/controller/ParkingController.php';

        $parkingController = new ParkingController();
        $parkingList = $parkingController->getParkingList();

        if (!empty($parkingList)) {
            echo '<label for="parking-select">Select Parking:</label>';
            echo '<select id="parking-select" name="parking-id">';
            foreach ($parkingList as $parking) {
                echo '<option value="' . htmlspecialchars($parking->id) . '">' . htmlspecialchars($parking->name) . '</option>';
            }
            echo '</select>';
        } else {
            echo '<p>No parking locations available.</p>';
        }
        ?>

        <label for="access-time">Enter after:</label>
        <input type="datetime-local" id="access-time" name="access-time" value="2025-08-29T19:30"
            min="2025-08-29T00:00" max="2026-08-29T00:00" />

        <label for="exit-time">Exit before:</label>
        <input type="datetime-local" id="exit-time" name="exit-time" value="2025-08-30T19:30"
            min="2025-08-29T00:00" max="2026-08-29T00:00" />

        <!-- JWT hidden input -->
        <input type="hidden" id="jwt-token" name="jwt-token" value="" />

        <button type="submit">Book</button>
    </form>
    <script>
        // Get JWT from localStorage and set it in the hidden input
        document.getElementById('jwt-token').value = localStorage.getItem('jwt') || '';
    </script>
    <script src="/js/functions.js"></script>
</body>

</html>