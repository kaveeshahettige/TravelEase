<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/driver/earings.css">
    <title><?php echo SITENAME ?></title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/driver/x-icon" href="<?php echo URLROOT; ?>/images/driver/TravelEase.png">
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
            <li><a href="<?php echo URLROOT; ?>driver/earings" class="active"><i class='bx bx-money-withdraw bx-sm'></i>Earings and Payments</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/notification"><i class='bx bxs-bell bx-sm'></i>Notification</a></li>
            
            <li><a href="<?php echo URLROOT; ?>driver/reviews"><i class='bx bxs-star bx-sm bx-fw'></i> Reviews</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/settings"><i class='bx bxs-cog bx-sm'></i> Settings</a></li>
            <li><a href="<?php echo URLROOT; ?>pages/indes" class="active"><i class='bx bxs-log-out bx-sm bx-fw'></i> Logout</a></li>
        </ul>
        <!-- <div class="logout">
            <a href="<?php echo URLROOT; ?>pages/indes" class="active"><i class='bx bxs-log-out bx-sm bx-fw'></i>  Logout</a>
        </div> -->
    </nav>
    <main>
        <div class="logo-container">
            <img src="<?php echo URLROOT; ?>/images/driver/TravelEase.png" alt="TravelEase Logo">
            <span class="logo-text">TravelEase</span>
        </div>

         <div class="dashboard-content">
            <h1>Earings and Payments</h1>
        </div>

        <div class="dashboard-sub-content">
            <div class="top-boxes">
    <!-- Total Bookings Box -->
                <div class="box">
                    <h2>Total Earnings</h2>
                    <p>$8,750</p>
                </div>
            
                <!-- Ongoing Bookings Box -->
                <div class="box">
                    <h2>Last Payout</h2>
                    <p>September 30, 2023</p>
                </div>

            </div>
            </div>
       
        <div class="table-content">
        <h2>Earnings Summary</h2>
            <table class="booking-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Time Period</th>
                        <th>Earnings</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                        
                    <tr>
                        <td>1</td>
                        <td>Daily</td>
                        <td>$250</td>
                        <td><button class="view-button">View</button></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Weekly</td>
                        <td>$1,500</td>
                        <td><button class="view-button">View</button></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Monthly</td>
                        <td>$6,000</td>
                        <td><button class="view-button">View</button></td>
                    </tr>   
                </tbody>
            </table>
        </div>

        <div class="dashboard-sub-content">
            <div class="top-boxes">
    <!-- Total Bookings Box -->

                <!-- Customers Box -->
                <div class="box">
                    <h2>Last Payment</h2>
                    <p>$100 on September 1, 2023</p>
                </div>
            </div>
            </div>

        <div class="table-content">
            <h2>Payment History</h2>
                <table class="booking-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Transaction ID</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                            
                        <tr>
                            <td>1</td>
                            <td>2023-09-01</td>
                                <td>$100</td>
                                <td>TXN12345</td>
                            <td><button class="view-button">View</button></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>2023-08-25</td>
                                <td>$75</td>
                                <td>TXN67890</td>
                            <td><button class="view-button">View</button></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>2023-09-01</td>
                                <td>$100</td>
                                <td>TXN12345</td>
                            <td><button class="view-button">View</button></td>
                        </tr>   
                    </tbody>
                </table>
            </div>
    
            <div class="more-content">
                <button class="next-page-btn">More Payments <i class='bx bx-chevron-right'></i></button>
            </div>

    </main>
</body>
</html>
