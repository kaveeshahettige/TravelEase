<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/gallery.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/navigation.css">
    <title>Hotel Notifications</title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/hotel/x-icon" href="<?php echo URLROOT; ?>/images/hotel/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<?php
$activePage = 'hotel/gallery'; // Set the active page dynamically based on your logic
include 'navigation.php';
?>
    <main>
        <div class="logo-container">
            <img src="<?php echo URLROOT; ?>/images/hotel/TravelEase.png" alt="TravelEase Logo">
            <span class="logo-text">TravelEase</span>
        </div>
        
        <div class="dashboard-content">
            <h1>Notifications</h1>
        </div>

        <div class="dashboard-sub-content">
            <div class="top-boxes">
                <!-- Small Image Boxes -->
                <div class="img-box">
                    <img src="<?php echo URLROOT; ?>/images/hotel/dashboard.jpg" alt="hotel Image">
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

        <div class="notifications-content">
            <?php
                $notifications = $data["notifications"];
                foreach ($notifications as $key => $notification):
                var_dump($notification);
                ?>

                <div class="notification-item">
                    <!-- Assuming you have an image path stored in $notification->sender_image -->
                    <img src="<?php echo $notification->sender_image; ?>" alt="Sender Image" class="sender-image">

                    <div class="notification-text-container">
                        <span class="sender-name"><?php echo $notification->sender_name; ?></span>
                        <span class="notification-date"><?php echo $notification->created_at; ?></span>
                        <p class="notification-text"><?php echo $notification->message; ?></p>
                        <a href="<?php echo URLROOT . '/hotel/markNotificationAsRead/' . $notification->id; ?>" class="mark-as-read-btn">Mark as Read</a>
                    </div>

                    <div class="read-status-dot <?php echo $notification->is_read ? 'read' : 'unread'; ?>"></div>
                </div>
            <?php endforeach; ?>
        </div>

        <script src= "<?php echo URLROOT?>/public/js/hotel/notifications.js"></script>
    </main>
</body>
</html>
