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



        <div class="review-content">
            <!-- Assuming $data['reviews'] is an array of reviews -->
            <?php
    if (!empty($data['reviews'])) {
        foreach ($data['reviews'] as $review) :
    ?>
            <div class="review-box">
                <div class="review-sub-content">
                    <div class="review-image">
                        <img src="<?php echo URLROOT; ?>/images/driver/wikum.jpg" alt="Guest Photo">
                    </div>
                    <!-- <h2><?php echo $review->user_name; ?></h2> -->

                    <div class="rating">
                        <?php
                    $rating = $review->rating;
                    for ($i = 1; $i <= 5; $i++) {
                        echo ($i <= $rating) ? '<span class="star">&#9733;</span>' : '<span class="star">&#9734;</span>';
                    }
                    ?>
                    </div>
                    <p>Trip ID: <?php echo $review->trip_id; ?></p>
                    <p>Date: <?php echo $review->end_date; ?></p>
                    <p class="review-text"><?php echo $review->comments; ?></p>


                </div>
            </div>
            <?php
        endforeach;
    } else {
        echo '<p>No reviews available.</p>';
    }
    ?>
        </div>


        </div>



    </main>
</body>

</html>