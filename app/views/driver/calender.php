<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/driver/calender.css">
    <script src="<?php echo URLROOT; ?>/public/js/hotel/popup.js"></script>
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/popup.css">
    <!-- <link rel="stylesheet" href="<?php echo URLROOT ?>/css/hotel/calender.css"> -->
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/hotel/calenders.css">
    <title><?php echo SITENAME ?></title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/driver/x-icon" href="<?php echo URLROOT; ?>/images/driver/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        /* Popup styles */
        .popup {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: rgba(0, 0, 0, 0.5); /* semi-transparent background */
    padding: 20px;
    border: 1px solid #ccc;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    z-index: 1000;
    max-width: 300px;
    display: none;
}

.popup-content {
    text-align: center;
}

.popup p {
    margin-bottom: 10px;
    color: #fff; /* text color for better visibility on dark background */
}

.popup button {
    padding: 8px 16px;
    background-color: #007bff;
    color: #fff;
    border: none;
    cursor: pointer;
}

.popup button:hover {
    background-color: #0056b3;
}

.close-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
    color: #fff; /* close button color */
}

    </style>

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
            <li><a href="<?php echo URLROOT; ?>driver/calender" class="active"><i class='bx bxs-book bx-sm'></i> Availabily Calender</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/bookings"><i class='bx bxs-package bx-sm'></i></i> Bookings</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/vehicle"><i class='bx bxs-car bx-sm'></i> Vehicle Informaion </a></li>
            <li><a href="<?php echo URLROOT; ?>driver/earings"><i class='bx bx-money-withdraw bx-sm'></i>Earings and Payments</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/notification"><i class='bx bxs-bell bx-sm bx-sm'></i>Notification</a></li>
            
            <li><a href="<?php echo URLROOT; ?>driver/reviews"><i class='bx bxs-star bx-sm bx-fw'></i> Reviews</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/settings"><i class='bx bxs-cog bx-sm'></i> Settings</a></li>
            <li> <a href="#" class="nav-button active" onclick="confirmLogout(event)"><i class='bx bxs-log-out bx-sm bx-fw'></i> Logout</a></li>
        </ul>
        
        <!-- <div class="logout">
            <a href="<?php echo URLROOT; ?>pages/indes" class="active"><i class='bx bxs-log-out bx-sm bx-fw'></i>  Logout</a>
        </div> -->
    </nav>

    <main>
        <div class="logo-container">
            <img src="<?php echo URLROOT; ?>/images/hotel/TravelEase.png" alt="TravelEase Logo">
            <span class="logo-text">TravelEase</span>
        </div>

        <div class="dashboard-content">
            <h1>Availability</h1>
        </div>


        <div class="dashboard-sub-content">

            <div class="calendar-container">
                <div class="calendar-content">
                    <div class="calendar-header">
                        <button onclick="navigateMonth(-1)">←</button>
                        <span id="current-month-year"></span>
                        <button onclick="navigateMonth(1)">→</button>
                    </div>
                    <div id="calendar-days" class="calendar-days"></div>
                </div>
                <div class="availability-content" id="availability-content">
                    <div id="selected-date"></div>
<!--                    <div id="availability-info"></div>-->
                    <div class="calendar-buttons">
                        <div class="calendar-buttons">
                            <div class="calendar-buttons">
                          
                            <form id="availabilityForm" action="<?= URLROOT ?>/driver/availablevehicles" method="get" onsubmit="return handleFormSubmit(event)">
    <input type="hidden" name="action" value="check_availability">
    <input name="date" type="hidden" id="selectedDate" value="<?php echo htmlspecialchars($data["selectedDate"]); ?>">
    <button type="submit" id="checkAvailabilityBtn">Check Availability</button>
    <p id="dateError" style="color: red; display: none;">Please select a date.</p>

    <?php
    $userData = $data['basicInfo']['userData'];
    // var_dump($data['vehicleCount']);
    ?>

    <!-- Popup content -->
    <div id="popup" class="popup" style="display: none;">
    <div class="popup-content">
        <span class="close-btn" onclick="closePopup()">&times;</span>
        <p>No vehicles available. Please add a vehicle to change availability.</p>
    </div>
</div>

</form>











                            </div>

                        </div>
                    </div>
                </div>
                <script src="<?php echo URLROOT ?>/public/js/driver/calender.js"></script>
                
            </div>



    </main>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var checkAvailabilityBtn = document.getElementById('checkAvailabilityBtn');
        var popup = document.getElementById('popup');

        checkAvailabilityBtn.addEventListener('click', function(event) {
            var vehicleCount = <?php echo $data['vehicleCount']; ?>;
            if (vehicleCount <= 0) {
                event.preventDefault(); // Prevent form submission
                popup.style.display = 'block'; // Show the popup
            }
        });
    });

    function closePopup() {
    var popup = document.getElementById('popup');
    popup.style.display = 'none';
}
</script>

</body>
</html>
