<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--    <link rel="stylesheet" href="--><?php //echo URLROOT
                                            ?><!--/css/hotel/settingssub.css">-->
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/hotel/navigation.css">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/hotel/availablerooms.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/popup.css">
    <title>Hotel - Add Rooms</title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/hotel/x-icon" href="<?php echo URLROOT; ?>/images/hotel/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
<?php
$userData= $data['basicInfo']['userData'];
?>
    <?php
    $activePage = 'hotel/calender'; // Set the active page dynamically based on your logic
    include 'navigation.php';
    ?>
    <main>
        <div class="logo-container">
            <img src="<?php echo URLROOT; ?>/images/hotel/TravelEase.png" alt="TravelEase Logo">
            <span class="logo-text">TravelEase</span>
        </div>

        <div class="dashboard-content">
            <div>
                <h1>Availability</h1>
            </div>
        </div>

        <div class="main-content">
            <div class="room-content">
                <h2>Rooms Details</h2>
                <?php echo "Selected Date: " . $data['date']; ?>
                <table class="room-table">
                    <thead>
                        <tr>
                            <th>Room ID</th>
                            <th>Room Type</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $roomData = $data["roomData"];
                        $date = $data['date'];
                        $unavailableRooms = $data['unavailableRooms'];
                        foreach ($roomData as $hotel_rooms) :
                        ?>
                            <tr>
                                <td><?php echo ucfirst($hotel_rooms->registration_number); ?></td>
                                <td><?php echo ucfirst($hotel_rooms->roomType); ?></td>

                                <td>
                                    <?php
                                    if (in_array($hotel_rooms->room_id, $unavailableRooms)) {
                                        echo "Unavailable";
                                    } else {
                                        echo "Available";
                                    }
                                    ?>

                                </td>

                                <td>
                                    <button class="btn btn-make-unavailable" onclick="updateRoomPopup(<?php echo $hotel_rooms->room_id; ?>, '<?php echo $data['date']; ?>')">
                                        <i class='bx bx-check'></i>
                                    </button>
<!--                                    deleteroomStatus-->
                                    <button class="btn btn-make-available" onclick="deleteRoomPopup(<?php echo $hotel_rooms->room_id; ?>, '<?php echo $data['date']; ?>')">
                                        <i class='bx bx-trash'></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>
</body>
<script src="<?php echo URLROOT ?>/public/js/hotel/calender.js"></script>

</html>