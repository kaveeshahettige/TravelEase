<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/settingssub.css">     <title><?php echo SITENAME ?></title>
    <link rel="icon" type="image/x-icon" href="../Images/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <nav class="left-menu">
    <div class="user-profile">
            <img src="<?php echo URLROOT; ?>/images/driver/wikum.jpg" alt="User Profile Photo">
            <span class="user-name">Travel Agency 1</span>
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
        
        <!-- <div class="logout">
            <a href="#" class="active"><i class='bx bxs-log-out bx-sm bx-fw'></i>  Logout</a>
        </div> -->
    </nav>
    <main>
        <div class="logo-container">
            <img src="<?php echo URLROOT; ?>/images/driver/TravelEase.png" alt="TravelEase Logo">
            <span class="logo-text">TravelEase</span>
        </div>
        <div class="dashboard-content">
            <div><h1>Vehicle info</h1> </div>

           
             
            <div id="base">
                <h3 style="padding-left:20px;">Basic Info</h3>
                <div id="form">
                <form class="registration-form" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
                    <div class="form-group">
                        <label for="make">Vehicle Brand:</label>
                        <input type="text" id="make" name="brand" required>

                    </div>
                    <div class="form-group">
                        <label for="model">Model:</label>
                        <input type="text" id="model" name="model"  required>
                    </div>
                    <div class="form-group">
                        <label for="plate">Plate Number:</label>
                        <input type="text" id="plate" name="plate_number"  required>
                    </div>

                    <div class="form-group">
                    <label for="fuel-type">Fuel Type:</label>
                    <select id="fuel-type" name="fuel_type" required>
                    <option value="petrol">Petrol</option>
                    <option value="diesel">Diesel</option>
                    <option value="electric">Electric</option>
                    <option value="hybrid">Hybrid</option>

                    </select>
                    </div>


                    <div class="form-group">
                    <label for="year">Year:</label>
                    <select id="year" name="year" required>
                        <?php
                        $currentYear = date("Y");
                        $startYear = $currentYear-50; // Set the start year, e.g., 50 years ago
                        $endYear = $currentYear; // Set the end year as the current year
                        
                        for ($year = $endYear; $year >= $startYear; $year--) {
                            echo "<option value='$year'>$year</option>";
                        }
                        ?>
                    </select>
                    </div>
                  
                            <div class="baseButtons">
                                <button id="cancelBut" type="cancel">Cancel</button>
                                <button id="saveBut" type="submit">Save</button>
                            </div>
                    
                    <!-- <div class="form-group">
                    <label for="vehicle-photo">Vehicle Photo:</label>
                    <input type="file" id="vehicle-photo" name="veh_photo" accept="image/*" required>

                    </div> -->

                    </form>
                            </div>

                    </div>
                                    </div>
                                </div>
           
            
        </div>
    </main>
</body>
</html>
