<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/bookings.css">    
    <title>TravelEase</title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/hotel/x-icon" href="<?php echo URLROOT; ?>/images/hotel/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <nav class="left-menu">
        <div class="user-profile">
        <img src="<?php echo empty($data['profile_picture']) ? URLROOT.'images/user.jpg' : URLROOT.'images1/'.$data['profile_picture']; ?>" alt="Profile Picture" alt="User Profile Photo">
            <span class="user-name"><?php echo $data['fname']."   ".$data['lname']?></span>
        </div>
        
        <div class="search-bar">
            <form action="#" method="GET">
                <input type="text" placeholder="Find a Setting">
                <button type="submit">Search</button>
            </form>
        </div>
        
        <ul>
            <li><a href="<?php echo URLROOT; ?>travelerDashboard/index/<?php echo $_SESSION['user_id']?>" class="nav-button "><i class='bx bxs-dashboard bx-sm'></i>Overview</a></li>
            <li><a href="<?php echo URLROOT; ?>travelerDashboard/bookings/<?php echo $_SESSION['user_id']?>" class="nav-button active"><i class='bx bxs-book bx-sm bx-fw'></i> Bookings</a></li>
            <li><a href="<?php echo URLROOT; ?>travelerDashboard/payments/<?php echo $_SESSION['user_id']?>" class="nav-button"><i class='bx bxs-package bx-sm' class="nav-button "></i></i> Payments</a></li>
            <li><a href="<?php echo URLROOT; ?>travelerDashboard/notifications/<?php echo $_SESSION['user_id']?>" class="nav-button"><i class='bx bxs-report bx-sm' class="nav-button "></i> Notifications</a></li>
            <li><a href="<?php echo URLROOT; ?>travelerDashboard/previoustrips/<?php echo $_SESSION['user_id']?>" class="nav-button"><i class='bx bx-line-chart bx-sm' class="nav-button "></i> Previous Trips</a></li>
            <li><a href="<?php echo URLROOT?>travelerDashboard/settings/<?php echo $_SESSION['user_id']?>" class="nav-button "><i class='bx bxs-cog bx-sm'></i> Settings</a></li>
           
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
                <p><?php  echo $data['noOfBooking']?></p>
            </div>
        
            <!-- Ongoing Bookings Box
            <div class="box">
                <h2>Ongoing Bookings</h2>
                <p>35</p>
            </div>
        
            <!-- Customers Box -->
            <!--<div class="box">
                <h2>Total Customers</h2>
                <p>10</p>
            </div> -->
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
                    <th>Booking ID</th>
                    <th>Service Provider</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                   
                </tr>
                </thead>
                <tbody>


                <?php
$count = 1;

if (!empty($data['mybooking']) && is_array($data['mybooking'])) {
    foreach ($data['mybooking'] as $booking ) {
        echo '<tr class="t-row">';
        echo '<td>' . $count . '</td>';
        echo '<td>' . $booking->booking_id . '</td>';
        echo '<td>' .$booking->fname.' '.$booking->lname.'</td>';
        echo '<td>' . $booking->startDate . '</td>';
        echo '<td>' . $booking->endDate . '</td>';
        echo '</tr>';
        $count++;
    }
} else {
    echo '<tr><td colspan="4">No data available</td></tr>';
}
?>

                </tbody>
            </table>
        </div>


        <div class="more-content">
            <button class="next-page-btn">More Bookings <i class='bx bx-chevron-right'></i></button>
        </div>

    </main>

    <div class="popup" id="popup">
        <div class="popup-content">
            <span class="close" onclick="closePopup()">&times;</span>
            <!-- Add details about the booking here -->
            <h2>Booking Details</h2>
            <p id="guestName">Guest Name: John Doe</p>
            <p id="checkInDate">Check-in Date: 2023-09-01</p>
            <p id="roomType">Room Type: Single Room</p>
            <!-- Add more details as needed -->
        </div>
    </div>
    <script src= "<?php echo URLROOT?>/public/js/hotel/bookings.js"></script>
</body>
</html>