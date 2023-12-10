<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT;?>css/packages/packages-settings.css">
    <title>Packages Settings</title>
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT;?>images/packages/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <nav class="left-menu">
        <div class="user-profile">
            <img src="<?php echo URLROOT;?>images/packages/uththara.jpg" alt="User Profile Photo">
            <span class="user-name"><?=$_SESSION['user_fname']?></span>
        </div>
        
        <div class="search-bar">
            <form action="#" method="GET">
                <input type="text" placeholder="Find a Setting">
                <button type="submit">Search</button>
            </form>
        </div>

        <ul>
            <li><a href="<?php echo URLROOT;?>packages/index" class="nav-button"><i class='bx bxs-dashboard bx-sm'></i> Dashboard</a></li>
            <li><a href="<?php echo URLROOT;?>packages/availability" class="nav-button"><i class='bx bxs-calendar bx-sm bx-fw'></i> Availability</a></li>
            <li><a href="<?php echo URLROOT;?>packages/bookings" class="nav-button"><i class='bx bxs-book bx-sm bx-fw'></i> Bookings</a></li>
            <li><a href="<?php echo URLROOT;?>packages/gallery" class="nav-button"><i class='bx bx-images bx-sm bx-fw'></i> Gallery</a></li>
            <li><a href="<?php echo URLROOT;?>packages/revenue" class="nav-button"><i class='bx bxs-wallet bx-sm bx-fw'></i> Revenue</a></li>
            <li><a href="<?php echo URLROOT;?>packages/packages" class="nav-button"><i class= 'bx bxs-package bx-sm'></i> Packages</a></li>
            <li><a href="<?php echo URLROOT;?>packages/review" class="nav-button"><i class='bx bxs-star bx-sm bx-fw'></i> Review</a></li>
            <li><a href="<?php echo URLROOT;?>packages/settings" class="nav-button active"><i class='bx bxs-cog bx-sm bx-fw'></i> Settings</a></li>
        </ul>  
        
        
        <div class="logout">
            <a href="<?php echo URLROOT;?>users/logout" class="nav-button active"><i class='bx bxs-log-out bx-sm bx-fw'></i>  Logout</a>
        </div>
    </nav>
    <main>
        <div class="logo-container">
            <img src="<?php echo URLROOT;?>images/packages/TravelEase.png" alt="TravelEase Logo">
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
                        <div class="center-image">
                            <img src="<?php echo URLROOT;?>images/packages/profile.png" alt="Profile Picture">
                        </div>
                        <div class="hotel-details">
                            <h3>Package Name</h3>
                            <h6>Package Type</h6>
                            <h6>Contact Number</h6>
                            <p>+1 123-456-7890</p>
                            <h6>Email</h6>
                            <p>example@example.com</p>
                            <h6>Location</h6>
                            <p>City, Country</p>
                        </div>
                        <a href="../Settings/sub/packages-edit.html">
                        <button class ="edit-button">Edit</button>
                        </a>
                     </div>
                </div>

                <div class="rectangle">
                    <!-- Rectangle 2: Change Password -->
                    <div class="basic-info-content">
                        <h2>Change Password</h2>
                        <!-- Add change password form here -->
                            <a href="../Settings/sub/packages-password.html">
                                <button  class ="edit-button">Edit</button>
                            </a>
                    </div>
                </div>
                
            </div>

            <div class="right-content">

                <div class="rectangle">
                    <!-- Rectangle 1: Image Slideshow -->
                    <img class="slideshow-image" src="<?php echo URLROOT;?>images/packages/hotel 10.jpg" alt="Image 2">
                </div>
                

                <div class="rectangle">
                    <!-- Rectangle 2: Rooms Allocated -->
                    <div class="basic-info-content">
                    <div class="hotel-details">
                        <h2>Package Created</h2>
                        <h6>Number of Packages </h6>
                        <p>5</p>
                    </div>
                        <a href="<?php echo URLROOT; ?>packages/addpackages">
                        <button  class ="edit-button">Add</button>
                        </a>
                    </div>
                </div>
                
            </div>

        </div>
        <div class="rectangle">
            <!-- Rectangle 3: Profile Deletion -->
            <div class="basic-info-content">
            <h2>Profile Deletion</h2>
            <!-- Add profile deletion option here -->
            <a href="../packages/addpackages">
            <button class ="delete-button">Delete</button></a>
            </div>
        </div>
    </div>
    </main>
</body>
</html>