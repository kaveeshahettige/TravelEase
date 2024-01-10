<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/settingssub.css">    <title>Hotel - Add Rooms</title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/hotel/x-icon" href="<?php echo URLROOT; ?>/images/hotel/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<nav class="left-menu">
    <div class="user-profile">
        <img src="<?= isset($_SESSION['user_profile_picture']) ? $_SESSION['user_profile_picture'] : '../Images/wikum.jpg'; ?> " alt="User Profile Photo">
        <span class="user-name"><?=$_SESSION['user_fname']?></span>
    </div>

    <div class="search-bar">
        <form action="#" method="GET">
            <input type="text" placeholder="Find a Setting">
            <button type="submit">Search</button>
        </form>
    </div>


    <ul>
        <li><a href="<?php echo URLROOT; ?>hotel/index" class="nav-button"><i class='bx bxs-info-circle bx-tada-hover bx-sm bx-fw'></i> Dashboard</a></li>
        <li><a href="<?php echo URLROOT; ?>hotel/bookings" class="nav-button "><i class='bx bxs-book bx-sm bx-fw'></i> Bookings</a></li>
        <li><a href="<?php echo URLROOT; ?>hotel/calender" class="nav-button "><i class='bx bxs-calendar bx-sm bx-fw'></i> Availability</a></li>
        <li><a href="<?php echo URLROOT; ?>hotel/gallery" class="nav-button "><i class='bx bx-images bx-sm bx-fw'></i> Notifications</a></li>
        <li><a href="<?php echo URLROOT; ?>hotel/revenue" class="nav-button "><i class='bx bxs-wallet bx-sm bx-fw'></i> Revenue</a></li>
        <li><a href="<?php echo URLROOT; ?>hotel/reviews" class="nav-button "><i class='bx bxs-star bx-sm bx-fw'></i> Reviews</a></li>
        <li><a href="<?php echo URLROOT; ?>hotel/settings" class="nav-button  active "><i class='bx bxs-cog bx-sm bx-fw'></i> Settings</a></li>
    </ul>

    <div class="logout">
        <a href="<?php echo URLROOT?>users/logout" class="nav-button active"><i class='bx bxs-log-out bx-sm bx-fw'></i>  Logout</a>
    </div>


</nav>
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
                    <h2><?php echo ucfirst($hotel_rooms->roomType);?></h2>
                    <h3>Price: <?php echo ucfirst($hotel_rooms->price);?></h4>
                    <p><?php echo ucfirst($hotel_rooms->roomDescription);?></p>
                    <div class="icons">
                        <a href="<?php echo URLROOT; ?>Hotel/hotelupdaterooms/<?= $hotel_rooms->room_id ?>"><i class='bx bx-edit'></i></a>
                        <a href="<?php echo URLROOT; ?>Hotel/deleterooms/<?= $hotel_rooms->room_id ?>"><i class='bx bx-trash'></i></a>
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

</main>
</body>
</html>
