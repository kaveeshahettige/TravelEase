<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>css/travelerDashboard/settings/style.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="<?php echo URLROOT?>js/travelerDashboard/editinfo/script.js"></script>

    <title> Settings</title>
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT?>images/TravelEase_logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
</head>
<body>
    <nav class="left-menu">
        <div class="user-profile">
            <img src="<?php echo empty($data['profile_picture']) ? URLROOT.'images/user.jpg' : URLROOT.'images1/'.$data['profile_picture']; ?>" alt="Profile Picture" alt="User Profile Photo">
            <span class="user-name"><?php echo $data['fname']."   ".$data['lname']?></span>
        </div>
        
        <div class="search-bar">
            <form action="#" method="GET">
                <input type="text" placeholder="Find a Setting">
                <button type="submit">Search</button>
            </form>
        </div>
        
        <ul>
            <li><a href="<?php echo URLROOT?>travelerDashboard/index/<?php echo $_SESSION['user_id']?>"><i class='bx bxs-dashboard bx-sm'></i> Overview</a></li>
            <li><a href=""><i class='bx bxs-book bx-sm'></i> Bookings</a></li>
            <li><a href=""><i class='bx bxs-package bx-sm'></i></i> Payments</a></li>
            <li><a href=""><i class='bx bxs-report bx-sm'></i> Notifications</a></li>
            <li><a href=""><i class='bx bx-line-chart bx-sm'></i> Previous Trips</a></li>
            <li><a href="<?php echo URLROOT?>travelerDashboard/settings/<?php echo $_SESSION['user_id']?>" class="active"><i class='bx bxs-cog bx-sm'></i> Settings</a></li>
        </ul>
        
        <div class="logout">
            <a href="<?php echo URLROOT?>users/logout" class="nav-button active"><i class='bx bxs-log-out bx-sm bx-fw'></i>  Logout</a>
        </div>
    </nav>
    <main>
        <div class="logo-container">
            <img src="<?php echo URLROOT?>images/TravelEase_logo.png" alt="TravelEase Logo">
            <span class="logo-text">TravelEase</span>
        </div>
        
        <div class="dashboard-content">
            <h1>Settings</h1>
        </div>

        <div class="dashboard-subcontent">
        <div class="content-container">
            <div class="left-content">

                <div class="rectangle">
                   <!-- Rectangle 1: Basic Info -->
                    <div class="basic-info-content">
                        <div class="center-image" >
                        <!-- src="<?php echo URLROOT?>images/5.jpg -->
                            <img style="cursor:pointer;transition: box-shadow 0.8s;" onclick="triggerClick()" id="profileDisplay" src="<?php echo empty($data['profile_picture']) ? URLROOT.'images/user.jpg' : URLROOT.'images1/'.$data['profile_picture']; ?>" alt="Profile Picture">
                            
                            
                        </div>
                        <div class="hotel-details">
                        
                            <h3><?php echo $data['fname']."  ".$data['lname']?></h3>
                            <!-- <h3><button onclick="uploadProfilePicture()">Change Picture</button></h3>
                            <input type="file" id="newProfilePicture" accept="image/*" style="display: none;"> -->
                            
                            <form action="<?php echo URLROOT?>/TravelerDashboard/changePicture" method="POST" enctype="multipart/form-data" >
                            <!-- <h3><button onclick="uploadProfilePicture()">Change Picture</button></h3> -->
                            <input type="file" id="newProfilePicture" name="newProfilePicture" onchange="displayImage(this)" accept="image/*" style="display:none;">
                            <span id="confirmationMessage" style="display: none;color:red">Click the button to confirm.</span>
                            <h3><button type="submit" name="savePic"> Confirm</button></h3>

                            </form>
                            <h6>Contact Number</h6>
                            <p><?php echo $data['number']?></p>
                            <h6>Email</h6>
                            <p><?php echo $data['email']?></p>
                            
                           <!-- Input for selecting a new profile picture -->
        
        
        <!-- Button to upload the selected file -->
        
                        </div>
                        
                       <a href="<?php echo URLROOT?>/users/edit/<?php echo $_SESSION['user_id']?>"><button id="editInfoBut" >Edit</button></a> 
                     </div>
                </div>

                <!-- <div class="rectangle">
                    
                    <div class="basic-info-content">
                        <h2>Change Password</h2>
                       
                            <a href="../Availability/hotel-availability.html">
                                <button>Edit</button>
                            </a>
                    </div>
                </div> -->
                
            </div>

            <div class="right-content">

                <div class="rectangle">
                    <!-- Rectangle 2: Change Password -->
                    <div class="basic-info-content">
                        <h2>Change Password</h2>
                        
                            
                                <button class ="edit-button" onclick="changePassword()">Edit</button>
                           
                    </div>
                </div>
                

                <div class="rectangle">
                    <!-- Rectangle 2: Rooms Allocated -->
                    <!-- <div class="basic-info-content">
                    <div class="hotel-details">
                        <h2>Rooms Allocated</h2>
                        <h6>No.of Rooms</h6>
                        <p>5</p>
                    </div>
                        <button>Add</button>
                    </div> -->
                    <div class="basic-info-content">
                        <h2>Profile Deletion</h2>
                        <!-- Add profile deletion option here -->
                        <a href="<?php echo URLROOT?>users/delete/<?php echo $_SESSION['user_id']?>"><button class ="delete-button">Delete</button></a>
                        
                        </div>
                </div>
                
            </div>

        </div>

    </div>
    </main>
</body>
</html>
