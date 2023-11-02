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
            <li><a href="<?php echo URLROOT; ?>driver/vehicle"><i class='bx bxs-car bx-sm'></i> Vehicle Informaion </a></li>
            <li><a href="<?php echo URLROOT; ?>driver/earings"><i class='bx bx-money-withdraw bx-sm'></i>Earings and Payments</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/notification"><i class='bx bxs-bell bx-sm'></i>Notification</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/reviews"><i class='bx bxs-star bx-sm bx-fw'></i> Reviews</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/settings" class="active"><i class='bx bxs-cog bx-sm'></i> Settings</a></li>
            <li><a href="<?php echo URLROOT?>users/logout" class="active"><i class='bx bxs-log-out bx-sm bx-fw'></i> Logout</a></li>
        </ul>   
        
    </nav>
    <main>
        <div class="logo-container">
            <img src="../Images/TravelEase.png" alt="TravelEase Logo">
            <span class="logo-text">TravelEase</span>
        </div>
        <div class="dashboard-content">
            <div><h1>Settings</h1> </div>
             
            <div id="base">
                <h3 style="padding-left:20px;">Add Rooms</h3>
                <div id="form">
                    <form class="registration-form">
                        <div>
                            <div class="form-group">
                                <label for="roomType">Room Type</label>
                                <select id="roomType" name="roomType">
                                  <option value="standard">Standard</option>
                                  <option value="deluxe">Deluxe</option>
                                  <option value="suite">Suite</option>
                                  <option value="other">Other</option>
                                </select>
                            </div>
                        
                            <div class="form-group">
                                <label for="numOfBeds">Number of Beds</label>
                                <select id="numOfBeds" name="numOfBeds">
                                  <option value="1">1 Bed</option>
                                  <option value="2">2 Beds</option>
                                  <option value="3">3 Beds</option>
                                  <option value="4">4 Beds</option>
                                </select>
                            </div>
                        </div>
                        

                        <div>
                            <div class="form-group">
                                <label for="price">Price (per night)</label>
                                <input type="number" id="price" name="price" required>
                            </div> 
                            <div  class="form-group">
                                <label for="roomImages">Room Images:</label>
                                <input type="file" id="roomImages" name="roomImages[]" accept="image/*" multiple required>
                            </div>                           
                        </div>

                        <div>
                            <div class="form-group">
                                <label for="roomDescription">Room Description:</label>
                                <textarea id="roomDescription" name="roomDescription" rows="4" required></textarea>
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
