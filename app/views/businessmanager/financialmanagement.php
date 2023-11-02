<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/businessmanager/manager-financial management.css">
    <title>Business Financial Management</title>
    <link rel="icon" type="<?php echo URLROOT?>/images/x-icon" href="<?php echo URLROOT?>/images/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <nav class="left-menu">
        <div class="user-profile">
            <img src="<?php echo URLROOT?>/images/wikum.jpg" alt="User Profile Photo">
            <span class="user-name">Business Manager Name</span>
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
            <li><a href="<?php echo URLROOT; ?>businessmanager/financialmanagement" class="nav-button active"><i class='bx bx-line-chart bx-sm'></i> Financial Management</a></li>
            <li><a href="<?php echo URLROOT; ?>businessmanager/settings" class="nav-button "><i class='bx bxs-cog bx-sm'></i> Settings</a></li>
        </ul>
    
    <div class="logout">
        <a href="#"class="nav-button active"><i class='bx bxs-log-out bx-sm bx-fw'></i>  Logout</a>
    </div>

    </nav>
    <main>
        <div class="logo-container">
            <img src="<?php echo URLROOT?>/images/TravelEase.png" alt="TravelEase Logo">
            <span class="logo-text">TravelEase</span>
        </div>
        <div class="dashboard-content">
            <h1>Financial Management</h1>
        </div>

        <div class="dashboard-sub-content">
            <div class="top-boxes">
                <!-- Small Image Boxes -->
                <div class="img-box">
                    <img src="<?php echo URLROOT?>/images/dashboard.jpg" alt="hotel Image">
                </div>
               
    
                <!-- Total Bookings Box -->
                <div class="box">
                    <h2>Total Revenue</h2>
                    <p>45,000 LKR</p>
                </div>
            
                <!-- Ongoing Bookings Box -->
                <div class="box">
                    <h2>Revenue Recieved</h2>
                    <p>30,000 LKR</p>
                </div>
            
                <!-- Customers Box -->
                <div class="box">
                    <h2>To Recieve</h2>
                    <p>12,000 LKR</p>
                </div>
            </div>
        
                
            </div>

        <div class = "search-content">
            <input type="text" id="transaction-search" placeholder="Search Transactions">
            <button class="filter-button"><i class='bx bx-filter-alt'></i></button>
        </div>
        
        <div class="table-content">
                <h2>All Transactions</h2>
                    <table class="transaction-table">
                        <thead>
                            <tr>
                                <th>Service Provider</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Account Number</th>
                                <th>Payment Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                                
                            <tr>
                                <td><div class="service-provider-info">
                                    <img src="<?php echo URLROOT?>/images/wikum.jpg" alt="Service Provider Photo">
                                    <span>Wikum Preethika</span>
                                </div></td>
                                <td>5000 LKR</td>
                                <td>2023-09-25</td>
                                <td>1234567890</td>
                                <td class="pending">Pending</td>
                                <td><button class="view-button">View</button></td>
                            </tr>

                            <tr>
                                <td><div class="service-provider-info">
                                    <img src="<?php echo URLROOT?>/images/wikum.jpg" alt="Service Provider Photo">
                                    <span>Wikum Preethika</span>
                                </div></td>
                                <td>5000 LKR</td>
                                <td>2023-09-25</td>
                                <td>1234567890</td>
                                <td class="pending">Pending</td>
                                <td><button class="view-button">View</button></td>
                            </tr>

                            <tr>
                                <td><div class="service-provider-info">
                                    <img src="<?php echo URLROOT?>/images/wikum.jpg" alt="Service Provider Photo">
                                    <span>Wikum Preethika</span>
                                </div></td>
                                <td>5000 LKR</td>
                                <td>2023-09-25</td>
                                <td>1234567890</td>
                                <td class="approved">Approved</td>
                                <td><button class="view-button">View</button></td>
                            </tr>
                
                        </tbody>
                    </table>
        </div>

    </main>
</body>
</html>
