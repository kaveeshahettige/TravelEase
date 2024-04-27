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
                    <p></p>
                </div>

                <!-- Ongoing Bookings Box -->
                <div class="box">
                    <h2>Completed Bookings</h2>
                    <p></p>
                </div>

            
            </div>
        </div>

        <div class="table-content">
            <div class="tab">
                <a href="<?php echo URLROOT?>/driver/bookings"><button class="tablinks">Ongoing
                        Bookings</button></a>
                <a href="<?php echo URLROOT?>/driver/combookings"><button class="tablinks active">Completed
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
            <h2>Completed Booking Details</h2>
            <table class="booking-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Trip ID</th>
                                                <th>Passenger Name</th>

                        <th>Trip Charges</th>
                        <!-- <th>Comments</th> -->
                        <th>More Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                  
            // Check if $data exists and has the expected structure
            if (!empty($data) && isset($data['completedBookings']) ) {
                $completedBookings = $data['completedBookings'];
                // var_dump($data['completedBookings']);
                $count = 0; // Initialize a counter variable

                foreach ($completedBookings as $Cbooking) {
                    
                    $count++; // Increment the counter for each iteration
            ?>
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $Cbooking->booking_id; ?></td>
                        <td><?php echo $Cbooking->fname . ' ' . $Cbooking->lname; ?>
                        <td><?php echo $Cbooking->payment_amount; ?></td>
                       
                        <td>
                            <!-- Add onclick event to trigger showDetails function -->
                            <button class="view-button"
                                onclick="showDetails(<?php echo $count; ?>,
    '<?php echo $Cbooking->booking_id; ?>',
    '                        <td><?php echo $Cbooking->fname . ' ' . $Cbooking->lname; ?>',
    '<?php echo $Cbooking->number; ?>',
    '<?php echo $Cbooking->startDate; ?>',
    '<?php echo $Cbooking->endDate; ?>',
    '<?php echo $Cbooking->start_time; ?>',
    '<?php echo $Cbooking->plate_number; ?>',
    '<?php echo $Cbooking->payment_amount; ?>',

    '<?php echo isset($Cbooking->feedbacks_details[0]->feedback) ? $booking->feedbacks_details[0]->feedback : 'No feedback'; ?>')">More</button>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                // Handle case where data is missing or not in expected format
                echo '<tr><td colspan="6">No data available</td></tr>';
            }
            ?>
            <!-- <?php   var_dump($Cbooking->fname . ' ' . $booking->lname); ?> -->
                </tbody>
            </table>
        </div>






    </main>

    <script>
    function showDetails(rowNumber, bookingId, travelerName, travelerNumber, startDate, endDate, start_time,
        plate_number, payment, rating, feedback) {
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
        <strong>Amount:</strong> ${payment}
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
        popupContainer.addEventListener('click', function(event) {
            if (event.target === popupContainer) {
                document.body.removeChild(popupContainer);
            }
        });
    }
    </script>
</body>


</html>