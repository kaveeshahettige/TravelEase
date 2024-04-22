<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/driver/bookings.css">
    <title><?php echo SITENAME ?></title>
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT; ?>/images/driver/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>





</head>

<?php
        // var_dump($data['completedBookings']);
        ?>


<body>
    <nav class="left-menu">
        <div class="user-profile">
            <img src="<?php echo URLROOT; ?>/images/<?php echo $data['profileimage']->profile_picture ?>"
                alt="User Profile Photo">
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
            <li><a href="<?php echo URLROOT?>users/logout" class="active"><i class='bx bxs-log-out bx-sm bx-fw'></i>
                    Logout</a></li>
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

        <div class="search-content">
            <div class="booking-search">
                <input type="text" id="booking-search" placeholder="Search for Boookings">
                <button onclick="filterBookings()">
                    <i class="bx bx-search"></i> <!-- Using the Boxicons search icon -->
                </button>
            </div>
        </div>

        <?php
// Add this before the foreach loop
// var_dump($data);
// var_dump($data['plateNumber']);

//  var_dump($data['paymentAmounts']);



?>
        <div class="table-content">
            <h2>Pending Booking Details</h2>
            <?php
    // Check if $data exists and has the expected structure
    if (!empty($data) && isset($data['pendingBookings'])) {
    ?>
            <table class="booking-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Booking ID</th>
                        <!-- <th>Temp ID</th> -->
                        <th>Passenger Name</th>
                        <th>Passenger Contact Number</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Time</th>
                        <th>Pickup Location</th>
                        <th>End Location</th>
                        <th>Vehicle Plate Number</th>
                        <th>Amount</th>
                        <th>With Driver</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                $pendingBookings = $data['pendingBookings'] ?? [];
                $paymentAmounts = $data['paymentAmounts'] ?? [];

                $count = 0; // Initialize a counter variable

                foreach (array_map(null, $pendingBookings, $paymentAmounts) as [$booking, $payment]) {
                    $count++; // Increment the counter for each iteration
                ?>
                    <tr>
                        <td><?php echo $count; ?></td> <!-- Display the count -->
                        <td><?php echo $booking->booking_id; ?></td>
                        <!-- <td><?php echo $booking->temporyid; ?></td> -->
                        <td><?php echo $booking->traveler_details->fname . ' ' . $booking->traveler_details->lname; ?>
                        </td>
                        <td><?php echo $booking->traveler_details->number; ?></td>
                        <td><?php echo $booking->startDate; ?></td>
                        <td><?php echo $booking->endDate; ?></td>
                        <td><?php echo $booking->start_time; ?></td>
                        <td><?php echo $booking->Pickup_Location; ?></td>
                        <td><?php echo $booking->End_Location; ?></td>
                        <td><?php echo $booking->plate_number; ?></td>
                        <td><?php echo $payment[0]; ?></td>
                        <td><?php echo $booking->withDriver ? 'Yes' : 'No'; ?></td>
                        <td><button class="cancel-button"
                                <?php if ($booking->bookingCondition === 'cancelled') echo 'disabled'; ?>
                                onclick="showCancelPopup(<?php echo $booking->agency_id; ?>, <?php echo $booking->user_id; ?>, '<?php echo $booking->booking_id;?>', '<?php echo $booking->startDate; ?>', '<?php echo $booking->endDate; ?>', <?php echo $booking->temporyid; ?>')">
                                <i class='bx bx-x'></i>
                            </button></td>



                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php } ?>
        </div>

        <div class="dashboard-content">
            <h1>Trip History</h1>
        </div>

        <div class="dashboard-sub-content">
            <div class="top-boxes">

                <!-- Total Request Box -->
                <div class="box">
                    <h2>Total Trips</h2>
                    <p>200</p>
                </div>


            </div>
        </div>

        <div class="search-content">
            <div class="booking-search">
                <input type="text" id="booking-search" placeholder="Search Trips">
                <button>
                    <i class="bx bx-search"></i> <!-- Using the Boxicons search icon -->
                </button>
            </div>
        </div>
        <div class="table-content">
    <h2>Completed Booking Details</h2>
    <table class="booking-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Trip ID</th>
                <th>Trip Charges</th>
                <th>Rating</th>
                <th>Comments</th>
                <th>More Details</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Check if $data exists and has the expected structure
            if (!empty($data) && isset($data['completedBookings']) && isset($data['CpaymentAmounts'])) {
                $completedBookings = $data['completedBookings'];
                $CpaymentAmounts = $data['CpaymentAmounts'];
                $count = 0; // Initialize a counter variable

                foreach (array_map(null, $completedBookings, $CpaymentAmounts) as $pair) {
                    list($booking, $payment) = $pair;
                    $count++; // Increment the counter for each iteration
            ?>
            <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $booking->booking_id; ?></td>
                <td><?php echo $payment[0]; ?></td>
                <td><?php echo isset($booking->feedbacks_details[0]->rating) ? $booking->feedbacks_details[0]->rating : 'N/A'; ?></td>
                <td><?php echo isset($booking->feedbacks_details[0]->feedback) ? $booking->feedbacks_details[0]->feedback : 'No feedback'; ?></td>
                <td>
                    <!-- Add onclick event to trigger showDetails function -->
                    <button class="view-button" onclick="showDetails(<?php echo $count; ?>,
    '<?php echo $booking->booking_id; ?>',
    '<?php echo $booking->traveler_details->fname . ' ' . $booking->traveler_details->lname; ?>',
    '<?php echo $booking->traveler_details->number; ?>',
    '<?php echo $booking->startDate; ?>',
    '<?php echo $booking->endDate; ?>',
    '<?php echo $booking->start_time; ?>',
    '<?php echo $booking->plate_number; ?>',
    '<?php echo $booking->Pickup_Location; ?>',
    '<?php echo $booking->End_Location; ?>',
    '<?php echo $payment[0]; ?>',
    '<?php echo isset($booking->feedbacks_details[0]->rating) ? $booking->feedbacks_details[0]->rating : 'N/A'; ?>',
    '<?php echo isset($booking->feedbacks_details[0]->feedback) ? $booking->feedbacks_details[0]->feedback : 'No feedback'; ?>')">More</button>
</td>
            </tr>
            <?php
                }
            } else {
                // Handle case where data is missing or not in expected format
                echo '<tr><td colspan="6">No data available</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>






    </main>

    <script>
    function showDetails(rowNumber, bookingId,travelerName,travelerNumber, startDate, endDate,start_time, plate_number,pickupLocation,endLocation,payment, rating, feedback) {
    var popupContainer = document.createElement('div');
    popupContainer.classList.add('popup-container');

    var popupContent = document.createElement('div');
    popupContent.classList.add('popup-content');
    popupContent.innerHTML = `
  

<div class="popup-content">
    <h3>Booking Details</h3>
    <div class="booking-detail">
        <strong>Booking ID:</strong> ${bookingId}
    </div>
    <div class="booking-detail">
        <strong>Traveler Name:</strong> ${travelerName}
    </div>
    <div class="booking-detail">
        <strong>Traveler Number:</strong> ${travelerNumber}
    </div>
    <div class="booking-detail">
        <strong>Start Date:</strong> ${startDate}
    </div>
    <div class="booking-detail">
        <strong>End Date:</strong> ${endDate}
    </div>
    <div class="booking-detail">
        <strong>Start Time:</strong> ${start_time}
    </div>
    <div class="booking-detail">
        <strong>Vehicle Number:</strong> ${plate_number}
    </div>
    <div class="booking-detail">
        <strong>Pickup Location:</strong> ${pickupLocation}
    </div>
    <div class="booking-detail">
        <strong>End Location:</strong> ${endLocation}
    </div>
    <div class="booking-detail">
        <strong>Rating:</strong>
        <div class="rating-stars">
            ${generateRatingStars(rating)}
        </div>
    </div>
    <div class="booking-detail">
        <strong>Amount:</strong> ${payment}
    </div>
    <div class="booking-detail">
        <strong>Feedback:</strong> ${feedback}
    </div>
</div>



   


`;

function generateRatingStars(rating) {
        let stars = '';
        for (let i = 1; i <= 5; i++) {
            if (i <= rating) {
                stars += '<span class="rating-stars"></span>';
            } else {
                stars += '<span class="rating-stars empty"></span>';
            }
        }
        return stars;
    }


    popupContainer.appendChild(popupContent);
    document.body.appendChild(popupContainer);

    // Close the popup when clicked outside the content
    popupContainer.addEventListener('click', function (event) {
        if (event.target === popupContainer) {
            document.body.removeChild(popupContainer);
        }
    });
}

</script>
</body>


</html>
