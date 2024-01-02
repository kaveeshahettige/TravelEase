<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/admin/package.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="<?php echo URLROOT?>/js/admin/script.js"></script>
    <title></title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/admin/x-icon" href="<?php echo URLROOT; ?>/images/admin/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <nav class="left-menu">
        <div class="user-profile">
            <img src="<?php echo URLROOT; ?>/images/admin/wikum.jpg" alt="User Profile Photo">
            <span class="user-name"><?php echo ucfirst($data['fname'])?></span>
        </div>
        
        <div class="search-bar">
            <form action="#" method="GET">
                <input type="text" placeholder="Find a Setting">
                <button type="submit">Search</button>
            </form>
        </div>
        
            
        <ul>
            <li><a href="<?php echo URLROOT; ?>admin/index" ><i class='bx bxs-dashboard bx-sm'></i> Overview</a></li>
            <li><a href="<?php echo URLROOT; ?>admin/request" ><i class='bx bxs-book bx-sm'></i> Request</a></li>
            <li><a href="<?php echo URLROOT; ?>admin/traveler" ><i class='bx bx-child bx-sm'></i></i> Traveler</a></li>

            <li><a href="<?php echo URLROOT; ?>admin/hotel"><i class='bx bxs-hotel bx-sm'></i></i> Hotels</a></li>
            <li><a href="<?php echo URLROOT; ?>admin/agency"><i class='bx bxs-car bx-sm'></i> Travel Agencies </a></li>
            <li><a href="<?php echo URLROOT; ?>admin/package" class="active"><i class='bx bx-package bx-sm'></i>Packages</a></li>
            <li><a href="<?php echo URLROOT; ?>admin/settings"><i class='bx bxs-cog bx-sm'></i> Settings</a></li>
            <li><a href="<?php echo URLROOT; ?>users/logout" class="active"><i class='bx bxs-log-out bx-sm bx-fw'></i> Logout</a></li>
        </ul> 
        
        <!-- <div class="logout">
            <a href="<?php echo URLROOT; ?>pages/indes" class="active"><i class='bx bxs-log-out bx-sm bx-fw'></i>  Logout</a>
        </div> -->
    </nav>
    <main>
        <div class="logo-container">
            <img src="<?php echo URLROOT; ?>/images/admin/TravelEase.png" alt="TravelEase Logo">
            <span class="logo-text">TravelEase</span>
        </div>
        
        <div class="dashboard-content">
            <h1>Packages</h1>
        </div>

        <div class="dashboard-sub-content">
        <div class="top-boxes">
 
            <!-- Total Request Box -->
            <div class="box">
                <h2>Total Packages</h2>
                <p><?php echo $data['no']?></p>
            </div>
        

        </div>
        </div>

        <div class="search-content">
        <div class="booking-search">
            <input type="text" id="booking-search" placeholder="Search Hotels">
            <button onclick="filterBookings()">
                <i class="bx bx-search"></i> <!-- Using the Boxicons search icon -->
            </button>
        </div>
        </div>
       
        <div class="table-content">
        <h2>Packages Details</h2>
            <table class="booking-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Registered Number</th>
                        <th>Packages Name</th>
                        
                        <!-- <th>Provider Name</th> -->
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                        
                <?php
$count=1;
                foreach ($data['package'] as $user) {
                    echo '<tr class="t-row">';
    echo '<td>' . $count . '</td>';
    echo '<td>' . $user->id . '</td>';
    echo '<td>' . ucfirst($user->fname).'  '.ucfirst($user->lname) . '</td>';
    echo '<td><button class="view-button">View</button>&nbsp;
    <button onclick="deleteGuide(' . $user->id . ')" class="view-button">Delete</button></td>';
    echo '</tr>';
    $count++;
}?>
                </tbody>
            </table>
        </div>

        <div class="more-content">
            <button class="next-page-btn" id="moreBtn">More Packages <i class='bx bx-chevron-right'></i></button>
        </div>

    </main>
</body>
</html>
