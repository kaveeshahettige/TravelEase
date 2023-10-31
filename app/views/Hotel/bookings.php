<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/bookings.css">    <title>Hotel Bookings</title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/hotel/x-icon" href="<?php echo URLROOT; ?>/images/hotel/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <nav class="left-menu">
        <div class="user-profile">
            <img src="<?php echo URLROOT; ?>/images/hotel/wikum.jpg" alt="User Profile Photo">
            <span class="user-name">Hotel Name</span>
        </div>
        
        <div class="search-bar">
            <form action="#" method="GET">
                <input type="text" placeholder="Find a Setting">
                <button type="submit">Search</button>
            </form>
        </div>
        
        <ul>
            <li><a href="<?php echo URLROOT; ?>hotel/index" class="nav-button "><i class='bx bxs-info-circle bx-tada-hover bx-sm bx-fw'></i> Dashboard</a></li>
            <li><a href="<?php echo URLROOT; ?>hotel/bookings" class="nav-button active"><i class='bx bxs-book bx-sm bx-fw'></i> Bookings</a></li>
            <li><a href="<?php echo URLROOT; ?>hotel/calender" class="nav-button "><i class='bx bxs-calendar bx-sm bx-fw'></i> Availability</a></li>
            <li><a href="<?php echo URLROOT; ?>hotel/gallery" class="nav-button "><i class='bx bx-images bx-sm bx-fw'></i> Gallery</a></li>
            <li><a href="<?php echo URLROOT; ?>hotel/revenue" class="nav-button "><i class='bx bxs-wallet bx-sm bx-fw'></i> Revenue</a></li>
            <li><a href="<?php echo URLROOT; ?>hotel/reviews" class="nav-button "><i class='bx bxs-star bx-sm bx-fw'></i> Reviews</a></li>
            <li><a href="<?php echo URLROOT; ?>hotel/settings" class="nav-button "><i class='bx bxs-cog bx-sm bx-fw'></i> Settings</a></li>
        </ul>

        <div class="logout">
            <a href="#" class="nav-button active"><i class='bx bxs-log-out bx-sm bx-fw'></i>  Logout</a>
        </div>
        
        
    </nav>
    <main>
        <div class="logo-container">
            <img src="<?php echo URLROOT; ?>/images/hotel/TravelEase.png" alt="TravelEase Logo">
            <span class="logo-text">TravelEase</span>
        </div>
        
        <div class="dashboard-content">
            <h1>Bookings</h1>
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

        <div class="search-content">
        <div class="booking-search">
            <input type="text" id="booking-search" placeholder="Search for Boookings">
            <button onclick="filterBookings()">
                <i class="bx bx-search"></i> <!-- Using the Boxicons search icon -->
            </button>
        </div>
        </div>
       
        <div class="table-content">
        <h2>Booking Details</h2>
            <table class="booking-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Guest Name</th>
                        <th>Check-in Date</th>
                        <th>Room Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                        
                    <tr>
                        <td>1</td>
                        <td>Wikum Preethika</td>
                        <td>2023-10-06</td>
                        <td>Single Room</td>
                        <td><button class="view-button">View</button></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Kaveesha Hettige</td>
                        <td>2023-10-17</td>
                        <td>Double Room</td>
                        <td><button class="view-button">View</button></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Dilanga</td>
                        <td>2023-10-17</td>
                        <td>Double Room</td>
                        <td><button class="view-button">View</button></td>
                    </tr>   
                </tbody>
            </table>
        </div>

        <div class="more-content">
            <button class="next-page-btn">More Bookings <i class='bx bx-chevron-right'></i></button>
        </div>

    </main>
</body>
</html>
