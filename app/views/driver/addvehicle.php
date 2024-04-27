<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/settingssub.css">
    <script src="<?php echo URLROOT; ?>/public/js/hotel/popup.js"></script>
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/popup.css">
    <title><?php echo SITENAME ?></title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/hotel/x-icon" href="<?php echo URLROOT; ?>/images/hotel/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <nav class="left-menu">
        <div class="user-profile">
        <img src="<?php echo URLROOT; ?>/images/<?php echo $data['profileimage']->profile_picture ?>" alt="User Profile Photo">
            <span class="user-name">Wikum Preethika</span>
        </div>
        
        <div class="search-bar">
            <form action="#" method="GET">
                <input type="text" placeholder="Find a Setting">
                <button type="submit">Search</button>
            </form>
        </div>
        
        <ul>
            <li><a href="<?php echo URLROOT; ?>driver/index"><i class='bx bxs-dashboard bx-sm'></i> Overview</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/calender"><i class='bx bxs-book bx-sm'></i> Availabily Calender</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/bookings"><i class='bx bxs-package bx-sm'></i></i> Bookings</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/vehicle"><i class='bx bxs-car bx-sm'></i> Vehicle Informaion </a></li>
            <li><a href="<?php echo URLROOT; ?>driver/earings"><i class='bx bx-money-withdraw bx-sm'></i>Earings and Payments</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/notification"><i class='bx bxs-bell bx-sm'></i>Notification</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/reviews"><i class='bx bxs-star bx-sm bx-fw'></i> Reviews</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/settings" class="active"><i class='bx bxs-cog bx-sm'></i> Settings</a></li>
            <li> <a href="#" class="nav-button active" onclick="confirmLogout(event)"><i class='bx bxs-log-out bx-sm bx-fw'></i> Logout</a></li>
        </ul>
        
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
                <div class="room-box">
                    <h3>Vehicle Number</h3>
                    <p>Description of the vehicle goes here.</p>
                    <div class="icons">
                        <a href="<?php echo URLROOT; ?>driver/addvehiclesedit"><i class='bx bx-edit'></i></a> 
                        <a href="#"><i class='bx bx-trash'></i></a> 
                    </div>
                </div>

                <div class="room-box">
                <h3>Vehicle Number</h3>
                    <p>Description of the vehicle goes here.</p>
                    <div class="icons">
                        <a href="<?php echo URLROOT; ?>driver/addvehiclesedit"><i class='bx bx-edit'></i></a> 
                        <a href="#"><i class='bx bx-trash'></i></a> 
                    </div>
                </div>

                <div class="add-room">
                <!-- <a href="<?php echo URLROOT; ?>driver/vehiclereg"></a> -->
                    <a href="<?php echo URLROOT; ?>driver/vehiclereg" class="add-room-link">
                        <i class='bx bx-plus-circle' id="add-icon"></i>  
                        <p>Add New Vehicle</p>
                    </a>
                </div>
            
            </div>
           
            
        </div>
    </main>
</body>
</html>
