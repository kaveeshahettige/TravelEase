<?php
/** @var array $data */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/hotel/calender.css">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/hotel/calenders.css">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/hotel/navigation.css">
    <title>Hotel Availability</title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/hotel/x-icon" href="<?php echo URLROOT; ?>/images/hotel/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <?php
    $activePage = 'hotel/calender';
    include 'navigation.php';
    ?>
    <main>
        <div class="logo-container">
            <img src="<?php echo URLROOT; ?>/images/hotel/TravelEase.png" alt="TravelEase Logo">
            <span class="logo-text">TravelEase</span>
        </div>

        <div class="dashboard-content">
            <h1>Availability</h1>
        </div>

        <div class="dashboard-sub-content">
            <div class="top-boxes">
                <!-- Small Image Boxes -->
                <div class="img-box">
                    <img src="<?php echo URLROOT; ?>/images/hotel/dashboard.jpg" alt="hotel Image">
                </div>


                <!-- Total Bookings Box -->
                <div class="box">
                    <h2>Total Rooms Allocated</h2>
                    <p>10</p>
                </div>

                <!-- Ongoing Bookings Box -->
                <div class="box">
                    <h2>Booked Rooms</h2>
                    <p>5</p>
                </div>

                <!-- Customers Box -->
                <div class="box">
                    <h2>Available Rooms</h2>
                    <p>5</p>
                </div>
            </div>
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
                    <div id="availability-info"></div>
                    <div class="calendar-buttons">
                        <div class="calendar-buttons">
                            <div class="calendar-buttons">

                                <form id="availabilityForm" action="<?= URLROOT?>/hotel/availablerooms" method="get" onsubmit="return handleFormSubmit()">
                                    <input type="hidden" name="action" value="check_availability">


                                    <input name="date" type="hidden" id="selectedDate" value="<?php
                                    echo htmlspecialchars($data["selectedDate"]); ?>">
                                    <button type="submit" id="checkAvailabilityBtn" disabled>Check Availability</button>
<!--                                    <p id="dateError" style="color: red; display: none;">Please select a date.</p>-->
                                </form>

                            </div>

                        </div>
                    </div>
                </div>
                <script src="<?php echo URLROOT ?>/public/js/hotel/calender.js"></script>
            </div>



    </main>
</body>

</html>