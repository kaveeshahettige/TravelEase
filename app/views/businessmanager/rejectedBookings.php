<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/bookings.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/businessmanager/navigation.css">
    <title>Business Manager Bookings</title>
    <link rel="icon" type="<?php echo URLROOT?>/images/x-icon" href="<?php echo URLROOT?>/images/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<?php
$activePage = 'businessmanager/bookings'; // Set the active page dynamically based on your logic
include 'navigation.php';
?>
<main>
    <div class="logo-container">
        <img src="<?php echo URLROOT?>/images/TravelEase.png" alt="TravelEase Logo">
        <span class="logo-text">TravelEase</span>
    </div>

    <div class="dashboard-content">
        <h1>Bookings</h1>
    </div>

    <div class="dashboard-sub-content">
        <div class="top-boxes">
            <!-- Small Image Boxes -->
            <div class="img-box">
                <img src="<?php echo URLROOT?>/images/dashboard.jpg" alt="hotel Image">
            </div>


            <?php
            $bookingsCount = $data["bookingsCount"]; ?>
            <div class="box">
                <h2>Total Bookings</h2>
                <p><?php echo $bookingsCount ?></p>
            </div>


            <!-- Ongoing Bookings Box -->
            <?php
            $OngoingCount = $data["OngoingCount"]; ?>
            <div class="box">
                <h2>Ongoing Bookings</h2>
                <p><?php echo $OngoingCount ?></p>
            </div>

            <!-- Customers Box -->
            <?php
            $guestCount = $data["guestCount"]; ?>
            <div class="box">
                <h2>Total Customers</h2>
                <p><?php echo $guestCount ?></p>
            </div>
        </div>
    </div>

    <div class="table-content">
        <div class="tab">
            <a href="<?php echo URLROOT?>/businessmanager/bookings"><button class="tablinks">Ongoing Bookings</button></a>
            <a href="<?php echo URLROOT?>/businessmanager/completedBookings"><button class="tablinks">Completed Bookings</button></a>
            <a href="<?php echo URLROOT?>/businessmanager/rejectedBookings"><button class="tablinks active">Cancelled Bookings</button></a>
        </div>
    </div>

    <div class="search-content">
        <div class="booking-search">
            <input type="text" id="booking-search" placeholder="Enter Name">
            <input type="date" id="start-date" placeholder="Start Date">
            <input type="date" id="end-date" placeholder="End Date">
            <button onclick="filterBookings()">
                <i class="bx bx-search"></i>
            </button>
        </div>
    </div>

    <script>
        function filterBookings() {
            var input, filter, startDate, endDate, table, tr, tdGuestName, tdServiceType, tdServiceProvider, tdStartDate, tdEndDate, i, txtGuestName, txtServiceType, txtServiceProvider;
            input = document.getElementById("booking-search");
            filter = input.value.toUpperCase();
            startDate = document.getElementById("start-date").value;
            endDate = document.getElementById("end-date").value;
            table = document.querySelector(".booking-table");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                tdGuestName = tr[i].getElementsByTagName("td")[1]; // Index 1 for Guest Name column
                tdServiceType = tr[i].getElementsByTagName("td")[2]; // Index 2 for Service Type column
                tdServiceProvider = tr[i].getElementsByTagName("td")[3]; // Index 3 for Service Provider column
                tdStartDate = tr[i].getElementsByTagName("td")[4]; // Index 4 for Start Date column
                tdEndDate = tr[i].getElementsByTagName("td")[5]; // Index 5 for End Date column

                if (tdGuestName && tdServiceType && tdServiceProvider) {
                    txtGuestName = tdGuestName.textContent || tdGuestName.innerText;
                    txtServiceType = tdServiceType.textContent || tdServiceType.innerText;
                    txtServiceProvider = tdServiceProvider.textContent || tdServiceProvider.innerText;

                    if ((txtGuestName.toUpperCase().indexOf(filter) > -1 || txtServiceType.toUpperCase().indexOf(filter) > -1 || txtServiceProvider.toUpperCase().indexOf(filter) > -1) &&
                        (compareDates(startDate, tdStartDate.textContent.trim()) && compareDates(tdEndDate.textContent.trim(), endDate))) {
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
            return startDate <= endDate;
        }
    </script>

    <div class="table-content">
        <h2>Cancelled Bookings</h2>
        <table class="booking-table">
            <thead>
            <tr>
                <th>No</th>
                <th>Guest Name</th>
                <th>Service Type</th>
                <th>Service Provider</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Service Details</th>
                <th>Payment Amount</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $bookings = $data["bookingData"];
            foreach ($bookings as $key => $booking):
                ?>

                <tr>
                    <td><?php echo $key + 1; ?></td>
                    <td><?php echo $booking->traveler_name; ?></td>
                    <td><?php echo $booking->service_type; ?></td>
                    <td><?php echo $booking->serviceprovider_name; ?></td>
                    <td><?php echo $booking->startDate; ?></td>
                    <td><?php echo $booking->endDate; ?></td>
                    <td><?php echo $booking->service_detail?></td>
                    <td><?php echo $booking->payment_amount; ?></td>
                    <td>
                        <button class="view-button" onclick="openPopup();updatePopupDetails('<?php echo $booking->traveler_name; ?>', '<?php echo $booking->service_type; ?>', '<?php echo $booking->serviceprovider_name; ?>', '<?php echo $booking->startDate; ?>', '<?php echo $booking->endDate; ?>', '<?php echo $booking->service_detail; ?>', '<?php echo $booking->payment_amount; ?>')">
                            <i class='bx bx-show'></i>
                        </button>
                    </td>
                </tr>

            <?php endforeach; ?>
            </tbody>
        </table>
    </div>



    <div class="more-content">
        <button class="next-page-btn">See More <i class='bx bx-chevron-right'></i></button>
    </div>
    <div class="popup" id="popup">
        <div class="popup-content">
            <span class="close" onclick="closePopup()">&times;</span>
            <!-- Add details about the booking here -->
            <h2>Cancelled Booking Details</h2>
            <div id="profile-picture" class="profile-picture"></div>
            <p id="traveler_name">Guest Name: </p>
            <p id="service_type">Service Type: </p>
            <p id="serviceprovider_name">Service Provider: </p>
            <p id="startDate">Start Date: </p>
            <p id="endDate">End Date: </p>
            <p id="service_detail">Service Details: </p>
            <p id="payment_amount">Payment Amount: </p>
        </div>
    </div>


    <script src= "<?php echo URLROOT?>/public/js/businessmanager/bookings.js"></script>

</main>
</body>
</html>
