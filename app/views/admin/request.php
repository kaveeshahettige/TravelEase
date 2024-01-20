<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/admin/request.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script src="<?php echo URLROOT?>/js/admin/script.js"></script>
    <title>TravelEase</title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/admin/x-icon" href="<?php echo URLROOT?>/images/TravelEase_logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <nav class="left-menu">
        <div class="user-profile">
            <img src="<?php echo URLROOT; ?>/images/admin/wikum.jpg" alt="User Profile Photo">
            <span class="user-name"><?php echo ucfirst($data['fname']); ?></span>
        </div>
        
        <div class="search-bar">
            <form action="#" method="GET">
                <input type="text" placeholder="Find a Setting">
                <button type="submit">Search</button>
            </form>
        </div>
        <ul>
            <li><a href="<?php echo URLROOT; ?>admin/index" ><i class='bx bxs-dashboard bx-sm'></i> Overview</a></li>
            <li><a href="<?php echo URLROOT; ?>admin/request" class="active" ><i class='bx bxs-book bx-sm'></i> Request</a></li>
            <li><a href="<?php echo URLROOT; ?>admin/traveler" ><i class='bx bx-child bx-sm'></i></i> Traveler</a></li>

            <li><a href="<?php echo URLROOT; ?>admin/hotel"><i class='bx bxs-hotel bx-sm'></i></i> Hotels</a></li>
            <li><a href="<?php echo URLROOT; ?>admin/agency"><i class='bx bxs-car bx-sm'></i> Travel Agencies </a></li>
            <li><a href="<?php echo URLROOT; ?>admin/package"><i class='bx bx-package bx-sm'></i>Packages</a></li>
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
            <h1>Requests</h1>
        </div>

        <div class="dashboard-sub-content">
        <div class="top-boxes">
 
            <!-- Total Request Box -->
            <div class="box">
                <h2>Total Requests</h2>
                <p><?php echo $data['nore'] ?></p>
            </div>
        

        </div>
        </div>

        <div class="search-content">
        <div class="booking-search">
            <input type="text" id="booking-search" placeholder="Search for Requesting">
            <button onclick="filterBookings()">
                <i class="bx bx-search"></i> <!-- Using the Boxicons search icon -->
            </button>
        </div>
        </div>
       
        <div class="table-content">
        <h2>Request Details</h2>
            <table class="booking-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Provider Type</th>
                        <th>Document</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
$count = 1;

if (!empty($data['requests']) && is_array($data['requests'])) {
    foreach ($data['requests'] as $user) {
        echo '<tr class="t-row">';
        echo '<td>' . $count . '</td>';
        echo '<td>' . $user->id . '</td>';
        echo '<td>' . $user->fname . '</td>';
        echo '<td>';
        switch ($user->type) {
            case 3:
                echo 'Hotel';
                break;
            case 4:
                echo 'Travel Agency';
                break;
            case 5:
                echo 'Guide';
                break;
        }
        echo '</td>';
        // echo '<td>' . $user->document .'</td>';
        // Assuming $user->documentName contains the document name
        echo '<td><button class="view-button" onclick="openDocument(\'' . $user->document . '\')">View Document</button></td>';
        // echo '<td> <button class="view-button" onclick="viewDocument(' . $user->id . ')">View Document</button></td>';
        echo '<td> <button class="accept-button" onclick="acceptUser(' . $user->id . ')">Accept</button> <button class="decline-button" onclick="declineUser(' . $user->id . ')">Decline</button></td>';
        echo '</tr>';
        $count++;
    }
} else {
    echo '<tr><td colspan="6">No requests available</td></tr>';
}
?>
    
                   
                </tbody>
            </table>
        </div>

        <div class="more-content">
            <button class="next-page-btn"  id="moreBtn">More Bookings <i class='bx bx-chevron-right'></i></button>
        </div>

    </main>
</body>
</html>
