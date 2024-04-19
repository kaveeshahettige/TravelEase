<!DOCTYPE html>
<html lang="en">

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo SITENAME ?></title>
<!-- <link rel="stylesheet" href="<?php echo URLROOT?>/css/driver/dashboard.css"> -->
<link rel="stylesheet" href="<?php echo URLROOT?>/css/driver/settings.css">
<link rel="stylesheet" href="<?php echo URLROOT?>/css/driver/bookings.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

        <?php
    // var_dump($data['profileimage']->profile_picture)

        ?>

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
            <li><a href="<?php echo URLROOT; ?>driver/index" class="active"><i class='bx bxs-dashboard bx-sm'></i>
                    Overview</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/calender"><i class='bx bxs-book bx-sm'></i> Availabily
                    Calender</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/bookings"><i class='bx bxs-package bx-sm'></i></i> Bookings</a>
            </li>
            <li><a href="<?php echo URLROOT; ?>driver/vehicle"><i class='bx bxs-car bx-sm'></i> Vehicle Informaion </a>
            </li>
            <li><a href="<?php echo URLROOT; ?>driver/earings"><i class='bx bx-money-withdraw bx-sm'></i>Earings and
                    Payments</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/notification"><i class='bx bxs-bell bx-sm'></i>Notification</a>
            </li>

            <li><a href="<?php echo URLROOT; ?>driver/reviews"><i class='bx bxs-star bx-sm bx-fw'></i> Reviews</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/settings"><i class='bx bxs-cog bx-sm'></i> Settings</a></li>
            <li><a href="<?php echo URLROOT?>users/logout" class="active"><i class='bx bxs-log-out bx-sm bx-fw'></i>
                    Logout</a></li>
        </ul>
        <!-- <div class="logout">
            <a href="<?php echo URLROOT; ?>pages/indes" class="active"><i class='bx bxs-log-out bx-sm bx-fw'></i>  Logout</a>
        </div> -->
    </nav>
    <div class="logo-container">
        <img src="<?php echo URLROOT; ?>/images/driver/TravelEase.png" alt="TravelEase Logo">
        <span class="logo-text">TravelEase</span>
    </div>

    <div class="dashboard-content">
        <h1>Overview</h1>
    </div>

    <div class="dashboard-sub-content">
        <div class="top-boxes">
            <!-- Small Image Boxes -->
            <div class="img-box">
                <img src="<?php echo URLROOT; ?>/images/hotel/dashboard.jpg" alt="hotel Image">
            </div>

            <!-- Total Bookings Box -->
            <!-- <?php $bookingsCount = $data["bookingsCount"]; ?> -->
            <div class="box">
                <h2>Total Bookings</h2>
                <p><?php echo $bookingsCount ?></p>
            </div>

    

            <!-- <?php
            $guestCount = $data["guestCount"]; ?> -->
            <div class="box">
                <h2>Total Customers</h2>
                <!-- <p><?php echo $guestCount?></p> -->
            </div>
        </div>
    </div>

    <div class="dashboard-subcontent">
        <div class="content-container">
            <div class="left-content">
                <div class="rectangle">
                    <div class="basic-info-content">
                        <div class="center-image">
                        <img src="<?php echo URLROOT; ?>/images/<?php echo $data['profileimage']->profile_picture ?>" alt="User Profile Photo">
                        </div>
                        <div class="hotel-details">
                            <h3><?php echo $_SESSION['user_fname'] . " " . $_SESSION['user_lname'] ?></h3>
                            <h6>Contact Number</h6>
                            <p><?php echo $_SESSION['user_number'] ?></p>
                            <h6>Email</h6>
                            <p><?php echo $_SESSION['user_email'] ?></p>

                        </div>






                        <h2>Agency Details</h2>
                        <div class="hotel-details">
                            <?php if (!empty($data['agencyDetails'])) : ?>
                            <h6>Agency Name </h6>
                            <p><?php echo $data['agencyDetails']->agency_name; ?></p>
                            <h6>Registration Number</h6>
                            <p> <?php echo $data['agencyDetails']->reg_number; ?></p>
                            <h6>Address </h6>
                            <p><?php echo $data['agencyDetails']->address; ?></p>
                            <h6>Description</h6>
                            <p> <?php echo $data['agencyDetails']->description; ?></p>
                            <h6>City</h6>
                            <p><?php echo $data['agencyDetails']->city; ?></p>
                            <?php else : ?>
                            <p>No agency details found</p>
                            <?php endif; ?>


                        </div>
                    </div>
                </div>









            </div>
            <div class="right-content">
    <!-- Table with Maximum 4 Rows -->
    <div class="table2-content">
        <h2>New Booking Details</h2>
        <?php
    // Check if $data exists and has the expected structure
    if (!empty($data) && isset($data['pendingBookings'])) {
    ?>
        <table class="booking-table">
            <thead>
                <tr>
                    <th>Passenger Name</th>
                    <th>Start Date</th>
                    <th>Vehicle Number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- PHP code here -->
                <?php
                $pendingBookings = $data['pendingBookings'] ?? [];
                $paymentAmounts = $data['paymentAmounts'] ?? [];

                $count = 0; // Initialize a counter variable

                foreach (array_map(null, $pendingBookings, $paymentAmounts) as [$booking, $payment]) {
                    $count++; // Increment the counter for each iteration
                ?>
                    <tr>
                    <td><?php echo $booking->traveler_details->fname . ' ' . $booking->traveler_details->lname; ?>
                    <td><?php echo $booking->startDate; ?></td>
                        <td><?php echo $booking->plate_number; ?></td>
                        <td>
                        <a class="view-button" href="<?php echo URLROOT; ?>driver/bookings">
                                        <i class='bx bx-search'></i>
                                    </a>
                        </td>
                    </tr>
                    <?php } ?>
            </tbody>
        </table>
        <?php } ?>
    </div>

    <!-- Rooms Allocated Section -->
    <div class="rectangle">
        <div class="basic-info-content">
            <div class="hotel-details">
                <h2>Total Vehicles</h2>
                <!-- PHP code here -->
                <?php
                $vehicleCount = $data['vehicleCount'];
                ?>
                <p><?php echo $vehicleCount; ?></p>
            </div>
            <a href="<?php echo URLROOT; ?>driver/vehiclereg">
                            <button class="edit-button">Add a Vehicle</button>
                        </a>
        </div>
    </div>
</div>


        </div>

    </div>



</body>

</html>