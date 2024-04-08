<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/driver/vehicleedit.css">     <title><?php echo SITENAME ?></title>
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
                <h3 style="padding-left:20px;">Edit Basic Info</h3>
                <div id="form">
                <!-- <?php echo $_SERVER['REQUEST_URI']; ?>" -->
                <form class="registration-form" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
                    <div class="form-group">
                    <label for="seating-capacity">Seating Capacity:</label>
                    <input type="number" id="seating_capacity" name="seating_capacity" >
                    </div>
                    <div class="form-group">
                    <label for="ac">Air Conditioning (AC) or Non-AC:</label>
                    <select id="ac_type" name="ac_type" >
                        <option value="1">AC</option>
                        <option value="0">Non-AC</option>
                    </select>
                    </div>
                    <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" rows="4" cols="65" ></textarea>

                    </div>

                    <div class="upload-container">
                    <div class="form-group">
                    <label id="file-label" for="file-input">Vehicle Photo</label>
                <input type="file" id="file-input" />
                    </div>
                </div>
            
                  
                  


                   
                  
                            <div class="baseButtons">
                                <button id="cancelBut" type="cancel">Cancel</button>
                                <button id="saveBut" type="submit">Save</button>
                            </div>
                    
                    </form>
                            </div>

                    </div>
                                    </div>
                                </div>
           
            
        </div>
    </main>
</body>
</html>
