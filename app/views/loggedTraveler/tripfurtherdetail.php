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
                <input type="date" id="checkin" name="checkin"  min="<?php echo date('Y-m-d'); ?>" required>
            </div>
            <div class="date-picker">
                <label for="checkout">Check-Out:</label>
                <input type="date" id="checkout" name="checkout" min="<?php echo date('Y-m-d'); ?>" required>
            </div>
            <button class="search-button" id="search-button" data-hotel-id="<?php echo $data['bookingDetails']->hotel_id; ?>" onclick="searchRooms(event)">Search</button>


        </div>
<!-- /////////////// -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const checkinInput = document.getElementById('checkin');
        const checkoutInput = document.getElementById('checkout');

        // Set minimum check-out date as 1 day after check-in date
        checkinInput.addEventListener('change', function() {
            const checkinDate = new Date(checkinInput.value);
            const minCheckoutDate = new Date(checkinDate);
            minCheckoutDate.setDate(minCheckoutDate.getDate() + 1);
            const minCheckoutDateString = minCheckoutDate.toISOString().split('T')[0];
            checkoutInput.min = minCheckoutDateString;
            checkoutInput.value = minCheckoutDateString; // Automatically set checkout to minimum
        });

        // Initial setup for checkout min value based on checkin
        const initialCheckinDate = new Date(checkinInput.value);
        const initialMinCheckoutDate = new Date(initialCheckinDate);
        initialMinCheckoutDate.setDate(initialMinCheckoutDate.getDate() + 1);
        const initialMinCheckoutDateString = initialMinCheckoutDate.toISOString().split('T')[0];
        checkoutInput.min = initialMinCheckoutDateString;

        // Validate on form submission
        document.getElementById('search-button').addEventListener('click', function(event) {
            if (!validateDates()) {
                event.preventDefault();
            }
        });

        // Function to validate dates
        function validateDates() {
            const checkinDate = new Date(checkinInput.value);
            const checkoutDate = new Date(checkoutInput.value);

            // Check if check-in date is after check-out date
            if (checkinDate >= checkoutDate) {
                alert("Check-out date must be after check-in date.");
                return false;
            }

            // All validations passed
            return true;
        }
    });
</script>



<!-- /////////////// -->



            <!-- /// -->
            
    <div>
    <?php if ($data['type']==3): ?>
    <h2 style="text-align: center;">Available rooms</h2>

            <table class="booking-table">
                <thead>
                    <tr>
                        <!-- <th>No</th> -->
                        <!-- <th>Room ID</th> -->
                        <th>Room type</th>
                        <th>About</th>
                        <th>price per Night</th>
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
        // echo '<td>' . $room->room_id . '</td>';
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
                <input type="date" id="pickup" name="pickup" min="<?php echo date('Y-m-d'); ?>" required>
            </div>
            <div class="date-picker">
                <label for="ptime">Pickup Time:</label>
                <input type="time" id="ptime" name="ptime" required>
            </div>
            <div class="date-picker">
                <label for="dropoff">Dropoff date:</label>
                <input type="date" id="dropoff" name="dropoff" min="<?php echo date('Y-m-d'); ?>" required>
            </div>
            <!-- <div class="date-picker">
                <label for="dtime">Time:</label>
                <input type="time" id="dtime" name="dtime" required>
            </div> -->
            <button class="search-button" id="search-button" data-agency-id="<?php echo $data['bookingDetails']->agency_id; ?>" onclick="searchVehicles(event)">Search</button>


        </div>
        <div>
            <!-- //////////// -->
            <script>
    document.addEventListener("DOMContentLoaded", function() {
        const pickupInput = document.getElementById('pickup');
        const dropoffInput = document.getElementById('dropoff');

        // Validate on form submission
        document.getElementById('search-button').addEventListener('click', function(event) {
            if (!validateDates()) {
                event.preventDefault();
            }
        });

        // Function to validate dates
        function validateDates() {
            const pickupDate = new Date(pickupInput.value);
            const dropoffDate = new Date(dropoffInput.value);

            // Check if pickup date is after dropoff date
            if (pickupDate > dropoffDate) {
                alert("Dropoff date must be on or after pickup date.");
                return false;
            }

            // All validations passed
            return true;
        }
        pickupInput.addEventListener("change", function() {
            dropoffInput.min = pickupInput.value;
        });
    });
</script>



            <!-- /////////// -->
    <?php if ($data['type']==4): ?>
    <h2 style="text-align: center;">Available vehicles</h2>

            <table class="booking-table">
                <thead>
                    <tr>
                        <!-- <th>No</th> -->
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
        //  echo '<td>' . $count . '</td>';
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
        <div class="view">
            <div class="bookingtitles"><h1><?php echo ucfirst($data['serviceProviderName'])?></h1>
                <h5>Guide details</h5>
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
                        <div class="booking-label">Guide name:</div>
                        <div class="booking-value"><?php echo ucfirst($data['serviceProviderName'])?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Registration Number:</div>
                        <div class="booking-value"><?php echo ucfirst($data['bookingDetails']->GuideRegNumber)?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Category:</div>
                        <div class="booking-value"><?php echo ucfirst($data['bookingDetails']->category)?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Languages:</div>
                        <div class="booking-value"><?php echo ucfirst($data['bookingDetails']->languages)?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Lisence Expiry Date:</div>
                        <div class="booking-value"><?php echo ucfirst($data['bookingDetails']->LisenceExpDate)?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Places:</div>
                        <div class="booking-value"><?php echo ucfirst($data['bookingDetails']->sites)?></div>
                    </div>
                </div>

                <div class="rightdiv">
                <div class="ldiv1">
                        <div class="booking-label">Address:</div>
                        <div class="booking-value"><?php echo ucfirst($data['bookingDetails']->address)?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">City:</div>
                        <div class="booking-value"><?php echo ucfirst($data['bookingDetails']->city)?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Province:</div>
                        <div class="booking-value"><?php echo ucfirst($data['bookingDetails']->province)?></div>
                    </div>
                <div class="ldiv1">
                        <div class="booking-label">Email:</div>
                        <div class="booking-value"><?php echo ucfirst($data['email'])?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Facebook:</div>
                        <div class="booking-value"><?php echo ucfirst($data['bookingDetails']->facebook)?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Instargram:</div>
                        <div class="booking-value"><?php echo ucfirst($data['bookingDetails']->instagram)?></div>
                    </div>
                    
                    
                </div>
                

            </div>
            <!-- //// -->
            <div class="search-section">
            <div class="date-picker">
                <label for="pickup">Start date:</label>
                <input type="date" id="pickup" name="pickup" min="<?php echo date('Y-m-d'); ?>" required>
            </div>
            <div class="date-picker">
                <label for="ptime">Meet Time:</label>
                <input type="time" id="ptime" name="ptime" required>
            </div>
            <div class="date-picker">
                <label for="dropoff">End date:</label>
                <input type="date" id="dropoff" name="dropoff" min="<?php echo date('Y-m-d'); ?>" required>
            </div>
            <!-- <div class="date-picker">
                <label for="dtime">Time:</label>
                <input type="time" id="dtime" name="dtime" required>
            </div> -->
            <button style="margin-top:30px" class="search-button"  id="search-button" data-guide-id="<?php echo $data['bookingDetails']->user_id; ?>" onclick="searchGuide(event)">Search</button>
            <button id="book-now-button" class="search-button" style="display: none;margin-top:30px;background-color:green" onclick="bookingGuide()">Book Now</button>
            <!-- <span id="not-available-button" style="display: none;margin-top:30px;color:red">Sry ,Not Available</span> -->
            

        </div>
        <div>
    
   
            </div>
            <script>
    document.addEventListener("DOMContentLoaded", function() {
        const pickupInput = document.getElementById('pickup');
        const dropoffInput = document.getElementById('dropoff');

        // Validate on form submission
        document.getElementById('book-now-button').addEventListener('click', function(event) {
            if (!validateDates()) {
                event.preventDefault();
            }
        });

        // Function to validate dates
        function validateDates() {
            const pickupDate = new Date(pickupInput.value);
            const dropoffDate = new Date(dropoffInput.value);

            // Check if pickup date is after dropoff date
            if (pickupDate > dropoffDate) {
                alert("Dropoff date must be on or after pickup date.");
                return false;
            }

            // All validations passed
            return true;
        }
        pickupInput.addEventListener("change", function() {
            dropoffInput.min = pickupInput.value;
        });
    });
</script>
        
    <?php endif; ?>


    <!-- //////// -->
    <div class="feedbacks">
    <h3 >Feedbacks</h2>
    <?php if (empty($data['feedbacks'])): ?>
    <p>No feedbacks available</p>
<?php else: ?>
    <?php foreach ($data['feedbacks'] as $feedbacks): ?>
        <div class="feedback">
            <div class="feedback-details">
                <img src="<?php echo URLROOT; ?>images1/<?php echo $feedbacks->profile_picture; ?>" alt="Publisher Picture" style="width: 50px; height: 50px; border-radius: 50%; margin-right: 10px; display: inline-block; vertical-align: middle;">
                <span style="margin-bottom: 5px; display: inline-block; vertical-align: middle;">Publisher: <?php echo $feedbacks->fname . " " . ($feedbacks->lname ? $feedbacks->lname : ""); ?></span>
                <span style="margin-bottom: 5px; display:block; vertical-align: middle;">&nbsp; &nbsp;&nbsp;&nbsp;<?php echo $feedbacks->time; ?></span>
            </div>
            <div class="rating">
                <!-- Display rating stars -->
                <?php for ($i = 0; $i < $feedbacks->rating; $i++): ?>
                    <span class="star">&#9733;</span>
                <?php endfor; ?>
            </div>
            <div class="comment">
                <!-- Display feedback comment -->
                <p><?php echo $feedbacks->feedback; ?></p>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

</div>

        </div>
           <!-- Hidden modal for cancellation confirmation -->
<!-- Modal HTML -->
<div id="modalguide" class="modalguide">
  <div class="modalguide-content">
    <span class="closeguide">&times;</span>
    <p>The guide is not available for the selected dates and times.</p>
  </div>
</div>

        
    </section>
   
    
    
  
</body>
</html>



    