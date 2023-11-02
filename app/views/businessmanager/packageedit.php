<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/businessmanager/package-edit.css">
    <title>Package Edit</title>
    <link rel="icon" type="image/x-icon" href="../Images/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <nav class="left-menu">
        <div class="user-profile">
            <img src="<?php echo URLROOT?>/images/wikum.jpg" alt="User Profile Photo">
            <span class="user-name">Wikum Preethika</span>
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
            <a href="#" class="nav-button active"><i class='bx bxs-log-out bx-sm bx-fw'></i>  Logout</a>
        </div>
    </nav>
    <main>
        <div class="logo-container">
            <img src="<?php echo URLROOT?>/images/TravelEase.png" alt="TravelEase Logo">
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
                                <label for="current-password">Current Password</label>
                                <input type="text" id="current-password" name="current-password" placeholder="Current Password" required>
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
