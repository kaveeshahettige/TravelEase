<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/travelerDashboard/bookings.css">    
    <title>TravelEase</title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/hotel/x-icon" href="<?php echo URLROOT; ?>/images/hotel/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo URLROOT?>js/travelerDashboard/script.js"></script>
</head>
<body>
    <nav class="left-menu">
        <div class="user-profile">
        <img style="cursor: pointer;" src="<?php echo empty($data['profile_picture']) ? URLROOT.'images/user.jpg' : URLROOT.'images1/'.$data['profile_picture']; ?>" alt="Profile Picture" alt="User Profile Photo" onclick="gotoHome()"> 
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
            <li><a href="<?php echo URLROOT; ?>travelerDashboard/bookings/<?php echo $_SESSION['user_id']?>" class="nav-button "><i class='bx bxs-book bx-sm bx-fw'></i> Bookings</a></li>
            <li><a href="<?php echo URLROOT; ?>travelerDashboard/payments/<?php echo $_SESSION['user_id']?>" class="nav-button active"><i class='bx bxs-package bx-sm' class="nav-button "></i></i> Payments</a></li>
            <li><a href="<?php echo URLROOT; ?>travelerDashboard/notifications/<?php echo $_SESSION['user_id']?>" class="nav-button"><i class='bx bxs-report bx-sm' class="nav-button "></i> Notifications</a></li>
            <li><a href="<?php echo URLROOT; ?>travelerDashboard/previoustrips/<?php echo $_SESSION['user_id']?>" class="nav-button"><i class='bx bx-line-chart bx-sm' class="nav-button "></i> Previous Trips</a></li>
            <li><a href="<?php echo URLROOT?>travelerDashboard/cart/<?php echo $_SESSION['user_id']?>" class="nav-button"><i class='bx bx-cart bx-sm'></i> Wishlist</a></li>
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
            <h1>Payments</h1>
        </div>

        <div class="dashboard-sub-content">
        <div class="top-boxes">
            <!-- Small Image Boxes -->
            <div class="img-box">
                <img src="<?php echo URLROOT; ?>/images/hotel/dashboard.jpg" alt="hotel Image">
            </div>
           

            <!-- Total Bookings Box -->
            <div class="box">
                <h2>Total Payments</h2>
                <p><?php  echo $data['noofPayments']?></p>
            </div>
            <div class="box">
                <h2>MonthlyTotal Payments</h2>
                <p><?php  echo $data['noofPaymentsMonth']?></p>
            </div>
            <div class="box">
                <h2>Monthly Payment Amount</h2>
                <p><?php  echo $data['amountofPaymentsMonth']?>.00 &nbsp LKR</p>
            </div>
        
           
        </div>
        </div>
        <!-- <?php echo var_dump($data['payments']) ?> -->

        <div class="search-content">
        <div class="booking-search">
            <input type="text" id="booking-search" placeholder="Search for Boookings">
            <button onclick="filterBookings()">
                <i class="bx bx-search"></i> <!-- Using the Boxicons search icon -->
            </button>
        </div>
        </div>

        <div class="card-container">
    <?php
    $count = 1;
    if (!empty($data['payments']) && is_array($data['payments'])) {
        foreach ($data['payments'] as $payment) {
            echo '<div class="card" style="background-color: #fff8e9;">';
            echo '<div class="card-header">';
            echo '<h3>' . $count . '</h3>';
            echo '</div>';
            echo '<div class="card-body">';
            // echo '<p><strong>Payment ID:</strong> ' . $payment->payment_id . '</p>';
            // echo '<p><strong>Booking ID:</strong> ' . $payment->booking_id . '</p>';
            echo '<p><strong>Booking:</strong> ' . $payment->fname . '</p>';
            echo '<p><strong>Amount (LKR):</strong> ' . $payment->amount . '.00</p>'; // Assuming all payments for the same booking have the same amount
            echo '<p><strong>Date of Payment:</strong> ' . $payment->payment_date . '</p>'; // Assuming all payments for the same booking have the same booking date

            // Add additional card content or buttons as needed

            echo '</div>'; // card-body
            echo '</div>'; // card
            $count++;
        }
    } else {
        echo '<div class="card">';
        echo '<div class="card-body">';
        echo '<p>No payments available</p>';
        echo '</div>'; // card-body
        echo '</div>'; // card
    }
    ?>
</div>



        <!-- <div class="more-content">
            <button class="next-page-btn">More <i class='bx bx-chevron-right'></i></button>
        </div> -->

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
