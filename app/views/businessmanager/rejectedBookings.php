<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/businessmanager/manager-bookings.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/businessmanager/navigation.css">
    <title>Business Manager Bookings</title>
    <link rel="icon" type="<?php echo URLROOT?>/images/x-icon" href="<?php echo URLROOT?>/images/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<?php
$activePage = 'businessmanager/bookings'; // Set the active page dynamically based on your logic
include 'navigation.php';
?>
<main>
    <div class="logo-container">
        <img src="<?php echo URLROOT?>/images/TravelEase.png" alt="TravelEase Logo">
        <span class="logo-text">TravelEase</span>
    </div>

    <div class="dashboard-content">
        <h1>Bookings</h1>
    </div>

    <div class="dashboard-sub-content">
        <div class="top-boxes">
            <!-- Small Image Boxes -->
            <div class="img-box">
                <img src="<?php echo URLROOT?>/images/dashboard.jpg" alt="hotel Image">
            </div>


            <?php
            $bookingsCount = $data["bookingsCount"]; ?>
            <div class="box">
                <h2>Total Bookings</h2>
                <p><?php echo $bookingsCount ?></p>
            </div>


            <!-- Ongoing Bookings Box -->
            <?php
            $OngoingCount = $data["OngoingCount"]; ?>
            <div class="box">
                <h2>Ongoing Bookings</h2>
                <p><?php echo $OngoingCount ?></p>
            </div>

            <!-- Customers Box -->
            <?php
            $guestCount = $data["guestCount"]; ?>
            <div class="box">
                <h2>Total Customers</h2>
                <p><?php echo $guestCount ?></p>
            </div>
        </div>
    </div>

    <div class="table-content">
        <div class="tab">
            <a href="<?php echo URLROOT?>/businessmanager/bookings"><button class="tablinks">Ongoing Bookings</button></a>
            <a href="<?php echo URLROOT?>/businessmanager/completedBookings"><button class="tablinks">Completed Bookings</button></a>
            <a href="<?php echo URLROOT?>/businessmanager/rejectedBookings"><button class="tablinks active">Cancelled Bookings</button></a>
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
        <h2>Cancelled Bookings</h2>
        <table class="booking-table">
            <thead>
            <tr>
                <th>No</th>
                <th>Guest Name</th>
                <th>Service Type</th>
                <th>Service Provider</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Service Details</th>
                <th>Payment Amount</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $bookings = $data["bookingData"];
            foreach ($bookings as $key => $booking):
                ?>

                <tr>
                    <td><?php echo $key + 1; ?></td>
                    <td><?php echo $booking->traveler_name; ?></td>
                    <td><?php echo $booking->service_type; ?></td>
                    <td><?php echo $booking->serviceprovider_name; ?></td>
                    <td><?php echo $booking->startDate; ?></td>
                    <td><?php echo $booking->endDate; ?></td>
                    <td><?php echo $booking->service_detail?></td>
                    <td><?php echo $booking->payment_amount; ?></td>
                    <td>
                        <button class="view-button" onclick="openPopup(<?php echo $key; ?>)">
                            <i class='bx bx-show'></i>
                        </button>
                </tr>

            <?php endforeach; ?>
            </tbody>
        </table>
    </div>



    <div class="more-content">
        <button class="next-page-btn">See More <i class='bx bx-chevron-right'></i></button>
    </div>

    <div class="popup" id="popup">
        <div class="popup-content">
            <span class="close" onclick="closePopup()">&times;</span>
            <!-- Add details about the booking here -->
            <h2>Booking Details</h2>
            <div id="profile-picture" class="profile-picture"></div>
            <p id="guestName">Guest Name: </p>
            <p id="providerType">Provider Type: </p>
            <p id="providerName">Provider Name: </p>
            <p id="paymentStatus">Payment Status: </p>
            <!-- Add more details as needed -->
        </div>
    </div>


    <script src= "<?php echo URLROOT?>/public/js/businessmanager/bookings.js"></script>

</main>
</body>
</html>
