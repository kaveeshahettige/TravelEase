<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
    <title>TravelEase</title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/hotel/x-icon" href="<?php echo URLROOT; ?>/images/hotel/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/bookings.css">    
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
            <li><a href="<?php echo URLROOT; ?>travelerDashboard/payments/<?php echo $_SESSION['user_id']?>" class="nav-button"><i class='bx bxs-package bx-sm' class="nav-button "></i></i> Payments</a></li>
            <li><a href="<?php echo URLROOT; ?>travelerDashboard/notifications/<?php echo $_SESSION['user_id']?>" class="nav-button"><i class='bx bxs-report bx-sm' class="nav-button "></i> Notifications</a></li>
            <li><a href="<?php echo URLROOT; ?>travelerDashboard/previoustrips/<?php echo $_SESSION['user_id']?>" class="nav-button"><i class='bx bx-line-chart bx-sm' class="nav-button "></i> Previous Trips</a></li>
            <li><a href="<?php echo URLROOT?>travelerDashboard/cart/<?php echo $_SESSION['user_id']?>" class="nav-button active"><i class='bx bx-cart bx-sm'></i> Cart</a></li>
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
            <h1>Cart bookings</h1>
        </div>

        <div class="dashboard-sub-content">
        <div class="top-boxes">
            <!-- Small Image Boxes -->
            <div class="img-box">
                <img src="<?php echo URLROOT; ?>/images/hotel/dashboard.jpg" alt="hotel Image">
            </div>
           

            <!-- Total Bookings Box -->
            <div class="box">
                <h2>Total Carts</h2>
                <p><?php  echo $data['noofCarts']?></p>
            </div>
            <div class="box">
                <h2>Total Items</h2>
                <p><?php  echo $data['noofCartItems']?></p>
            </div>
        </div>
        </div>
    <!-- <?php echo var_dump($data['cartDetails'])?> -->
        <div class="search-content">
        <div class="booking-search">
            <input type="text" id="booking-search" placeholder="Search for Bookings">
            <button onclick="filterBookings()">
                <i class="bx bx-search"></i> <!-- Using the Boxicons search icon -->
            </button>
        </div>
        </div>

        <div class="table-content">
            <h2>Cart Details</h2>
            <table class="booking-table">
                <thead>
                <tr>
                    <th>No</th>
                    <!-- <th>Booking ID</th> -->
                    <th>Cart</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Booking Date</th>
                    <th></th>
                    <th></th>

                   
                </tr>
                </thead>
                <tbody>

<!-- <?php echo var_dump($data['mybooking'])?> -->
<?php
$count = 1; // Initialize the count

if (!empty($data['cartDetails']) && is_array($data['cartDetails'])) {
    $previousBookingId = null; // Initialize previous booking ID

    foreach ($data['cartDetails'] as $booking) {
        // Check if it's the same booking ID as the previous one
        if ($booking->cartbooking_id !== $previousBookingId) {
            // If it's a new booking ID, start a new row
            if ($previousBookingId !== null) {
                // Close the previous row if it's not the first booking
                echo '<td>' . $names . '</td>'; // Display accumulated names
                // Display other data only once
                echo '<td>' . $booking->startDate . '</td>';
                echo '<td>' . $booking->endDate . '</td>';
                echo '<td>' . date('Y-m-d', strtotime($booking->bookingDate)) . '</td>';
                echo '<td><button class="viewbooking" onclick="openPopup($booking->cartbooking_id)">View</button></td>';
                echo '<td><button class="cancel-button" onclick="cancelBooking($booking->cartbooking_id)"><i class="bx bx-x-circle"></i>Remove</button></td>';
                echo '</tr>';
                $count++; // Increment the count for the new row
            }
            // Start a new row for the current booking
            echo '<tr class="t-row">';
            echo '<td>' . $count . '</td>'; // Display count only once
            // Initialize names variable for the current booking
            $names = $booking->fname . ' ' . $booking->lname;
        } else {
            // If it's the same booking ID, accumulate names with commas
            $names .= ', ' . $booking->fname . ' ' . $booking->lname;
        }
        // Update the previous booking ID
        $previousBookingId = $booking->cartbooking_id;
    }
    // After the loop, display the last row
    echo '<td>' . $names . '</td>'; // Display accumulated names
    // Display other data for the last row
    echo '<td>' . $booking->startDate . '</td>';
    echo '<td>' . $booking->endDate . '</td>';
    echo '<td>' . date('Y-m-d', strtotime($booking->bookingDate)) . '</td>';
    echo '<td><button class="viewbooking" onclick="openPopup()">View</button></td>';
    echo '<td><button class="cancel-button" onclick="cancelBooking()"><i class="bx bx-x-circle"></i>Remove</button></td>';
    echo '</tr>';
    $count++; // Increment the count for the last row
} else {
    // Display a message if there are no cart details
    echo '<tr><td colspan="7">No data available</td></tr>';
}
?>



                </tbody>
            </table>
        </div>


        <div class="more-content">
            <button class="next-page-btn">More Bookings <i class='bx bx-chevron-right'></i></button>
        </div>

    </main>

    <div id="myModal" class="modal1">
  <div class="modal1-content">
    <span class="close1">&times;</span>
    <iframe id="popupFrame" width="100%" height="100%"></iframe>
  </div>
</div>

   <!-- Hidden modal for cancellation confirmation -->
<div id="confirmationModal" class="modal2">
  <div class="modal2-content">
    <span class="close2">&times;</span>
    <p>Are you sure you want to cancel this booking?</p>
    <button id="confirmCancelBtn">Yes, Cancel Booking</button>
    <button id="denyCancelBtn">No,Close</button>
    <div id="confirmationMessage"></div>
  </div>
</div>
<iframe id="cancelFrame" style="display: none;"></iframe>
</body>

</html>

