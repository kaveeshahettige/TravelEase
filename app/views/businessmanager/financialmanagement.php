<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/businessmanager/manager-financial management.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/businessmanager/navigation.css">
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

        <div class = "search-content">
            <input type="text" id="transaction-search" placeholder="Search Transactions">
            <button class="filter-button"><i class='bx bx-filter-alt'></i></button>
        </div>
        
        <div class="table-content">
                <h2>All Transactions</h2>
            <?php if (empty($data["finalPayment"])): ?>
                <p>No revenue details available.</p>
            <?php else: ?>
            <table class="transaction-table">
                <thead>
                <tr>
                    <th>Service Provider Name</th>
                    <th>Service Type</th>
                    <th>Total Amount</th>
                    <th>To Paid</th>
                    <th>Current Date</th>
                    <th>Account Number</th>
<!--                    <th>Payment Status</th>-->
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php if (!empty($finalTransactionData) && is_array($finalTransactionData)) : ?>
                    <?php foreach ($finalTransactionData as $transaction) : ?>
                        <tr>
                            <td>
                                <div class="service-provider-info">
                                    <!-- Assuming there's a profile_picture property in the transaction object -->
                                    <img src="<?php echo $transaction->profile_picture ?>" alt="Service Provider Photo">
                                    <span><?php echo $transaction->serviceprovider_name; ?></span>
                                </div>
                            </td>
                            <td><?php echo $transaction->service_type; ?></td>
                            <td><?php echo number_format($data['totalAmount'], 2); ?> LKR</td>
                            <td><?php echo number_format($data['totalAmount'] * 0.90, 2); ?> LKR</td>
                            <td><?php echo date('Y-m-d'); ?></td>
                            <td><?php echo $transaction->account_number; ?></td>
                            <td>
                                <a href="<?php echo URLROOT; ?>businessmanager/payment?serviceProvider_id=<?php echo $transaction->serviceProvider_id; ?>&totalAmount=<?php echo $data['totalAmount']; ?>" class="view-button">
                                    Proceed Payment
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="7">No transactions found.</td>
                    </tr>
                <?php endif; ?>

                </tbody>
            </table>
            <?php endif; ?>
        </div>

    </main>
</body>
</html>
