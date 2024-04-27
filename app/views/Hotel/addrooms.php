<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/settingssub.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/navigation.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/popup.css">
    <script src="<?php echo URLROOT; ?>/public/js/hotel/popup.js"></script>
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



        <div class="add-room">
            <a href="<?php echo URLROOT; ?>Hotel/hoteladdroomsedit" class="add-room-link">
                <i class='bx bx-plus-circle' id="add-icon"></i>
                <p>Add New Room</p>
            </a>
        </div>

    </div>

    <!-- Popup -->
    <div class="popup" id="popup">
        <div class="popup-content">
            <div class="close-btn" onclick="closePopup()">&times;</div>
            <div class="popup-text">
                <h2>Room Details</h2>
                <div class="popup-details">
                    <img id="room-image" src="" alt="Room Image">
                    <h3>Room Number: <span id="room-number"></span></h3>
                    <h3>Room Type: <span id="room-type"></span></h3>
                    <h3>Price: <span id="room-price"></span></h3>
                    <h3>Description: <span id="room-description"></span></h3>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openPopup(room_id) {
            // Fetch room details based on room ID
            var roomDetails = <?php echo json_encode($data["activeRooms"]); ?>.find(room => room.room_id === room_id);

            // Populate the popup with room details

            document.getElementById("room-number").innerText = roomDetails.registration_number;
            document.getElementById("room-type").innerText = roomDetails.roomType;
            document.getElementById("room-price").innerText = roomDetails.price;
            document.getElementById("room-description").innerText = roomDetails.description;

            // Set the image source
            document.getElementById("room-image").src = "<?php echo URLROOT; ?>/public/images/" + roomDetails.image;
            // Display the popup
            document.getElementById("popup").style.display = "block";
        }

        function closePopup() {
            // Hide the popup
            document.getElementById("popup").style.display = "none";
        }
    </script>

    <style>
        /* Popup Styles */
        .popup {
            display: none; /* Hide popup by default */
            position: fixed;
            top: 0;
            left: 0;
            background-color: rgba(0, 0, 0, 0.5);
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .popup-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 10px; /* Increased border-radius for a more rounded appearance */
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            max-width: 600px;
            width: 100%;
            text-align: center; /* Center-align the content */
        }

        /* Style for the room image */
        #room-image {
            max-width: 100%; /* Ensure the image doesn't exceed its container */
            height: 50%; /* Maintain aspect ratio */
            display: block; /* Ensure the image is displayed as a block element */
            margin-top: 10px; /* Add some space between the image and other details */
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            font-size: 20px;
        }
    </style>


</main>
</body>
</html>
