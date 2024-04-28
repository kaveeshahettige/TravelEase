<!DOCTYPE html>
<html lang="en">

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo SITENAME ?></title>
<!-- <link rel="stylesheet" href="<?php echo URLROOT?>/css/driver/dashboard.css"> -->
<link rel="stylesheet" href="<?php echo URLROOT?>/css/driver/settings.css">
<link rel="stylesheet" href="<?php echo URLROOT?>/css/driver/bookings.css">
<script src="<?php echo URLROOT; ?>/public/js/hotel/popup.js"></script>
<link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/popup.css">
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
            <li> <a href="#" class="nav-button active" onclick="confirmLogout(event)"><i class='bx bxs-log-out bx-sm bx-fw'></i> Logout</a></li>
        </ul>
        <!-- <div class="logout">
            <a href="<?php echo URLROOT; ?>pages/indes" class="active"><i class='bx bxs-log-out bx-sm bx-fw'></i>  Logout</a>
        </div> -->
    </nav>

    <div class="main">

        <div class="logo-container">
            <img src="<?php echo URLROOT; ?>/images/driver/TravelEase.png" alt="TravelEase Logo">
            <span class="logo-text">TravelEase</span>
        </div>

        <div class="dashboard-content">
            <h1>Overview</h1>
        </div>
        <div class="dashboard-sub-content">
            <div class="top-boxes">
                <div class="box">
                    <?php if (empty($data['agencyDetails'])) : ?>
                    <h2>Provide Agency Details</h2>
                    <a href="<?php echo URLROOT; ?>driver/addagency">
                        <button class="edit-button">Click Here</button>
                    </a>
                    <?php else : ?>
                    <h2>Welcome,</h2>

                    <h1><?php echo $data['userDetails']->fname;  ?></h1>
                    <!-- Show other content or message -->
                    <?php endif; ?>
                </div>

                <div class="box">
                    <?php if ($data['userDetails']->approval == 0 && ($data['userDetails']->document == NULL)) : ?>
                    <!-- <h2>Service Validation</h2> -->
                    <h2>Please upload your service validation documents.</h2>
                    <a href="<?php echo URLROOT; ?>driver/settings">
                        <button class="edit-button">Click Here</button>
                    </a>
                    <?php elseif (!empty($data['userDetails']->document) && $data['userDetails']->approval == 0) : ?>
                    <h2>Service Validation Pending.</h2>
                    <p>Your documents have been submitted.</p>
                    <?php elseif (!empty($data['userDetails']->document) && $data['userDetails']->approval == 1) : ?>
                    <h2>Congratulations!</h2>
                    <p>Service Validation Accepted.</p>
                    <?php elseif (!empty($data['userDetails']->document) && $data['userDetails']->approval == 2) : ?>
                    <h2>Service Validation Declined.</h2>
                    <!-- <p>Unfortunately, your service validation has been declined. Please review the details and resubmit.</p> -->
                    <a href="<?php echo URLROOT; ?>driver/settings">
                        <button class="edit-button">Resubmit</button>
                    </a>
                    <?php endif; ?>
                </div>

            </div>
        </div>


        <div class="dashboard-subcontent">
            <div class="content-container">
                <div class="left-content">
                    <div class="rectangle">
                        <div class="basic-info-content">
                            <div class="center-image">

                                <img src="<?php echo URLROOT; ?>/images/<?php echo $data['profileimage']->profile_picture;; ?>"
                                    alt="profile Picture">


                            </div>

                            <div class="hotel-details">
                                <h3><?php echo $_SESSION['user_fname'] . " " . $_SESSION['user_lname'] ?></h3>
                                <h6>Contact Number</h6>
                                <p><?php echo $_SESSION['user_number'] ?></p>
                                <h6>Email</h6>
                                <p><?php echo $_SESSION['user_email'] ?></p>

                            </div>






                           
                            <div class="hotel-details">
                                <?php if (!empty($data['agencyDetails'])) : ?>
                                <h6>Manager Name </h6>
                                <p><?php echo $data['agencyDetails']->manager_name; ?></p>
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
                    <div class="table2-content">

                        <?php
// Check if $data exists and has the expected structure
if (!empty($data) && isset($data['pendingBookings'])) {
    if ($data['vehicleCount'] == 0 && $data['pendingBookings'] == NULL) {
        echo '<div class="rectangle">
                <div class="basic-info-content">
                    <div class="hotel-details">
                        <p>Add vehicles to get new Bookings.</p>
                    </div>
                </div>
            </div>';
    } elseif ($data['vehicleCount'] != 0 && $data['pendingBookings'] == NULL) {
            
            echo '<div class="rectangle">
            <div class="basic-info-content">
                <div class="hotel-details">
                <p>No New Bookings to Show.</p>
                </div>
            </div>
        </div>';


        } else {
            // Display the table if conditions are not met
    ?>
                        <h2>New Booking Details</h2>
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


            $count = 0; // Initialize a counter variable

            foreach ($pendingBookings as $booking) {
                $count++; // Increment the counter for each iteration
            ?>
                                <tr>
                                    <td><?php echo $booking->fname . ' ' . $booking->lname; ?>
                                    <td><?php echo $booking->startDate; ?></td>
                                    <td><?php echo $booking->plate_number; ?></td>
                                    <td>
                                        <a class="view-button" href="<?php echo URLROOT; ?>driver/bookings" style="width: 15px;";>
                                            <i class='bx bx-search'></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <?php } // End of else block
    } // End of if $data check ?>
                    </div>


                    <?php
                $vehicleCount = $data['vehicleCount'];
                ?>

                    <!-- Rooms Allocated Section -->
                    <div class="rectangle">
                        <div class="basic-info-content">
                            <div class="hotel-details">
                                <h2>Total Vehicles</h2>
                                <!-- PHP code here -->

                                <h2><?php echo $vehicleCount; ?></h2>
                            </div>
                            <a href="<?php echo URLROOT; ?>driver/vehiclereg">
                                <button class="edit-button">Add a Vehicle</button>
                            </a>
                        </div>
                    </div>


                </div>


            </div>

        </div>



    </div>


</body>

</html>