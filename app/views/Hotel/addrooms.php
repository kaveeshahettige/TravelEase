<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/settingssub.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/navigation.css">
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
$activePage = 'hotel/settings'; // Set the active page dynamically based on your logic
include 'navigation.php';
?>
<main>
    <div class="logo-container">
        <img src="<?php echo URLROOT; ?>/images/hotel/TravelEase.png" alt="TravelEase Logo">
        <span class="logo-text">TravelEase</span>
    </div>

    <div class="dashboard-content">
        <div><h1>Settings</h1> </div>
    </div>

    <div class="main-content">
        <div class="room-container">
            <?php
            $activeRooms = $data["activeRooms"];
            foreach ($activeRooms as $hotel_rooms):
//                var_dump($hotel_rooms);
                ?>
                <div class="room-box" >
                    <div onclick="openPopup(<?php echo $hotel_rooms->room_id; ?>)">
                    <h2><?php echo ucfirst($hotel_rooms->registration_number); ?></h2>
                    <h3><?php echo ucfirst($hotel_rooms->roomType);?> -<?php echo ucfirst($hotel_rooms->price);?></h3>
                    <p><?php echo ucfirst($hotel_rooms->description);?></p>
                    </div>
                    <div class="icons">
                        <a href="<?php echo URLROOT; ?>Hotel/hotelupdaterooms/<?= $hotel_rooms->room_id ?>"><i class='bx bx-edit'></i></a>
                        <a href="#" onclick="confirmDelete(event,<?= $hotel_rooms->room_id ?>)"><i class='bx bx-trash'></i></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <script src="<?php echo URLROOT; ?>/public/js/hotel/popup.js"></script>

        <div class="add-room">
            <a href="<?php echo URLROOT; ?>Hotel/hoteladdroomsedit" class="add-room-link">
                <i class='bx bx-plus-circle' id="add-icon"></i>
                <p>Add New Room</p>
            </a>
        </div>

    </div>

    <<!-- Popup -->
    <div id="room-popup" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closePopup()">&times;</span>
            <h2>Room Details</h2>
            <p><strong>Room Type:</strong> <?php echo $hotel_rooms->roomType; ?></p>
            <p><strong>Number of Beds:</strong> <?php echo $hotel_rooms->numOfBeds; ?></p>
            <p><strong>Price:</strong> <?php echo $hotel_rooms->price; ?></p>
            <p><strong>Description:</strong> <?php echo $hotel_rooms->description; ?></p>
            <p><strong>Pet Policy:</strong> <?php echo $hotel_rooms->petPolicy; ?></p>
            <!-- Displaying the image -->
            <img id="profile-picture" src="<?= isset($hotel_rooms->roomImages2) ? '../public/images/' . $hotel_rooms->roomImages2 : '../Images/wikum.jpg'; ?>" alt="Room Image">
            <?php
            var_dump($hotel_rooms->roomImages3);
            ?>
        </div>
    </div>

    <script>
        // Get the modal
        var modal = document.getElementById('room-popup');

        // Function to open the popup
        function openPopup(room_id) {
            // Here, you can use the room_id parameter to fetch additional data or perform any other actions
            modal.style.display = "block";
            console.log("Room ID: " + room_id);
        }

        // Function to close the popup
        function closePopup() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>



</main>
</body>
</html>
