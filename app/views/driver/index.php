<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/driver/dashboard.css">
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
            <li><a href="<?php echo URLROOT; ?>driver/index" class="active"><i class='bx bxs-dashboard bx-sm'></i> Overview</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/calender"><i class='bx bxs-book bx-sm'></i> Availabily Calender</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/bookings"><i class='bx bxs-package bx-sm'></i></i> Bookings</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/vehicle"><i class='bx bxs-car bx-sm'></i> Vehicle Informaion </a></li>
            <li><a href="<?php echo URLROOT; ?>driver/earings"><i class='bx bx-money-withdraw bx-sm'></i>Earings and Payments</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/notification"><i class='bx bxs-bell bx-sm'></i>Notification</a></li>
            
            <li><a href="<?php echo URLROOT; ?>driver/reviews"><i class='bx bxs-star bx-sm bx-fw'></i> Reviews</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/settings"><i class='bx bxs-cog bx-sm'></i> Settings</a></li>
            <li><a href="<?php echo URLROOT?>users/logout" class="active"><i class='bx bxs-log-out bx-sm bx-fw'></i> Logout</a></li>
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

    <div class="dashboard-subcontent">
        <div class="content-container">
            <div class="left-content">

                <div class="rectangle">
                   <!-- Rectangle 1: Basic Info -->
                    <div class="basic-info-content">
                        <div class="center-image">
                            <img src="<?php echo URLROOT?>/images/driver/wikum.jpg" alt="Profile Picture">
                        </div>
                        <div class="hotel-details">
                            <h3><?php echo $_SESSION['user_fname']."  ".$_SESSION['user_lname']?></h3>
                            <h6>Contact Number</h6>
                            <p><?php echo $_SESSION['user_number']?></p>
                            <h6>Email</h6>
                            <p><?php echo $_SESSION['user_email']?></p>
                            <h6>Location</h6>
                            <p>LOL</p>
                        </div>
                     </div>
                </div>
                <form action="<?php echo URLROOT; ?>driver/process-form.php" method="POST" enctype="multipart/form-data">
                <div class="rectangle">
                <h2>Agency Detailes</h2>

                <lable for="agencyname">Agency Name:</lable>
                <input type="text" id="agency_name" name="agency_name" required>

                <label for="agencyAddress">Agency Address:</label>
                <input type="text" id="address" name="address" required>

                <label for="agencyRegNumber">Agency Registration Number:</label>
                <input type="text" id="reg_number" name="reg_number" required>
                
                <label class="checkbox-label" for="terms">
                <input type="checkbox" id="terms" name="terms" required>
                I agree to the <a href="#">Terms and Conditions</a>
</label>
                    
                
                            
                <button type="submit">Submit</button>          
            

           
           
                    </div>
</div>
            </div>
            </form>
            <div class="rectangle">
                    <!-- Rectangle 3: Service Validation -->
                    <div class="basic-info-content">
                        <h2>Service Validation</h2>
                        <form class="service-validation-form" method="POST" action="<?php echo URLROOT; ?>/driver/process-form" enctype="multipart/form-data">
                            <p>Submit a PDF for Service Validation:</p>
                            <input type="file" id="service-validation-pdf" name="service-validation-pdf" accept=".pdf" required>
                            <button class="edit-button" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
           
                </div>
                </div>
                </div>


                
</body>
</html>
