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
</head>
<body style="margin-top:2%">
    <div class="payment-container" >
        <!-- <div class="payment-box">
            <h2>Payment Information</h2>
            <div class="payment-gateway">
                <h3>Card Payment</h3>
                <form action="<?php echo URLROOT ?>loggedTraveler/bookingpayment/<?php echo $data['furtherBookingDetails']->type . '/' . $data['furtherBookingDetails']->room_id ?>" method="POST">
                    <label for="cardholderName">Cardholder Name:</label>
                    <input type="text" id="cardholderName" name="cardholderName" value="<?php echo $data['user']->fname." ".$data['user']->lname?>" required>

                    <label for="cardNumber">Card Number:</label>
                    <input type="text" id="cardNumber" name="cardNumber" placeholder="XXXX XXXX XXXX XXXX" >

                    <div class="expiration-date">
                        <label for="expirationMonth">Expiry Month:</label>
                        <input type="number" id="expirationMonth" name="expirationMonth" placeholder="MM" min="1" max="12" >

                        <label for="expirationYear">Expiry Year:</label>
                        <input type="number" id="expirationYear" name="expirationYear" placeholder="YYYY" min="2023" >
                    </div>

                    <label for="cvv">CVV:</label>
                    <input type="text" id="cvv" name="cvv" placeholder="XXX" >

                    Payment and Cancel buttons added -->
                    <!-- <div class="buttons">
                        <button type="submit" class="payment-button">Make Payment</button>
                        <button type="reset" class="cancel-button">Cancel</button>
                    </div>
                </form>
            </div>
        </div> --> 
        
    <div class="booking-box">
        <!-- <?php echo var_dump($data['furtherBookingDetails'])?> -->
            <h2 style=" text-align: center;">Booking Information</h2>
            <div class="hotel-details">

            <div class="image-container">
        <img src="<?php echo URLROOT ?>/images/<?php echo $data['furtherBookingDetails']->image ?>" alt="Image">
        <!-- <?php echo $data['furtherBookingDetails']->image ?> -->
    </div>
                
            <div class="maincontainer">
            <div>
                    
                    
                    <?php if ($data['type'] == 3): ?>
                    <div class="reservation-details">
                        <p><strong>Room ID:</strong> <?php echo $data['furtherBookingDetails']->room_id ?></p>
                        <p><strong>Number of Beds:</strong> <?php echo $data['furtherBookingDetails']->numOfBeds ?> </p>
                        <p><strong>About:</strong> <?php echo $data['furtherBookingDetails']->description ?></p>
                        <p><strong>AC availability:</strong> <?php echo $data['furtherBookingDetails']->acAvailability ?></p>
                        <p><strong>TV availability:</strong> <?php echo $data['furtherBookingDetails']->tvAvailability ?></p>
                        <p><strong>Wifi availability:</strong> <?php echo $data['furtherBookingDetails']->wifiAvailability ?></p>
                    </div>
                    <div class="reservation-details">
                        <p><strong>Cancellation policy:</strong> <?php echo $data['furtherBookingDetails']->cancellationPolicy ?> </p>
                        <p><strong>Smoking policy:</strong> <?php echo $data['furtherBookingDetails']->smokingPolicy ?></p>
                        <p><strong>Pet policy:</strong> <?php echo $data['furtherBookingDetails']->petPolicy ?></p>
                    </div>
                    <?php elseif ($data['type'] == 4): ?>
    <div class="reservation-details">
        <p><strong>Brand:</strong> <?php echo $data['furtherBookingDetails']->brand ?> </p>
        <p><strong>Model:</strong> <?php echo $data['furtherBookingDetails']->model ?></p>
        <p><strong>Plate Number:</strong> <?php echo $data['furtherBookingDetails']->plate_number ?></p>
        <p><strong>Fuel Type:</strong> <?php echo $data['furtherBookingDetails']->fuel_type ?></p>
        <p><strong>Year:</strong> <?php echo $data['furtherBookingDetails']->year ?></p>
        <p><strong>Seating Capacity:</strong> <?php echo $data['furtherBookingDetails']->seating_capacity ?></p>
        <p><strong>Air Condition:</strong> 
<?php 
if ($data['furtherBookingDetails']->ac_type  == 1) {
    echo "Available";
} else {
    echo "Not Available";
}
?>
</p>

        
    </div>
    <?php elseif ($data['type'] == 5): ?>
    <div class="reservation-details">
        <p><strong>Name:</strong> <?php echo $data['serviceProvider']->fname ?> </p>
        <p><strong>About:</strong> <?php echo $data['furtherBookingDetails']->description ?></p>
        <p><strong>Category:</strong> <?php echo $data['furtherBookingDetails']->category ?></p>
        <p><strong>Languages:</strong> <?php echo $data['furtherBookingDetails']->languages ?></p>
        <p><strong>Guide Register Number:</strong> <?php echo $data['furtherBookingDetails']->GuideRegNumber ?></p>
        <p><strong>Lisence Expiry Date:</strong> <?php echo $data['furtherBookingDetails']->LisenceExpDate ?></p>
        <p><strong>Sites:</strong> <?php echo $data['furtherBookingDetails']->sites ?></p>
</p>

        
    </div>
<?php else: ?>
    <p>No details available for this type.</p>
<?php endif; ?>
            </div>
                    
    
                    <!-- <div class="special-requests">
                        <p><strong>Special Requests:</strong> No special requests</p>
                    </div> -->
                    <div class="guest-info">
                        <p><strong>Your Full Name: </strong><?php echo $data['user']->fname." ".$data['user']->lname?></p>
                        <p><strong> Email Address:</strong> <?php echo $data['user']->email?></p>
                        <p><strong> Phone Number:</strong><?php echo $data['user']->number?></p>
                        
                        <?php if ($data['type'] == 4||$data['type'] == 5 ): ?>
                            <div class="reservation-details">
                        <p><strong> Pick-up Date : </strong>  <?php echo $data['checkinDate'] ?></p>
                        <p><strong> Drop-off Date : </strong>  <?php echo $data['checkoutDate'] ?></p>
                        <p><strong> Pickup time:</strong> <?php echo $data['pickupTime']?></p>

                    </div>

                         <?php elseif($data['type'] == 3):?>
                            <div class="reservation-details">
                        <p><strong>Check-in Date : </strong>  <?php echo $data['checkinDate'] ?></p>
                        <p><strong>Check-out Date : </strong>  <?php echo $data['checkoutDate'] ?></p>
                    </div>
                            
                          <?php else: ?>
                          
                          <?php endif;?>
                        <br>
                        <?php if ($data['type'] == 4): ?>
                            <?php
$date1 = strtotime($data['checkinDate']);
$date2 = strtotime($data['checkoutDate']);
$diffTime = abs($date2 - $date1) + (60 * 60 * 24);
$daysD = ceil($diffTime / (60 * 60 * 24)); // Convert seconds to days
?>

                            <div class="driver-selection">
                            <strong>With Driver</strong>
        <input type="checkbox" id="withDriver" name="withDriver" value="1" onclick="handleCheckboxClick('withDriver', '<?php echo htmlspecialchars($data['furtherBookingDetails']->vehicle_id, ENT_QUOTES, 'UTF-8') ?>', <?php echo $daysD; ?>)">
        <label for="withDriver"></label>

    <strong>Without Driver</strong>
    <input type="checkbox" id="withoutDriver" name="withoutDriver" value="0" checked onclick="handleCheckboxClick('withoutDriver', '<?php echo htmlspecialchars($data['furtherBookingDetails']->vehicle_id, ENT_QUOTES, 'UTF-8') ?>', <?php echo $daysD; ?>)">
    <label for="withoutDriver"></label>
</div>
<p id="totalPrice" data-initial-price="<?php echo htmlspecialchars($data['price'], ENT_QUOTES, 'UTF-8') ?>"><strong>Total : <?php echo htmlspecialchars($data['price'], ENT_QUOTES, 'UTF-8') ?>  LKR</strong></p>


<script>
function updateFormAction(driverType, vehicleId, days, updatedPrice) {
    const form = document.getElementById('paymentForm');
    if (driverType === 'withDriver') {
    const driver = 1;
    // Construct the URL with updated price and set it as the form action
    form.action = '<?php echo URLROOT ?>loggedTraveler/dopaymentVehicles/' + '<?php echo $data['type'] . '/' . $data['furtherBookingDetails']->vehicle_id?>' + '/' + '<?php echo $data['checkinDate'].'/'.$data['checkoutDate'].'/'.$data['pickupTime']?>' + '/' + updatedPrice+'/'+driver;
} else {
    const driver = 0;
        // Use the initial price for withoutDriver and set it as the form action
        const initialPrice = parseFloat(document.getElementById('totalPrice').dataset.initialPrice);
        form.action = '<?php echo URLROOT ?>loggedTraveler/dopaymentVehicles/' + '<?php echo $data['type'] . '/' . $data['furtherBookingDetails']->vehicle_id?>' + '/' + '<?php echo $data['checkinDate'].'/'.$data['checkoutDate'].'/'.$data['pickupTime']?>' + '/' + initialPrice+'/'+driver;
}

}
function handlePriceUpdate(updatedPrice) {
    const driverType = document.getElementById('withDriver').checked ? 'withDriver' : 'withoutDriver';
    const vehicleId = '<?php echo htmlspecialchars($data['furtherBookingDetails']->vehicle_id, ENT_QUOTES, 'UTF-8') ?>';
    const days = <?php echo $daysD; ?>;
    
    // Update the form action with the updated price
    updateFormAction(driverType, vehicleId, days, updatedPrice);
}
</script>

     
<form id="paymentForm" action="<?php echo URLROOT ?>loggedTraveler/dopaymentVehicles/<?php echo $data['type'] . '/' . $data['furtherBookingDetails']->vehicle_id.'/'.$data['checkinDate'].'/'.$data['checkoutDate'].'/'.$data['pickupTime'].'/'.$data['price']?>/0" method="POST">
                            <div class="buttons">
                                <button type="submit" class="payment-button">Make Payment</button>
                            </div>
                        </form>
                        <?php else: ?>
                            <?php
$date1 = strtotime($data['checkinDate']);
$date2 = strtotime($data['checkoutDate']);
$diffTime = abs($date2 - $date1) + (60 * 60 * 24);
$daysD = ceil($diffTime / (60 * 60 * 24)); // Convert seconds to days
if($data['type']==3){
    $tot=$daysD* $data['furtherBookingDetails']->price;
}else if($data['type']==5){
    $tot=$daysD*$data['furtherBookingDetails']->pricePerDay;
}

?>
                        <p ><strong>Total :  <?php echo $tot?>  LKR</strong></p>
                       
                        <?php if($data['type']==3):?>
                        <form action="<?php echo URLROOT ?>loggedTraveler/dopayment/<?php echo $data['furtherBookingDetails']->type . '/' . $data['furtherBookingDetails']->room_id.'/'.$data['checkinDate'].'/'.$data['checkoutDate'].'/'.$tot?>">
                            <div class="buttons">
                                <button type="submit" class="payment-button">Make Payment</button>
                            </div>
                        </form>
                        <?php elseif($data['type']==5):?>
                            <form action="<?php echo URLROOT ?>loggedTraveler/dopaymentGuides/5/<?php echo $data['furtherBookingDetails']->user_id.'/'.$data['checkinDate'].'/'.$data['checkoutDate'].'/'.$tot.'/'.$data['pickupTime']?>">
                            <div class="buttons">
                                <button type="submit" class="payment-button">Make Payment</button>
                            </div>
                        </form>
                        <?php endif;?>
                        <?php endif; ?>

                
                        
                    </div>
                    
            </div>
           
                
            </div>
           
        </div>
        
        
    </div>
</body>
</html>
