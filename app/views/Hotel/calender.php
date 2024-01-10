<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/calender.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/calenders.css">
    <title>Hotel Availability</title>
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
            <li><a href="<?php echo URLROOT; ?>hotel/index" class="nav-button "><i class='bx bxs-info-circle bx-tada-hover bx-sm bx-fw'></i> Dashboard</a></li>
            <li><a href="<?php echo URLROOT; ?>hotel/bookings" class="nav-button "><i class='bx bxs-book bx-sm bx-fw'></i> Bookings</a></li>
            <li><a href="<?php echo URLROOT; ?>hotel/calender" class="nav-button active"><i class='bx bxs-calendar bx-sm bx-fw'></i> Availability</a></li>
            <li><a href="<?php echo URLROOT; ?>hotel/gallery" class="nav-button "><i class='bx bx-images bx-sm bx-fw'></i> Notifications</a></li>
            <li><a href="<?php echo URLROOT; ?>hotel/revenue" class="nav-button "><i class='bx bxs-wallet bx-sm bx-fw'></i> Revenue</a></li>
            <li><a href="<?php echo URLROOT; ?>hotel/reviews" class="nav-button "><i class='bx bxs-star bx-sm bx-fw'></i> Reviews</a></li>
            <li><a href="<?php echo URLROOT; ?>hotel/settings" class="nav-button "><i class='bx bxs-cog bx-sm bx-fw'></i> Settings</a></li>
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
            <h1>Availability</h1>
        </div>

        <div class="dashboard-sub-content">
        <div class="top-boxes">
            <!-- Small Image Boxes -->
            <div class="img-box">
                <img src="<?php echo URLROOT; ?>/images/hotel/dashboard.jpg" alt="hotel Image">
            </div>
           

            <!-- Total Bookings Box -->
            <div class="box">
                <h2>Total Rooms Allocated</h2>
                <p>10</p>
            </div>
        
            <!-- Ongoing Bookings Box -->
            <div class="box">
                <h2>Booked Rooms</h2>
                <p>5</p>
            </div>
        
            <!-- Customers Box -->
            <div class="box">
                <h2>Available Rooms</h2>
                <p>5</p>
            </div>
        </div>
        </div>

        <div class ="dashboard-sub-content">
            <div class="calendar-container">
                <div class="calendar-content">
                    <div class="calendar-header">
                        <button onclick="navigateMonth(-1)">←</button>
                        <span id="current-month-year"></span>
                        <button onclick="navigateMonth(1)">→</button>
                    </div>
                    <div id="calendar-days" class="calendar-days"></div>
                </div>
                <div class="availability-content" id="availability-content">
                    <div id="selected-date"></div>
                    <div id="availability-info"></div>
                    <div class="calendar-buttons">
                        <button onclick="handleButtonClick('Add')">Make Unavailable</button>
                        <button onclick="handleButtonClick('Delete')">Delete Unavailable</button>
                    </div>
                </div>
            </div>
            <script src= "<?php echo URLROOT?>/public/js/hotel/calender.js"></script>
        </div>

    </main>
</body>
</html>
