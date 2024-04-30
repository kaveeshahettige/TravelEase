<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/bookings.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/businessmanager/navigation.css">
    <script src= "<?php echo URLROOT?>/public/js/businessmanager/script.js"></script>
    <title>Registered Rooms</title>
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
        <h1>Registered Rooms</h1>
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
            <a href="<?php echo URLROOT?>/businessmanager/services"><button class="tablinks active">Registered Rooms</button></a>
            <a href="<?php echo URLROOT?>/businessmanager/vehicles"><button class="tablinks">Registered Vehicles</button></a>
            <a href="<?php echo URLROOT?>/businessmanager/guide"><button class="tablinks">Registered Guides</button></a>
        </div>
    </div>

    <div class="table-content">
        <table class="booking-table">
            <thead>
            <tr>
                <th>No</th>
                <th>Room Type</th>
                <th>Hotel</th>
                <th>Room Price</th>
                <th>Room Description</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $rooms = $data["hotelRooms"];
            foreach ($rooms as $key=> $room) {
                ?>
                <tr>
                    <td><?php echo $key+1 ?></td>
                    <td><?php echo $room->roomType ?></td>
                    <td><?php echo $room->hotel_name ?></td>
                    <td><?php echo $room->price ?></td>
                    <td><?php echo $room->description ?></td>
                    <td>
                      <button class="view-button" onclick="roomopenPopup();roomupdatePopupDetails('<?php echo $room->roomType ?>', '<?php echo $room->hotel_name ?>', <?php echo $room->price ?>,' <?php echo $room->description ?>')">
                          <i class='bx bx-show'></i>
                      </button>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>

    <div class="popup" id="popup">
        <div class="popup-content">
            <span class="close" onclick="closePopup()">&times;</span>
            <!-- Add details about the booking here -->
            <h2>Room Details</h2>
            <p id="roomType">Room Type: </p>
            <p id="hotel_name">Hotel: </p>
            <p id="price">Price: </p>
            <p id="description">Description: </p>
        </div>
    </div>



</main>
</body>
</html>
