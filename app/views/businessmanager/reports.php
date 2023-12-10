<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/businessmanager/manager-reports.css">
    <title>Business Manager Reports</title>
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
            <li><a href="<?php echo URLROOT; ?>businessmanager/bookings"class="nav-button"><i class='bx bxs-book bx-sm'></i> Bookings</a></li>
            <li><a href="<?php echo URLROOT; ?>businessmanager/packages" class="nav-button"><i class='bx bxs-package bx-sm'></i></i> Packages</a></li>
            <li><a href="<?php echo URLROOT; ?>businessmanager/reports active" class="nav-button active"><i class='bx bxs-report bx-sm'></i> Reports</a></li>
            <li><a href="<?php echo URLROOT; ?>businessmanager/financialmanagement" class="nav-button"><i class='bx bx-line-chart bx-sm'></i> Financial Management</a></li>
            <li><a href="<?php echo URLROOT; ?>businessmanager/settings" class="nav-button"><i class='bx bxs-cog bx-sm'></i> Settings</a></li>
        </ul> 
            
            
        
        
        <div class="logout">
            <a href="<?php echo URLROOT; ?>users/logout" class="active"><i class='bx bxs-log-out bx-sm bx-fw'></i>  Logout</a>
        </div>
    </nav>
    <main>
        <div class="logo-container">
            <img src="<?php echo URLROOT?>/images/TravelEase.png" alt="TravelEase Logo">
            <span class="logo-text">TravelEase</span>
        </div>
        <div class="dashboard-content">
            <h1>Reports</h1>
        </div>


        <div class="dashboard-content">

            <div class="filter-option">
                <label for="service-type">Service Type:</label>
                <select id="service-type">
                    <option value="hotel">Hotel</option>
                    <option value="transport">Transport Provider</option>
                    <option value="transport">Packages</option>
                </select>
            </div>

            <div class="filter-option">
                <label for="service-type">Service Provider:</label>
                <select id="service-type">
                    <option value="hotel">Hotel</option>
                    <option value="transport">User Activity</option>
                </select>
            </div>

            <div class="filter-option">
                <label for="service-type">Report Type:</label>
                <select id="service-type">
                    <option value="hotel">Money Earned</option>
                    <option value="transport">User Activity</option>
                </select>
            </div>

            <div class="filter-options">
                <div class="filter-option">
                    <label for="time-range">Time Range:</label>
                    <select id="time-range">
                        <option value="last-week">Last Week</option>
                        <option value="last-month">Last Month</option>
                        <option value="last-year">Last Year</option>
                    </select>
                </div>
            
                

                
                
            </div>
        </div>

        <div class="table-content">
            <h2>Previous Reports</h2>
                <table class="booking-table">
                    <thead>
                        <tr>
                            <th>Time Range</th>
                            <th>Service Type</th>
                            <th>Service Provider Name</th>
                            <th>Report type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                            
                        <tr>
                            <td>2023-09-15 to 2023-10-15 </td>
                            <td>Hotels</td>
                            <td>Hotel Name</td>
                            <td>Money Earned</td>
                            <td>
                                <button class="view-button">View</button>
                                <button class="download-button">Download</button>
                            </td>
                        </tr>

                        <tr>
                            <td>2023-09-15 to 2023-10-15 </td>
                            <td>Hotels</td>
                            <td>Hotel Name</td>
                            <td>Money Earned</td>
                            <td>
                                <button class="view-button">View</button>
                                <button class="download-button">Download</button>
                            </td>
                        </tr>

                        <tr>
                            <td>2023-09-15 to 2023-10-15 </td>
                            <td>Hotels</td>
                            <td>Hotel Name</td>
                            <td>Money Earned</td>
                            <td>
                                <button class="view-button">View</button>
                                <button class="download-button">Download</button>
                            </td>
                        </tr>
                          
                    </tbody>
                </table>
            </div>
        

    </main>
</body>
</html>
