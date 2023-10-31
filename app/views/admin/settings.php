<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/admin/settings.css">
    <title>Business admin Settings</title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/admin/x-icon" href="<?php echo URLROOT; ?>/images/admin/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <nav class="left-menu">
        <div class="user-profile">
            <img src="<?php echo URLROOT; ?>/images/admin/wikum.jpg" alt="User Profile Photo">
            <span class="user-name">Travel Agency 1</span>
        </div>
        
        <div class="search-bar">
            <form action="#" method="GET">
                <input type="text" placeholder="Find a Setting">
                <button type="submit">Search</button>
            </form>
        </div>
        <ul>
            <li><a href="<?php echo URLROOT; ?>admin/index" ><i class='bx bxs-dashboard bx-sm'></i> Overview</a></li>
            <li><a href="<?php echo URLROOT; ?>admin/request" ><i class='bx bxs-book bx-sm'></i> Request</a></li>
            <li><a href="<?php echo URLROOT; ?>admin/hotel"><i class='bx bxs-hotel bx-sm'></i></i> Hotels</a></li>
            <li><a href="<?php echo URLROOT; ?>admin/agency"><i class='bx bxs-car bx-sm'></i> Travel Agencies </a></li>
            <li><a href="<?php echo URLROOT; ?>admin/package"><i class='bx bx-package bx-sm'></i>Packages</a></li>
            <li><a href="<?php echo URLROOT; ?>admin/settings"class="active"><i class='bx bxs-cog bx-sm'></i> Settings</a></li>
            <li><a href="<?php echo URLROOT; ?>pages/indes" class="active"><i class='bx bxs-log-out bx-sm bx-fw'></i> Logout</a></li>
        </ul> 
        

        
        <!-- <div class="logout">
            <a href="<?php echo URLROOT; ?>pages/indes" class="active"><i class='bx bxs-log-out bx-sm bx-fw'></i>  Logout</a>
        </div> -->
    </nav>
    <main>
        <div class="logo-container">
            <img src="<?php echo URLROOT; ?>/images/admin/TravelEase.png" alt="TravelEase Logo">
            <span class="logo-text">TravelEase</span>
        </div>
        <div class="dashboard-content">
            <div><h1>Settings</h1> </div>
             
            <div id="base">
                <h3 style="padding-left:20px;">Basic Info</h3>
                <div id="form">
                    <form class="registration-form">
                        <div>
                            <div class="form-group">
                                <label for="First Name">First Name</label>
                                <input type="text" id="first-name" name="first-name" placeholder="Kaveesha"required>
                            </div>
                            <div class="form-group">
                                <label for="Last Name">Last Name</label>
                                <input type="text" id="last-name" name="last-name" placeholder="Hettige" required>
                            </div>
                            
                            
                            
                        </div>
                        <div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" id="email" name="email" placeholder="kaveesha.hettige@gmail.com" required>
                            </div>
                        
                            <div class="form-group">
                                <label for="phonenumber">Phone Number</label>
                                <input type="text" id="number" name="number" placeholder="0764532789" required>
                            </div>
                            
                        </div>
                        <div>
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" id="location" name="location" placeholder="Galle">
                            </div>
                            
                        </div>
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
