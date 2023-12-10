<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/businessmanager/manager-settings.css">
    <title>Business Manager Settings</title>
    <link rel="icon" type="<?php echo URLROOT?>/images/x-icon" href="<?php echo URLROOT?>/images/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <nav class="left-menu">
        <div class="user-profile">
            <img src="<?php echo URLROOT?>/images/wikum.jpg" alt="User Profile Photo">
            <span class="user-name"><?php echo $_SESSION['user_fname'].' '.$_SESSION['user_lname']?></span>
        </div>
        
        <div class="search-bar">
            <form action="#" method="GET">
                <input type="text" placeholder="Find a Setting">
                <button type="submit">Search</button>
            </form>
        </div>
        <ul>
            <li><a href="<?php echo URLROOT; ?>businessmanager/index" class="nav-button  "><i class='bx bxs-dashboard bx-sm'></i> Overview</a></li>
            <li><a href="<?php echo URLROOT; ?>businessmanager/bookings"class="nav-button"><i class='bx bxs-book bx-sm'></i> Bookings</a></li>
            <li><a href="<?php echo URLROOT; ?>businessmanager/packages" class="nav-button"><i class='bx bxs-package bx-sm'></i></i> Packages</a></li>
            <li><a href="<?php echo URLROOT; ?>businessmanager/reports" class="nav-button"><i class='bx bxs-report bx-sm'></i> Reports</a></li>
            <li><a href="<?php echo URLROOT; ?>businessmanager/financialmanagement" class="nav-button"><i class='bx bx-line-chart bx-sm'></i> Financial Management</a></li>
            <li><a href="<?php echo URLROOT; ?>businessmanager/settings" class="nav-button active"><i class='bx bxs-cog bx-sm'></i> Settings</a></li>
        </ul> 

        <div class="logout">
            <a href="<?php echo URLROOT; ?>users/logout" class="nav-button active"><i class='bx bxs-log-out bx-sm bx-fw'></i>  Logout</a>
        </div>
    </nav>
    <main>
        <div class="logo-container">
            <img src="<?php echo URLROOT?>/images/TravelEase.png" alt="TravelEase Logo">
            <span class="logo-text">TravelEase</span>
        </div>
        
        <div class="dashboard-content">
            <h1>Settings</h1>
        </div>

        <div class="dashboard-subcontent">
        <div class="content-container">
            <div class="left-content">

                <div class="rectangle">
                    <div class="basic-info-content">
                        <div class="center-image">
                            <img src="<?php echo URLROOT?>/images/wikum.jpg" alt="Profile Picture">
                        </div>
                        <div class="hotel-details">
                            <h3><?=$_SESSION['user_fname']?></h3>
                            <h6>Contact Number</h6>
                            <p><?=$_SESSION['user_number']?></p>
                            <h6>Email</h6>
                            <p><?=$_SESSION['user_email']?></p>
                            <!-- <h6>Location</h6>
                            <p>City, Country</p> -->
                        </div>
                        <a href="<?php echo URLROOT; ?>businessmanager/businessmanageredit">
                        <button class ="edit-button">Edit</button>
                        </a>
                     </div>
                </div>

                
            </div>

            <div class="right-content">
                

                <div class="rectangle">
                    <div class="basic-info-content">
                    <div class="hotel-details">
                        <h2>Pacakge Details</h2>
                        <h6>No. Package Created</h6>
                        <p>5</p>
                    </div>
                        <a href="<?php echo URLROOT; ?>businessmanager/addpackage">  
                        <button  class ="edit-button">Add</button>
                        </a>
                    </div>
                </div>

                <div class="rectangle">
                    <div class="basic-info-content">
                        <h2>Change Password</h2>
                            <a href="<?php echo URLROOT; ?>businessmanager/businessmanagerpassword">
                                <button  class ="edit-button">Edit</button>
                            </a>
                    </div>
                </div>
                
            </div>

        </div>
        <div class="rectangle">
            <div class="basic-info-content">
            <h2>Profile Deletion</h2>
            <a href="<?php echo URLROOT; ?>businessmanager/hoteledit">
            <button class ="delete-button">Delete</button></a>
            </div>
        </div>
    </div>
    </main>
</body>
</html>
