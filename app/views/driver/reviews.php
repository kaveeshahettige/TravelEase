<!-- <?php var_dump($data['feedbackDetails']) ;?> -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/driver/reviews.css">
    <script src="<?php echo URLROOT; ?>/public/js/hotel/popup.js"></script>
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/popup.css">
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
            <img src="<?php echo URLROOT; ?>/images/<?php echo $data['profileimage']->profile_picture ?>"
                alt="User Profile Photo">
            <span class="user-name"><?php echo $_SESSION['user_fname'].' '.$_SESSION['user_lname']?></span>
            <a class="" href="<?php echo URLROOT; ?>/driver/notification">
                <i class="bx bx-bell"></i>
            </a>

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
            <li> <a href="#" class="nav-button active" onclick="confirmLogout(event)"><i class='bx bxs-log-out bx-sm bx-fw'></i> Logout</a></li>
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
                    <p></p>
                </div>

                <!-- Ongoing Bookings Box -->
                <div class="box">
                    <h2>Total Bookings</h2>
                    <p></p>
                </div>

                <!-- Customers Box -->
                <div class="box">
                    <h2>Total Customers</h2>
                    <p></p>
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
            <?php
            $reviews = $data['feedbackDetails'];
            if (empty($reviews)): ?>
            <p>No reviews available.</p>
            <?php else:
                foreach ($reviews as $review): ?>
            <!-- <?php var_dump($review); ?> -->
            <div class="review-box">
                <div class="review-image">
                    <img src="<?php echo URLROOT; ?>/images/<?php echo $review->profile_picture; ?>"
                        alt="Publisher Picture"
                        style="width: 50px; height: 50px; border-radius: 50%; margin-right: 10px; display: inline-block; vertical-align: middle;">
                </div>
                <div class="review-sub-content">
                    <h2><?= $review->fname . " " . $review->lname; ?></h2>
                    <p class="review-text"><?= $review->feedback; ?></p>
                    <p>Review for : <?=$review->booking_id?></p>
                    <p>Rating: <?= getStarRating($review->rating); ?></p>
                    <p>Date: <?= $review->time; ?></p>
                </div>
            </div>
            <?php endforeach;
            endif; ?>
        </div>


        <?php
        function getStarRating($rating) {
            $stars = '';
            for ($i = 0; $i < $rating; $i++) {
                $stars .= '<i class="bx bxs-star"></i>';
            }
            return $stars;
        }
        ?>








    </main>
</body>

</html>