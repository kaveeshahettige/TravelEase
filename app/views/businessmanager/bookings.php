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
        <h2>All Bookings</h2>
            <table class="booking-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Guest Name</th>
                        <th>Service Type</th>
                        <th>Service Name</th>
                        <th>Status</th>
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
                        <td><?php echo $booking->guest_name; ?></td>
                        <td><?php
                            switch ($booking->provider_type) {
                                case 0:
                                    echo "Admin";
                                    break;
                                case 1:
                                    echo "Traveler";
                                    break;
                                case 2:
                                    echo "Business Manager";
                                    break;
                                case 3:
                                    echo "Hotel";
                                    break;
                                case 4:
                                    echo "Transport Provider";
                                    break;
                                case 5:
                                    echo "Guide";
                                    break;
                                default:
                                    echo "Unknown";
                                    break;
                            }
                            ?></td>
                        <td><?php echo $booking->provider_name; ?></td>
                        <td><?php echo $booking->payment_status ?></td>
                        <td>
                            <button class="view-button" onclick="openPopup(); updatePopupDetails(
                                    '<?php echo $booking->user_profile_picture; ?>',
                                    '<?php echo $booking->guest_name; ?>',
                                    '<?php echo $booking->provider_type; ?>',
                                    '<?php echo $booking->provider_name; ?>',
                                    '<?php echo $booking->payment_status; ?>'
                                    )">
                                <i class='bx bx-show'></i>
                            </button>
                        </td>
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
