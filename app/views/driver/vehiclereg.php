<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/driver/vehicleAdd.css">
    
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <title><?php echo SITENAME ?></title>
    <link rel="icon" type="image/x-icon" href="../Images/TravelEase.png">
</head>
<body>
    <nav class="left-menu">
        <div class="user-profile">
            <img src="<?php echo URLROOT; ?>/images/driver/wikum.jpg" alt="User Profile Photo">
            <span class="user-name"><?php echo $_SESSION['user_fname'] . ' ' . $_SESSION['user_lname'] ?></span>
        </div>
        
        <div class="search-bar">
            <form action="#" method="GET">
                <input type="text" placeholder="Find a Setting">
                <button type="submit">Search</button>
            </form>
        </div>
        
        <ul>
            <li><a href="<?php echo URLROOT; ?>driver/index"><i class='bx bxs-dashboard bx-sm'></i> Overview</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/calender"><i class='bx bxs-book bx-sm'></i> Availabily Calendar</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/bookings"><i class='bx bxs-package bx-sm'></i> Bookings</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/vehicle" class="active"><i class='bx bxs-car bx-sm'></i> Vehicle Information </a></li>
            <li><a href="<?php echo URLROOT; ?>driver/earings"><i class='bx bx-money-withdraw bx-sm'></i>Earnings and Payments</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/notification"><i class='bx bxs-bell bx-sm'></i>Notification</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/reviews"><i class='bx bxs-star bx-sm bx-fw'></i> Reviews</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/settings" ><i class='bx bxs-cog bx-sm'></i> Settings</a></li>
            <li><a href="<?php echo URLROOT; ?>pages/index" class="active"><i class='bx bxs-log-out bx-sm bx-fw'></i> Logout</a></li>
        </ul>   
    </nav>
    <main>
        <div class="logo-container">
            <img src="<?php echo URLROOT; ?>/images/driver/TravelEase.png" alt="TravelEase Logo">
            <span class="logo-text">TravelEase</span>
        </div>
        <div class="dashboard-content">
            <div>
                <h1>Vehicle Registration Form</h1>
            </div>
             
            <div id="base">
                <div id="form">
                    <form class="registration-form" action="<?php echo URLROOT ?>driver/vehiclereg" method="POST" enctype="multipart/form-data">
                   
                    <!-- <div>
                    <label for="vehicleOwner">Are you the current owner of this vehicle as per the certificate of registration?</label>
                    <div class="radio-buttons">
                    <input type="radio" id="yes" name="vehicleOwner" value="yes">
                    <label for="yes">Yes</label>

                    <input type="radio" id="no" name="vehicleOwner" value="no">
                    <label for="no">No</label>
                </div>
                   </div>  -->
                        <h2>Vehicle Details</h2>

                        <div class="form-group">
                    <label for="vehicle_type">Vehicle Type :</label>
                    <select id="vehicle_type" name="vehicle_type" required>
                    <option value="car">Car</option>
                    <option value="van">Van</option>
                    <option value="bus">Bus</option>
                   </select>
                   </div>

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
                    <option value="Petrol">Petrol</option>
                    <option value="Diesel">Diesel</option>
                    <option value="Electric">Electric</option>
                    <option value="Hybrid">Hybrid</option>
                   
                </select>
</div>


                <div class="form-group">
                    <label for="year">Year:</label>
                    <select id="year" name="year" required>
                        <?php
                        $currentYear = date("Y");
                        $startYear = $currentYear-25; // Set the start year, e.g., 50 years ago
                        $endYear = $currentYear; // Set the end year as the current year
                        
                        for ($year = $endYear; $year >= $startYear; $year--) {
                            echo "<option value='$year'>$year</option>";
                        }
                        ?>
                    </select>
                    </div>

                    <div class="form-group">
                    <label for="seating-capacity">Seating Capacity:</label>
                    <input type="number" id="seating_capacity" name="seating_capacity" required>
                </div>

                <div class="form-group">
                    <label for="ac">Air Conditioning (AC) or Non-AC:</label>
                    <select id="ac_type" name="ac_type" required>
                        <option value="1">AC</option>
                        <option value="0">Non-AC</option>
                    </select>
                </div>

                <label for="description">Description :</label>
                <textarea id="description" name="description" rows="4" required></textarea>

                    <h2 style="padding-left:40px;">Take a photo of your Vehicle</h2>
                    <div class="upload-container">
                    <div class="form-group">
                    <label id="file-label" for="file-input">Vehicle Photo</label>
                <input type="file" id="file-input" />
                    </div>
                </div>
            
               
                

                    <h2 style="padding-left:40px;">Take a photo of your Vehicle Insurance</h2>

                    

                    <p style="padding-left:30px;">If the vehicle owner name on the vehicle documents is different from mine, then I hereby confirm that I have the vehicle owner's consent to drive this vehicle on the TravelEase Platform. This declaration can be treated as a No-Objection Certificate and releases TravelEase from any legal obligations and consequences.</p>

                    <div class="upload-container">
                    <div class="form-group">
                    <label id="file-label" for="file-input">Insurance Photo</label>
                <input type="file" id="file-input" />
                    </div>
                </div>
                
                
                    


                    
                    <!-- Registation details -->

                    <h2 style="padding-left:40px;">Take a photo of your Vehicle Registration Document</h2>
                    <div class="upload-container">
                    <div class="form-group">
                    <label id="file-label" for="file-input">Registation card Photo</label>
                <input type="file" id="file-input" />
                    
                </div></div>


                    <p style="padding-left:30px;">If the vehicle owner name on the vehicle documents is different from mine, then I hereby confirm that I have the vehicle owner's consent to drive this vehicle on the TravelEase Platform. This declaration can be treated as a No-Objection Certificate and releases TravelEase from any legal obligations and consequences.</p>
                    
                    <h2 style="padding-left:40px;">Take a photo of your Revenue License</h2>
                    <div class="upload-container">
                    <div class="form-group">
                    <label id="file-label" for="file-input">Revenue License Photo</label>
                <input type="file" id="file-input" />
                    
                </div></div>
                    <p style="padding-left:30px;">If the vehicle owner name on the vehicle documents is different from mine, then I hereby confirm that I have the vehicle owner's consent to drive this vehicle on the TravelEase Platform. This declaration can be treated as a No-Objection Certificate and releases TravelEase from any legal obligations and consequences.</p>
                
                    
                    <div >
                            <div class="baseButtons">
                                <button id="cancelBut">Cancel</button>
                                <button id="saveBut" type="submit">Save</button>
                            </div>
                
                </div>
            </form>

                
                </div>
            </div>
        </div>
    </main>
</body>
</html>
