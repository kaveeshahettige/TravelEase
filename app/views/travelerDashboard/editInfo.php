<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>css/travelerDashboard/editInfo/style.css">
    <title>Traveler Dashboard</title>
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT?>images/TravelEase_logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <nav class="left-menu">
        <div class="user-profile">
            <img src="<?php echo URLROOT?>images/5.jpg" alt="User Profile Photo">
            <span class="user-name"><?php echo $data['fname']."   ".$data['lname']?></span>
        </div>
        
        <div class="search-bar">
            <form action="#" method="GET">
                <input type="text" placeholder="Find a Setting">
                <button type="submit">Search</button>
            </form>
        </div>
        
            
        <ul>
        <li><a href="<?php echo URLROOT; ?>travelerDashboard/index/<?php echo $_SESSION['user_id']?>" class="nav-button "><i class='bx bxs-dashboard bx-sm'></i>Overview</a></li>
            <li><a href="<?php echo URLROOT; ?>travelerDashboard/bookings/<?php echo $_SESSION['user_id']?>" class="nav-button"><i class='bx bxs-book bx-sm bx-fw'></i> Bookings</a></li>
            <li><a href="<?php echo URLROOT; ?>travelerDashboard/payments/<?php echo $_SESSION['user_id']?>" class="nav-button"><i class='bx bxs-package bx-sm' class="nav-button "></i></i> Payments</a></li>
            <li><a href="<?php echo URLROOT; ?>travelerDashboard/notifications/<?php echo $_SESSION['user_id']?>" class="nav-button"><i class='bx bxs-report bx-sm' class="nav-button "></i> Notifications</a></li>
            <li><a href="<?php echo URLROOT; ?>travelerDashboard/previoustrips/<?php echo $_SESSION['user_id']?>" class="nav-button"><i class='bx bx-line-chart bx-sm' class="nav-button "></i> Previous Trips</a></li>
            <li><a href="<?php echo URLROOT?>travelerDashboard/cart/<?php echo $_SESSION['user_id']?>" class="nav-button"><i class='bx bx-cart bx-sm'></i> Cart</a></li>
         
            <li><a href="<?php echo URLROOT?>travelerDashboard/settings/<?php echo $_SESSION['user_id']?>" class="active"><i class='bx bxs-cog bx-sm'></i>Settings</a></li>
        </ul>  
        
        
        <div class="logout">
            <a href="<?php echo URLROOT?>users/logout" class="active"><i class='bx bxs-log-out bx-sm bx-fw'></i>  Logout</a>
        </div>
    </nav>
    <main>
        <div class="logo-container">
            <img src="<?php echo URLROOT?>images/TravelEase_logo.png" alt="TravelEase Logo">
            <span class="logo-text">TravelEase</span>
        </div>
        <div class="dashboard-content">
            <div><h1>Settings</h1> </div>
             
            <div id="base">
                <h3 style="padding-left:20px;">Basic Info</h3>
                <div id="form" >
                    <form class="registration-form" action="<?php echo URLROOT?>Users/edit/<?php echo $_SESSION['user_id']?>" method="POST">
                        <div>
                            <div class="form-group">
                                <label for="First Name">First Name</label>
                                <input type="text" id="first-name" name="fname"  value="<?php echo $data['fname']?>" required>
                                
                            </div>
                            <div class="form-group">
                                <label for="Last Name">Last Name</label>
                                <input type="text" id="last-name" name="lname"  value="<?php echo $data['lname']?>" required>
                                
                            </div>
                            
                            
                            
                        </div>
                        <div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" id="email" name="email" value="<?php echo $data['email']?>"  required>
                                
                            </div>
                        
                            <div class="form-group">
                                <label for="phonenumber">Phone Number</label>
                                <input type="text" id="number" name="number" value="<?php echo $data['number']?>"  required>
                               
                            </div>
                            
                        </div>
                        <div>
                            <!-- <div class="form-group">
                                <label for="location">Living</label>
                                <input type="text" id="location" name="location" placeholder="Galle">
                            </div> -->
                            
                        </div>
                        <div >
                            <div class="baseButtons">
                                <button id="cancelBut" type="reset">Cancel</button>
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
