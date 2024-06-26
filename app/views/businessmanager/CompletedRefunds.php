<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/businessmanager/manager-packages.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/bookings.css">
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
            $totalRefundCharge = $data['totalRefundCharge'];?>
            <div class="box">
                <h2>Total Refund Charge</h2>
                <p><?php echo  $totalRefundCharge -> totalRefundCharge ?> LKR</p>
            </div>
        </div>

    </div>

    <div class="table-content">
        <div class="tab">
            <a href="<?php echo URLROOT?>/businessmanager/refund"><button class="tablinks">Pending Refunds</button></a>
            <a href="<?php echo URLROOT?>/businessmanager/CompletedRefunds"><button class="tablinks active">Completed Refunds</button></a>
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
                <th>Paid Amount</th>
                <th>Refund Charge</th>
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
                    <td><?php echo $refund->final_refund; ?></td>
                    <td><?php echo $refund->refund_charge; ?></td>
                    <td>
                        <button class="view-button">
                            <i class='bx bx-show'></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php
        $totalRefundCharge = $data['totalRefundCharge'];?>
        <div class="total-refund-charge">
            <h2>Total Refund Charge</h2>
            <p><?php echo $totalRefundCharge->totalRefundCharge ?> LKR</p>
    </div>



    <div class="more-content">
        <button class="next-page-btn" onclick="showNextPage()">See More <i class='bx bx-chevron-right'></i></button>
    </div>

    <script>
        // JavaScript function to show the next page of table rows
        function showNextPage() {
            var table = document.querySelector(".booking-table");
            var tr = table.getElementsByTagName("tr");
            var i;
            for (i = 0; i < tr.length; i++) {
                if (tr[i].style.display === "none") {
                    tr[i].style.display = "";
                }
            }
        }
        //limit rows
        var table = document.querySelector(".booking-table");
        var tr = table.getElementsByTagName("tr");
        var i;
        for (i = 0; i < tr.length; i++) {
            if (i > 3) {
                tr[i].style.display = "none";
            }
        }

    </script>


</main>
</body>
</html>
