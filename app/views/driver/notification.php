<!-- <?php var_dump($data["notification"]); ?> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/driver/notification.css">
    <title><?php echo SITENAME ?></title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/driver/x-icon" href="<?php echo URLROOT; ?>/images/driver/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <nav class="left-menu">
       <div class="user-profile">
            <img src="<?php echo URLROOT; ?>/images/<?php echo $data['profileimage']->profile_picture ?>" alt="User Profile Photo">
            <span class="user-name"><?php echo $_SESSION['user_fname'].' '.$_SESSION['user_lname']?></span>
            <a class="" href="<?php echo URLROOT; ?>/driver/notification">
                <i class="bx bx-bell"></i>
            </a>
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
            <li><a href="<?php echo URLROOT; ?>driver/earings"><i class='bx bx-money-withdraw bx-sm'></i>Earings and Payments</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/notification" class="active"><i class='bx bxs-bell bx-sm bx-sm'></i>Notification</a></li>
            
            <li><a href="<?php echo URLROOT; ?>driver/reviews"><i class='bx bxs-star bx-sm bx-fw'></i> Reviews</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/settings"><i class='bx bxs-cog bx-sm'></i> Settings</a></li>
            <li><a href="<?php echo URLROOT?>users/logout" class="active"><i class='bx bxs-log-out bx-sm bx-fw'></i> Logout</a></li>
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
            <h1>Notifications</h1>
        </div>

        <div class="dashboard-sub-content">
        <div class="top-boxes">
 
            <!-- Total Request Box -->
            <div class="box">
                <h2>Total Notification</h2>
                <p><?php echo $data['count'];?></p>
            </div>
        

        </div>
        </div>

        <div class="search-content">
        <div class="booking-search">
            <input type="text" id="booking-search" placeholder="Search Notifications">
            <button onclick="filterBookings()">
                <i class="bx bx-search"></i> <!-- Using the Boxicons search icon -->
            </button>
        </div>
        </div>

        

        <div class="notifications-content">
    <?php
    $notification = $data["notification"];
    if (!empty($notification)) {
        foreach ($notification as $key => $notifications):
            if ($notifications->markAsRead == 0) {
                ?>
                <div class="notification-item">
                    <!-- Assuming you have an image path stored in $notification->sender_image -->
                    <img src="<?php echo URLROOT; ?>/images/<?php echo $notifications->profile_picture; ?>" alt="Sender Image" class="sender-image">

                    <div class="notification-text-container">
                        <span class="sender-name"><?php echo $notifications->fname." ".$notifications->lname ?></span>
                        <span class="notification-date"><?php echo $notifications->nDate; ?></span>
                        <p class="notification-text"><?php echo $notifications->notification; ?></p>
                        <button onclick="markAsRead(<?php echo $notifications->notification_id; ?>)" class="mark-as-read-btn">Mark as read</button>
                    </div>
                </div>
                <?php
            }
        endforeach;
    } else {
        echo "<h3>No new notifications to display.</h3>";
    }
    ?>
</div>

       

    </main>

    <script>
        function markAsRead(notification_id) {
    var form = new FormData();
    form.append('notification_id', notification_id);

    fetch('http://localhost/TravelEase/driver/markNotificationAsRead', {
        method: 'POST',
        body: form
    })
        .then(async function(response) {
            if (response.ok) {
                const data = await response.json();
                console.log(data);
                console.log('Notification marked as read successfully');
                window.location.reload();
            } else {
                console.error('Error marking notification as read:', response.status);
            }
        })
        .catch(function(error) {
            console.error('Error marking notification as read:', error);
        });
}
    </script>
</body>
</html>
