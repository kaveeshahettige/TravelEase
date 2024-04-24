<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/businessmanager/manager-financial management.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/businessmanager/navigation.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/popup.css">
    <title>Business Financial Management</title>
    <link rel="icon" type="<?php echo URLROOT?>/images/x-icon" href="<?php echo URLROOT?>/images/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<?php
$activePage = 'businessmanager/financialmanagement'; // Set the active page dynamically based on your logic
include 'navigation.php';
?>
<main>
    <div class="logo-container">
        <img src="<?php echo URLROOT?>/images/TravelEase.png" alt="TravelEase Logo">
        <span class="logo-text">TravelEase</span>
    </div>
    <div class="dashboard-content">
        <h1>Financial Management</h1>
    </div>

    <div class="dashboard-sub-content">

        <?php
        $bookingDetails = $data['bookingDetails'];
        foreach ($bookingDetails as $bookingDetail)
        ?>
        <h3 style="margin-left: 15px">Transactions of Service Provider: <?php echo $bookingDetail->serviceprovider_name; ?></h3>


        <table class="transaction-table">
            <thead>
                <tr>
                    <th>Traveler Name</th>
                    <th>Booking Type</th>
                    <th>Booking Date</th>
                    <th>Check-in Date</th>
                    <th>Check-out Date</th>
                    <th>Service Detail</th>
                    <th>Amount</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $bookingDetails = $data['bookingDetails'];
                var_dump($bookingDetails[0]);
                foreach ($bookingDetails as $bookingDetail):
                ?>
                    <tr>
                        <td><?php echo $bookingDetail->traveler_name; ?></td>
                        <td><?php echo $bookingDetail->booking_type; ?></td>
                        <td><?php echo $bookingDetail->bookingDate; ?></td>
                        <td><?php echo $bookingDetail->startDate; ?></td>
                        <td><?php echo $bookingDetail->endDate; ?></td>
                        <td><?php echo $bookingDetail->service_detail; ?></td>
                        <td><?php echo $bookingDetail->payment_amount; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

        <div class="final-transaction">
            <h3 class="transaction-heading">Final Transaction Detail of Service Provider: <?php echo $bookingDetail->serviceprovider_name; ?></h3>
            <div class="transaction-details">
                <div class="total-amount">
                    <h4>Total Revenue from Bookings</h4>
                    <p class="amount"><?php echo number_format($data['totalAmount'], 2); ?></p>
                </div>
                <div class="commission">
                    <h4>Commission Percentage</h4>
                    <p class="percentage">10%</p>
                </div>
                <div class="final-payment">
                    <h4>Final Payment</h4>
                    <?php
                    $finalPayment = $data['totalAmount'] * 0.9; // Calculate the final payment (90% of total revenue)
                    ?>
                    <p style="font-weight: bold=">Final Payment: <?php echo number_format($finalPayment, 2); ?></p>
                </div>
            </div>
        </div>

        <div class="action-buttons">

<!--            <a href="--><?php //echo URLROOT; ?><!--businessmanager/makeInvoice" class="">-->
<!--                <i class=''></i> -->
<!--            </a>-->

            <button class="download-button" onclick="InvoicePopup(<?php echo $data['serviceProvider_id']; ?>, <?php echo floatval(str_replace(',', '', $data['totalAmount'])); ?>)">
                <i class='bx bx-download'></i> Download Invoice
            </button>

            <button class="payment-button" onclick="PaymentPopup(<?php echo $data['serviceProvider_id']; ?>, <?php echo floatval(str_replace(',', '', $data['totalAmount'])); ?>)">
                <i class='bx bx-credit-card'></i> Make Payment
            </button>

        </div>


        <script src= "<?php echo URLROOT?>/public/js/businessmanager/script.js"></script>
</main>
</body>
</html>
