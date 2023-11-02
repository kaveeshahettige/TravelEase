<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT;?>/css/packages/available.css">
    <title>Packages Availability</title>
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT;?>/images/packages/TravelEase_logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
</head>
<body>

    <nav class="left-menu">
        <div class="user-profile">
            <img src="<?php echo URLROOT; ?>\images\packages\availability\Uththara.jpg" alt="User Profile Photo">
            <span class="user-name">Uththara Samadhi</span>
        </div>
        
        <div class="search-bar">
            <form action="#" method="GET">
                <input type="text" placeholder="Find a Setting">
                <button type="submit">Search</button>
            </form>
        </div>
        
        <ul>
            <li><a href="../Dashboard/hotel-dashboard.html" class="nav-button "><i class='bx bxs-dashboard bx-sm'></i> Dashboard</a></li>
            <li><a href="../Availability/Packages-availability.html" class="nav-button active"><i class='bx bxs-calendar bx-sm bx-fw'></i> Availability</a></li>
            <li><a href="../Bookings/Packages-bookings.html" class="nav-button"><i class= 'bx bxs-book bx-sm bx-fw'></i>Bookings</a></li>
            <li><a href="../Gallery/Packages-gallery.html" class="nav-button"><i class='bx bx-images bx-sm bx-fw'></i> Gallery</a></li>
            <li><a href="../Revenue/hotel-revenue.html" class="nav-button"><i class='bx bxs-wallet bx-sm bx-fw'></i> Revenue</a></li>
            <li><a href="../Packages/Packages.html" class="nav-button"><i class= 'bx bxs-package bx-sm'></i> Packagess</a></li>
            <li><a href="../Review/Packages-review.html" class="nav-button"><i class= 'bx bxs-star bx-sm bx-fw'></i> Review</a></li>
            <li><a href="../Settings/Packages-settings.html" class="nav-button"><i class='bx bxs-cog bx-sm bx-fw'></i> Settings</a></li>
        </ul>
        
        <div class="logout">
            <a href="#" class="nav-button active"><i class='bx bxs-log-out bx-sm bx-fw'></i>  Logout</a>
        </div>
    </nav>
    <main>
        <div class="logo-container">
            <img src="<?php echo URLROOT; ?>\images\TravelEase_logo.png" alt="TravelEase Logo">
            <span class="logo-text">TravelEase</span>
        </div>
        
        <div class="dashboard-content">
            <h1>Availability</h1>
        </div>

        <div class="dashboard-sub-content">
        <div class="top-boxes">
            <!-- Small Image Boxes -->
            <div class="img-box">
                <img src="<?php echo URLROOT; ?>\images\packages\availability\couple image.jpg" alt="hotel Image">
            </div>
           

            <!-- Total Bookings Box -->
            <div class="box">
                <h2>Packages registered</h2>
                <p>10</p>
            </div>
        
            <!-- Ongoing Bookings Box -->
            <div class="box">
                <h2>Booked Packages</h2>
                <p>5</p>
            </div>
        
            <!-- Customers Box -->
            <div class="box">
                <h2>Available Packages</h2>
                <p>5</p>
            </div>
        </div>

        <div class="calendar">
            <div class="calendar-header">
                <span>Sunday</span>
                <span>Monday</span>
                <span>Tuesday</span>
                <span>Wednesday</span>
                <span>Thursday</span>
                <span>Friday</span>
                <span>Saturday</span>
            </div>
            <div class="calendar-week">
                <span class="other-month">26</span>
                <span class="other-month">27</span>
                <span class="other-month">28</span>
                <span>1</span>
                <span>2</span>
                <span>3</span>
                <span>4</span>
            </div>
            <div class="calendar-week">
                <span>5</span>
                <span>6</span>
                <span>7</span>
                <span>8</span>
                <span>9</span>
                <span>10</span>
                <span>11</span>
            </div>
            </div>
        </div>            

    </main>
</body>
</html>
