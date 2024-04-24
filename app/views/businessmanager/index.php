<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/businessmanager/manager- dashboard style.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/businessmanager/manager-settings.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/businessmanager/navigation.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/businessmanager/manager-bookings.css">
    <title>Business Manager Dashboard</title>
    <link rel="icon" type="<?php echo URLROOT?>/images/x-icon" href="<?php echo URLROOT?>/images/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<?php
$activePage = 'businessmanager/index'; // Set the active page dynamically based on your logic
include 'navigation.php';
?>
<main>
    <div class="logo-container">
        <img src="<?php echo URLROOT?>/images/TravelEase.png" alt="TravelEase Logo">
        <span class="logo-text">TravelEase</span>
    </div>
    
    <div class="dashboard-content">
        <h1>Packages</h1>
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

    <div class="dashboard-subcontent">
    <div class="content-container">
        <div class="left-content">

            <div class="rectangle">

                <?php
                $profilePicture = $data["profilePicture"];
                //                    var_dump($profilePicture);
                ?>

                <div class="basic-info-content">
                    <div class="center-image" onclick="openPopup()">
                        <img id="profile-picture" src="<?= isset($profilePicture->profile_picture) ? $profilePicture->profile_picture : '../Images/wikum.jpg'; ?>" alt="User Profile Photo">
                        <div class="edit-icon">&#9998;</div>
                    </div>
                </div>

                <div class="hotel-details">
                    <h3><?=$_SESSION['user_fname']?></h3>
                    <h6>Full Name</h6>
                    <p><?= $_SESSION['user_fname'] ?></p>
                    <h6>Contact Number</h6>
                    <p><?=$_SESSION['user_number']?></p>
                    <h6>Email</h6>
                    <p><?=$_SESSION['user_email']?></p>
                    <!--                            <h6>Location</h6>-->
                    <!--                            <p>--><?php //=$hotelData->add ?><!-- </p>-->
                </div>

                <a href="<?php echo URLROOT; ?>businessmanager/businessmanageredit">
                    <button class="edit-button">Edit</button>
                </a>

                <div id="profile-picture-form" class="popup">
                    <div class="popup-content">
                        <span class="close-icon" onclick="closePopup()">&times;</span>
                        <form method="POST" action="<?php echo URLROOT; ?>/businessmanager/changeProfilePicture" enctype="multipart/form-data">
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
            <div class="table-content2">
                <h2>Ongoing Bookings</h2>
                <table class="booking-table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Guest Name</th>
                        <th>Service Provider</th>
                        <th>Start Date</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $bookings = $data["bookingData"];
                    // Limit the loop to only display the first three rows
                    $limit = min(2, count($bookings));
                    for ($key = 0; $key < $limit; $key++):
                        ?>
                        <tr>
                            <td><?php echo $key + 1; ?></td>
                            <td><?php echo $bookings[$key]->traveler_name; ?></td>
                            <td><?php echo $bookings[$key]->serviceprovider_name; ?></td>
                            <td><?php echo $bookings[$key]->startDate; ?></td>
                            <td><?php echo $bookings[$key]->payment_amount; ?></td>
                            <td>
                                <a class="view-button" href="<?php echo URLROOT; ?>businessmanager/bookings">
                                    <i class='bx bx-search'></i> <!-- Change the icon to 'bx-search' -->
                                </a>
                            </td>
                        </tr>
                    <?php endfor; ?>
                    </tbody>
                </table>
            </div>

            <div class="table-content2">
                <h2>Pending Refunds</h2>
                <table class="booking-table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Traveler Name</th>
                        <th>Service Cancelled by</th>
                        <th>Refund Amount</th>
                        <th>Cancelled Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $refunds = $data['refundData'];
                    // Limit the loop to display only the first three rows
                    $limit = min(2, count($refunds));
                    for ($key = 0; $key < $limit; $key++):
                        $refund = $refunds[$key];
                        ?>
                        <tr>
                            <td><?php echo $key + 1; ?></td>
                            <td><?php echo $refund->user_fname; ?></td>
                            <td><?php echo $refund->cancel_user_fname; ?></td>
                            <td><?php echo $refund->refund_amount; ?></td>
                            <td><?php echo $refund->cancelled_date; ?></td>
                            <td>
                                <a class="view-button" href="<?php echo URLROOT; ?>businessmanager/refund">
                                    <i class='bx bx-search'></i> <!-- Change the icon to 'bx-search' -->
                                </a>
                            </td>
                        </tr>
                    <?php endfor; ?>
                    </tbody>
                </table>
            </div>






        </div>
    </div>
    </div>

</main>
</body>
</html>
