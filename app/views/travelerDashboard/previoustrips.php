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
            <li><a href="<?php echo URLROOT; ?>travelerDashboard/bookings/<?php echo $_SESSION['user_id']?>" class="nav-button"><i class='bx bxs-book bx-sm bx-fw'></i> Bookings</a></li>
            <li><a href="<?php echo URLROOT; ?>travelerDashboard/payments/<?php echo $_SESSION['user_id']?>" class="nav-button"><i class='bx bxs-package bx-sm' class="nav-button "></i></i> Payments</a></li>
            <li><a href="<?php echo URLROOT; ?>travelerDashboard/notifications/<?php echo $_SESSION['user_id']?>" class="nav-button"><i class='bx bxs-report bx-sm' class="nav-button "></i> Notifications</a></li>
            <li><a href="<?php echo URLROOT; ?>travelerDashboard/previoustrips/<?php echo $_SESSION['user_id']?>" class="nav-button active"><i class='bx bx-line-chart bx-sm' class="nav-button "></i> Previous Trips</a></li>
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
            <h1>Your Past Trips</h1>
        </div>

        <div class="dashboard-sub-content">
        <div class="top-boxes">
            <!-- Small Image Boxes -->
            <div class="img-box">
                <img src="<?php echo URLROOT; ?>/images/hotel/dashboard.jpg" alt="hotel Image">
            </div>
           

            <!-- Total Bookings Box -->
            <div class="box">
                <h2>Total Trips Finished</h2>
                <p><?php  echo $data['noOfPreviousTrips']?></p>
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
<!-- <?php echo var_dump($data['previousTrips'])?> -->
        <div class="table-content">
            <h2>Trip Details</h2>
            <table class="booking-table">
                <thead>
                <tr>
                    <th>No</th>
                    <!-- <th>Trip ID</th> -->
                    <th>Service Provider</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Booking</th>
                    <th></th>
                    <th></th>

                   
                </tr>
                </thead>
                <tbody>


                <?php
$count = 1;

if (!empty($data['previousTrips']) && is_array($data['previousTrips'])) {
    foreach ($data['previousTrips'] as $booking) {
        echo '<tr class="t-row">';
        echo '<td>' . $count . '</td>';
        // echo '<td>' . $booking->booking_id . '</td>';
         echo '<td>' . $booking->fname . ' ' . $booking->lname . '</td>';
        echo '<td>' . $booking->startDate . '</td>';
        echo '<td>' . $booking->endDate . '</td>';
        if ($booking->room_id !== null) {
            // Display the description from hotel_rooms if room_id is not null
            echo '<td>' . $booking->hotel_description . '</td>'; // Assuming you alias it as hotel_description
        } elseif ($booking->vehicle_id !== null) {
            // Display the description from vehicles if vehicle_id is not null
            echo '<td>' . $booking->vehicle_description . '</td>'; // Assuming you alias it as vehicle_description
        } elseif ($booking->package_id !== null) {
            // Display the description from another source (if applicable) based on the context
        }

        
        echo '<td><button class="viewbooking" onclick="openPopup(' . $booking->serviceProvider_id . ', ' . $booking->booking_id . ')">View</button></td>';
       // Check if feedback has been provided for this booking
       $feedbackProvided = $this->userModel->checkFeedbackProvided($booking->booking_id);

       // Display the "Feedback" button only if feedback hasn't been provided
       if (!$feedbackProvided) {
        echo '<td><button class="provide-feedback-button" onclick="openFeedbackPopup(' . $booking->booking_id . ', \'' . $booking->fname . ' ' . $booking->lname . '\')"><i class="bx bx-plus"></i>Feedback</button></td>';
    } else {
        echo '<td><button class="submitted-button" disabled><i class="bx bx-check"></i>Submitted</button></td>';
    }
    

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

        <!-- pop up -->
        <div id="feedbackModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeFeedbackPopup()">&times;</span>
    <h2>Feedback for : <span id="bookingNameSpan"></span></h2>
    <!-- Feedback form and rating input -->
    <div class="feedback-form">
      <label for="feedback">How was the service : </label>
      <textarea id="feedback" rows="4" cols="50"></textarea>
      <label for="rating">Rating : </label>
      <div class="rating">
      <input type="radio" id="star1" name="rating" value="5" /><label for="star1" title="1 star"></label>
      <input type="radio" id="star2" name="rating" value="4" /><label for="star2" title="2 stars"></label>
      <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 stars"></label>
        <input type="radio" id="star4" name="rating" value="2" /><label for="star4" title="4 stars"></label>
        <input type="radio" id="star5" name="rating" value="1" /><label for="star5" title="5 stars"></label>
      </div>
      <button id="submitFeedbackButton" onclick="submitFeedback()">Submit</button>
    </div>
    <div id="successMessage" style="display: none;color:red"></div>
  </div>
</div>

        <!-- /// -->

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
    <!-- <script src= "<?php echo URLROOT?>/public/js/hotel/bookings.js"></script> -->
    <div id="myModal" class="modal1">
  <div class="modal1-content">
    <span class="close1">&times;</span>
    <iframe id="popupFrame" width="100%" height="100%"></iframe>
  </div>
</div>
</body>
</html>
