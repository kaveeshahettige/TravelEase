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
                            <td><button class="cancel-button" onclick="cancelBooking(\'<?php echo $booking->temporyid; ?>\', \'<?php echo $booking->booking_id; ?>\')"><i class="bx bx-x-circle"></i> Cancel Booking</button></td>



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
                <form action="<?php echo URLROOT; ?>/driver/bookings" method="post">
                    <h2>Completed Booking Details</h2>
                    <table class="booking-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Trip ID</a></th>
                                <th>Trip Charges</th>
                                <th>Rating</th>
                                <th>Comments</th>
                                <th>More Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                $completedBookings = $data['completedBookings'] ?? [];
                $CpaymentAmounts = $data['CpaymentAmounts'] ?? [];
                $count = 0; // Initialize a counter variable


                foreach (array_map(null, $completedBookings, $CpaymentAmounts) as [$booking, $payment]) {
                    $count++; // Increment the counter for each iteration
                ?>
                            <tr>
                                <td><?php echo $count; ?></td> <!-- Display the count -->
                                <td><?php echo $booking->booking_id; ?></td>
                                <td><?php echo $payment[0]; ?></td>
                                <td><?php echo isset($booking->feedbacks_details[0]->rating) ? $booking->feedbacks_details[0]->rating : 'N/A'; ?>
                                </td>
                                <td><?php echo isset($booking->feedbacks_details[0]->feedback) ? $booking->feedbacks_details[0]->feedback : 'No feedback'; ?>
                                </td>
                                <td>
                                    <button class="view-button"
                                        onclick="showCompleteBookingsPopup('<?php echo $booking->booking_id; ?>')">More</button>
                                </td>
                                <?php } ?>
                        </tbody>
                    </table>
                </form>
            </div>


            


            <!-- <div id="tripDetailsPopup" class="popup">
                <div class="popup-content">
                    Trip details content
                    <h3>Trip Details</h3>
                    <div class="detail-row">
                        <label>Booking ID:</label>
                        <span id="bookingId"></span>
                    </div>
                    <div class="detail-row">
                        <label>Passenger Name:</label>
                        <span id="passengerName"></span>
                    </div>
                    <div class="detail-row">
                        <label>Contact Number:</label>
                        <span id="contactNumber"></span>
                    </div>
                    <div class="detail-row">
                        <label>Start Date:</label>
                        <span id="startDate"></span>
                    </div>
                    <div class="detail-row">
                        <label>End Date:</label>
                        <span id="endDate"></span>
                    </div>
                    <div class="detail-row">
                        <label>Time:</label>
                        <span id="time"></span>
                    </div>
                    <div class="detail-row">
                        <label>Pickup Location:</label>
                        <span id="pickupLocation"></span>
                    </div>
                    <div class="detail-row">
                        <label>End Location:</label>
                        <span id="endLocation"></span>
                    </div>
                    <div class="detail-row">
                        <label>Vehicle Plate Number:</label>
                        <span id="plateNumber"></span>
                    </div>
                    <div class="detail-row">
                        <label>Amount:</label>
                        <span id="amount"></span>
                    </div>
                    <div class="detail-row">
                        <label>With Driver:</label>
                        <span id="withDriver"></span>
                    </div>
                    <button onclick="closePopup()">Close</button>
                </div>
            </div> -->



            <div id="confirmationModal" class="modal2">
  <div class="modal2-content">
    <span class="close2">&times;</span>
    <p>Are you sure you want to cancel this booking?</p>
    <button id="confirmCancelBtn">Yes, Cancel Booking</button>
    <button id="denyCancelBtn">No,Close</button>
    <div id="confirmationMessage"></div>
  </div>
</div>
<iframe id="cancelFrame" style="display: none;"></iframe>











        
</body>

<script>
    // Declare confirmBtn and confirmationMessage globally
var confirmBtn, confirmationMessage;

document.addEventListener("DOMContentLoaded", function(){
  // Get the confirmation button, deny button, and the <span> element that closes the modal
  confirmBtn = document.getElementById("confirmCancelBtn");
  var denyBtn = document.getElementById("denyCancelBtn");
  var span = document.getElementsByClassName("close2")[0];
  // Get the confirmation message element
  confirmationMessage = document.getElementById("confirmationMessage");

  // Event listener for the <span> element that closes the modal
  span.onclick = function() {
    closeModal();
  }

  // Event listener for clicks outside the modal to close it
  window.onclick = function(event) {
    var modal = document.getElementById("confirmationModal");
    if (event.target == modal) {
      closeModal();
    }
  }

  // Event listener for the deny button to close the modal
  denyBtn.onclick = function() {
    closeModal();
  }
});

// Function to open the confirmation modal
function openModal() {
  var modal = document.getElementById("confirmationModal");
  modal.style.display = "block";
}

// Function to close the confirmation modal after a delay
function closeModalWithDelay() {
  // Close the modal after a delay of 2 seconds
  setTimeout(function() {
    closeModal();
  }, 2000); // Adjust the delay as needed
}

// Function to close the confirmation modal
function closeModal() {
  var modal = document.getElementById("confirmationModal");
  modal.style.display = "none";
}

// Function to handle cancellation of booking
function cancelBooking(tid, bookingId){
  console.log("Traveler ID: " + tid);
  console.log("Cancelling booking with ID: " + bookingId);

  // Call the function to open the confirmation modal
  openModal();

  // Event listener for the confirmation button
  confirmBtn.onclick = function() {
    // Display the confirmation message
    confirmationMessage.innerHTML = "Deleting successful. Refund will be processed shortly.";

    // Execute the cancellation action using iframe
    var iframe = document.getElementById("cancelFrame");
    iframe.onload = function() {
      // After the cancellation action is completed, refresh the page
      //window.location.reload();
      window.location.href = "http://localhost/TravelEase/loggedTraveler/index";
    };
    iframe.src = "http://localhost/TravelEase/driver/cancelBooking/" + tid + "/" + bookingId;

    // Close the confirmation modal after action is performed with a delay
    closeModalWithDelay();
  }
}



// Function to simulate refund initiation
function initiateRefund() {
  // Simulate refund process (for demonstration purposes)
  setTimeout(function() {
    location.reload();
  }, 2000);
}
</script>

</html>