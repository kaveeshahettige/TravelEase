<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>css/loggedTraveler/bookingpayment.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <title>Payment</title>
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT?>/images/TravelEase_logo.png">
</head>
<body style="margin-top:10%">
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

                    <!-- Payment and Cancel buttons added -->
                    <!-- <div class="buttons">
                        <button type="submit" class="payment-button">Make Payment</button>
                        <button type="reset" class="cancel-button">Cancel</button>
                    </div>
                </form>
            </div>
        </div> --> -->
        
    <div class="booking-box">
        <!-- <?php echo var_dump($data['furtherBookingDetails'])?> -->
            <h2 style=" text-align: center;">Booking Information</h2>
            <div class="hotel-details">

            <div class="image-container">
        <img src="<?php echo URLROOT ?>/images/<?php echo $data['furtherBookingDetails']->image ?>" alt="room Image">
    </div>
                
            <div class="maincontainer">
            <div>
                    
                    <div class="reservation-details">
                        <p><strong>Check-in Date : </strong>  <?php echo $data['checkinDate'] ?></p>
                        <p><strong>Check-out Date : </strong>  <?php echo $data['checkoutDate'] ?></p>
                    </div>
    
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
                    </div>
                    
    
                    <!-- <div class="special-requests">
                        <p><strong>Special Requests:</strong> No special requests</p>
                    </div> -->
                    <div class="guest-info">
                        <p><strong>Your Full Name: </strong><?php echo $data['user']->fname." ".$data['user']->lname?></p>
                        <p><strong>Your Email Address:</strong> <?php echo $data['user']->email?></p>
                        <p><strong>Your Phone Number:</strong><?php echo $data['user']->number?></p>
                        <br>
                        <p ><strong>Total :  <?php echo $data['furtherBookingDetails']->price ?></strong></p>
                <form action="<?php echo URLROOT ?>loggedTraveler/dopayment/<?php echo $data['furtherBookingDetails']->type . '/' . $data['furtherBookingDetails']->room_id.'/'.$data['checkinDate'].'/'.$data['checkoutDate'] ?>">
        <div class="buttons">
                        <button type="submit" class="payment-button">Make Payment</button>
                    </div>
        </form>
                        
                    </div>
                    
            </div>
           
                
            </div>
           
        </div>
        
        
    </div>
</body>
</html>
