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
    <style>
        .total-value {
    text-align: center;
    font-size: 24px;
    color: #333; /* Adjust the color as needed */
    margin-top: 20px;
    font-weight: bold;
}

    </style>
</head>
<body style="margin-top:2%">
    <div class="payment-container" >
    <div class="booking-box">
        <!-- <?php echo var_dump($data['furtherBookingDetails'])?> -->
            <h2 style=" text-align: center;">Service Details</h2>
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
        <!-- <p><strong>Plate Number:</strong> <?php echo $data['furtherBookingDetails']->plate_number ?></p> -->
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
        <!-- <p><strong>Air bags:</strong> <?php echo $data['furtherBookingDetails']->seating_capacity ?></p>
        <p><strong>TV : </strong> <?php echo $data['furtherBookingDetails']->seating_capacity ?></p> -->


        
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
                        
                        <?php if ($data['type'] == 3): ?>
                            <div class="reservation-details">
                            <p><strong>AC availability:</strong> <?php echo $data['furtherBookingDetails']->acAvailability ?></p>
                        <p><strong>TV availability:</strong> <?php echo $data['furtherBookingDetails']->tvAvailability ?></p>
                        <p><strong>Wifi availability:</strong> <?php echo $data['furtherBookingDetails']->wifiAvailability ?></p>

                    </div>
                    <?php elseif ($data['type'] == 5): ?>
                        <div class="reservation-details">
                            <p><strong>Facebook :</strong> <?php echo $data['furtherBookingDetails']->facebook ?></p>
                        <p><strong>Instagram :</strong> <?php echo $data['furtherBookingDetails']->instagram ?></p>
                       

                    </div>
                          
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
<p class="total-value" id="totalPrice" data-initial-price="<?php echo htmlspecialchars($data['price'], ENT_QUOTES, 'UTF-8') ?>"><strong>Total : <?php echo htmlspecialchars($data['price'], ENT_QUOTES, 'UTF-8') ?>&nbsp LKR</strong></p>


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

     
<!-- <form id="paymentForm" action="<?php echo URLROOT ?>loggedTraveler/dopaymentVehicles/<?php echo $data['type'] . '/' . $data['furtherBookingDetails']->vehicle_id.'/'.$data['checkinDate'].'/'.$data['checkoutDate'].'/'.$data['pickupTime'].'/'.$data['price']?>/0" method="POST">
                            <div class="buttons">
                                <button type="submit" class="payment-button">Make Payment</button>
                            </div>
                        </form> -->
                        <?php else: ?>
                            <?php

if($data['type']==3){
    $date1 = strtotime($data['checkinDate']);
$date2 = strtotime($data['checkoutDate']);
$diffTime = abs($date2 - $date1) ;
$daysD = ceil($diffTime / (60 * 60 * 24)); // Convert seconds to days
    $tot=$daysD* $data['furtherBookingDetails']->price;
}else if($data['type']==5){
    $date1 = strtotime($data['checkinDate']);
$date2 = strtotime($data['checkoutDate']);
$diffTime = abs($date2 - $date1) + (60 * 60 * 24);
$daysD = ceil($diffTime / (60 * 60 * 24)); // Convert seconds to days
    $tot=$daysD*$data['furtherBookingDetails']->pricePerDay;
}

?>
                        <p class="total-value"><strong>Total :  <?php echo $tot?>&nbsp LKR</strong></p>
                        
                        
                        <?php endif; ?>

                
                        
                    </div>
                    
            </div>
           
                
            </div>
           
        </div>
        
        
    </div>
</body>
</html>
