<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/index.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/settings.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/navigation.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/bookings.css">
    <title>Package Dashboard</title>
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
$activePage = 'packages/index'; // Set the active page dynamically based on your logic
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

    <div class="settings-subcontent">
        <div class="content-container">
            <div class="left-content">
                <div class="rectangle">
        <?php
        $userData = $data['userData'];
        $guideData = $data['guideData'];
        ?>
        <!-- Rectangle 1: Basic Info -->
        <div class="basic-info-content">
            <div class="center-image" onclick="openPopup()">
                <img id="profile-picture" src="<?= isset($userData->profile_picture) ? '../public/images/' . $userData->profile_picture : '../public/images/profile.png'; ?>" alt="Profile Picture">
                <div class="edit-icon">&#9998;</div>
            </div>
            <div class="hotel-details">
                <h3><?=($userData->fname)?></h3>
                <h6>Contact Number</h6>
                <p><?=($userData->number)?></p>
                <h6>Email</h6>
                <p><?=($userData->email)?></p>
                <h6>Location</h6>
                <p><?=($guideData->address)?></p>
            </div>
            <a href="<?php echo URLROOT; ?>packages/packagesedit">
                <button class="edit-button">Edit</button>
            </a>
        </div>
        <!-- Profile Picture Change Popup -->
        <div id="profile-picture-form" class="popup">
            <div class="popup-content">
                <span class="close-icon" onclick="closePopup()">&times;</span>
                <form method="POST" action="<?php echo URLROOT; ?>/packages/changeProfilePicture" enctype="multipart/form-data">
                    <p>Change Profile Picture:</p>
                    <input type="file" name="profile-picture" accept="image/*" required>
                    <button type="submit">Upload</button>
                    <button type="button" onclick="closePopup()">Cancel</button>
                </form>
            </div>
        </div>
        <!-- JavaScript to handle the popup and image update -->
        <script>
            function openPopup() {
                var formPopup = document.getElementById("profile-picture-form");
                formPopup.style.display = "flex";
            }

            function closePopup() {
                var formPopup = document.getElementById("profile-picture-form");
                formPopup.style.display = "none";
            }
        </script>
    </div>
            </div>
            <div class="right-content">
                <div class="table2-content">
                    <h2>Booking Details</h2>
                    <table class="booking-table">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Guest Name</th>
                            <th>Check-in Date</th>
                            <th>Pickup Time</th>
                            <th>Booking Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        $bookings = $data["bookings"];
                        // Limiting to 3 rows
                        for ($i = 0; $i < min(3, count($bookings)); $i++) {
                            $booking = $bookings[$i];
                            ?>
                            <tr>
                                <td><?php echo $i + 1; ?></td>
                                <td><?php echo $booking->fname; ?></td>
                                <td><?php echo $booking->startDate; ?></td>
                                <td><?php echo date('H:i', strtotime($booking->meetTime)); ?></td>
                                <td><?php echo $booking->bookingCondition; ?></td>
                                <td>
                                    <a class="view-button" href="<?php echo URLROOT; ?>packages/bookings">
                                        <i class='bx bx-search'></i> <!-- Change the icon to 'bx-search' -->
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>

                        <script src= "<?php echo URLROOT?>/public/js/package/bookings.js"></script>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</main>
</body>
</html>
