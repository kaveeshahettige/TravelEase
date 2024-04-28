<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>css/travelerDashboard/settings/style.css">
    <title>Dashboard</title>
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT?>images/TravelEase_logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="<?php echo URLROOT?>js/travelerDashboard/script.js"></script>
</head>
<body>
    <nav class="left-menu">
        <div class="user-profile">
            <img style="cursor: pointer;" src="<?php echo empty($data['profile_picture']) ? URLROOT.'images/user.jpg' : URLROOT.'images1/'.$data['profile_picture']; ?>" alt="Profile Picture" alt="User Profile Photo" onclick="gotoHome()"> 
            <span class="user-name" style="font-weight: bold;"><?php echo  $data['user']->fname."  ". $data['user']->lname?></span>

        </div>
        
        <div class="search-bar">
            <form action="#" method="GET">
                <input type="text" placeholder="Find a Setting">
                <button type="submit">Search</button>
            </form>
        </div>
        
            
        <ul>
            <li><a href="<?php echo URLROOT?>travelerDashboard/index/<?php echo $_SESSION['user_id']?>" class="active"><i class='bx bxs-dashboard bx-sm'></i> Overview</a></li>
            <li><a href="<?php echo URLROOT?>travelerDashboard/bookings/<?php echo $_SESSION['user_id']?>"><i class='bx bxs-book bx-sm'></i> Bookings</a></li>
            <li><a href="<?php echo URLROOT?>travelerDashboard/payments/<?php echo $_SESSION['user_id']?>"><i class='bx bxs-package bx-sm'></i></i> Payments</a></li>
            <li><a href="<?php echo URLROOT?>travelerDashboard/notifications/<?php echo $_SESSION['user_id']?>"><i class='bx bxs-report bx-sm'></i> Notifications</a></li>
            <li><a href="<?php echo URLROOT?>travelerDashboard/previoustrips/<?php echo $_SESSION['user_id']?>"><i class='bx bx-line-chart bx-sm'></i> Previous Trips</a></li>
            <li><a href="<?php echo URLROOT?>travelerDashboard/cart/<?php echo $_SESSION['user_id']?>"><i class='bx bx-cart bx-sm'></i> Wish List</a></li>
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
        
        <div class="dashboard-content">
            <h1>Overview</h1>
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
                            
                            <h3><?php echo  $data['user']->fname."  ". $data['user']->lname?></h3><br>
                            <h6 style="font-weight:bold">Registration Number: <?php echo $data['user']->id?></h6><br>
                            <h6 style="font-weight:bold"><?php echo $data['user']->email?></h6> <br>  
                            <h6 style="font-weight:bold"><?php echo $data['user']->number?></h6> <br>
                        </div>   
                    </div>
                </div>
                <!-- <div class="rectangle">
                   
                    <div class="basic-info-content">
                        <div class="center-image" >
                        
                            <img style="cursor:pointer;transition: box-shadow 0.8s;" onclick="triggerClick()" id="profileDisplay" src="<?php echo empty($data['profile_picture']) ? URLROOT.'images/user.jpg' : URLROOT.'images1/'.$data['profile_picture']; ?>" alt="Profile Picture">  
                        </div>
                        <div class="hotel-details">
                            
                            <h3><?php echo  $data['user']->fname."  ". $data['user']->lname?></h3><br>
                            <h6 style="font-weight:bold">Registration Number: <?php echo $data['user']->id?></h6><br>
                            <h6 style="font-weight:bold"><?php echo $data['user']->email?></h6> <br>  
                            <h6 style="font-weight:bold"><?php echo $data['user']->number?></h6> <br>
                        </div>   
                    </div>
                </div> -->
            
                
         </div>
         
         

            <div class="right-content">

                <div class="rectangle">
                    <!-- Rectangle 2: Change Password -->
                    <div class="basic-info-content">
                        <h2 style="margin-top:0px;">Total Monthly Bookings</h2>
                        <h4 style="font-weight:bold; margin:0px;"><?php echo $data['noOfBooking']; ?></h4> 
                    </div>      
                </div>
                <div class="rectangle">
                    <!-- Rectangle 2: Change Password -->
                <div class="basic-info-content">
                        <h2 style="margin-top:0px;">Upcoming Trips</h2>
                        <h4 style="font-weight:bold; margin:0px;"><?php echo $data['noOfUpcomingTrips']; ?></h4>
                        <button type="button" onclick="viewBookings(<?php echo $_SESSION['user_id']?>)">View</button>

                </div>
    
                </div>
                <div class="rectangle">
                    <!-- Rectangle 2: Change Password -->
                    <div class="basic-info-content">
                        <h2 style="margin-top:0px;">Total Monthly Payments</h2>
                        <h4 style="font-weight:bold; margin:0px;"><?php echo $data['monthlyPayment']; ?> LKR</h4> 
                        <button type="button" onclick="viewPayments(<?php echo $_SESSION['user_id']?>)">View</button>

                    </div>      
                </div>
                <div class="rectangle">
                    <!-- Rectangle 2: Change Password -->
                    <div class="basic-info-content">
                        <h2 style="margin-top:0px;">Feedbacks provided</h2> 
                        <h4 style="font-weight:bold; margin:0px;"><?php echo $data['noOfFeedbacks']; ?></h4>   
                                                
                    </div>      
                </div>
                

                
                
            </div>

        </div>

    </div>
    </main>
    
    
</body>
</html>
