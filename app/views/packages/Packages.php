<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT;?>css/packages/Packages.css">
    <title>Packages</title>
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT;?>images/packages/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <nav class="left-menu">
        <div class="user-profile">
            <img src="<?php echo URLROOT;?>images/packages/Uththara.jpg" alt="User Profile Photo">
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
            <li><a href="<?php echo URLROOT;?>packages/packages" class="nav-button active"><i class= 'bx bxs-package bx-sm'></i> Packages</a></li>
            <li><a href="<?php echo URLROOT;?>packages/review" class="nav-button"><i class='bx bxs-star bx-sm bx-fw'></i> Review</a></li>
            <li><a href="<?php echo URLROOT;?>packages/settings" class="nav-button "><i class='bx bxs-cog bx-sm bx-fw'></i> Settings</a></li>
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
            <h1>Packages</h1>
        </div>

        <div class="dashboard-sub-content">
            <div class="top-boxes">
                <!-- Small Image Boxes -->
                <div class="img-box">
                    <img src="<?php echo URLROOT;?>images/packages/dashboard.jpg" alt="hotel Image">
                </div>
               
    
                <!-- Total Bookings Box -->
                <div class="box">
                    <h2>Total Packages</h2>
                    <p>20</p>
                </div>
            
                <!-- Ongoing Bookings Box -->
                <div class="box">
                    <h2>Ongoing Packages</h2>
                    <p>18</p>
                </div>
            
                <!-- Customers Box -->
                <div class="box">
                    <h2>Total Customers</h2>
                    <p>15</p>
                </div>
            </div>
        </div>

        <div class="search-content">
            <div class="booking-search">
                <input type="text" id="booking-search" placeholder="Search for Pacakges">
                <button onclick="filterBookings()">
                    <i class="bx bx-search"></i> <!-- Using the Boxicons search icon -->
                </button>
            </div>
            </div>
           
            <div class="table-content">
            <h2>All Packages</h2>
                <table class="booking-table">
                    <thead>
                        <tr>
                            <th>Package Name</th>
                            <th>Package Owner</th>
                            <th>Description</th>
                            <th>Location</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                            
                        <tr>
                            <td>Aqua Adventure</td>
                            <td>Wikum Preethika</td>
                            <td>Exploration of underwater life</td>
                            <td>Galle</td>
                            <td>25000 LKR</td>
                            <td class="pending">Pending</td>
                            <td>
                                <button class="view-button">View</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Aqua Adventure</td>
                            <td>Wikum Preethika</td>
                            <td>Exploration of underwater life</td>
                            <td>Galle</td>
                            <td>25000 LKR</td>
                            <td class="pending">Pending</td>
                            <td>
                                <button class="view-button">View</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Aqua Adventure</td>
                            <td>Wikum Preethika</td>
                            <td>Exploration of underwater life</td>
                            <td>Galle</td>
                            <td>25000 LKR</td>
                            <td class="approved">Approved</td>
                            <td>
                                <button class="view-button">View</button>
                            </td>
                        </tr>   
                    </tbody>
                </table>
            </div>
    
            <div class="more-content">
                <button class="next-page-btn">See More <i class='bx bx-chevron-right'></i></button>
            </div>

    </main>
</body>
</html>
