<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/bookings.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/navigation.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/popup.css">
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
            <?php
            $bookingCount = $data["bookingCount"];
            ?>
            <div class="box">
                <h2>Total Bookings</h2>
                <p><?php echo $bookingCount;?></p>
            </div>

            <!-- Ongoing Bookings Box -->
            <?php
            $totalRevenue = $data["totalRevenue"];
            ?>
            <div class="box">
                <h2>Total Revenue</h2>
                <p><?php echo $totalRevenue;?> LKR</p>
            </div>

            <!-- Customers Box -->
            <?php
            $guestCount = $data["guestCount"];
            ?>
            <div class="box">
                <h2>Total Customers</h2>
                <p><?php echo $guestCount; ?></p>
            </div>
        </div>
    </div>

    <div class="table-content">
        <div class="tab">
            <a href="<?php echo URLROOT?>/packages/bookings"><button class="tablinks">Ongoing Bookings</button></a>
            <a href="<?php echo URLROOT?>/packages/combookings"><button class="tablinks active">Completed Bookings</button></a>
            <a href="<?php echo URLROOT?>/packages/cancelledBookings"><button class="tablinks ">Cancelled Bookings</button></a>
        </div>
    </div>

    <div class="search-content">
        <div class="booking-search">
            <input type="text" id="booking-search" placeholder="Enter Name or Room Type">
            <input type="date" id="start-date" placeholder="Start Date">
            <input type="date" id="end-date" placeholder="End Date">
            <button onclick="filterBookings()">
                <i class="bx bx-search"></i>
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
                <th>Pickup Time</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>


            <?php
            $combookings = $data["combookings"];
            //            var_dump($bookings);
            foreach ($combookings as $key => $booking): ?>
                <tr>
                    <td><?php echo $key + 1; ?></td>
                    <td><?php echo $booking->fname; ?></td>
                    <td><?php echo $booking->startDate; ?></td>
                    <td><?php echo $booking->endDate; ?></td>
                    <td><?php echo date('H:i', strtotime($booking->meetTime)); ?></td>
                    <td>
                        <button class="view-button" onclick="openPopup(); updatePopupDetails('<?php echo $booking->profile_picture; ?>','<?php echo $booking->fname; ?>', '<?php echo $booking->startDate; ?>', '<?php echo $booking->roomType; ?>')">
                            <i class='bx bx-show'></i>
                        </button>
                        <button class="cancel-button" <?php if ($booking->bookingCondition === 'cancelled') echo 'disabled'; ?> onclick="showCancelPopup(<?php echo $booking->package_id; ?>, <?php echo $booking->user_id; ?>, '<?php echo $booking->booking_id;?>', '<?php echo $booking->startDate; ?>', '<?php echo $booking->endDate; ?>', <?php echo $booking->temporyid; ?>, '<?php echo $booking->meetTime; ?>')">
                            <i class='bx bx-x'></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>

            <script src= "<?php echo URLROOT?>/public/js/package/bookings.js"></script>
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
</body>
</html>
