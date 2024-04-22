<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/revenue.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/bookings.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/navigation.css">
    <title>Hotel Revenue</title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/hotel/x-icon" href="<?php echo URLROOT; ?>/images/hotel/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<?php
$userData= $data['basicInfo']['userData'];
?>
<?php
$activePage = 'hotel/revenue'; // Set the active page dynamically based on your logic
include 'navigation.php';
?>
    <main>
        <div class="logo-container">
            <img src="<?php echo URLROOT; ?>/images/hotel/TravelEase.png" alt="TravelEase Logo">
            <span class="logo-text">TravelEase</span>
        </div>
        
        <div class="dashboard-content">
            <h1>Revenue</h1>
        </div>

        <div class="dashboard-sub-content">
        <div class="top-boxes">
            <!-- Small Image Boxes -->
            <div class="img-box">
                <img src="<?php echo URLROOT; ?>/images/hotel/dashboard.jpg" alt="hotel Image">
            </div>
           

            <!-- Total Bookings Box -->
            <div class="box">
                <h2>Total Revenue</h2>
                <p>45,000 LKR</p>
            </div>
        
            <!-- Ongoing Bookings Box -->
            <div class="box">
                <h2>Revenue Recieved</h2>
                <p>30,000 LKR</p>
            </div>
        
            <!-- Customers Box -->
            <div class="box">
                <h2>To Recieve</h2>
                <p>12,000 LKR</p>
            </div>
        </div>
    
            
        </div>

        <div class="search-content">
            <div class="booking-search">
                <input type="text" id="booking-search" placeholder="Search for Revenue">
                <button onclick="filterBookings()">
                    <i class="bx bx-search"></i> <!-- Using the Boxicons search icon -->
                </button>
            </div>
            </div>

        <div class="table-content">
            <h2>Revenue Details</h2>
            <table class="booking-table">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Payment Date</th>
                    <th>Total Amount</th>
                    <th>TravelEase Revenue</th>
                    <th>Payment Amount</th>
                    <th>Invoice</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $finalPayment = $data["finalPayment"];

                // Check if $finalPayment is an array or object
                if (is_array($finalPayment) || is_object($finalPayment)) {
                    foreach ($finalPayment as $key => $payment):

                        ?>
                        <tr>
                            <td><?php echo $key + 1; ?></td>
                            <td><?php echo $payment->paidDate; ?></td>
                            <td><?php echo number_format($payment->paidAmount / 0.9, 2) . ' LKR'; ?></td>
                            <td><?php echo number_format(($payment->paidAmount / 0.9) * 0.1, 2) . ' LKR'; ?></td>
                            <td><?php echo strval($payment->paidAmount) . ' LKR'; ?></td>
                            <td>
                                <a href="../public/invoice/<?php echo $payment->invoice; ?>" target="_blank" class="view-button" title="View Document">
                                    <i class="bx bx-show"></i>
                                </a>
                                <a href="../public/invoice/<?php echo $payment->invoice; ?>" download="<?php echo $payment->invoice; ?>" class="download-button" title="Download Document">
                                    <i class="bx bx-download"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach;
                } else {
                    // Handle the case when $finalPayment is not valid (e.g., no payment records found)
                    echo "<tr><td colspan='4'>No payment records found.</td></tr>";
                }
                ?>

                </tbody>
            </table>
        </div>



        <div class="more-content">
            <button class="next-page-btn">More Bookings <i class='bx bx-chevron-right'></i></button>
        </div>

    </main>
</body>
</html>
