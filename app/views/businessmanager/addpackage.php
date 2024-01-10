<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/businessmanager/add-package.css">
    <title>Add Package</title>
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
            <li><a href="<?php echo URLROOT; ?>businessmanager/notifications" class="nav-button"><i class='bx bx-bell bx-sm bx-fw'></i>Notifications</a></li>
            <li><a href="<?php echo URLROOT; ?>businessmanager/settings" class="nav-button active"><i class='bx bxs-cog bx-sm'></i> Settings</a></li>
<!--            <li><a href="--><?php //echo URLROOT; ?><!--users/logout" class="nav-button active"><i class='bx bxs-log-out bx-sm bx-fw'></i> Logout</a></li>-->
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
            <div><h1>Settings</h1> </div>
        </div>
        
        <div class="main-content">
            <div class="room-container">
                <div class="room-box">
                    <h3>Package Name</h3>
                    <p>Description of the room goes here.</p>
                    <div class="icons">
                        <a href="<?php echo URLROOT; ?>businessmanager/packageedit"><i class='bx bx-edit'></i></a> 
                        <a href="#"><i class='bx bx-trash'></i></a> 
                    </div>
                </div>

                <div class="room-box">
                    <h3>Package Name</h3>
                    <p>Description of the room goes here.</p>
                    <div class="icons">
                        <a href="<?php echo URLROOT; ?>businessmanager/packageedit"><i class='bx bx-edit'></i></a> 
                        <a href="#"><i class='bx bx-trash'></i></a> 
                    </div>
                </div>

                <div class="room-box">
                    <h3>Package Name</h3>
                    <p>Description of the room goes here.</p>
                    <div class="icons">
                        <a href="<?php echo URLROOT; ?>businessmanager/packageedit"><i class='bx bx-edit'></i></a> 
                        <a href="#"><i class='bx bx-trash'></i></a> 
                    </div>
                </div>

                <div class="room-box">
                    <h3>Package Name</h3>
                    <p>Description of the room goes here.</p>
                    <div class="icons">
                        <a href="<?php echo URLROOT; ?>businessmanager/packageedit"><i class='bx bx-edit'></i></a> 
                        <a href="#"><i class='bx bx-trash'></i></a> 
                    </div>
                </div>

                <div class="room-box">
                    <h3>Package Name</h3>
                    <p>Description of the room goes here.</p>
                    <div class="icons">
                        <a href="<?php echo URLROOT; ?>businessmanager/packageedit"><i class='bx bx-edit'></i></a> 
                        <a href="#"><i class='bx bx-trash'></i></a> 
                    </div>
                </div>

                <div class="add-room">
                    <a href="<?php echo URLROOT; ?>businessmanager/packageedit" class="add-room-link">
                        <i class='bx bx-plus-circle' id="add-icon"></i>  
                        <p>Add New Pacakge</p>
                    </a>
                </div>
            
            </div>
           
            
        </div>
    </main>
</body>
</html>
