<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/businessmanager/manager-packages.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/businessmanager/navigation.css">
    <title>Business Manager Refunds</title>
    <link rel="icon" type="<?php echo URLROOT?>/images/x-icon" href="<?php echo URLROOT?>/images/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<?php
$activePage = 'businessmanager/refund'; // Set the active page dynamically based on your logic
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

    <div class="table-content">
        <div class="tab">
            <a href="<?php echo URLROOT?>/businessmanager/refund"><button class="tablinks">Pending Refunds</button></a>
            <a href="<?php echo URLROOT?>/businessmanager/CompletedRefunds"><button class="tablinks active">Completed Refunds</button></a>
        </div>
    </div>

    <div class="search-content">
        <div class="booking-search">
            <input type="text" id="booking-search" placeholder="Search for Refund Details">
            <button onclick="filterBookings()">
                <i class="bx bx-search"></i> <!-- Using the Boxicons search icon -->
            </button>
        </div>
    </div>

    <div class="table-content">
        <h2>Completed Refunds</h2>
        <table class="booking-table">
            <thead>
            <tr>
                <th>No</th>
                <th>Booking ID</th>
                <th>Service Provider Name</th>
                <th>Traveler Name</th>
                <th>Service Cancelled by</th>
                <th>Refund Amount</th>
                <th>Cancelled Date</th>
                <th>Refund Date</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $completeRefundData = $data['completeRefundData'];
            foreach ($completeRefundData as $key => $refund): ?>
                <tr>
                    <td><?php echo $key + 1; ?></td>
                    <td><?php echo $refund->booking_id; ?></td>
                    <td><?php echo $refund->provider_fname; ?></td>
                    <td><?php echo $refund->user_fname; ?></td>
                    <td><?php echo $refund->cancel_user_fname; ?></td>
                    <td><?php echo $refund->refund_amount; ?></td>
                    <td><?php echo $refund->cancelled_date; ?></td>
                    <td><?php echo $refund->refund_date; ?></td>
                    <td>
                        <button class="view-button">
                            <i class='bx bx-show'></i>
                        </button>
                        <button class="cancel-button">
                            <i class='bx bx-x'></i>
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

</main>
</body>
</html>
