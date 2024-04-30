<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/bookings.css">
    <script src= "<?php echo URLROOT?>/public/js/businessmanager/script.js"></script>
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/businessmanager/navigation.css">
    <title>Registered Vehicles</title>
    <link rel="icon" type="<?php echo URLROOT?>/images/x-icon" href="<?php echo URLROOT?>/images/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<?php
$activePage = 'businessmanager/services'; // Set the active page dynamically based on your logic
include 'navigation.php';
?>
<main>
    <div class="logo-container">
        <img src="<?php echo URLROOT?>/images/TravelEase.png" alt="TravelEase Logo">
        <span class="logo-text">TravelEase</span>
    </div>

    <div class="dashboard-content">
        <h1>Registered Vehicles</h1>
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
            <a href="<?php echo URLROOT?>/businessmanager/services"><button class="tablinks">Registered Rooms</button></a>
            <a href="<?php echo URLROOT?>/businessmanager/vehicles"><button class="tablinks active">Registered Vehicles</button></a>
            <a href="<?php echo URLROOT?>/businessmanager/guide"><button class="tablinks">Registered Guides</button></a>
        </div>
    </div>

    <div class="table-content">
        <table class ="booking-table">
            <tr>
                <th>Vehicle ID</th>
                <th>Agency Name</th>
                <th>Vehicle Name</th>
                <th>Vehicle Type</th>
                <th>Vehicle Plate Number</th>
                <th>Vehicle Price</th>
                <th>Vehicle Description</th>
                <th>Action</th>
            </tr>
            <?php
            $vehicles = $data["vehicles"];
            foreach ($vehicles as $key=>$vehicle) {
                ?>
                <tr>
                    <td><?php echo  $key+1 ?></td>
                    <td><?php echo $vehicle->agency_name; ?></td>
                    <td><?php echo $vehicle->brand; ?></td>
                    <td><?php echo $vehicle->model; ?></td>
                    <td><?php echo $vehicle->plate_number; ?></td>
                    <td><?php echo $vehicle->priceperday; ?></td>
                    <td><?php echo $vehicle->description; ?></td>
                    <td>
                        <button class="view-button" onclick="vehicleopenPopup();vehicleupdatePopupDetails('<?php echo $vehicle->agency_name; ?>','<?php echo $vehicle->brand; ?>','<?php echo $vehicle->model; ?>','<?php echo $vehicle->plate_number; ?>',<?php echo $vehicle->priceperday; ?>,'<?php echo $vehicle->description; ?>')">
                            <i class='bx bx-show'></i>
                        </button>
                    </td>
                </tr>
            <?php } ?>
        </table>

        <div class="more-content">
            <button class="next-page-btn" onclick="showNextPage()">See More <i class='bx bx-chevron-right'></i></button>
        </div>

        <script>
            // JavaScript function to show the next page of table rows
            function showNextPage() {
                var table = document.querySelector(".booking-table");
                var tr = table.getElementsByTagName("tr");
                var i;
                for (i = 0; i < tr.length; i++) {
                    if (tr[i].style.display === "none") {
                        tr[i].style.display = "";
                    }
                }
            }
            //limit rows
            var table = document.querySelector(".booking-table");
            var tr = table.getElementsByTagName("tr");
            var i;
            for (i = 0; i < tr.length; i++) {
                if (i > 10) {
                    tr[i].style.display = "none";
                }
            }

        </script>

        <div class="popup" id="popup">
            <div class="popup-content">
                <span class="close" onclick="closePopup()">&times;</span>
                <!-- Add details about the booking here -->
                <h2>Vehicle Details</h2>
                <p id="agency_name">Agency Name: </p>
                <p id="brand">Vehicle Name: </p>
                <p id="model">Vehicle Type: </p>
                <p id="plate_number">Vehicle Plate Number: </p>
                <p id="priceperday">Vehicle Price: </p>
                <p id="description">Vehicle Description: </p>
            </div>
        </div>



</main>
</body>
</html>
