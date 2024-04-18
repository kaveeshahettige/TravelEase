<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/bookings.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/navigation.css">
    <title>Packages Bookings</title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/hotel/x-icon" href="<?php echo URLROOT; ?>/images/hotel/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<?php
$userData = $data['userData'];
?>
<?php
$activePage = 'packages/bookings'; // Set the active page dynamically based on your logic
include 'navigation.php';
?>


<main>
    <div class="logo-container">
        <img src="<?php echo URLROOT; ?>/images/hotel/TravelEase.png" alt="TravelEase Logo">
        <span class="logo-text">TravelEase</span>
    </div>

    <div class="dashboard-content">
        <h1>Bookings</h1>
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

    <div class="search-content">
        <div class="booking-search">
            <input type="text" id="booking-search" placeholder="Search for Boookings">
            <button onclick="filterBookings()">
                <i class="bx bx-search"></i> <!-- Using the Boxicons search icon -->
            </button>
        </div>
    </div>

    <div class="table-content">
        <h2>Booking Details</h2>
        <table class="booking-table">
            <thead>
            <tr>
                <th>No</th>
                <th>Guest Name</th>
                <th>Check-in Date</th>
                <th>Check-out Date</th>
                <th></th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>


            <?php
            $bookings = $data["bookings"];
            foreach ($bookings as $key => $booking): ?>
                <tr>
                    <td><?php echo $key + 1; ?></td>
                    <td><?php echo $booking->fname; ?></td>
                    <td><?php echo $booking->startDate; ?></td>
                    <td><?php echo $booking->endDate; ?></td>
                    <td><?php echo $booking->roomType; ?></td>
                    <td>
                        <button class="view-button" onclick="openPopup(); updatePopupDetails('<?php echo $booking->profile_picture; ?>','<?php echo $booking->fname; ?>', '<?php echo $booking->startDate; ?>', '<?php echo $booking->roomType; ?>')">
                            <i class='bx bx-show'></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>


            </tbody>
        </table>
    </div>


    <div class="more-content">
        <button class="next-page-btn">More Bookings <i class='bx bx-chevron-right'></i></button>
    </div>

</main>

<div class="popup" id="popup">
    <div class="popup-content">
        <span class="close" onclick="closePopup()">&times;</span>
        <!-- Add details about the booking here -->
        <h2>Booking Details</h2>
        <div id="profile-picture" class="profile-picture"></div>
        <p id="guestName">Guest Name: John Doe</p>
        <p id="checkInDate">Check-in Date: 2023-09-01</p>
        <p id="roomType">Room Type: Single Room</p>
        <!-- Add more details as needed -->
    </div>
</div>
<script src= "<?php echo URLROOT?>/public/js/hotel/bookings.js"></script>
</body>
</html>
