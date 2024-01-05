<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/driver/bookings.css">
    <title><?php echo SITENAME ?></title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/driver/x-icon" href="<?php echo URLROOT; ?>/images/driver/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <nav class="left-menu">
        <div class="user-profile">
            <img src="<?php echo URLROOT; ?>/images/driver/wikum.jpg" alt="User Profile Photo">
            <span class="user-name"><?php echo $_SESSION['user_fname'].' '.$_SESSION['user_lname']?></span>
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
            <li><a href="<?php echo URLROOT; ?>driver/bookings" class="active"><i class='bx bxs-package bx-sm'></i></i> Bookings</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/vehicle"><i class='bx bxs-car bx-sm'></i> Vehicle Informaion </a></li>
            <li><a href="<?php echo URLROOT; ?>driver/earings"><i class='bx bx-money-withdraw bx-sm'></i>Earings and Payments</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/notification"><i class='bx bxs-bell bx-sm'></i>Notification</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/reviews"><i class='bx bxs-star bx-sm bx-fw'></i> Reviews</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/settings"><i class='bx bxs-cog bx-sm'></i> Settings</a></li>
            <!-- <div class="logout"> -->
            <li><a href="<?php echo URLROOT?>users/logout" class="active"><i class='bx bxs-log-out bx-sm bx-fw'></i> Logout</a></li>
        <!-- </div> -->
        </ul>
        
        
    </nav>
    <main>
        <main>
            <div class="logo-container">
                <img src="<?php echo URLROOT; ?>/images/driver/TravelEase.png" alt="TravelEase Logo">
                <span class="logo-text">TravelEase</span>
            </div>
            
            <div class="dashboard-content">
                <h1>Bookings</h1>
            </div>
    
            <div class="dashboard-sub-content">
            <div class="top-boxes">
                <!-- Small Image Boxes -->
                <div class="img-box">
                    <img src="<?php echo URLROOT; ?>/images/driver/dashboard.jpg" alt="hotel Image">
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
    <h2>Pending Booking Details</h2>
    <table class="booking-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Trip ID</th>
                <th>Pickup Date</th>
                <th>End Date</th>
                <th>Pickup Location</th>
                <th>Dropoff Location</th>
                <th>Number of passengers</th>
                <th>Accept</th>
                <th>Decline</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($data['pendingbookings'])) {
                $count = 1;
                foreach ($data['pendingbookings'] as $booking) :
            ?>
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $booking->trip_id; ?></td>
                        <td><?php echo $booking->start_date; ?></td>
                        <td><?php echo $booking->end_date; ?></td>
                        <td><?php echo $booking->pickup_location; ?></td>
                        <td><?php echo $booking->dropoff_location; ?></td>
                        <td><?php echo $booking->passenger_count; ?></td>
                        <td><button class="view-button">Accept</button></td>
                        <td><button class="view-button">Decline</button></td>
                    </tr>
            <?php
                    $count++;
                endforeach;
            } else {
                echo '<tr><td colspan="8"><center>No pending bookings available.</center></td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>

           

            <div class="table-content">
    <h2>Accepted Booking Details</h2>
    <table class="booking-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Trip ID</th>
                <th>Pickup Date</th>
                <th>End Date</th>
                <th>Pickup Location</th>
                <th>Dropoff Location</th>
                <th>Number of passengers</th>
                <th>Trip Charge</th>
                <th>Decline</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($data['acceptedbookings'])) {
                $count = 1;
                foreach ($data['acceptedbookings'] as $booking) :
            ?>
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $booking->trip_id; ?></td>
                        <td><?php echo $booking->start_date; ?></td>
                        <td><?php echo $booking->end_date; ?></td>
                        <td><?php echo $booking->pickup_location; ?></td>
                        <td><?php echo $booking->dropoff_location; ?></td>
                        <td><?php echo $booking->passenger_count; ?></td>
                        <td><?php echo $booking->earnings; ?></td>
                        <td><button class="view-button">Decline</button></td>
                    </tr>
            <?php
                    $count++;
                endforeach;
            } else {
                echo '<tr><td colspan="8"><center>No accepted bookings available.</center></td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>


    
           
            <div class="dashboard-content">
            <h1>Trip History</h1>
        </div>

        <div class="dashboard-sub-content">
        <div class="top-boxes">
 
            <!-- Total Request Box -->
            <div class="box">
                <h2>Total Trips</h2>
                <p>200</p>
            </div>
        

        </div>
        </div>

        <div class="search-content">
        <div class="booking-search">
            <input type="text" id="booking-search" placeholder="Search Trips">
            <button onclick="filterBookings()">
                <i class="bx bx-search"></i> <!-- Using the Boxicons search icon -->
            </button>
        </div>
        </div>
       
        <div class="table-content">
    <h2>Completed Booking Details</h2>
    <table class="booking-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Trip ID</th>
                <th>Start Date</th>
                <th>End Date</th>           
                <th>Pickup Location</th>
                <th>Dropoff Location</th>
                <th>Earnings</th>
                <th>Passenger</th>
                <th>Rating</th>
                <th>Comments</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($data['completedbookings'])) {
                $count = 1;
                foreach ($data['completedbookings'] as $booking) :
            ?>
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $booking->trip_id; ?></td>
                        <td><?php echo $booking->start_date; ?></td>
                        <td><?php echo $booking->end_date; ?></td>
                        <td><?php echo $booking->pickup_location; ?></td>
                        <td><?php echo $booking->dropoff_location; ?></td>
                        <td><?php echo $booking->earnings; ?></td>
                        <td><?php echo $booking->passenger_count; ?></td>
                        <td><?php echo $booking->rating; ?></td>
                        <td><?php echo $booking->comments; ?></td>
                        <td><button class="view-button">More Details</button></td>
                    </tr>
            <?php
                    $count++;
                endforeach;
            } else {
                echo '<tr><td colspan="11"><center>No completed bookings available.</center></td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>

        
        </main>

    </main>
</body>
</html>