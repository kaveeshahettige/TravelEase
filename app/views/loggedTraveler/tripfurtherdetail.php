<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>TraveleEase Landpage</title>
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT?>/images/TravelEase_logo.png">
    <link rel="stylesheet" href="<?php echo URLROOT?>css/loggedTraveler/booking.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <script src="<?php echo URLROOT?>js/loggedTraveler/script.js"></script>
    <style>

    </style>
</head>
<body>
    
    <div class="navbar">
        <div class="logo">
            <img src="<?php echo URLROOT?>/images/TravelEase_logo.png" alt="Logo">
            <label for="logoname">Travel<span style="color: #458A9E;">Ease</span> </label>
        </div>
        <ul>
        <li><a href="<?php echo URLROOT?>loggedTraveler/index">Home</a></li>
            <li><a href="<?php echo URLROOT?>loggedTraveler/hotel" >Hotels</a></li>
            <li><a href="<?php echo URLROOT?>loggedTraveler/transport">Transport Providers</a></li>
            <li><a href="<?php echo URLROOT?>loggedTraveler/package">Packages</a></li>
            <div class="rightcontent">
            <li><a href="<?php echo URLROOT?>travelerDashboard/index"><img src="<?php echo empty($data['profile_picture']) ? URLROOT.'images/user.jpg' : URLROOT.'images1/'.$data['profile_picture']; ?>" alt="Profile Picture" alt="User Profile Photo"> </a></li>
                <li><a href="<?php echo URLROOT?>users/logout" id="logout">Log Out</a></li>
                </div>
        </ul>
    </div>
    
    <section class="bookingResultm1">
    <?php if ($data['type']==3): ?>
        
        <div class="view">
            <div class="bookingtitles"><h1><?php echo ucfirst($data['serviceProviderName'])?></h1>
                <h5>Hotel details</h5>
            </div>
            <div class="images">
                <div class="mainimage">
                <img src="<?php echo URLROOT ?>/images/<?php echo $data['service_image'] ?>" alt="">
                </div>
                <!-- <div class="submimages">
                    <div><img src="<?php echo URLROOT?>/images/yala2.jpg" alt=""></div>
                    <div><img src="<?php echo URLROOT?>/images/yala3.jpg" alt=""></div>
                </div>
                <div class="submimages">
                    <div><img src="<?php echo URLROOT?>/images/yala4.jpg" alt=""></div>
                    <div><img src="<?php echo URLROOT?>/images/yala5.jpg" alt=""></div>
                </div> -->

            </div>
            <div class="des">
                <h5 style="margin: 0px;">About</h5>
                <p><?php echo $data['bookingDetails']->description ? ucfirst($data['bookingDetails']->description) : '-----'; ?></p> 
            </div> 
            <!-- <?php echo var_dump($data['rooms']) ?> -->
            <div class="bookingdetails">
                <div class="leftdiv">
                    <div class="ldiv1">
                        <div class="booking-label">Hotel name:</div>
                        <div class="booking-value"><?php echo ucfirst($data['serviceProviderName'])?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Hotel type:</div>
                        <div class="booking-value"><?php echo ucfirst($data['bookingDetails']->hotel_type)?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Address:</div>
                        <div class="booking-value"><?php echo ucfirst($data['bookingDetails']->street_address)?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">City:</div>
                        <div class="booking-value"><?php echo ucfirst($data['bookingDetails']->city)?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Province:</div>
                        <div class="booking-value"><?php echo ucfirst($data['bookingDetails']->state_province)?></div>
                    </div>
                </div>

                <div class="rightdiv">
                <div class="ldiv1">
                        <div class="booking-label">Email:</div>
                        <div class="booking-value"><?php echo ucfirst($data['email'])?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Facebook:</div>
                        <div class="booking-value"><?php echo ucfirst($data['bookingDetails']->facebook)?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Twitter:</div>
                        <div class="booking-value"><?php echo ucfirst($data['bookingDetails']->twitter)?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Instargram:</div>
                        <div class="booking-value"><?php echo ucfirst($data['bookingDetails']->instagram)?></div>
                    </div>
                    <!-- <div class="ldiv1">
                        <div class="booking-label">Availble rooms:</div>
                        <div class="booking-value"><?php echo ucfirst($data['bookingDetails']->instagram)?></div>
                    </div> -->
                    
                </div>
                

            </div>
            <!-- //// -->
            <div class="search-section">
            <div class="date-picker">
                <label for="checkin">Check-In:</label>
                <input type="date" id="checkin" name="checkin" required>
            </div>
            <div class="date-picker">
                <label for="checkout">Check-Out:</label>
                <input type="date" id="checkout" name="checkout" required>
            </div>
            <button class="search-button" id="search-button" data-hotel-id="<?php echo $data['bookingDetails']->hotel_id; ?>" onclick="searchRooms(event)">Search</button>


        </div>




            <!-- /// -->
            
    <div>
    <?php if ($data['type']==3): ?>
    <h2 style="text-align: center;">Available rooms</h2>

            <table class="booking-table">
                <thead>
                    <tr>
                        <!-- <th>No</th> -->
                        <th>Room ID</th>
                        <th>Room type</th>
                        <th>About</th>
                        <th>price</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="available-rooms">
                
            <?php
$count = 1;

if (!empty($data['rooms']) && is_array($data['rooms'])) {
    foreach ($data['rooms'] as $room) {
        echo '<tr class="t-row">';
        // echo '<td>' . $count . '</td>';
        echo '<td>' . $room->room_id . '</td>';
        echo '<td>' . $room->roomType . '</td>';
        echo '<td>' . $room->description . '</td>';
        echo '<td>' . $room->price . '</td>';
        echo '</td>';
        // echo '<td><button class="view-button" onclick="booking(' . $data['type'] . ',' . $room->room_id . ')">Book Now</button></td>';
         echo '</tr>';
        $count++;
    }
} else {
    echo '<tr><td colspan="6">No Rooms available right now</td></tr>';
}
?>
</tbody>
<?php endif; ?>
            </table>
   
            </div>
            <?php elseif ($data['type'] == 4): ?>
                <div class="view">
            <div class="bookingtitles"><h1><?php echo ucfirst($data['serviceProviderName'])?></h1>
                <h5>Agency details</h5>
            </div>
            <div class="images">
                <div class="mainimage">
                <img src="<?php echo URLROOT ?>/images/<?php echo $data['service_image'] ?>" alt="">
                </div>

            </div>
            <div class="des">
                <h5 style="margin: 0px;">About</h5>
                <p><?php echo $data['bookingDetails']->description ? ucfirst($data['bookingDetails']->description) : '-----'; ?></p> 
            </div> 
            
            <div class="bookingdetails">
                <div class="leftdiv">
                    <div class="ldiv1">
                        <div class="booking-label">Agency name:</div>
                        <div class="booking-value"><?php echo ucfirst($data['serviceProviderName'])?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">No of vehicles:</div>
                        <div class="booking-value"><?php echo ucfirst($data['NoVehicles'])?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Address:</div>
                        <div class="booking-value"><?php echo ucfirst($data['bookingDetails']->address)?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">City:</div>
                        <div class="booking-value"><?php echo ucfirst($data['bookingDetails']->city)?></div>
                    </div>
                </div>

                <div class="rightdiv">
                <div class="ldiv1">
                        <div class="booking-label">Email:</div>
                        <div class="booking-value"><?php echo ucfirst($data['email'])?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Facebook:</div>
                        <div class="booking-value"><?php echo ucfirst($data['bookingDetails']->facebook)?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Twitter:</div>
                        <div class="booking-value"><?php echo ucfirst($data['bookingDetails']->twitter)?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Instargram:</div>
                        <div class="booking-value"><?php echo ucfirst($data['bookingDetails']->instagram)?></div>
                    </div>
                    <!-- <div class="ldiv1">
                        <div class="booking-label">Availble rooms:</div>
                        <div class="booking-value"><?php echo ucfirst($data['bookingDetails']->instagram)?></div>
                    </div> -->
                    
                </div>
                

            </div>
            <!-- //// -->
            <div class="search-section">
            <div class="date-picker">
                <label for="pickup">Pickup date:</label>
                <input type="date" id="pickup" name="pickup" required>
            </div>
            <div class="date-picker">
                <label for="ptime">Pickup Time:</label>
                <input type="time" id="ptime" name="ptime" required>
            </div>
            <div class="date-picker">
                <label for="dropoff">Dropoff date:</label>
                <input type="date" id="dropoff" name="dropoff" required>
            </div>
            <!-- <div class="date-picker">
                <label for="dtime">Time:</label>
                <input type="time" id="dtime" name="dtime" required>
            </div> -->
            <button class="search-button" id="search-button" data-agency-id="<?php echo $data['bookingDetails']->agency_id; ?>" onclick="searchVehicles(event)">Search</button>


        </div>
        <div>
    <?php if ($data['type']==4): ?>
    <h2 style="text-align: center;">Available vehicles</h2>

            <table class="booking-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Plate Number</th>
                        <th>Fuel Type</th>
                        <th>Year</th>
                        <th>Seating Capacity</th>
                        <th></th>
                        
                    </tr>
                </thead>
                <tbody id="available-vehicles">
                
            <?php
$count = 1;

if (!empty($data['vehicles']) && is_array($data['vehicles'])) {
    foreach ($data['vehicles'] as $vehicle) {
        echo '<tr class="t-row">';
         echo '<td>' . $count . '</td>';
        echo '<td>' . $vehicle->brand . '</td>';
        echo '<td>' . $vehicle->model . '</td>';
        echo '<td>' . $vehicle->plate_number . '</td>';
        echo '<td>' . $vehicle->fuel_type . '</td>';
        echo '<td>' . $vehicle->year . '</td>';
        echo '<td>' . $vehicle->seating_capacity . '</td>';
        echo '</td>';
        // echo '<td><button class="view-button" onclick="booking(' . $data['type'] . ',' . $room->room_id . ')">Book Now</button></td>';
         echo '</tr>';
        $count++;
    }
} else {
    echo '<tr><td colspan="6">No vehicles available right now</td></tr>';
}
?>
</tbody>
<?php endif; ?>
            </table>
   
            </div>
        
    <?php elseif ($data['type'] == 5): ?>
        type 5
    <?php endif; ?>
        </div>
    </section>
    <section style="margin:50px">
    
    </section>
   
    
    
  
</body>
</html>



    