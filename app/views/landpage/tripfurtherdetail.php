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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-5Kiaq/+vzFRWJRpeOJBe5evwSH3/S/UVdPC0kt3F82XQdEnLZyOaKg4Z3dGvXVr9Gq5brGmPYJ21fBzKp+1pMw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.2/css/boxicons.min.css">
    

    <style>
            .booking-value a{
                padding: 0px 30px 0px 0px;
                text-decoration: none;
                color:#777;
            }
            #loginbut{
    background-color: #706F6C;
    padding: 10px 25px 10px 25px;
    border-radius: 20px;
    color: #FDFFFF;
}
    </style>
</head>
<body>
    
    <div class="navbar">
        <div class="logo">
            <img src="<?php echo URLROOT?>/images/TravelEase_logo.png" alt="Logo">
            <label for="logoname">Travel<span style="color: #458A9E;">Ease</span> </label>
        </div>
        <ul>
        <li><a href="<?php echo URLROOT?>Landpage">Home</a></li>
            <li><a href="<?php echo URLROOT?>Landpage/hotel" >Hotels</a></li>
            <li><a href="<?php echo URLROOT?>Landpage/transport">Transport Providers</a></li>
            <li><a href="<?php echo URLROOT?>Landpage/package">Guides</a></li>
            <div class="rightcontent">
            <!-- <li><a href="<?php echo URLROOT ?>travelerDashboard/cart/<?php echo $_SESSION['user_id'] ?>"><i class='bx bxs-cart bx-lg bx-tada bx-rotate-90' ></i></a></li> -->
            <!-- <li><a href="<?php echo URLROOT?>travelerDashboard/index"><img src="<?php echo empty($data['profile_picture']) ? URLROOT.'images/user.jpg' : URLROOT.'images1/'.$data['profile_picture']; ?>" alt="Profile Picture" alt="User Profile Photo"> </a></li> -->
            <li><a href="<?php echo URLROOT?>Users/login" id="loginbut">Login</a></li>
                </div>
        </ul>
    </div>
    
    <section class="bookingResultm1">
    <?php if ($data['type']==3): ?>
        
        <div class="view">
            <div class="bookingtitles"><h1><?php echo ucfirst($data['serviceProviderName'])?></h1>
                <!-- <h5>Hotel details</h5> -->
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
            <h5 style="margin: 0px;"><i class="bx bx-info-circle"></i> About</h5>

                <p><?php echo $data['bookingDetails']->description ? ucfirst($data['bookingDetails']->description) : '-----'; ?></p> 
            </div> 
            <!-- <?php echo var_dump($data['rooms']) ?> -->
            <div class="bookingdetails">
                <div class="leftdiv">
                <!-- <div class="ldiv1">
    <div class="booking-label"><i class='bx bxs-hotel bx-sm'></i> Hotel name:</div>
    <div class="booking-value"><?php echo ucfirst($data['serviceProviderName'])?></div>
</div> -->
<div class="ldiv1">
    <div class="booking-label"><i class='bx bxs-building bx-sm'></i> Hotel Type:</div>
    <div class="booking-value"><?php echo ucfirst($data['bookingDetails']->hotel_type)?></div>
</div>
<div class="ldiv1">
    <div class="booking-label"><i class='bx bxs-map bx-sm'></i> Address:</div>
    <div class="booking-value"><?php echo ucfirst($data['bookingDetails']->street_address)?></div>
</div>
<div class="ldiv1">
                        <div class="booking-label"><i class='bx bx-sm bxs-envelope'></i> Email:</div>
                        <div class="booking-value"><?php echo ucfirst($data['email'])?></div>
                    </div>


                </div>

                <div class="rightdiv">
                <div class="ldiv1">
    <div class="booking-label"><i class='bx bxs-city bx-sm'></i> City:</div>
    <div class="booking-value"><?php echo ucfirst($data['bookingDetails']->city)?></div>
</div>
<div class="ldiv1">
    <div class="booking-label"><i class='bx bxs-city bx-sm'></i> Province:</div>
    <div class="booking-value"><?php echo ucfirst($data['bookingDetails']->state_province)?></div>
</div>
                
                    <div class="ldiv1">
                    <div class="booking-label"><i class='bx bx-world'></i> Visit:</div>
                        <div class="booking-value">
                        <a href="www.<?php echo $data['bookingDetails']->facebook ?>" target="_blank"><i class='bx bx-sm bxl-facebook'></i></a>
        <a href="www.<?php echo $data['bookingDetails']->twitter ?>" target="_blank"><i class='bx bx-sm bxl-twitter'></i></a>
        <a href="www.<?php echo $data['bookingDetails']->instagram ?>" target="_blank"><i class='bx bx-sm bxl-instagram'></i></a>
    
                        </div>
                    
</div>

                    
                </div>
                

            </div>
            <!-- //// -->
            <!-- <div class="search-section">
                        <div class="date-picker">
                <label for="checkin"><i class="bx bx-calendar"></i> Check-In:</label>
                <input type="date" id="checkin" name="checkin" min="<?php echo date('Y-m-d'); ?>" required>
            </div>
            <div class="date-picker">
                <label for="checkout"><i class="bx bx-calendar"></i> Check-Out:</label>
                <input type="date" id="checkout" name="checkout" min="<?php echo date('Y-m-d'); ?>" required>
            </div>


            <button class="search-button" id="search-button" data-hotel-id="<?php echo $data['bookingDetails']->hotel_id; ?>" onclick="searchRooms(event)">Search</button>


        </div> -->
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
                        <th><i class="bx bx-sm bxs-bed"></i> Room type</th>
            <th><i class="bx bx-sm bxs-info-circle"></i> About</th>
            <th><i class="bx bx-sm bxs-dollar-circle"></i> Price per Night</th>
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
         echo '<td><button class="view-button" onclick="gotologin()">View</button></td>';
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
            <script>
    function gotologin(){
        window.location.href='/TravelEase/Users/login';
    }
</script>
            <?php elseif ($data['type'] == 4): ?>
                <div class="view">
            <div class="bookingtitles"><h1><?php echo ucfirst($data['serviceProviderName'])?></h1>
                <!-- <h5>Agency details</h5> -->
            </div>
            <div class="images">
                <div class="mainimage">
                <img src="<?php echo URLROOT ?>/images/<?php echo $data['service_image'] ?>" alt="">
                </div>

            </div>
            <div class="des">
               <h5 style="margin: 0px;"><i class="bx bx-info-circle"></i> About</h5>
                <p><?php echo $data['bookingDetails']->description ? ucfirst($data['bookingDetails']->description) : '-----'; ?></p> 
            </div> 
            
            <div class="bookingdetails">
                <div class="leftdiv">
                    <!-- <div class="ldiv1">
                        <div class="booking-label">Agency name:</div>
                        <div class="booking-value"><?php echo ucfirst($data['serviceProviderName'])?></div>
                    </div> -->
                    <!-- <div class="ldiv1">
                        <div class="booking-label">No of vehicles:</div>
                        <div class="booking-value"><?php echo ucfirst($data['NoVehicles'])?></div>
                    </div> -->
                     <!-- <div class="ldiv1">
                        <div class="booking-label"><i class='bx bxs-car bx-sm'></i> Registration No:</div>
                        <div class="booking-value"><?php echo ucfirst($data['bookingDetails']->reg_number)?></div>
                    </div> -->

                    <div class="ldiv1">
                        <div class="booking-label"><i class='bx bxs-map bx-sm'></i> Address:</div>
                        <div class="booking-value"><?php echo ucfirst($data['bookingDetails']->address)?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label"><i class='bx bxs-city bx-sm'></i> City:</div>
                        <div class="booking-value"><?php echo ucfirst($data['bookingDetails']->city)?></div>
                    </div>
                </div>

                <div class="rightdiv">
                <div class="ldiv1">
                        <div class="booking-label"><i class='bx bx-sm bxs-envelope'> </i>Email:</div>
                        <div class="booking-value"><?php echo ucfirst($data['email'])?></div>
                    </div>
                    
                    <div class="ldiv1">
                    <div class="booking-label"><i class='bx bx-world'></i> Visit:</div>
                        <div class="booking-value">
                        <a href="www.<?php echo $data['bookingDetails']->facebook ?>" target="_blank"><i class='bx bx-sm bxl-facebook'></i></a>
        <a href="www.<?php echo $data['bookingDetails']->twitter ?>" target="_blank"><i class='bx bx-sm bxl-twitter'></i></a>
        <a href="www.<?php echo $data['bookingDetails']->instagram ?>" target="_blank"><i class='bx bx-sm bxl-instagram'></i></a>
        
    
                        </div>
            </div>
                    <!-- <div class="ldiv1">
                        <div class="booking-label">Availble rooms:</div>
                        <div class="booking-value"><?php echo ucfirst($data['bookingDetails']->instagram)?></div>
                    </div> -->
                    
                </div>
                

            </div>
            <!-- //// -->
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
                        <th><i class="bx bx-car"></i> Brand</th>
                        <th><i class="bx bx-car"></i> Model</th>
                        <th><i class="bx bx-gas-pump"></i> Fuel Type</th>
                        <th><i class="bx bx-dollar"></i> Price per Day</th>
                        <th><i class="bx bx-chair"></i> Seating Capacity</th>
                        <th></th>

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
        echo '<td>' . $vehicle->fuel_type . '</td>';
        echo '<td>' . $vehicle->priceperday . '</td>';
        echo '<td>' . $vehicle->seating_capacity . '</td>';
        
        echo '</td>';
         echo '<td><button class="view-button" onclick="booking()">View</button></td>';
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
                <!-- <h5>Guide details</h5> -->
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
                    <!-- <div class="ldiv1">
                        <div class="booking-label">Guide name:</div>
                        <div class="booking-value"><?php echo ucfirst($data['serviceProviderName'])?></div>
                    </div> -->
                    <!-- <div class="ldiv1">
                        <div class="booking-label">Registration No:</div>
                        <div class="booking-value"><?php echo ucfirst($data['bookingDetails']->GuideRegNumber)?></div>
                    </div> -->
                    <div class="ldiv1">
                    <div class="booking-label"><i class='bx bx-category'></i> Category:</div>
                    <div class="booking-value"><?php echo ucfirst($data['bookingDetails']->category)?></div>
                </div>
                <div class="ldiv1">
                    <div class="booking-label"><i class='bx bx-chat'></i> Languages:</div>
                    <div class="booking-value"><?php echo ucfirst($data['bookingDetails']->languages)?></div>
                </div>
                <div class="ldiv1">
                    <div class="booking-label"><i class='bx bx-map'></i> Places:</div>
                    <div class="booking-value"><?php echo ucfirst($data['bookingDetails']->sites)?></div>
                </div>
                <div class="ldiv1">
                    <div class="booking-label"><i class='bx bx-envelope'></i> Email:</div>
                    <div class="booking-value"><?php echo ucfirst($data['email'])?></div>
                </div>

                </div>

                <div class="rightdiv">
                <!-- <div class="ldiv1">
                        <div class="booking-label">Address:</div>
                        <div class="booking-value"><?php echo ucfirst($data['bookingDetails']->address)?></div>
                    </div> -->
                    <div class="ldiv1">
                        <div class="booking-label"><i class='bx bxs-city bx-sm'></i> City:</div>
                        <div class="booking-value"><?php echo ucfirst($data['bookingDetails']->city)?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label"><i class='bx bxs-city bx-sm'></i> Province:</div>
                        <div class="booking-value"><?php echo ucfirst($data['bookingDetails']->province)?></div>
                    </div>
                    <div class="ldiv1">
                    <div class="booking-label"><i class='bx bx-world'></i> Visit:</div>
                        <div class="booking-value">
                        <a href="www.<?php echo $data['bookingDetails']->facebook ?>" target="_blank"><i class='bx bx-sm bxl-facebook'></i></a>
        <a href="www.<?php echo $data['bookingDetails']->twitter ?>" target="_blank"><i class='bx bx-sm bxl-twitter'></i></a>
        <a href="www.<?php echo $data['bookingDetails']->instagram ?>" target="_blank"><i class='bx bx-sm bxl-instagram'></i></a>
        
    
                        </div>

            </div>
            <!-- <button style="margin-left:5%;margin-top:5%;padding:10px 40px;" class="search-button"  id="search-button" onclick="gotologin()">View</button> -->
                    
                    
                </div>
                

            </div>
            <!-- //// -->
            <!-- <div class="search-section"> -->
                <!-- <div class="date-picker">
                    <label for="pickup"><i class="bx bx-calendar"></i> Start date:</label>
                    <input type="date" id="pickup" name="pickup" min="<?php echo date('Y-m-d'); ?>" required>
                </div>
                <div class="date-picker">
                    <label for="ptime"><i class="bx bx-time"></i> Meet Time:</label>
                    <input type="time" id="ptime" name="ptime" required>
                </div>
                <div class="date-picker">
                    <label for="dropoff"><i class="bx bx-calendar"></i> End date:</label>
                    <input type="date" id="dropoff" name="dropoff" min="<?php echo date('Y-m-d'); ?>" required>
                </div> -->

             <!-- <div class="date-picker">
                <label for="dtime">Time:</label>
                 <input type="time" id="dtime" name="dtime" required> 
            </div>  -->
            
            <!-- <button id="book-now-button" class="search-button" style="display: none;margin-top:30px;background-color:green" onclick="bookingGuide()">Book Now</button> -->
            <!-- <span id="not-available-button" style="display: none;margin-top:30px;color:red">Sry ,Not Available</span> -->
            

        <!-- </div> -->
        <div>
    
   
            </div>
            <script>
                function gotologin(){
                    window.location.href='/Travelease/Users/login';
                }
            </script>
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
    <h3><i class="bx bx-message-square-detail"></i> Feedbacks</h3>

    <?php if (empty($data['feedbacks'])): ?>
    <p>No feedbacks available</p>
<?php else: ?>
    <?php foreach ($data['feedbacks'] as $feedbacks): ?>
        <div class="feedback">
            <div class="feedback-details">
                <img src="<?php echo URLROOT; ?>images1/<?php echo $feedbacks->profile_picture; ?>" alt="Publisher Picture" style="width: 50px; height: 50px; border-radius: 50%; margin-right: 10px; display: inline-block; vertical-align: middle;">
                <span style="margin-bottom: 5px; display: inline-block; vertical-align: middle;font-weight:bold;">Publisher: <?php echo $feedbacks->fname . " " . ($feedbacks->lname ? $feedbacks->lname : ""); ?></span>
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



    