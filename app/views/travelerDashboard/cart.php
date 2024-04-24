<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
    <title>TravelEase</title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/hotel/x-icon" href="<?php echo URLROOT; ?>/images/hotel/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/travelerDashboard/cart.css">    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo URLROOT?>js/travelerDashboard/script.js"></script>
</head>
<body>
    <nav class="left-menu">
        <div class="user-profile">
        <img style="cursor: pointer;" src="<?php echo empty($data['profile_picture']) ? URLROOT.'images/user.jpg' : URLROOT.'images1/'.$data['profile_picture']; ?>" alt="Profile Picture" alt="User Profile Photo" onclick="gotoHome()"> 
            <span class="user-name"><?php echo $data['fname']."   ".$data['lname']?></span>
        </div>
        
        <div class="search-bar">
            <form action="#" method="GET">
                <input type="text" placeholder="Find a Setting">
                <button type="submit">Search</button>
            </form>
        </div>
        
        <ul>
            <li><a href="<?php echo URLROOT; ?>travelerDashboard/index/<?php echo $_SESSION['user_id']?>" class="nav-button "><i class='bx bxs-dashboard bx-sm'></i>Overview</a></li>
            <li><a href="<?php echo URLROOT; ?>travelerDashboard/bookings/<?php echo $_SESSION['user_id']?>" class="nav-button "><i class='bx bxs-book bx-sm bx-fw'></i> Bookings</a></li>
            <li><a href="<?php echo URLROOT; ?>travelerDashboard/payments/<?php echo $_SESSION['user_id']?>" class="nav-button"><i class='bx bxs-package bx-sm' class="nav-button "></i></i> Payments</a></li>
            <li><a href="<?php echo URLROOT; ?>travelerDashboard/notifications/<?php echo $_SESSION['user_id']?>" class="nav-button"><i class='bx bxs-report bx-sm' class="nav-button "></i> Notifications</a></li>
            <li><a href="<?php echo URLROOT; ?>travelerDashboard/previoustrips/<?php echo $_SESSION['user_id']?>" class="nav-button"><i class='bx bx-line-chart bx-sm' class="nav-button "></i> Previous Trips</a></li>
            <li><a href="<?php echo URLROOT?>travelerDashboard/cart/<?php echo $_SESSION['user_id']?>" class="nav-button active"><i class='bx bx-cart bx-sm'></i> Cart</a></li>
            <li><a href="<?php echo URLROOT?>travelerDashboard/settings/<?php echo $_SESSION['user_id']?>" class="nav-button "><i class='bx bxs-cog bx-sm'></i> Settings</a></li>
           
        </ul>

        <div class="logout">
            <a href="<?php echo URLROOT?>users/logout" class="nav-button active"><i class='bx bxs-log-out bx-sm bx-fw'></i>  Logout</a>
        </div>
        
        
    </nav>
    <main>
        <div class="logo-container">
            <img src="<?php echo URLROOT; ?>/images/hotel/TravelEase.png" alt="TravelEase Logo">
            <span class="logo-text">TravelEase</span>
        </div>
        
        <div class="dashboard-content">
            <h1>Carts</h1>
        </div>

        <div class="dashboard-sub-content">
        <div class="top-boxes">
            <!-- Small Image Boxes -->
            <div class="img-box">
                <img src="<?php echo URLROOT; ?>/images/hotel/dashboard.jpg" alt="hotel Image">
            </div>
           

            <!-- Total Bookings Box -->
            <div class="box">
                <h2>Total Carts</h2>
                <p><?php  echo $data['noofCarts']?></p>
            </div>
            <div class="box">
                <h2>Total Items</h2>
                <p><?php  echo $data['noofCartItems']?></p>
            </div>
        </div>
        </div>
    <!-- <?php echo var_dump($data['cartDetails'])?> -->
        <div class="search-content">
        <div class="booking-search">
            <input type="text" id="booking-search" placeholder="Search for Bookings">
            <button onclick="filterBookings()">
                <i class="bx bx-search"></i> <!-- Using the Boxicons search icon -->
            </button>
        </div>
        </div>

        <div class="table-content">

    <h2>Cart Details</h2>
    <div class="card-container">
        <!-- Loop through each cart item to display as a card -->
        <?php
        
        if (!empty($data['cartDetails']) && is_array($data['cartDetails'])) {
            // Array to keep track of displayed IDs
            $displayedIds = [];
        
            foreach ($data['cartDetails'] as $booking) {
                // Check if the current ID has already been displayed
                if (!in_array($booking->cartbooking_id, $displayedIds)) {
                    $displayedIds[] = $booking->cartbooking_id;
        
                    // Get all names for this cartbooking_id
                    $names = [];
                    foreach ($data['cartDetails'] as $provider) {
                        if ($provider->cartbooking_id === $booking->cartbooking_id) {
                            $names[] = $provider->fname.' '.$provider->lname;
                        }
                    }
        
                    // Display the card for this booking
                    echo '<div class="card">';
                    echo '<div class="card-content">';
                    echo '<h3>Trip : ' . implode(', ', $names) . '</h3>';
        
                    // Display names separated by commas
        
                    // echo '<p>Start Date: ' . $booking->startDate . '</p>';
                    // echo '<p>End Date: ' . $booking->endDate . '</p>';
                    echo '<p>Added Date: ' . date('Y-m-d', strtotime($booking->bookingDate)) . '</p>';
                    echo '<div class="card-buttons">';
                    echo '<button class="viewbooking" onclick="proceedCart(\'' . $booking->cartbooking_id . '\')">';
                    echo '<i class="bx bx-chevron-right"></i> Proceed</button>';  //icon 
                    echo '<button class="cancel-button" onclick="removeCart(\'' . $booking->cartbooking_id . '\')">';
                    echo '<i class="bx bx-trash"></i> Remove</button>'; //icon 
                    echo '</div>'; // Close card-buttons
                    echo '</div>'; // Close card-content
                    echo '</div>'; // Close card
                }
            }
                
        } else {
            // Display a message if there are no cart details
            echo '<p>No cart items available</p>';
        }
        ?>
    </div> <!-- End of card-container -->
</div>


 

    <div id="myModal" class="modal1">
  <div class="modal1-content">
    <span class="close1">&times;</span>
    <iframe id="popupFrame" width="100%" height="100%"></iframe>
  </div>
</div>


   <!-- Hidden modal for cancellation confirmation -->
<div id="confirmationModal" class="modal2">
  <div class="modal2-content">
    <span class="close2">&times;</span>
    <p>Are you sure you want to remove this from cart?</p>
    <button id="confirmCancelBtn">Yes, Remove</button>
    <button id="denyCancelBtn">No,Close</button>
    <div id="confirmationMessage"></div>
  </div>
</div>
<iframe id="cancelFrame" style="display: none;"></iframe>

<!-- // -->
<!-- Date Modal -->
<!-- Date Modal -->
<div id="dateModal">
    <div id="dateModal-content">
        <span class="close-date-modal" onclick="closeDateModal()">&times;</span>
        <h2>Enter Check-in and Check-out Dates : </h2>
        <form id="dateForm">
            <!-- Hidden input for cartId -->
            <input type="hidden" id="cartIdInput" name="cartIdInput" >

            <label for="checkin">Check-in Date:</label>
            <input type="date" id="checkin" name="checkin" min="<?php echo date('Y-m-d'); ?>" required>

            <label for="checkout">Check-out Date:</label>
            <input type="date" id="checkout" name="checkout" min="<?php echo date('Y-m-d'); ?>" required>

            <button type="button" onclick="submitDates()">Submit</button>
        </form>
    </div>
</div>



<script>
        // Function to open the date modal
        function openDateModal() {
            document.getElementById("dateModal").style.display = "block";
        }

        // Function to close the date modal
        function closeDateModal() {
            document.getElementById("dateModal").style.display = "none";
        }

        // Function to handle "Proceed" button click
        function proceedCart(cartId) {
            // Open the date modal
            openDateModal();
            console.log("Proceeding with Cart ID: " + cartId);

            // Save the cartId somewhere (e.g., a hidden field in the form)
            document.getElementById("cartIdInput").value = cartId;
        }

        // Function to submit dates from the date modal
       // Function to submit dates from the date modal
function submitDates() {
    // Get the selected dates
    var checkinElement = document.getElementById("checkin");
    var checkoutElement = document.getElementById("checkout");

    // Check if the elements exist
    if (!checkinElement || !checkoutElement) {
        console.error("Check-in or Check-out element not found.");
        return;
    }

    var checkinDate = checkinElement.value;
    var checkoutDate = checkoutElement.value;

    // Get the cartId from the hidden input
    var cartIdInput = document.getElementById("cartIdInput");
    if (!cartIdInput) {
        console.error("Cart ID input not found.");
        return;
    }
    var cartId = cartIdInput.value;

    // Close the date modal
    closeDateModal();

    // You can now use the cartId, checkinDate, and checkoutDate
    // For example, you can make an AJAX request to send this data to the server
    console.log("Cart ID: " + cartId);
    console.log("Check-in Date: " + checkinDate);
    console.log("Check-out Date: " + checkoutDate);

    // Here you can do further processing or send the data to the server
    // For now, just an example alert
    window.location.href = "<?php echo URLROOT; ?>travelerDashboard/myCartDetails/" + cartId + "/" + checkinDate + "/" + checkoutDate;
    //alert("Proceeding with Cart ID: " + cartId + "\nCheck-in: " + checkinDate + "\nCheck-out: " + checkoutDate);
}

    </script>


   <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the form and input elements
        const bookingForm = document.getElementById("dateForm");
        const checkinDateInput = document.getElementById("checkin");
        const checkoutDateInput = document.getElementById("checkout");

        // Add event listener for form submission
        bookingForm.addEventListener("submit", function(event) {
            // Prevent form submission if validation fails
            if (!validateDates()) {
                event.preventDefault();
            }
        });

        // Function to validate dates
        function validateDates() {
            const checkinDate = new Date(checkinDateInput.value);
            const checkoutDate = new Date(checkoutDateInput.value);
            const today = new Date();

            // Check if check-in date is after check-out date
            if (checkinDate >= checkoutDate) {
                alert("Check-out date must be after check-in date.");
                return false;
            }

            // Check if check-in date is in the past
            if (checkinDate < today) {
                alert("Check-in date cannot be in the past.");
                return false;
            }

            // Check if check-out date is in the past
            if (checkoutDate < today) {
                alert("Check-out date cannot be in the past.");
                return false;
            }

            // All validations passed
            return true;
        }

        // Update min date for checkout when checkin changes
        checkinDateInput.addEventListener("change", function() {
            checkoutDateInput.min = checkinDateInput.value; // Update min date for checkout
        });
    });
</script>



</body>

</html>

