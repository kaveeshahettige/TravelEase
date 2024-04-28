<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/bookings.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/navigation.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/popup.css">
    <title>Hotel Bookings</title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/hotel/x-icon" href="<?php echo URLROOT; ?>/images/hotel/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<?php
$userData= $data['basicInfo']['userData'];
?>
<?php
$activePage = 'hotel/bookings'; // Set the active page dynamically based on your logic
include 'navigation.php';
?>


<main>
    <div class="logo-container">
        <img src="<?php echo URLROOT; ?>/images/hotel/TravelEase.png" alt="TravelEase Logo">
        <span class="logo-text">TravelEase</span>
    </div>

    <div class="dashboard-content">
        <h1>Bookings</h1>
    </div>

    <div class="dashboard-sub-content">
        <div class="top-boxes">
            <!-- Small Image Boxes -->
            <div class="img-box">
                <img src="<?php echo URLROOT; ?>/images/hotel/dashboard.jpg" alt="hotel Image">
            </div>


            <!-- Total Bookings Box -->
            <?php
            $bookingsCount = $data["bookingsCount"]; ?>
            <div class="box">
                <h2>Total Bookings</h2>
                <p><?php echo $bookingsCount ?></p>
            </div>

            <!-- Ongoing Bookings Box -->
            <?php
            $reviewCount = $data["reviewCount"]; ?>
            <div class="box">
                <h2>Total Reviews</h2>
                <p><?php echo $reviewCount ?></p>
            </div>

            <?php
            $guestCount = $data["guestCount"]; ?>
            <div class="box">
                <h2>Total Customers</h2>
                <p><?php echo $guestCount?></p>
            </div>

        </div>
    </div>

    <div class="table-content">
        <div class="tab">
            <a href="<?php echo URLROOT?>/hotel/bookings"><button class="tablinks">Ongoing Bookings</button></a>
            <a href="<?php echo URLROOT?>/hotel/combookings"><button class="tablinks active">Completed Bookings</button></a>
            <a href="<?php echo URLROOT?>/hotel/rejbookings"><button class="tablinks">Cancelled Bookings</button></a>
        </div>
    </div>

    <div class="search-content">
        <div class="booking-search">
            <input type="text" id="booking-search" placeholder="Enter Name or Room Type">
            <input type="date" id="start-date" placeholder="Start Date">
            <input type="date" id="end-date" placeholder="End Date">
            <button onclick="filterBookings()">
                <i class="bx bx-search"></i>
            </button>
        </div>
    </div>

    <script>
        function filterBookings() {
            var input, filter, startDate, endDate, table, tr, tdGuestName, tdRoomType, tdStartDate, tdEndDate, i, txtGuestName, txtRoomType,txtRoomNumber ;
            input = document.getElementById("booking-search");
            filter = input.value.toUpperCase();
            startDate = document.getElementById("start-date").value;
            endDate = document.getElementById("end-date").value;
            table = document.querySelector(".booking-table");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                tdGuestName = tr[i].getElementsByTagName("td")[1]; // Index 1 for Guest Name column
                tdRoomType = tr[i].getElementsByTagName("td")[4]; // Index 4 for Room Type column
                tdStartDate = tr[i].getElementsByTagName("td")[2]; // Index 2 for Check-in Date column
                tdEndDate = tr[i].getElementsByTagName("td")[3]; // Index 3 for Check-out Date column
                tdRoomNumber = tr[i].getElementsByTagName("td")[3]; // Index 3 for Room Number column

                if (tdGuestName && tdRoomType && tdRoomNumber) {
                    txtGuestName = tdGuestName.textContent || tdGuestName.innerText;
                    txtRoomType = tdRoomType.textContent || tdRoomType.innerText;
                    txtRoomNumber = tdRoomNumber.textContent || tdRoomNumber.innerText;
                    if ((txtGuestName.toUpperCase().indexOf(filter) > -1 || txtRoomType.toUpperCase().indexOf(filter) > -1 || txtRoomNumber.toUpperCase().indexOf(filter) > -1) &&
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
        <h2>Completed Booking Details</h2>
        <?php if (empty($data["completedBookings"])): ?>
            <p>No completed bookings</p>
        <?php else: ?>
            <table class="booking-table">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Guest Name</th>
                    <th>Check-in Date</th>
                    <th>Check-out Date</th>
                    <th>Room Number</th>
                    <th>Room Type</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>


                <?php
                $completedBookings = $data["completedBookings"];
                //                var_dump($bookingData[6]);
                foreach ($completedBookings as $key => $completedbooking):

                    ?>

                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo $completedbooking->fname; ?></td>
                        <td><?php echo date("Y-m-d", strtotime($completedbooking->startDate)); ?></td>
                        <td><?php echo date("Y-m-d", strtotime($completedbooking->endDate)); ?></td>
                        <td><?php echo $completedbooking->registration_number; ?></td>
                        <td><?php echo $completedbooking->roomType; ?></td>
                        <td>
                            <button class="view-button" onclick="openPopup(); updatePopupDetails('<?php echo $completedbooking->profile_picture; ?>','<?php echo $completedbooking->fname; ?>', '<?php echo $completedbooking->startDate; ?>', '<?php echo $completedbooking->roomType; ?>')">
                                <i class='bx bx-show'></i>
                            </button>



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




</main>

<div class="popup" id="popup">
    <div class="popup-content">
        <span class="close" onclick="closePopup()">&times;</span>
        <!-- Add details about the booking here -->
        <h2>Booking Details</h2>
        <div id="profile-picture" class="profile-picture"></div>
        <p id="guestName">Guest Name: John Doe</p>
        <p id="checkInDate">Check-in Date: 2023-09-01</p>
        <p id="roomType">Room Type: Single Room</p>
        <!-- Add more details as needed -->
    </div>
</div>
<script src= "<?php echo URLROOT?>/public/js/hotel/bookings.js"></script>
</body>
</html>
