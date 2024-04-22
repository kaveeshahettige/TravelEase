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
    <h2>Earnings Summary</h2>
    <table class="booking-table">
        <thead>
            <tr>
                <th>Time Period</th>
                <th>Earnings</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $weeklyEarnings = 0;
            $monthlyEarnings = 0;
            if (!empty($data['payments'])) {
                var_dump($data['totalEarnings']);
                foreach ($data['payments'] as $payment) {
                    // Assuming your date format is Y-m-d
                    $paymentDate = new DateTime($payment->end_date);

                    // Check if the payment date falls within the current week
                    $currentWeek = (new DateTime())->format("W");
                    if ($paymentDate->format("W") == $currentWeek) {
                        $weeklyEarnings += $payment->earnings;
                    }

                    // Check if the payment date falls within the current month
                    $currentMonth = (new DateTime())->format("m");
                    if ($paymentDate->format("m") == $currentMonth) {
                        $monthlyEarnings += $payment->earnings;
                    }
                }
            }
            ?>
            <tr>
                <td>Weekly</td>
                <td>Rs. <?php echo number_format($weeklyEarnings, 2); ?></td>
                <td><button class="view-button">View</button></td>
            </tr>
            <tr>
                <td>Monthly</td>
                <td>Rs. <?php echo number_format($monthlyEarnings, 2); ?></td>
                <td><button class="view-button">View</button></td>
            </tr>
        </tbody>
    </table>
</div>



<div class="table-content">
    <h2>Payment History</h2>
    <table class="booking-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Date</th>
                <th>Amount</th>
                <th>Trip ID</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($data['payments'])) {
                $counter = 1;
                foreach ($data['payments'] as $payment) :
            ?>
                    <tr>
                        <td><?php echo $counter; ?></td>
                        <td><?php echo $payment->end_date; ?></td>
                        <td>Rs. <?php echo number_format($payment->earnings, 2); ?></td>
                        <td><?php echo $payment->trip_id; ?></td>
                        <td><button class="view-button">View</button></td>
                    </tr>
            <?php
                    $counter++;
                endforeach;
            } else {
                echo '<tr><td colspan="5">No payment history available.</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>

<div class="more-content">
    <button class="next-page-btn">More Payments <i class='bx bx-chevron-right'></i></button>
</div>


    </main>
</body>
</html>
