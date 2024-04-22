<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/settingssub.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/navigation.css">
    <title>Packages - Add Packages</title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/hotel/x-icon" href="<?php echo URLROOT; ?>/images/hotel/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<?php
$userData = $data['userData'];
?>
<?php
$activePage = 'packages/settings'; // Set the active page dynamically based on your logic
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
            $roomData = $data["roomData"];
            foreach ($roomData as $hotel_rooms):
                ?>
                <div class="room-box">
                    <!--                    <h3>--><?php //echo $hotel_rooms->room_id ?><!--</h3>-->
                    <h2><?php echo ucfirst($hotel_rooms->registration_number); ?></h2>
                    <h3><?php echo ucfirst($hotel_rooms->roomType);?> -<?php echo ucfirst($hotel_rooms->price);?></h3>
                    <p><?php echo ucfirst($hotel_rooms->roomDescription);?></p>
                    <div class="icons">
                        <a href="<?php echo URLROOT; ?>Hotel/hotelupdaterooms/<?= $hotel_rooms->room_id ?>"><i class='bx bx-edit'></i></a>
                        <a href="<?php echo URLROOT; ?>Hotel/deleterooms/<?= $hotel_rooms->room_id ?>"><i class='bx bx-trash'></i></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="add-room">
            <a href="<?php echo URLROOT; ?>packages/addpackagesedit" class="add-room-link">
                <i class='bx bx-plus-circle' id="add-icon"></i>
                <p>Add New Room</p>
            </a>
        </div>

    </div>

</main>
</body>
</html>
