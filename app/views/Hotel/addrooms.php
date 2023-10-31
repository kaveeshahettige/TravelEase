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
            <img src="<?php echo URLROOT; ?>/images/hotel/wikum.jpg" alt="User Profile Photo">
            <span class="user-name">Wikum Preethika</span>
        </div>
        
        <div class="search-bar">
            <form action="#" method="GET">
                <input type="text" placeholder="Find a Setting">
                <button type="submit">Search</button>
            </form>
        </div>
        
            
        <ul>
            <li><a href="<?php echo URLROOT; ?>hotel/index" class="nav-button active"><i class='bx bxs-info-circle bx-tada-hover bx-sm bx-fw'></i> Dashboard</a></li>
            <li><a href="<?php echo URLROOT; ?>hotel/bookings" class="nav-button "><i class='bx bxs-book bx-sm bx-fw'></i> Bookings</a></li>
            <li><a href="<?php echo URLROOT; ?>hotel/calender" class="nav-button "><i class='bx bxs-calendar bx-sm bx-fw'></i> Availability</a></li>
            <li><a href="<?php echo URLROOT; ?>hotel/gallery" class="nav-button "><i class='bx bx-images bx-sm bx-fw'></i> Gallery</a></li>
            <li><a href="<?php echo URLROOT; ?>hotel/revenue" class="nav-button "><i class='bx bxs-wallet bx-sm bx-fw'></i> Revenue</a></li>
            <li><a href="<?php echo URLROOT; ?>hotel/reviews" class="nav-button "><i class='bx bxs-star bx-sm bx-fw'></i> Reviews</a></li>
            <li><a href="<?php echo URLROOT; ?>hotel/settings" class="nav-button "><i class='bx bxs-cog bx-sm bx-fw'></i> Settings</a></li>
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
                    <h3>Room Name</h3>
                    <p>Description of the room goes here.</p>
                    <div class="icons">
                        <a href="<?php echo URLROOT; ?>hotel/indexaddroomsedit"><i class='bx bx-edit'></i></a> 
                        <a href="#"><i class='bx bx-trash'></i></a> 
                    </div>
                </div>

                <div class="room-box">
                    <h3>Room Name</h3>
                    <p>Description of the room goes here.</p>
                    <div class="icons">
                        <a href="<?php echo URLROOT; ?>hotel/indexaddroomsedit""><i class='bx bx-edit'></i></a> 
                        <a href="#"><i class='bx bx-trash'></i></a> 
                    </div>
                </div>

                <div class="room-box">
                    <h3>Room Name</h3>
                    <p>Description of the room goes here.</p>
                    <div class="icons">
                        <a href="<?php echo URLROOT; ?>hotel/indexaddroomsedit""><i class='bx bx-edit'></i></a> 
                        <a href="#"><i class='bx bx-trash'></i></a> 
                    </div>
                </div>

                <div class="room-box">
                    <h3>Room Name</h3>
                    <p>Description of the room goes here.</p>
                    <div class="icons">
                        <a href="<?php echo URLROOT; ?>hotel/indexaddroomsedit""><i class='bx bx-edit'></i></a> 
                        <a href="#"><i class='bx bx-trash'></i></a> 
                    </div>
                </div>

                <div class="room-box">
                    <h3>Room Name</h3>
                    <p>Description of the room goes here.</p>
                    <div class="icons">
                        <a href="<?php echo URLROOT; ?>hotel/indexaddroomsedit""><i class='bx bx-edit'></i></a> 
                        <a href="#"><i class='bx bx-trash'></i></a> 
                    </div>
                </div>

                <div class="add-room">
                    <a href="<?php echo URLROOT; ?>hotel/indexaddroomsedit"" class="add-room-link">
                        <i class='bx bx-plus-circle' id="add-icon"></i>  
                        <p>Add New Room</p>
                    </a>
                </div>
            
            </div>
           
            
        </div>
    </main>
</body>
</html>
