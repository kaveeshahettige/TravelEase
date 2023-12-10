<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/driver/vehicle.css">
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
            <li><a href="<?php echo URLROOT; ?>driver/bookings"><i class='bx bxs-package bx-sm'></i></i> Bookings</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/vehicle" class="active"><i class='bx bxs-car bx-sm'></i> Vehicle Informaion </a></li>
            <li><a href="<?php echo URLROOT; ?>driver/earings"><i class='bx bx-money-withdraw bx-sm'></i>Earings and Payments</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/notification"><i class='bx bxs-bell bx-sm'></i>Notification</a></li>
            
            <li><a href="<?php echo URLROOT; ?>driver/reviews"><i class='bx bxs-star bx-sm bx-fw'></i> Reviews</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/settings"><i class='bx bxs-cog bx-sm'></i> Settings</a></li>
            <li><a href="<?php echo URLROOT?>users/logout" class="active"><i class='bx bxs-log-out bx-sm bx-fw'></i> Logout</a></li>
        </ul> 
        
        
        
    </nav>
    <main>
        <div class="logo-container">
            <img src="<?php echo URLROOT; ?>/images/driver/TravelEase.png" alt="TravelEase Logo">
            <span class="logo-text">TravelEase</span>
        </div>
        
        <div class="dashboard-content">
            <h1>Vehicle Informaion</h1>
        </div>

        <div class="search-content">
            <div class="booking-search">
                <input type="text" id="booking-search" placeholder="Search Vehicles">
                <button onclick="filterBookings()">
                    <i class="bx bx-search"></i> <!-- Using the Boxicons search icon -->
                </button>
            </div>
            </div>

        <div class="dashboard-sub-content">
        <div class="top-boxes">
 
            <!-- Total Request Box -->
            <div class="box">
                <h2>Total Vehicles</h2>
                <p>1</p >
            </div>
                        
            <div class="box">
                    <!-- Rectangle 2: Change Password -->
                    <div class="basic-info-content">
                        <h2>Add Vehicle</h2>
                        <!-- Add change password form here -->
                            <a href="<?php echo URLROOT; ?>driver/vehiclereg/<?php echo $_SESSION['user_id']?>">
                                <button  class ="edit-button">Add</button>
                            </a>
                    </div>
                </div>

        </div>
        </div>

        
        <div class="interim_container">
            <div class="dashboard-subcontent">
                  <div class="content-container">
                  <!-- <?php var_dump($data) ?>    ;  -->
    <?php if (!empty($data)): ?>
    <?php foreach ($data as $vehicle): ?>
        
            <div class="left-content">

                <div class="rectangle">
                   <!-- Rectangle 1: Basic Info -->
                    <div class="basic-info-content">
                        <div class="center-image">
                        <img src="<?php echo URLROOT; ?>/images/driver/vehicle_1.jpg" alt="Guest Photo">
                        </div>
                        <div class="hotel-details">
                        <div class="detail"><strong>Vehicle Brand :</strong><?php echo $vehicle['brand']?></div>
                    <div class="detail"><strong>Model:</strong> <?php echo $vehicle['model']?></div>
                    <div class="detail"><strong>Plate Number:</strong> <?php echo $vehicle['plate_number']?></div>
                    <div class="detail"><strong>Year:</strong> <?php echo $vehicle['year']?></div>
                    <div class="detail"><strong>Fuel Type:</strong> <?php echo $vehicle['fuel_type']?></div>
                        </div>
                        <a href="<?php echo URLROOT; ?>driver/vehicleedit/<?php echo $vehicle['id']?>"><button class="edit-button2">Edit </button>
</a>
                    <a href="<?php echo URLROOT?>driver/vehicledelete/<?php echo $vehicle['id']?>"><button class ="edit-button2">Delete</button></a>
                     </div>
                    
                </div>
                </div>
                
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
            </div>
            </div>


        <div class="more-content">
            <button class="next-page-btn">More<i class='bx bx-chevron-right'></i></button>
        </div>
        <script src="<?php echo URLROOT?>/js/driver/vehicle.js"></script>
    </main>
</body>
</html>
            