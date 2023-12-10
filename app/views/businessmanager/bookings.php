<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/businessmanager/manager-bookings.css">
    <title>Business Manager Bookings</title>
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
            <li><a href="<?php echo URLROOT; ?>businessmanager/bookings"class="nav-button active"><i class='bx bxs-book bx-sm'></i> Bookings</a></li>
            <li><a href="<?php echo URLROOT; ?>businessmanager/packages" class="nav-button"><i class='bx bxs-package bx-sm'></i></i> Packages</a></li>
            <li><a href="<?php echo URLROOT; ?>businessmanager/reports" class="nav-button"><i class='bx bxs-report bx-sm'></i> Reports</a></li>
            <li><a href="<?php echo URLROOT; ?>businessmanager/financialmanagement" class="nav-button"><i class='bx bx-line-chart bx-sm'></i> Financial Management</a></li>
            <li><a href="<?php echo URLROOT; ?>businessmanager/settings" class="nav-button"><i class='bx bxs-cog bx-sm'></i> Settings</a></li>
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
            <h1>Bookings</h1>
        </div>

        <div class="dashboard-sub-content">
        <div class="top-boxes">
            <!-- Small Image Boxes -->
            <div class="img-box">
                <img src="<?php echo URLROOT?>/images/dashboard.jpg" alt="hotel Image">
            </div>
           

            <!-- Total Bookings Box -->
            <div class="box">
                <h2>Total Bookings</h2>
                <p>120</p>
            </div>
        
            <!-- Ongoing Bookings Box -->
            <div class="box">
                <h2>Ongoing Bookings</h2>
                <p>35</p>
            </div>
        
            <!-- Customers Box -->
            <div class="box">
                <h2>Total Customers</h2>
                <p>10</p>
            </div>
        </div>
        </div>

        <div class="search-content">
        <div class="booking-search">
            <input type="text" id="booking-search" placeholder="Search for Boookings">
            <button onclick="filterBookings()">
                <i class="bx bx-search"></i> <!-- Using the Boxicons search icon -->
            </button>
        </div>
        </div>
       
        <div class="table-content">
        <h2>All Bookings</h2>
            <table class="booking-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Guest Name</th>
                        <th>Service</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                        
                    <tr>
                        <td>1</td>
                        <td>Wikum Preethika</td>
                        <td>Hotel</td>
                        <td>Full Paid</td>
                        <td><button class="view-button">View</button></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Kaveesha Hettige</td>
                        <td>Transporation provider</td>
                        <td>Full Paid</td>
                        <td><button class="view-button">View</button></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Dilanga</td>
                        <td>Package</td>
                        <td>Full Paid</td>
                        <td><button class="view-button">View</button></td>
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
