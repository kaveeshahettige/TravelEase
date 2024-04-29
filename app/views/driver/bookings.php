<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/driver/bookings.css">
    <script src="<?php echo URLROOT; ?>/public/js/hotel/popup.js"></script>
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/popup.css">
   <script src="<?php echo URLROOT; ?>/public/js/driver/booking.js"></script>
    <title><?php echo SITENAME ?></title>
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT; ?>/images/driver/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>





</head>


<?php
                // var_dump($data['completedBookings']);

// var_dump($data['vehicle'])?>


<body>
    <nav class="left-menu">
        <div class="user-profile">
            <img src="<?php echo URLROOT; ?>/images/<?php echo $data['profileimage']->profile_picture ?>"
                alt="User Profile Photo">
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
            <li><a href="<?php echo URLROOT; ?>driver/calender"><i class='bx bxs-book bx-sm'></i> Availabily
                    Calender</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/bookings" class="active"><i class='bx bxs-package bx-sm'></i></i>
                    Bookings</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/vehicle"><i class='bx bxs-car bx-sm'></i> Vehicle Informaion </a>
            </li>
            <li><a href="<?php echo URLROOT; ?>driver/earings"><i class='bx bx-money-withdraw bx-sm'></i>Earings and
                    Payments</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/notification"><i class='bx bxs-bell bx-sm'></i>Notification</a>
            </li>
            <li><a href="<?php echo URLROOT; ?>driver/reviews"><i class='bx bxs-star bx-sm bx-fw'></i> Reviews</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/settings"><i class='bx bxs-cog bx-sm'></i> Settings</a></li>
            <!-- <div class="logout"> -->
            <li> <a href="#" class="nav-button active" onclick="confirmLogout(event)"><i class='bx bxs-log-out bx-sm bx-fw'></i> Logout</a></li>
            <!-- </div> -->
        </ul>




    </nav>
    <main>
        <div class="logo-container">
            <img src="<?php echo URLROOT; ?>/images/driver/TravelEase.png" alt="TravelEase Logo">
            <span class="logo-text">TravelEase</span>
        </div>

        <div class="dashboard-content">
            <h1>Bookings</h1>
        </div>

        <div class="dashboard-sub-content">
            <div class="top-boxes">
                <!-- Small Image Boxes -->
                <div class="img-box">
                    <img src="<?php echo URLROOT; ?>/images/driver/dashboard.jpg" alt="hotel Image">
                </div>
<!-- <?php $totalbookings = $data['totalBookings'];?> -->

                <!-- Total Bookings Box -->
                <div class="box">
                    <h2>Total Bookings</h2>
                    <p><?php echo $data['totalBookingsArray']; ?></p>
                </div>

                <!-- Ongoing Bookings Box -->
                <div class="box">
                    <h2>Ongoing Bookings</h2>
                    <p></p>
                </div>

                <!-- Customers Box -->
                <div class="box">
                    <h2>Total Customers</h2>
                    <p></p>
                </div>
            </div>
        </div>

        <div class="table-content">
            <div class="tab">
                <a href="<?php echo URLROOT?>/driver/bookings"><button class="tablinks active">Ongoing
                        Bookings</button></a>
                <a href="<?php echo URLROOT?>/driver/combookings"><button class="tablinks">Completed
                        Bookings</button></a>
                <a href="<?php echo URLROOT?>/driver/rejbookings"><button class="tablinks">Cancelled
                        Bookings</button></a>
            </div>
        </div>

        <div class="search-content">
    <div class="booking-search">
        <input type="text" id="cab-search" placeholder="Name or Vehicle Number">
        <input type="date" id="start-date" placeholder="Start Date">
        <input type="date" id="end-date" placeholder="End Date">
        <button onclick="filterCabBookings()">
            <i class="bx bx-search"></i>
        </button>
    </div>
</div>

<script>
    function filterCabBookings() {
        var input, filter, startDate, endDate, table, tr, tdPassengerName, tdPlateNumber, tdDate, i, txtPassengerName, txtPlateNumber, txtDate ;
        input = document.getElementById("cab-search");
        filter = input.value.toUpperCase();
        startDate = document.getElementById("start-date").value;
        endDate = document.getElementById("end-date").value;
        table = document.querySelector(".cab-booking-table");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            tdPassengerName = tr[i].getElementsByTagName("td")[1]; // Index 1 for Passenger Name column
            tdPlateNumber = tr[i].getElementsByTagName("td")[4]; // Index 4 for Plate Number column
            tdDate = tr[i].getElementsByTagName("td")[2]; // Index 2 for Date column

            if (tdPassengerName && tdPlateNumber && tdDate) {
                txtPassengerName = tdPassengerName.textContent || tdPassengerName.innerText;
                txtPlateNumber = tdPlateNumber.textContent || tdPlateNumber.innerText;
                txtDate = tdDate.textContent || tdDate.innerText;
                if ((txtPassengerName.toUpperCase().indexOf(filter) > -1 || txtPlateNumber.toUpperCase().indexOf(filter) > -1) &&
                    (compareDates(startDate, txtDate) && compareDates(txtDate, endDate))) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    function compareDates(start, end) {
        if (!start || !end) return true;
        var startDate = new Date(start);
        var endDate = new Date(end);
        var compareDate = new Date(end);
        compareDate.setDate(compareDate.getDate() + 1); // Add one day to include the end date
        return new Date(start) <= endDate && new Date(end) >= startDate;
    }
</script>

        <div class="table-content">
            <h2>Ongoing Booking Details</h2>
            <?php
    // Check if $data exists and has the expected structure
    if (!empty($data) && isset($data['pendingBookings'])) {
    ?>
            <table class="booking-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <!-- <th>Booking ID</th> -->
                        <!-- <th>Temp ID</th> -->
                        <th>Passenger Name</th>
                        <th>Passenger Contact Number</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Time</th>
                        <th>Vehicle Plate Number</th>
                        <th>Amount</th>
                        <th>With Driver</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                $pendingBookings = $data['pendingBookings'] ?? [];
                
                $count = 0; // Initialize a counter variable

                foreach ($pendingBookings as $booking) {

                    $count++; // Increment the counter for each iteration
                ?>
                    <tr>
                        <td><?php echo $count; ?></td> <!-- Display the count -->
                        <!-- <td><?php echo $booking->booking_id; ?></td> -->
                        <!-- <td><?php echo $booking->temporyid; ?></td> -->
                        <td><?php echo $booking->fname . ' ' . $booking->lname; ?>
                        </td>
                        <td><?php echo $booking->number; ?></td>
                        <td><?php echo $booking->startDate; ?></td>
                        <td><?php echo $booking->endDate; ?></td>
                        <td><?php echo $booking->start_time; ?></td>
                        <td><?php echo $booking->plate_number; ?></td>
                        <td><?php echo $booking->payment_amount; ?></td>
                        <td><?php echo $booking->withDriver ? 'Yes' : 'No'; ?></td>
                        <td>

                        <?php
                        // Calculate the difference in days between today and the start date of the booking
                        $diffStart = strtotime($booking->startDate) - strtotime(date('Y-m-d'));
                        $daysStart = round($diffStart / 86400); // Convert seconds to days

                        // Calculate the difference in days between the booking date and today
                        $diffBooking = strtotime(date('Y-m-d')) - strtotime($booking->bookingDate);
                        $daysBooking = round($diffBooking / 86400); // Convert seconds to days

                        // Check both conditions
                        if ($daysStart > 3 && $daysBooking < 7) {
                            // Enable the cancel button
                            $disableCancel = '';
                        } else {
                            // Disable the cancel button
                            $disableCancel = 'disabled';
                        }
                        ?>

                        <button class="cancel-button" <?php echo $disableCancel; ?> onclick="showCancelPopup(<?php echo $booking->vehicle_id; ?>, <?php echo $booking->user_id; ?>, '<?php echo $booking->booking_id; ?>', '<?php echo $booking->startDate; ?>', '<?php echo $booking->endDate; ?>', <?php echo $booking->tempory_id; ?>, '<?php echo $booking->plate_number; ?>', <?php echo $booking->payment_amount; ?>)">
                            <i class='bx bx-x'></i>
                        </button>
                        </td>



                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php } ?>
        </div>        
</body>


</html>