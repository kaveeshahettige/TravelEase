<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/driver/earings.css">
    <title><?php echo SITENAME ?></title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/driver/x-icon" href="<?php echo URLROOT; ?>/images/driver/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <nav class="left-menu">
       <div class="user-profile">
            <img src="<?php echo URLROOT; ?>/images/<?php echo $data['profileimage']->profile_picture ?>" alt="User Profile Photo">
            <span class="user-name"><?php echo $_SESSION['user_fname'].' '.$_SESSION['user_lname']?></span>
            <a class="" href="<?php echo URLROOT; ?>/driver/notification">
                <i class="bx bx-bell"></i>
            </a>
        </div>

        
        <div class="search-bar">
            <form action="#" method="GET">
                <input type="text" placeholder="Find a Setting">
                <button type="submit">Search</button>
            </form>
        </div>
        
        <ul>
            <li><a href="<?php echo URLROOT; ?>driver/index"><i class='bx bxs-dashboard bx-sm'></i> Overview</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/calender"><i class='bx bxs-book bx-sm'></i> Availabily Calender</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/bookings"><i class='bx bxs-package bx-sm'></i></i> Bookings</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/vehicle"><i class='bx bxs-car bx-sm'></i> Vehicle Informaion </a></li>
            <li><a href="<?php echo URLROOT; ?>driver/earings" class="active"><i class='bx bx-money-withdraw bx-sm'></i>Earings and Payments</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/notification"><i class='bx bxs-bell bx-sm'></i>Notification</a></li>
            
            <li><a href="<?php echo URLROOT; ?>driver/reviews"><i class='bx bxs-star bx-sm bx-fw'></i> Reviews</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/settings"><i class='bx bxs-cog bx-sm'></i> Settings</a></li>
            <li><a href="<?php echo URLROOT?>users/logout" class="active"><i class='bx bxs-log-out bx-sm bx-fw'></i> Logout</a></li>
        </ul>
        <!-- <div class="logout">
            <a href="<?php echo URLROOT; ?>pages/indes" class="active"><i class='bx bxs-log-out bx-sm bx-fw'></i>  Logout</a>
        </div> -->
    </nav>
    <main>
    <div class="logo-container">
    <img src="<?php echo URLROOT; ?>/images/driver/TravelEase.png" alt="TravelEase Logo">
    <span class="logo-text">TravelEase</span>
</div>

<div class="dashboard-content">
    <h1>Earnings and Payments</h1>
</div>

<div class="dashboard-sub-content">
    <div class="top-boxes">
        <!-- Total Earnings Box -->
        <div class="box">
            <h2>Total Earnings</h2>
            <p>Rs. <?= isset($totalEarnings) ? number_format($totalEarnings, 2) : '0.00' ?></p>
        </div>
        <div class="box">
            <h2>Last Payment</h2>
            <p></p>
        </div>
    </div>
</div>




<div class="table-content">
            <h2>Revenue Details</h2>
            <?php if (empty($data["finalPayment"]) || !is_array($data["finalPayment"])): ?>
                <p>No revenue details available.</p>
            <?php else: ?>
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
                    <?php foreach ($data["finalPayment"] as $key => $payment): ?>
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
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="more-content">
                    <button class="next-page-btn">More Bookings <i class='bx bx-chevron-right'></i></button>
                </div>
            <?php endif; ?>
        </div>

<div class="more-content">
    <button class="next-page-btn">More Payments <i class='bx bx-chevron-right'></i></button>
</div>


    </main>
</body>
</html>
