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

        <div class="search-content">
            <div class="booking-search">
                <input type="text" id="booking-search" placeholder="Search for New Transactions">
                <button onclick="filterBookings()">
                    <i class="bx bx-search"></i> <!-- Using the Boxicons search icon -->
                </button>
            </div>
        </div>
        
        <div class="table-content">
                <h2>All Transactions</h2>
            <table class="transaction-table">
                <thead>
                <tr>
                    <th>Service Provider Name</th>
                    <th>Service Type</th>
                    <th>Total Amount</th>
                    <th>To Paid</th>
                    <th>Current Date</th>
                    <th>Account Number</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $finalTransactionData = $data['finalTransactionData'];
                if (isset($finalTransactionData) && is_array($finalTransactionData) && count($finalTransactionData) > 0) {
                foreach ($finalTransactionData as $key => $transaction): ?>
                        <tr>
                            <td>
                                <div class="service-provider-info">
                                    <?php
                                    $profilePicture = $transaction[0]->profile_picture ?? 'profile.png';
                                    ?>
                                    <img src="../public/images/<?php echo $profilePicture ?>" alt="Service Provider Photo">

                                    <span><?php echo $transaction[0]->serviceprovider_name; ?></span>
                                </div>
                            </td>
                            <td><?php echo $transaction[0]->service_type; ?></td>
                            <td><?php echo number_format($data['totalAmount'], 2); ?> LKR</td>
                            <td><?php echo number_format($data['totalAmount'] * 0.90, 2); ?> LKR</td>
                            <td><?php echo date('Y-m-d'); ?></td>
                            <td><?php echo $transaction[0]->account_number; ?></td>
                            <td>
                                <a href="<?php echo URLROOT; ?>businessmanager/payment?serviceProvider_id=<?php echo $transaction[0]->serviceProvider_id; ?>&totalAmount=<?php echo $data['totalAmount']; ?>" class="view-button">
                                    Proceed Payment
                                </a>
                            </td>
                        </tr>
                <?php endforeach;
                } else {
                    echo "<tr><td colspan='7'>No transactions found.</td></tr>";
                }
                ?>
                    <tr>
                    </tr>
              </tbody>
            </table>
        </div>



    </main>
</body>
</html>
