<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/businessmanager/notifications.css">    <title>Hotel Gallery</title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/hotel/x-icon" href="<?php echo URLROOT; ?>/images/hotel/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<nav class="left-menu">
    <div class="user-profile">
        <img src="<?php echo URLROOT; ?>/images/hotel/wikum.jpg" alt="User Profile Photo">
        <span class="user-name"><?=$_SESSION['user_fname']?></span>
    </div>

    <div class="search-bar">
        <form action="#" method="GET">
            <input type="text" placeholder="Find a Setting">
            <button type="submit">Search</button>
        </form>
    </div>

    <ul>
        <li><a href="<?php echo URLROOT; ?>businessmanager/index" class="nav-button  "><i class='bx bxs-dashboard bx-sm'></i> Overview</a></li>
        <li><a href="<?php echo URLROOT; ?>businessmanager/bookings"class="nav-button"><i class='bx bxs-book bx-sm'></i> Bookings</a></li>
        <li><a href="<?php echo URLROOT; ?>businessmanager/packages" class="nav-button"><i class='bx bxs-package bx-sm'></i></i> Packages</a></li>
        <li><a href="<?php echo URLROOT; ?>businessmanager/reports" class="nav-button"><i class='bx bxs-report bx-sm'></i> Reports</a></li>
        <li><a href="<?php echo URLROOT; ?>businessmanager/financialmanagement" class="nav-button"><i class='bx bx-line-chart bx-sm'></i> Financial Management</a></li>
        <li><a href="<?php echo URLROOT; ?>businessmanager/notifications" class="nav-button active"><i class='bx bx-bell bx-sm bx-fw'></i>Notifications</a></li>
        <li><a href="<?php echo URLROOT; ?>businessmanager/settings" class="nav-button"><i class='bx bxs-cog bx-sm'></i> Settings</a></li>
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
        <h1>Notifications</h1>
    </div>

    <div class="dashboard-sub-content">
        <div class="top-boxes">
            <!-- Small Image Boxes -->
            <div class="img-box">
                <img src="<?php echo URLROOT; ?>/images/hotel/dashboard.jpg" alt="hotel Image">
            </div>


            <!-- Total Bookings Box -->
            <div class="box">
                <h2>Total Bookings</h2>
                <p>120</p>
            </div>

            <!-- Ongoing Bookings Box -->
            <div class="box">
                <h2>Ongoing Bookings</h2>
                <p>35</p>
            </div>

            <!-- Customers Box -->
            <div class="box">
                <h2>Total Customers</h2>
                <p>10</p>
            </div>
        </div>
    </div>

    <div class="notifications-content">
        <div class="notification-item">
            <img src="<?php echo URLROOT; ?>public/images/hotel/wikum.jpg" alt="Sender Image" class="sender-image">
            <div class="notification-text-container">
                <span class="sender-name">Wikum Preethika</span>
                <span class="notification-date">5 minutes ago</span>
                <p class="notification-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam hendrerit velit eu turpis vulputate, a cursus dui sagittis.</p>
                <button class="mark-as-read-btn">Mark as Read</button>
            </div>
            <div class="read-status-dot read"></div>
        </div>

        <div class="notification-item">
            <img src="<?php echo URLROOT; ?>public/images/hotel/wikum.jpg" alt="Sender Image" class="sender-image">
            <div class="notification-text-container">
                <span class="sender-name">Wikum Preethika</span>
                <span class="notification-date">5 minutes ago</span>
                <p class="notification-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam hendrerit velit eu turpis vulputate, a cursus dui sagittis.</p>
                <button class="mark-as-read-btn">Mark as Read</button>
            </div>
            <div class="read-status-dot unread"></div>
        </div>

    </div>

</main>
</body>
</html>
