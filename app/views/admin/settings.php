<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/admin/settings.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="<?php echo URLROOT?>/js/admin/script.js"></script>
    <title>TravelEase</title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/admin/x-icon" href="<?php echo URLROOT?>/images/TravelEase_logo.png">
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <nav class="left-menu">
        <div class="user-profile">
            <img src="<?php echo URLROOT; ?>/images/admin/wikum.jpg" alt="User Profile Photo">
            <span class="user-name"><?php echo ucfirst($data['fname']); ?></span>
        </div>
        
        <div class="search-bar">
    <form id="searchForm" action="#" method="GET">
        <input type="text" id="searchInput" placeholder="Find a Setting">
        <button type="submit">Search</button>
    </form>
    </div>
        <ul id="navList">
            <li><a href="<?php echo URLROOT; ?>admin/index" ><i class='bx bxs-dashboard bx-sm'></i> Overview</a></li>
            <li><a href="<?php echo URLROOT; ?>admin/request" ><i class='bx bxs-book bx-sm'></i> Request</a></li>
            <li><a href="<?php echo URLROOT; ?>admin/traveler" ><i class='bx bx-child bx-sm'></i></i> Traveler</a></li>

            <li><a href="<?php echo URLROOT; ?>admin/hotel"><i class='bx bxs-hotel bx-sm'></i></i> Hotels</a></li>
            <li><a href="<?php echo URLROOT; ?>admin/agency"><i class='bx bxs-car bx-sm'></i> Travel Agencies </a></li>
            <li><a href="<?php echo URLROOT; ?>admin/package"><i class='bx bx-package bx-sm'></i>Guide</a></li>
            <li><a href="<?php echo URLROOT; ?>admin/settings"class="active"><i class='bx bxs-cog bx-sm'></i> Settings</a></li>
            <li><a href="<?php echo URLROOT; ?>users/logout" class="nav-button active"><i class='bx bxs-log-out bx-sm bx-fw'></i> Logout</a></li>
            
        </ul> 
            
            
        
        
        <!-- <div class="logout">
            <a href="<?php echo URLROOT?>users/logout" class="nav-button active"><i class='bx bxs-log-out bx-sm bx-fw'></i> Logout</a>
        </div> -->
    </nav>
    <main>
        <div class="logo-container">
            <img src="<?php echo URLROOT; ?>/images/admin/TravelEase.png" alt="TravelEase Logo">
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
                            <img src="<?php echo URLROOT; ?>/images/admin/wikum.jpg" alt="Profile Picture">
                        </div>
                        <div class="hotel-details">
                            <h3><?php echo ucfirst($data['fname']); ?></h3>
                            <h6>Contact Number</h6>
                            <p><?php echo $data['number']; ?></p>
                            <h6>Email</h6>
                            <p><?php echo $data['email']; ?></p>
                            
                        </div>
                        <a href="<?php echo URLROOT; ?>/admin/adminedit">
                        <button class ="edit-button">Edit</button>
                        </a>
                     </div>
                </div>

                
            </div>

            <div class="right-content">
                

                <div class="rectangle">
                    <div class="basic-info-content">
                    <div class="hotel-details">
                        <h2>Add Business Manager</h2>
                        <h6>No. of Business Managers</h6>
                        <p><?php echo $data['no'] ?></p>
                    </div>
                        <a href="<?php echo URLROOT; ?>/admin/addbusinessmanager">  
                        <button  class ="edit-button">Add</button>
                        </a>
                    </div>
                </div>

                <div class="rectangle">
                    <div class="basic-info-content">
                        <h2>Change Password</h2>
                            <a href="<?php echo URLROOT; ?>admin/adminpassword">
                                <button  class ="edit-button">Change</button>
                            </a>
                    </div>
                </div>
                
            </div>

        </div>
        <div class="rectangle">
            <div class="basic-info-content">
            <h2>Profile Deletion</h2>
            <a href="">
            <button class ="delete-button" onclick="return adminDelete();">Delete</button></a>
            </div>
        </div>
    </div>
    </main>
</body>
</html>
