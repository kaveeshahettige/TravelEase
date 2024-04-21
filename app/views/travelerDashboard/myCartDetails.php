<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>css/loggedTraveler/bookingpayment.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <title>Payment</title>
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT?>/images/TravelEase_logo.png">
    <script src="<?php echo URLROOT?>js/loggedTraveler/script.js"></script>
    <link href="https://cdn.jsdelivr.net/boxicons/2.0.7/css/boxicons.min.css" rel="stylesheet">

    <style>
        .final-info {
    margin-top: 20px;
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    background-color: #f9f9f9;
}
.final-info{
    display:grid;
    grid-template-columns: 1fr 1fr;
}
.final-info p {
    margin-bottom: 10px;
}

.final-info strong {
    color: #333;
}
.total-amount {
    
            padding: 10px;
            border: 1px solid #99c2ff; /* Light blue border color */
            border-radius: 5px;
            font-size: 25px;
            font-weight: bold;
            color: #ff0000; /* Dark blue text color */
        }


    </style>
</head>
<body style="margin-top:50%">


    <div class="payment-container" >
    <div class="booking-box">
    <!-- <?php echo var_dump($data['resultArray'])?> -->
    <h2 style="text-align: center;">Cart Details</h2>
    <?php foreach ($data['resultArray'] as $data1): ?>
        
        <div class="hotel-details">
            <div class="image-container">
                <img src="<?php echo URLROOT ?>/images/<?php echo $data1['furtherBookingDetails']->image ?>" alt="Image">
            </div>
            <div class="maincontainer">
                <div>
                    <?php if ($data1['type'] == 3): ?>
                        
                        <div class="reservation-details">
                            <p><strong>Room ID:</strong> <?php echo $data1['furtherBookingDetails']->room_id ?></p>
                            <p><strong>Number of Beds:</strong> <?php echo $data1['furtherBookingDetails']->numOfBeds ?> </p>
                            <p><strong>About:</strong> <?php echo $data1['furtherBookingDetails']->description ?></p>
                            <p><strong>AC availability:</strong> <?php echo $data1['furtherBookingDetails']->acAvailability ?></p>
                            <p><strong>TV availability:</strong> <?php echo $data1['furtherBookingDetails']->tvAvailability ?></p>
                            <p><strong>Wifi availability:</strong> <?php echo $data1['furtherBookingDetails']->wifiAvailability ?></p>
                        </div>
                        <div class="reservation-details">
                            <p><strong>Cancellation policy:</strong> <?php echo $data1['furtherBookingDetails']->cancellationPolicy ?> </p>
                            <p><strong>Smoking policy:</strong> <?php echo $data1['furtherBookingDetails']->smokingPolicy ?></p>
                            <p><strong>Pet policy:</strong> <?php echo $data1['furtherBookingDetails']->petPolicy ?></p>
                            <br><br>
                            <?php if ($data1['checkAvailbility'] === false): ?>
    <div class="not-available">
        <p class="not-available-text"><i class="fas fa-exclamation-circle"></i> Not Available</p>
    </div>
<?php endif; ?>
                        </div>
                    <?php elseif ($data1['type'] == 4): ?>
                        <div class="reservation-details">
                            <p><strong>Brand:</strong> <?php echo $data1['furtherBookingDetails']->brand ?> </p>
                            <p><strong>Model:</strong> <?php echo $data1['furtherBookingDetails']->model ?></p>
                            <p><strong>Plate Number:</strong> <?php echo $data1['furtherBookingDetails']->plate_number ?></p>
                            <p><strong>Fuel Type:</strong> <?php echo $data1['furtherBookingDetails']->fuel_type ?></p>
                            <p><strong>Year:</strong> <?php echo $data1['furtherBookingDetails']->year ?></p>
                            <p><strong>Seating Capacity:</strong> <?php echo $data1['furtherBookingDetails']->seating_capacity ?></p>
                            <p><strong>Air Condition:</strong> 
                                <?php 
                                    if ($data1['furtherBookingDetails']->ac_type  == 1) {
                                        echo "Available";
                                    } else {
                                        echo "Not Available";
                                    }
                                ?>
                            </p>
                            <?php if ($data1['checkAvailbility'] === false): ?>
    <div class="not-available">
        <p class="not-available-text"><i class="fas fa-exclamation-circle"></i> Not Available</p>
    </div>
<?php endif; ?>
                        </div>
                        <?php elseif ($data1['type'] == 5): ?>
    <div class="reservation-details">
        <p><strong>Name:</strong> <?php echo $data1['serviceProvider']->fname ?> </p>
        <!-- <p><strong>About:</strong> <?php echo $data1['furtherBookingDetails']->description ?></p> -->
        <p><strong>Category:</strong> <?php echo $data1['furtherBookingDetails']->category ?></p>
        <p><strong>Languages:</strong> <?php echo $data1['furtherBookingDetails']->languages ?></p>
        <p><strong>Guide Register Number:</strong> <?php echo $data1['furtherBookingDetails']->GuideRegNumber ?></p>
        <p><strong>Lisence Expiry Date:</strong> <?php echo $data1['furtherBookingDetails']->LisenceExpDate ?></p>
        <p><strong>Sites:</strong> <?php echo $data1['furtherBookingDetails']->sites ?></p>
        <p><strong>facebook :</strong> <?php echo $data1['furtherBookingDetails']->facebook ?></p>
        <p><strong>Instagram:</strong> <?php echo $data1['furtherBookingDetails']->instagram ?></p>
        <p><strong>Contact number:</strong> <?php echo $data1['furtherBookingDetails']->number ?></p>
</p>
<?php if ($data1['checkAvailbility'] === false): ?>
    <div class="not-available">
        <p class="not-available-text"><i class="fas fa-exclamation-circle"></i> Not Available</p>
    </div>
<?php endif; ?>
        
    </div>
                    <?php else: ?>
                        <p>No details available for this type.</p>
                    <?php endif; ?>
                </div>
                <div class="">
                    <!-- <p><strong>Your Full Name: </strong><?php echo $data['user']->fname." ".$data['user']->lname?></p>
                    <p><strong>Email Address:</strong> <?php echo $data['user']->email?></p>
                    <p><strong>Phone Number:</strong><?php echo $data['user']->number?></p> -->
                    <?php if ($data1['type'] == 4): ?>
                        <div class="reservation-details">
                            <!-- <p><strong>Pick-up Date:</strong> <?php echo $data1['checkinDate'] ?></p>
                            <p><strong>Drop-off Date:</strong> <?php echo $data1['checkoutDate'] ?></p> -->
                            <p><strong>Pickup time:</strong> <?php echo $data1['pickupTime']?></p>
                        </div>
                    <?php elseif($data1['type'] == 3): ?>
                        <!-- <div class="reservation-details">
                            <p><strong>Check-in Date:</strong> <?php echo $data1['checkinDate'] ?></p>
                            <p><strong>Check-out Date:</strong> <?php echo $data1['checkoutDate'] ?></p>
                        </div> -->
                        <?php elseif($data1['type'] == 5): ?>
                            <p><strong>Meet time:</strong> <?php echo $data1['meetTime']?></p>
        
                    <?php else: ?>
                    <?php endif; ?>
                    <br>
                    <?php if ($data1['type'] == 4): ?>
                        <?php
                            $date1 = strtotime($data1['checkinDate']);
                            $date2 = strtotime($data1['checkoutDate']);
                            $diffTime = abs($date2 - $date1) + (60 * 60 * 24);
                            $daysD = ceil($diffTime / (60 * 60 * 24)); // Convert seconds
                            ?>
                            <div class="driver-selection">
                                <strong>With Driver</strong>
                                <input type="checkbox" id="withDriver" name="withDriver" value="1" onclick="handleCheckboxClick('withDriver', '<?php echo htmlspecialchars($data1['furtherBookingDetails']->vehicle_id, ENT_QUOTES, 'UTF-8') ?>', <?php echo $daysD; ?>)">
                                <label for="withDriver"></label>
    
                                <strong>Without Driver</strong>
                                <input type="checkbox" id="withoutDriver" name="withoutDriver" value="0" checked onclick="handleCheckboxClick('withoutDriver', '<?php echo htmlspecialchars($data1['furtherBookingDetails']->vehicle_id, ENT_QUOTES, 'UTF-8') ?>', <?php echo $daysD; ?>)">
                                <label for="withoutDriver"></label>
                            </div>
                            <!-- remove -->
                            <p id="totalPrice" class="t-price" data-initial-price="<?php echo htmlspecialchars($data1['price'], ENT_QUOTES, 'UTF-8') ?>"><strong>Price : <?php echo htmlspecialchars($data1['price'], ENT_QUOTES, 'UTF-8') ?> LKR</strong></p>
                            <!-- <button class="remove-button" onclick="removefromCart('<?php echo $data['cartbooking_id']; ?>', '<?php echo $data1['furtherBookingDetails']->vehicle_id; ?>')"> -->
                            <button class="remove-button" onclick="removefromCart('<?php echo $data1['cart_id']; ?>')">
                             <i class='bx bx-trash'></i> Remove
                            </button>

                            <script>
                                function updateFormAction(driverType, vehicleId, days, updatedPrice) {
    const form = document.getElementById('paymentForm');
    if (form) {
        if (driverType === 'withDriver') {
            const driver = 1;
            // Construct the URL with updated price and set it as the form action
            form.action = '<?php echo URLROOT ?>loggedTraveler/dopaymentVehicles/' + '<?php echo $data1['type'] . '/' . $data1['furtherBookingDetails']->vehicle_id?>' + '/' + '<?php echo $data1['checkinDate'].'/'.$data1['checkoutDate'].'/'.$data1['pickupTime']?>' + '/' + updatedPrice+'/'+driver;
        } else {
            const driver = 0;
            // Use the initial price for withoutDriver and set it as the form action
            const initialPrice = parseFloat(document.getElementById('totalPrice').dataset.initialPrice);
            form.action = '<?php echo URLROOT ?>loggedTraveler/dopaymentVehicles/' + '<?php echo $data1['type'] . '/' . $data1['furtherBookingDetails']->vehicle_id?>' + '/' + '<?php echo $data1['checkinDate'].'/'.$data1['checkoutDate'].'/'.$data1['pickupTime']?>' + '/' + initialPrice+'/'+driver;
        }
    } else {
        console.error('Form element not found');
    }
}

    
                                function handlePriceUpdate(updatedPrice) {
                                    const driverType = document.getElementById('withDriver').checked ? 'withDriver' : 'withoutDriver';
                                    const vehicleId = '<?php echo htmlspecialchars($data1['furtherBookingDetails']->vehicle_id, ENT_QUOTES, 'UTF-8') ?>';
                                    const days = <?php echo $daysD; ?>;
                                    // Update the form action with the updated price
                                    updateFormAction(driverType, vehicleId, days, updatedPrice);
                                }
                                
                            </script>
    
                            <!-- <form id="paymentForm" action="<?php echo URLROOT ?>loggedTraveler/dopaymentVehicles/<?php echo $data1['type'] . '/' . $data1['furtherBookingDetails']->vehicle_id.'/'.$data['checkinDate'].'/'.$data1['checkoutDate'].'/'.$data1['pickupTime'].'/'.$data1['price']?>/0" method="POST">
                                
                            </form> -->
                        <?php elseif ($data1['type'] == 5): ?>
                            <?php
                                $date1 = strtotime($data1['checkinDate']);
                                $date2 = strtotime($data1['checkoutDate']);
                                $diffTime = abs($date2 - $date1) + (60 * 60 * 24);
                                $daysD = ceil($diffTime / (60 * 60 * 24)); // Convert seconds to days
                                $tot = $daysD * $data1['furtherBookingDetails']->pricePerDay;
                            ?>
                            <p class="t-price"><strong>Price : <?php echo $tot?> LKR</strong></p>
                            <!-- remove -->
                            <button class="remove-button" onclick="removefromCart('<?php echo $data1['cart_id']; ?>')">
                            <i class='bx bx-trash'></i> Remove
                            </button>
                        <?php else: ?>
                            <?php
                                $date1 = strtotime($data1['checkinDate']);
                                $date2 = strtotime($data1['checkoutDate']);
                                $diffTime = abs($date2 - $date1) ;
                                $daysD = ceil($diffTime / (60 * 60 * 24)); // Convert seconds to days
                                $tot = $daysD * $data1['furtherBookingDetails']->price;
                            ?>
                            <p class="t-price"><strong>Price : <?php echo $tot?> LKR</strong></p>
                            <!-- remove -->
                            <button class="remove-button" onclick="removefromCart('<?php echo $data1['cart_id']; ?>')">
                            <i class='bx bx-trash'></i> Remove
                             </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="final-info">
    <div class="guest-info">
        <p><strong>Your Full Name : </strong><?php echo $data['user']->fname." ".$data['user']->lname?></p>
        <p><strong>Email Address : </strong> <?php echo $data['user']->email?></p>
        <p><strong>Phone Number : </strong><?php echo $data['user']->number?></p>
        <p><strong>Start Date : </strong><?php echo $data1['checkinDate']?></p>
        <p><strong>End Date : </strong><?php echo $data1['checkoutDate']?></p>        
    </div>
    <div>
    <p class="total-amount">
        <strong>Total : </strong>
        <!-- add all -->
        <?php
        $date1 = strtotime($data1['checkinDate']);
        $date2 = strtotime($data1['checkoutDate']);
        $diffTime = abs($date2 - $date1) + (60 * 60 * 24);
        $daysD = ceil($diffTime / (60 * 60 * 24)); // Convert seconds
        ?>
       <?php
// Calculate the total amount
$total = 0;
foreach ($data['resultArray'] as $bookingData):
    if ($bookingData['type'] == 4) {
        $total += $bookingData['price'];
    } elseif ($bookingData['type'] == 3) {
        $date1 = strtotime($bookingData['checkinDate']);
        $date2 = strtotime($bookingData['checkoutDate']);
        $diffTime = abs($date2 - $date1);
        $daysD = ceil($diffTime / (60 * 60 * 24)); // Convert seconds to days
        $total += $daysD * $bookingData['furtherBookingDetails']->price;
    }elseif($bookingData['type'] == 5){
        $total += $bookingData['price'];
    }
endforeach;
            echo $total . ".00 LKR";
        ?>
    </p>
    <p>
    <ul>
    <?php foreach ($data['resultArray'] as $bookingData): ?>
        <?php if ($bookingData['type'] == 4): ?>
            <!-- <li class="vehicle-booking-price" data-price="<?php echo $bookingData['price'] ?>">Vehicle Booking - Price : <?php echo $bookingData['price'] ?> LKR</li> -->
            <li class="vehicle-booking-price"><strong> <?php  echo $bookingData['furtherBookingDetails']->brand.' '. $bookingData['furtherBookingDetails']->model ?></strong></li>
        <?php elseif ($bookingData['type'] == 3): ?>
            <!-- <li class="room-booking-price" data-price="<?php echo $daysD * $bookingData['furtherBookingDetails']->price ?>">Room Booking - Price : <?php echo $daysD * $bookingData['furtherBookingDetails']->price ?> LKR</li> -->
            <li class="room-booking-price"><strong> <?php  echo $bookingData['furtherBookingDetails']->description?></strong></li>
        <?php elseif ($bookingData['type'] == 5): ?>
            <!-- <li class="room-booking-price" data-price="<?php echo $daysD * $bookingData['furtherBookingDetails']->price ?>">Room Booking - Price : <?php echo $daysD * $bookingData['furtherBookingDetails']->price ?> LKR</li> -->
            <li class="guide-booking-price"><strong>Guide&nbsp<?php  echo $bookingData['furtherBookingDetails']->fname?></strong></li>
        <?php endif; ?>
    <?php endforeach; ?>
</ul>

<script>
    // Function to update the hidden input field with the selected driver type
    function updateDriverType() {
        const withDriverCheckbox = document.getElementById('withDriver');
        const withoutDriverCheckbox = document.getElementById('withoutDriver');
        const driverTypeInput = document.getElementById('driverTypeInput');

        // Set the value of the hidden input field based on the selected checkbox
        if (withDriverCheckbox.checked) {
            driverTypeInput.value = 'withDriver';
        } else if (withoutDriverCheckbox.checked) {
            driverTypeInput.value = 'withoutDriver';
        }
    }

    // Attach event listeners to the checkboxes to update the driver type
    const withDriverCheckbox = document.getElementById('withDriver');
    const withoutDriverCheckbox = document.getElementById('withoutDriver');

    withDriverCheckbox.addEventListener('change', updateDriverType);
    withoutDriverCheckbox.addEventListener('change', updateDriverType);
</script>

    </p>
    <!-- <?php echo var_dump($data['bookingcartArray'])?> -->
    <!-- <form id="paymentFormMain" action="<?php echo URLROOT ?>loggedTraveler/cartpayment/<?php echo urlencode(json_encode($data['bookingcartArray'])) . '/' .$data['checkinDate'].'/'.$data['checkoutDate'] . '/' . $data['pickupTime'] ?>" method="POST">
    <input type="hidden" name="totalAmount" id="totalAmountInput" value="<?php echo $total; ?>">
    <input type="hidden" name="driverType" id="driverTypeInput" value="">
    <div class="buttons">
        <button type="submit" class="payment-button">Make Payment</button>
    </div>
</form> -->

<form id="paymentFormMain" action="<?php echo URLROOT ?>loggedTraveler/example/<?php echo $data['cartbooking_id'].'/'.$data1['checkinDate'].'/'.$data1['checkoutDate'] . '/' . $data1['pickupTime'] . '/' .$data1['meetTime']?>" method="POST">
    <input type="hidden" name="totalAmount" id="totalAmountInput" value="<?php echo $total; ?>">
    <input type="hidden" name="driverType" id="driverTypeInput" value="">
    <div class="buttons">
        <button type="submit" class="payment-button"><i class="bx bx-chevron-right"></i> Proceed</button>
        <!-- <button type="submit" formaction="<?php echo URLROOT ?>loggedTraveler/addtocart/<?php echo $data1['checkinDate'].'/'.$data1['checkoutDate'] . '/' . $data1['pickupTime'] . '/' .$data1['meetTime']?>" class="payment-button">Add to Cart</button> -->
    </div>
</form>


</div>

    </div>
   
    <script>
    function removefromCart(cart_id){
 console.log(cart_id);
 var notification = document.getElementById('removecartNotification');
notification.style.display = "block";
setTimeout(function() {
      notification.style.display = 'none'; // Hide notification
  }, 3000); // 3 seconds
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // console.log(this.responseText);
            location.reload();
        }
    };
    xhttp.open("GET", "<?php echo URLROOT?>travelerDashboard/removefromCartByCartId/"+cart_id, true);
    xhttp.send();
}
    </script>
    
    <!-- <?php echo var_dump($data['resultArray'])?> -->
    <div id="removecartNotification" class="cart-notification">Item removed from the cart!</div>
</body>
</html>
