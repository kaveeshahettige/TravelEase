<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/driver/reviews.css">
    <title><?php echo SITENAME ?></title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/driver/x-icon"
        href="<?php echo URLROOT; ?>/images/driver/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <nav class="left-menu">
        <div class="user-profile">
        <img src="<?php echo URLROOT; ?>/images/<?php echo $data['profileimage']->profile_picture ?>" alt="User Profile Photo">
            <span class="user-name"><?php echo $_SESSION['user_fname'].' '.$_SESSION['user_lname']?></span>
        </div>

        <div class="search-bar">
            <form action="#" method="GET">
                <input type="text" placeholder="Find a Setting">
                <button type="submit">Search</button>
            </form>
        </div>
        <ul>
            <li><a href="<?php echo URLROOT; ?>/driver/index"><i class='bx bxs-dashboard bx-sm'></i> Overview</a></li>
            <li><a href="<?php echo URLROOT; ?>/driver/calender"><i class='bx bxs-book bx-sm'></i> Availabily
                    Calender</a></li>
            <li><a href="<?php echo URLROOT; ?>/driver/bookings"><i class='bx bxs-package bx-sm'></i></i> Bookings</a>
            </li>
            <li><a href="<?php echo URLROOT; ?>/driver/vehicle"><i class='bx bxs-car bx-sm'></i> Vehicle Informaion </a>
            </li>
            <li><a href="<?php echo URLROOT; ?>/driver/earings"><i class='bx bx-money-withdraw bx-sm'></i>Earings and
                    Payments</a></li>
            <li><a href="<?php echo URLROOT; ?>/driver/notification"><i class='bx bxs-bell bx-sm'></i>Notification</a>
            </li>
            <li><a href="<?php echo URLROOT; ?>/driver/reviews" class="active"><i class='bx bxs-star bx-sm bx-fw'></i>
                    Reviews</a></li>
            <li><a href="<?php echo URLROOT; ?>/driver/settings"><i class='bx bxs-cog bx-sm'></i> Settings</a></li>
            <li><a href="<?php echo URLROOT?>users/logout" class="active"><i class='bx bxs-log-out bx-sm bx-fw'></i>
                    Logout</a></li>
        </ul>


    </nav>
    <main>
        <div class="logo-container">
            <img src="<?php echo URLROOT; ?>/images/driver/TravelEase.png" alt="TravelEase Logo">
            <span class="logo-text">TravelEase</span>
        </div>

        <div class="dashboard-content">
            <h1>Reviews</h1>
        </div>

        <div class="dashboard-sub-content">
            <div class="top-boxes">
                <!-- Small Image Boxes -->
                <div class="img-box">
                    <img src="<?php echo URLROOT; ?>/images/driver/dashboard.jpg" alt="hotel Image">
                </div>


                <!-- Total Bookings Box -->
                <div class="box">
                    <h2>Total Reviews</h2>
                    <p>100</p>
                </div>

                <!-- Ongoing Bookings Box -->
                <div class="box">
                    <h2>Total Bookings</h2>
                    <p>100</p>
                </div>

                <!-- Customers Box -->
                <div class="box">
                    <h2>Total Customers</h2>
                    <p>50</p>
                </div>
            </div>
        </div>

        <div class="search-content">
            <div class="review-search">
                <input type="text" id="review-search" placeholder="Search for Reviews">
                <button onclick="filterBookings()">
                    <i class="bx bx-search"></i> <!-- Using the Boxicons search icon -->
                </button>
            </div>
        </div>


        <?php
        $completedBookings = $data['completedBookings'] ?? [];

        foreach ($completedBookings as $feedback): ?>
        <div class="review-content">
            <div class="feedback">

                <div class="card">
                    <div class="feedback-details">
                    <img src="<?php echo URLROOT; ?>/images1/<?php echo $feedback->traveler_details->profile_picture; ?>" alt="Publisher Picture" style="width: 50px; height: 50px; border-radius: 50%; margin-right: 10px; display: inline-block; vertical-align: middle;">
                    <!-- <img src="<?php echo URLROOT; ?>/images1/<?php echo $notifications->profile_picture ?>" alt="Sender Image" class="sender-image"> -->



                        <span style="margin-bottom: 5px; display: inline-block; vertical-align: middle;">Publisher:
                            <?php echo $feedback->traveler_details->fname . " " . ($feedback->traveler_details->lname ? $feedback->traveler_details->lname : ""); ?></span>
                        <span style="margin-bottom: 5px; display:block;">&nbsp;
                            &nbsp;&nbsp;&nbsp;<?php echo $feedback->feedbacks_details[0]->time; ?></span>

                        <span style="margin-bottom: 5px; display:block;">
                            <p style="margin-left: 15px;">Booking ID:
                                <?php echo $feedback->feedbacks_details[0]->booking_id; ?></p>
                        </span>
                    </div>

                    <div class="feedback-details">

                    </div>
                    <div class="rating">
                        <!-- Display rating stars -->
                        <?php for ($i = 0; $i < $feedback->feedbacks_details[0]->rating; $i++): ?>
                        <span class="star">&#9733;</span>
                        <?php endfor; ?>
                    </div>
                    <div class="comment">
                        <!-- Display feedback comment -->
                        <p><?php echo $feedback->feedbacks_details[0]->feedback; ?></p>
                    </div>

                </div>

            </div>

        </div>
        <?php endforeach; ?>








    </main>
</body>

</html>