<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>css/travelerDashboard/style.css">
    <title>  Dashboard</title>
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
            <li><a href="<?php echo URLROOT?>travelerDashboard/index/<?php echo $_SESSION['user_id']?>" class="active"><i class='bx bxs-dashboard bx-sm'></i> Overview</a></li>
            <li><a href=""><i class='bx bxs-book bx-sm'></i> Bookings</a></li>
            <li><a href=""><i class='bx bxs-package bx-sm'></i></i> Payments</a></li>
            <li><a href=""><i class='bx bxs-report bx-sm'></i> Notifications</a></li>
            <li><a href=""><i class='bx bx-line-chart bx-sm'></i> Previous Trips</a></li>
            <li><a href="<?php echo URLROOT?>travelerDashboard/settings/<?php echo $_SESSION['user_id']?>"><i class='bx bxs-cog bx-sm'></i> Settings</a></li>
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
        <div class="right">
            <div class="item2">
                <span id="pageTitle">Overview</span>
                
                </div>

                <div class="item4">
                    <div class="profile-card">
                        <div class="profilepicture">
                        <img src="<?php echo empty($data['profile_picture']) ? URLROOT.'images/user.jpg' : URLROOT.'images1/'.$data['profile_picture']; ?>" alt="Profile Picture" alt="User Profile Photo"> 
                        </div>
                        <div class="profileinfo">
                            <h1><?php echo $_SESSION['user_fname']."  ".$_SESSION['user_lname']?></h1>
                            <h4 style="font-weight:bold"><?php echo $_SESSION['user_email']?></h4>
                            <h4 style="font-weight:bold">Registration Number: <?php echo $_SESSION['user_id']?></h4>
                            
                        </div>
                    </div>
                    
                    <table class="summary">
                        <thead>
                            <tr>
                                <th>Bookings</th>
                                <th>Upcoming Trips</th>
                                <th>Payments</th>
                                <th>Feedbacks provided</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>10</td>
                                <td>2</td>
                                <td>$30000</td>
                                <td>4</td>
                            </tr>
                            <!-- Add more rows for additional trip summaries -->
                        </tbody>
                    </table>
                </div>
        </div>
    </main>
</body>
</html>
