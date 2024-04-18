<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/index.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/settings.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/bookings.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/navigation.css">
    <title>Hotel Dashboard</title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/hotel/x-icon" href="<?php echo URLROOT; ?>/images/hotel/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<?php
$userData= $data['basicInfo']['userData'];
$hotelData= $data['basicInfo']['hotelData'];
?>
<?php
$activePage = 'hotel/index';
include 'navigation.php';
?>
<main>
    <div class="logo-container">
        <img src="<?php echo URLROOT; ?>/images/hotel/TravelEase.png" alt="TravelEase Logo">
        <span class="logo-text">TravelEase</span>
    </div>

    <div class="dashboard-content">
        <h1>Dashboard</h1>
    </div>

    <div class="dashboard-sub-content">
        <div class="top-boxes">
            <!-- Small Image Boxes -->
            <div class="img-box">
                <img src="<?php echo URLROOT; ?>/images/hotel/dashboard.jpg" alt="hotel Image">
            </div>

            <!-- Total Bookings Box -->
            <?php $bookingsCount = $data["bookingsCount"]; ?>
            <div class="box">
                <h2>Total Bookings</h2>
                <p><?php echo $bookingsCount ?></p>
            </div>

            <!-- Ongoing Bookings Box -->
            <div class="box">
                <h2>Total Revenue</h2>
                <p>65,000 LKR</p>
            </div>

            <?php
            $guestCount = $data["guestCount"]; ?>
            <div class="box">
                <h2>Total Customers</h2>
                <p><?php echo $guestCount?></p>
            </div>
        </div>
    </div>

    <div class="dashboard-sub-content">
        <div class="content-container">
            <div class="left-content">
                <div class="rectangle">
                    <!-- Basic Information Section -->
                    <div class="basic-info-content">
                        <div class="center-image" onclick="openPopup()">
                            <img id="profile-picture" src="<?= isset($userData->profile_picture) ? $userData->profile_picture : '../Images/wikum.jpg'; ?>" alt="User Profile Photo">
                            <div class="edit-icon">&#9998;</div>
                        </div>
                        <div class="hotel-details">
                            <h3><?=($userData->fname)?></h3>
                            <h6>Hotel Type</h6>
                            <p><?=($hotelData->hotel_type)?></p>
                            <h6>Contact Number</h6>
                            <p><?=($userData->number)?></p>
                            <h6>Email</h6>
                            <p><?=($userData->email)?></p>
                            <h6>Location</h6>
                            <p><?=$hotelData->address ?> </p>
                        </div>
                        <a href="<?php echo URLROOT; ?>hotel/hoteledit">
                            <button class="edit-button">Edit</button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="right-content">
                <!-- Table with Maximum 4 Rows -->
                <div class="table2-content">
                    <h2>Booking Details</h2>
                    <table class="booking-table">
                        <thead>
                        <tr>
                            <th>Guest Name</th>
                            <th>Check-in Date</th>
                            <th>Room Number</th>
                            <th>Room Type</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $bookingData = $data["bookingData"];
                        $rowCount = 0;
                        foreach ($bookingData as $key => $booking):
                            if ($rowCount >= 4) break; // Limit to 4 rows
                            ?>
                            <tr>
                                <td><?php echo $booking->fname; ?></td>
                                <td><?php echo date("Y-m-d", strtotime($booking->startDate)); ?></td>
                                <td><?php echo $booking->registration_number; ?></td>
                                <td><?php echo $booking->roomType; ?></td>
                                <td>
                                    <a class="view-button" href="<?php echo URLROOT; ?>hotel/bookings">
                                        <i class='bx bx-search'></i> <!-- Change the icon to 'bx-search' -->
                                    </a>
                                </td>
                            </tr>
                            <?php
                            $rowCount++;
                        endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Rooms Allocated Section -->
                <div class="rectangle">
                    <div class="basic-info-content">
                        <div class="hotel-details">
                            <h2>Rooms Allocated</h2>
                            <h6>No.of Rooms</h6>
                            <?php
                            $roomCount = $data;
                            ?>
                            <p><?php echo $data['roomCount']; ?></p>
                        </div>
                        <a href="<?php echo URLROOT; ?>hotel/addrooms">
                            <button class="edit-button">Add</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>
