<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>css/loggedTraveler/bookingcartpayment.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <title>Payment</title>
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT?>/images/TravelEase_logo.png">
    <script src="<?php echo URLROOT?>js/loggedTraveler/script.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .reservation-details p{
                padding: 3px;
        }
        .reservation-details p i{
                padding-right: 20px;
        }
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
<body >
<!-- <?php echo var_dump($data['bookingcartArray'])?> -->
<!-- <?php echo var_dump($data['furtherBookingDetails'])?> -->


<?php $servicePrices = [];?>
    <div class="payment-container" >
    <div class="booking-box">
    
    <h2 style="text-align: center;">Booking Information</h2>
    <!-- <?php echo var_dump($data['furtherBookingDetails'])?> -->
    <?php foreach ($data['furtherBookingDetails'] as $data1): ?>
       
        <div class="hotel-details" >
            <div class="image-container">
                <img src="<?php echo URLROOT ?>/images/<?php echo $data1->image ?>" alt="Image">
            </div>
            <div class="maincontainer">
                <div>
                    <?php if ($data1->type == 3): ?>
                        <div class="reservation-details">
                             <p><strong><i class="fas fa-bed"></i> Beds:</strong> <?php echo $data1->numOfBeds ?></p>
                                <p><strong><i class="fas fa-align-left"></i> About:</strong> <?php echo $data1->description ?></p>
                                <p><strong><i class="fas fa-smoking"></i> Smoking policy:</strong> <?php echo $data1->smokingPolicy ?></p>
                                <p><strong><i class="fas fa-paw"></i> Pet policy:</strong> <?php echo $data1->petPolicy ?></p>
                               
                                <p>
    <strong><i class="fas fa-coffee"></i> Breakfast: </strong>
    <?php if ($data1->breakfastIncluded == 'yes'): ?>
        <i style="color:green" class="fas fa-check-circle"></i>
    <?php else: ?>
        <i style="color:red" class="fas fa-times-circle"></i>
    <?php endif; ?>
    <strong><i class="fas fa-utensils"></i> Lunch: </strong>
    <?php if ($data1->lunchIncluded == 'yes'): ?>
        <i style="color:green" class="fas fa-check-circle"></i>
    <?php else: ?>
        <i style="color:red" class="fas fa-times-circle"></i>
    <?php endif; ?>
    <strong><i class="fas fa-utensils"></i> Dinner: </strong>
    <?php if ($data1->dinnerIncluded == 'yes'): ?>
        <i style="color:green" class="fas fa-check-circle"></i>
    <?php else: ?>
        <i style="color:red" class="fas fa-times-circle"></i>
    <?php endif; ?>
</p>
    
<p>
    <strong><i class="fas fa-box"></i> AC:</strong>
    <?php if ($data1->acAvailability == 'yes'): ?>
        <i style="color:green" class="fas fa-check-circle"></i>
    <?php else: ?>
        <i style="color:red" class="fas fa-times-circle"></i>
    <?php endif; ?>
    <strong><i class="fas fa-tv"></i> TV: </strong>
    <?php if ($data1->tvAvailability == 'yes'): ?>
        <i style="color:green" class="fas fa-check-circle"></i>
    <?php else: ?>
        <i style="color:red" class="fas fa-times-circle"></i>
    <?php endif; ?>
    <strong><i class="fas fa-wifi"></i> WiFi: </strong>
    <?php if ($data1->wifiAvailability == 'yes'): ?>
        <i style="color:green" class="fas fa-check-circle"></i>
    <?php else: ?>
        <i style="color:red" class="fas fa-times-circle"></i>
    <?php endif; ?>
    
</p>

<p><strong><i class="fas fa-bed"></i> Room size:</strong> <?php echo $data1->roomSize ?></p>
<p><strong><i class="fas fa-user"></i> Adults:</strong> <?php echo $data1->numAdults ?></p>
<p><strong><i class="fas fa-child"></i> Children:</strong> <?php echo $data1->numChildren ?></p>

<p>
    <strong><i class="fas fa-box"></i> Private pool: <?php echo $data1->privatePoolAvailability ?></strong>
    <?php if ($data1->privatePoolAvailability == 'yes'): ?>
        <i style="color:green" class="fas fa-check-circle"></i>
    <?php else: ?>
        <i style="color:red" class="fas fa-times-circle"></i>
    <?php endif; ?>
</p>

<p>
    <strong><i class="fas fa-cube"></i> Hot tub: <?php echo $data1->hotTubAvailability ?></strong>
    <?php if ($data1->hotTubAvailability == 'yes'): ?>
        <i style="color:green" class="fas fa-check-circle"></i>
    <?php else: ?>
        <i style="color:red" class="fas fa-times-circle"></i>
    <?php endif; ?>
</p>

                            </div>
                    <?php elseif ($data1->type == 4): ?>
                        <div class="reservation-details">
                                <p><strong><i class="fas fa-car"></i> Brand:</strong> <?php echo $data1->brand ?></p>
                                <p><strong><i class="fas fa-car"></i> Model:</strong> <?php echo $data1->model ?></p>
                                <p><strong><i class="fas fa-car"></i> Plate Number:</strong> <?php echo $data1->plate_number ?></p>
                                <p><strong><i class="fas fa-gas-pump"></i> Fuel Type:</strong> <?php echo $data1->fuel_type ?></p>
                                <p><strong><i class="fas fa-calendar-alt"></i> Year:</strong> <?php echo $data1->year ?></p>
                                <p><strong><i class="fas fa-chair"></i> Seating Capacity:</strong> <?php echo $data1->seating_capacity ?></p>
                                <p><strong><i class="fas fa-snowflake"></i> Air Condition:</strong>
                                    <?php
                                    if ($data1->ac_type  == 1) {
                                        echo '<i style="color:green" class="fas fa-check-circle"></i>';
                                    } else {
                                        echo '<i style="color:red" class="fas fa-times-circle"></i>';
                                    }
                                    ?>
                                </p>
<p>
    <strong><i class="fas fa-circle"></i> Air bags: <?php echo $data1->airbag ?></strong>
    <?php if ($data1->airbag == 1): ?>
        <i style="color:green" class="fas fa-check-circle"></i>
    <?php else: ?>
        <i style="color:red" class="fas fa-times-circle"></i>
    <?php endif; ?>
    <strong><i class="fas fa-map"></i> Navigation: <?php echo $data1->nav ?></strong>
    <?php if ($data1->nav == 1): ?>
        <i style="color:green" class="fas fa-check-circle"></i>
    <?php else: ?>
        <i style="color:red" class="fas fa-times-circle"></i>
    <?php endif; ?>
</p>

<!-- For TV -->
<p>
    <strong><i class="fas fa-tv"></i> TV: <?php echo $data1->tv ?></strong>
    <?php if ($data1->tv == 1): ?>
        <i style="color:green" class="fas fa-check-circle"></i>
    <?php else: ?>
        <i style="color:red" class="fas fa-times-circle"></i>
    <?php endif; ?>
    <strong><i class="fas fa-plug"></i> USB: <?php echo $data1->usb ?></strong>
    <?php if ($data1->usb == 1): ?>
        <i style="color:green" class="fas fa-check-circle"></i>
    <?php else: ?>
        <i style="color:red" class="fas fa-times-circle"></i>
    <?php endif; ?>
</p>

<!-- For USB -->
<p>
   
</p>



                            </div>
                        <?php elseif ($data1->type == 5): ?>
                            
                            <div class="reservation-details">
                                 
                                <p><strong><i class="fas fa-user"></i> Name:</strong> <?php echo $data1->fname ?></p>
                                <p><strong><i class="fas fa-tags"></i> Category:</strong> <?php echo $data1->category ?></p>
                                <p><strong><i class="fas fa-language"></i> Languages:</strong> <?php echo $data1->languages ?></p>
                                <p><strong><i class="fas fa-id-badge"></i> Guide Register Number:</strong> <?php echo $data1->GuideRegNumber ?></p>
                                <p><strong><i class="fas fa-calendar-alt"></i> Lisence Expiry Date:</strong> <?php echo $data1->LisenceExpDate ?></p>
                                <p><strong><i class="fas fa-map-marker-alt"></i> Sites:</strong> <?php echo $data1->sites ?></p>
                                <!-- <p style="margin-right:30px;"><strong><i class="fas fa-info-circle" ></i> About:</strong> <?php echo $data1->description ?></p> -->
                                </p>


                            </div>
                    <?php else: ?>
                        <p>No details available for this type.</p>
                    <?php endif; ?>
                </div>
                <div class="">
                    <?php if ($data1->type == 4): ?>
                        <div class="reservation-details">
                            <p><strong><i class="fas fa-clock"></i> Pickup time:</strong> <?php echo $data['pickupTime']?></p>
                            <p><strong><i class="fas fa-user"></i> Driver:</strong> <?php if ($data['driverType'] == 'withDriver'): ?>
                                <i style="color:green" class="fas fa-check-circle"></i>
                            <?php else:?>
                                <i style="color:red" class="fas fa-times-circle"></i>
                            <?php endif; ?>
                        </div>
                    <?php elseif($data1->type == 3): ?>
                        <?php elseif($data1->type == 5): ?>
                            <p><strong><i class="fas fa-clock"></i> Meet time:</strong> <?php echo $data['meetTime']?></p>
        
                    <?php else: ?>
                    <?php endif; ?>
                    <br>
                    <?php if ($data1->type== 4): ?>
                        <?php
                            $date1 = strtotime($data['checkinDate']);
                            $date2 = strtotime($data['checkoutDate']);
                            $diffTime = abs($date2 - $date1) + (60 * 60 * 24);
                            $daysD = ceil($diffTime / (60 * 60 * 24)); // Convert seconds
                            ?>
                            
                            <?php 
                            if($data['driverType']=="withDriver"){
                                $tot= ($data1->priceperday+$data1->withDriverPerDay) * $daysD;
                            }else{
                                $tot= $data1->priceperday * $daysD;
                            }
                            $servicePrices[] =$tot;
                            ?>
                            <p class="t-price"><strong>Price : <?php echo $tot?> LKR</strong></p>
                        <?php elseif ($data1->type== 5): ?>
                            <?php
                                $date1 = strtotime($data['checkinDate']);
                                $date2 = strtotime($data['checkoutDate']);
                                $diffTime = abs($date2 - $date1) + (60 * 60 * 24);
                                $daysD = ceil($diffTime / (60 * 60 * 24)); // Convert seconds to days
                                // $tot = $daysD * $data1->pricePerDay;
                                //$servicePrices[] = $tot;
                            ?>
                            <?php $tot=$data1->pricePerDay *$daysD?>
                            <?php $servicePrices[] = $tot;?>
                            <p class="t-price"><strong>Price : <?php echo $tot?> LKR</strong></p>
                            
                            <!-- <p class="t-price"><strong>Price : <?php echo $tot?> LKR</strong></p> -->
                        <?php else: ?>
                            <?php
                                $date1 = strtotime($data['checkinDate']);
                                $date2 = strtotime($data['checkoutDate']);
                                $diffTime = abs($date2 - $date1) ;
                                $daysD = ceil($diffTime / (60 * 60 * 24)); // Convert seconds to days
                                 $tot = $daysD * $data1->price;
                                
                                $servicePrices[] = $tot;
                            ?>
                            <p class="t-price"><strong>Price : <?php echo $tot?> LKR</strong></p>
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
        <p><strong>Start Date : </strong><?php echo $data['checkinDate']?></p>
        <p><strong>End Date : </strong><?php echo $data['checkoutDate']?></p>        
    </div>
    <div>
    <p class="total-amount">
        <strong>Total : </strong>
        <!-- add all -->
        <?php
        $date1 = strtotime($data['checkinDate']);
        $date2 = strtotime($data['checkoutDate']);
        $diffTime = abs($date2 - $date1) + (60 * 60 * 24);
        $daysD = ceil($diffTime / (60 * 60 * 24)); // Convert seconds
        ?>
       <?php
// Calculate the total amount
$total = 0;
foreach ($data['furtherBookingDetails'] as $bookingData):
    if ($bookingData->type == 4) {
        if($data['driverType']=='withDriver'){
            $total += ($bookingData->priceperday+$bookingData->withDriverPerDay) * $daysD;
        }else{
            $total += $bookingData->priceperday * $daysD;
        }
        
    } elseif ($bookingData->type == 3) {
        $date1 = strtotime($data['checkinDate']);
        $date2 = strtotime($data['checkoutDate']);
        $diffTime = abs($date2 - $date1);
        $daysDt = ceil($diffTime / (60 * 60 * 24)); // Convert seconds to days
        $total += $daysDt * $bookingData->price;
    }elseif($bookingData->type == 5){
        $total += $bookingData->pricePerDay * $daysD;
    }
endforeach;
            echo $total . ".00 LKR";
        ?>

    </p>
    
    <?php if($total!=0):?>
    <form id="paymentFormMain" action="<?php echo URLROOT ?>TravelerDashboard/paymentwishlist/<?php echo $data['cartid'] ?>/<?php echo urlencode(json_encode($servicePrices)) ?>" method="POST">
    <input type="hidden" name="totalAmount" id="totalAmountInput" value="<?php echo $total; ?>">
    <input type="hidden" name="driverType" id="driverTypeInput" value="<?php echo $data['driverType']; ?>">
    <input type="hidden" name="pickupTime" id="pickupTime" value="<?php echo $data['pickupTime']; ?>">
    <input type="hidden" name="meetTime" id="meetTime" value="<?php echo $data['meetTime']; ?>">
    <!-- //checkinDate -->
    <input type="hidden" name="checkinDate" id="checkinDate" value="<?php echo $data['checkinDate']; ?>">
    <!-- //checkoutDate -->
    <input type="hidden" name="checkoutDate" id="checkoutDate" value="<?php echo $data['checkoutDate']; ?>">


    <div class="buttons">
        <button type="submit" class="payment-button">Make Payment</button>
        <!-- <button type="submit" formaction="<?php echo URLROOT ?>loggedTraveler/addtocart/<?php echo urlencode(json_encode($data['bookingcartArray'])) . '/' .$data['checkinDate'].'/'.$data['checkoutDate'] . '/' . $data['pickupTime'] . '/' .$data1['meetTime']?>" class="payment-button">Add to Wish List</button> -->
    </div>
</form>
<?php else:?>
    <p style="color:red">No items are available right now.Come again later!</p>
<?php endif ;?>

</div>

    </div>
    
</body>
</html>
