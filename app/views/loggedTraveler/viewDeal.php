<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT ?>css/loggedTraveler/bookingpayment.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <title>Payment</title>
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT ?>/images/TravelEase_logo.png">
    <script src="<?php echo URLROOT ?>js/loggedTraveler/script.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .reservation-details i {
            padding-right: 10px;
        }

        .guest-info i {
            padding-right: 10px;
        }

        .reservation-details p {
            margin-top: 15px;
        }

        .guest-info p {
            margin-top: 15px;
        }
    </style>
</head>

<body style="margin-top:2%">
    <div class="payment-container">
        <div class="booking-box">
            <!-- <?php echo var_dump($data['furtherBookingDetails']) ?> -->
            <h2 style=" text-align: center;">Booking Information</h2>
            <div class="hotel-details">

                <div class="image-container">
                    <img src="<?php echo URLROOT ?>/images/<?php echo $data['furtherBookingDetails']->image ?> " style="border-radius:10%;" alt="Image">
                    <!-- <?php echo $data['furtherBookingDetails']->image ?> -->
                </div>

                <div class="maincontainer">
                    <div>


                        <?php if ($data['type'] == 3) : ?>
                            <div class="reservation-details">
                                <!-- <p><strong><i class="fas fa-door-open"></i> Room ID:</strong> <?php echo $data['furtherBookingDetails']->room_id ?></p> -->
                                <p><strong><i class="fas fa-bed"></i> Beds:</strong> <?php echo $data['furtherBookingDetails']->numOfBeds ?></p>
                                <p><strong><i class="fas fa-align-left"></i> About:</strong> <?php echo $data['furtherBookingDetails']->description ?></p>
                                <!-- <p><strong><i class="fas fa-snowflake"></i> AC :</strong> <?php echo $data['furtherBookingDetails']->acAvailability ?></p> -->
                                <!-- <p><strong><i class="fas fa-tv"></i> TV :</strong> <?php echo $data['furtherBookingDetails']->tvAvailability ?></p> -->
                                <!-- <p><strong><i class="fas fa-wifi"></i> Wifi :</strong> <?php echo $data['furtherBookingDetails']->wifiAvailability ?></p> -->
                                <!-- <p><strong><i class="fas fa-file-contract"></i> Cancellation policy:</strong> <?php echo $data['furtherBookingDetails']->cancellationPolicy ?></p> -->
                                <p><strong><i class="fas fa-smoking"></i> Smoking policy:</strong> <?php echo $data['furtherBookingDetails']->smokingPolicy ?></p>
                                <p><strong><i class="fas fa-paw"></i> Pet policy:</strong> <?php echo $data['furtherBookingDetails']->petPolicy ?></p>
                               
                                <p>
    <strong><i class="fas fa-coffee"></i> Breakfast: <?php echo $data['furtherBookingDetails']->breakfastIncluded ?></strong>
    <?php if ($data['furtherBookingDetails']->breakfastIncluded == 'yes'): ?>
        <i style="color:green" class="fas fa-check-circle"></i>
    <?php else: ?>
        <i style="color:red" class="fas fa-times-circle"></i>
    <?php endif; ?>
    <strong><i class="fas fa-utensils"></i> Lunch: <?php echo $data['furtherBookingDetails']->lunchIncluded ?></strong>
    <?php if ($data['furtherBookingDetails']->lunchIncluded == 'yes'): ?>
        <i style="color:green" class="fas fa-check-circle"></i>
    <?php else: ?>
        <i style="color:red" class="fas fa-times-circle"></i>
    <?php endif; ?>
    <strong><i class="fas fa-utensils"></i> Dinner: <?php echo $data['furtherBookingDetails']->dinnerIncluded ?></strong>
    <?php if ($data['furtherBookingDetails']->dinnerIncluded == 'yes'): ?>
        <i style="color:green" class="fas fa-check-circle"></i>
    <?php else: ?>
        <i style="color:red" class="fas fa-times-circle"></i>
    <?php endif; ?>
</p>

</p>

<p>
    

</p>
<p>
    
<p>
    <strong><i class="fas fa-box"></i> AC:</strong>
    <?php if ($data['furtherBookingDetails']->acAvailability == 'yes'): ?>
        <i style="color:green" class="fas fa-check-circle"></i>
    <?php else: ?>
        <i style="color:red" class="fas fa-times-circle"></i>
    <?php endif; ?>
    <strong><i class="fas fa-tv"></i> TV: </strong>
    <?php if ($data['furtherBookingDetails']->tvAvailability == 'yes'): ?>
        <i style="color:green" class="fas fa-check-circle"></i>
    <?php else: ?>
        <i style="color:red" class="fas fa-times-circle"></i>
    <?php endif; ?>
    <strong><i class="fas fa-wifi"></i> WiFi: </strong>
    <?php if ($data['furtherBookingDetails']->wifiAvailability == 'yes'): ?>
        <i style="color:green" class="fas fa-check-circle"></i>
    <?php else: ?>
        <i style="color:red" class="fas fa-times-circle"></i>
    <?php endif; ?>
</p>

<p><strong><i class="fas fa-bed"></i> Room size:</strong> <?php echo $data['furtherBookingDetails']->roomSize ?></p>
<p><strong><i class="fas fa-user"></i> Adults:</strong> <?php echo $data['furtherBookingDetails']->numAdults ?></p>
<p><strong><i class="fas fa-child"></i> Children:</strong> <?php echo $data['furtherBookingDetails']->numChildren ?></p>

<p>
    <strong><i class="fas fa-box"></i> Private pool: <?php echo $data['furtherBookingDetails']->privatePoolAvailability ?></strong>
    <?php if ($data['furtherBookingDetails']->privatePoolAvailability == 'yes'): ?>
        <i style="color:green" class="fas fa-check-circle"></i>
    <?php else: ?>
        <i style="color:red" class="fas fa-times-circle"></i>
    <?php endif; ?>
</p>

<p>
    <strong><i class="fas fa-cube"></i> Hot tub: <?php echo $data['furtherBookingDetails']->hotTubAvailability ?></strong>
    <?php if ($data['furtherBookingDetails']->hotTubAvailability == 'yes'): ?>
        <i style="color:green" class="fas fa-check-circle"></i>
    <?php else: ?>
        <i style="color:red" class="fas fa-times-circle"></i>
    <?php endif; ?>
</p>

                            </div>
                        <?php elseif ($data['type'] == 4) : ?>
                            <div class="reservation-details">
                                <p><strong><i class="fas fa-car"></i> Brand:</strong> <?php echo $data['furtherBookingDetails']->brand ?></p>
                                <p><strong><i class="fas fa-car"></i> Model:</strong> <?php echo $data['furtherBookingDetails']->model ?></p>
                                <p><strong><i class="fas fa-car"></i> Plate Number:</strong> <?php echo $data['furtherBookingDetails']->plate_number ?></p>
                                <p><strong><i class="fas fa-gas-pump"></i> Fuel Type:</strong> <?php echo $data['furtherBookingDetails']->fuel_type ?></p>
                                <p><strong><i class="fas fa-calendar-alt"></i> Year:</strong> <?php echo $data['furtherBookingDetails']->year ?></p>
                                <p><strong><i class="fas fa-chair"></i> Seating Capacity:</strong> <?php echo $data['furtherBookingDetails']->seating_capacity ?></p>
                                <p><strong><i class="fas fa-snowflake"></i> Air Condition:</strong>
                                    <?php
                                    if ($data['furtherBookingDetails']->ac_type  == 1) {
                                        echo "Available";
                                    } else {
                                        echo "Not Available";
                                    }
                                    ?>
                                </p>
<!-- For Air bags -->
<!-- For Air bags -->
<p>
    <strong><i class="fas fa-circle"></i> Air bags: <?php echo $data['furtherBookingDetails']->airbag ?></strong>
    <?php if ($data['furtherBookingDetails']->airbag == 1): ?>
        <i style="color:green" class="fas fa-check-circle"></i>
    <?php else: ?>
        <i style="color:red" class="fas fa-times-circle"></i>
    <?php endif; ?>
    <strong><i class="fas fa-map"></i> Navigation: <?php echo $data['furtherBookingDetails']->nav ?></strong>
    <?php if ($data['furtherBookingDetails']->nav == 1): ?>
        <i style="color:green" class="fas fa-check-circle"></i>
    <?php else: ?>
        <i style="color:red" class="fas fa-times-circle"></i>
    <?php endif; ?>
</p>

<!-- For Navigation -->
<p>
    
</p>

<!-- For TV -->
<p>
    <strong><i class="fas fa-tv"></i> TV: <?php echo $data['furtherBookingDetails']->tv ?></strong>
    <?php if ($data['furtherBookingDetails']->tv == 1): ?>
        <i style="color:green" class="fas fa-check-circle"></i>
    <?php else: ?>
        <i style="color:red" class="fas fa-times-circle"></i>
    <?php endif; ?>
    <strong><i class="fas fa-plug"></i> USB: <?php echo $data['furtherBookingDetails']->usb ?></strong>
    <?php if ($data['furtherBookingDetails']->usb == 1): ?>
        <i style="color:green" class="fas fa-check-circle"></i>
    <?php else: ?>
        <i style="color:red" class="fas fa-times-circle"></i>
    <?php endif; ?>
</p>

<!-- For USB -->
<p>
   
</p>



                            </div>
                        <?php elseif ($data['type'] == 5) : ?>
                            <div class="reservation-details">
                                <p><strong><i class="fas fa-user"></i> Name:</strong> <?php echo $data['serviceProvider']->fname ?></p>
                                <p><strong><i class="fas fa-tags"></i> Category:</strong> <?php echo $data['furtherBookingDetails']->category ?></p>
                                <p><strong><i class="fas fa-language"></i> Languages:</strong> <?php echo $data['furtherBookingDetails']->languages ?></p>
                                <p><strong><i class="fas fa-id-badge"></i> Guide Register Number:</strong> <?php echo $data['furtherBookingDetails']->GuideRegNumber ?></p>
                                <p><strong><i class="fas fa-calendar-alt"></i> Lisence Expiry Date:</strong> <?php echo $data['furtherBookingDetails']->LisenceExpDate ?></p>
                                <p><strong><i class="fas fa-map-marker-alt"></i> Sites:</strong> <?php echo $data['furtherBookingDetails']->sites ?></p>
                                <p style="margin-right:30px;"><strong><i class="fas fa-info-circle" ></i> About:</strong> <?php echo $data['furtherBookingDetails']->description ?></p>
                                </p>


                            </div>
                        <?php else : ?>
                            <p>No details available for this type.</p>
                        <?php endif; ?>
                    </div>


                    <!-- <div class="special-requests">
                        <p><strong>Special Requests:</strong> No special requests</p>
                    </div> -->
                    <div class="guest-info">
                        <p><strong><i class="fas fa-user"></i> Your Full Name: </strong><?php echo $data['user']->fname . " " . $data['user']->lname ?></p>
                        <p><strong><i class="fas fa-envelope"></i> Email Address:</strong> <?php echo $data['user']->email ?></p>
                        <p><strong><i class="fas fa-phone"></i> Phone Number:</strong> <?php echo $data['user']->number ?></p>

                        <?php if ($data['type'] == 4 || $data['type'] == 5) : ?>
                            <div class="reservation-details">
                                <p><strong><i class="far fa-calendar-alt"></i> Pick-up Date:</strong> <?php echo $data['checkinDate'] ?></p>
                                <p><strong><i class="far fa-calendar-alt"></i> Drop-off Date:</strong> <?php echo $data['checkoutDate'] ?></p>
                                <p><strong><i class="far fa-clock"></i> Pickup Time:</strong> <?php echo $data['pickupTime'] ?></p>

                            </div>

                        <?php elseif ($data['type'] == 3) : ?>
                            <div class="reservation-details">
                                <p><strong><i class="far fa-calendar-alt"></i> Check-in Date:</strong> <?php echo $data['checkinDate'] ?></p>
                                <p><strong><i class="far fa-calendar-alt"></i> Check-out Date:</strong> <?php echo $data['checkoutDate'] ?></p>
                            </div>

                        <?php else : ?>

                        <?php endif; ?>
                        <br>
                        <?php if ($data['type'] == 4) : ?>
                            <?php
                            $date1 = strtotime($data['checkinDate']);
                            $date2 = strtotime($data['checkoutDate']);
                            $diffTime = abs($date2 - $date1) + (60 * 60 * 24);
                            $daysD = ceil($diffTime / (60 * 60 * 24)); // Convert seconds to days
                            ?>

                            <div class="driver-selection">
                                <strong><i class="fas fa-user"></i> With Driver</strong>
                                <input type="checkbox" id="withDriver" name="withDriver" value="1" onclick="handleCheckboxClick('withDriver', '<?php echo htmlspecialchars($data['furtherBookingDetails']->vehicle_id, ENT_QUOTES, 'UTF-8') ?>', <?php echo $daysD; ?>)">
                                <label for="withDriver"></label>

                                <strong><i class="fas fa-user-slash"></i> Without Driver</strong>
                                <input type="checkbox" id="withoutDriver" name="withoutDriver" value="0" checked onclick="handleCheckboxClick('withoutDriver', '<?php echo htmlspecialchars($data['furtherBookingDetails']->vehicle_id, ENT_QUOTES, 'UTF-8') ?>', <?php echo $daysD; ?>)">
                                <label for="withoutDriver"></label>
                            </div>
                            <p id="totalPrice" data-initial-price="<?php echo htmlspecialchars($data['price'], ENT_QUOTES, 'UTF-8') ?>"><strong>Total : <?php echo htmlspecialchars($data['price'], ENT_QUOTES, 'UTF-8') ?> LKR</strong></p>


                            <script>
                                function updateFormAction(driverType, vehicleId, days, updatedPrice) {
                                    const form = document.getElementById('paymentForm');
                                    if (driverType === 'withDriver') {
                                        const driver = 1;
                                        // Construct the URL with updated price and set it as the form action
                                        form.action = '<?php echo URLROOT ?>loggedTraveler/dopaymentVehicles/' + '<?php echo $data['type'] . '/' . $data['furtherBookingDetails']->vehicle_id ?>' + '/' + '<?php echo $data['checkinDate'] . '/' . $data['checkoutDate'] . '/' . $data['pickupTime'] ?>' + '/' + updatedPrice + '/' + driver;
                                    } else {
                                        const driver = 0;
                                        // Use the initial price for withoutDriver and set it as the form action
                                        const initialPrice = parseFloat(document.getElementById('totalPrice').dataset.initialPrice);
                                        form.action = '<?php echo URLROOT ?>loggedTraveler/dopaymentVehicles/' + '<?php echo $data['type'] . '/' . $data['furtherBookingDetails']->vehicle_id ?>' + '/' + '<?php echo $data['checkinDate'] . '/' . $data['checkoutDate'] . '/' . $data['pickupTime'] ?>' + '/' + initialPrice + '/' + driver;
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


                            <!-- <form id="paymentForm" action="<?php echo URLROOT ?>loggedTraveler/dopaymentVehicles/<?php echo $data['type'] . '/' . $data['furtherBookingDetails']->vehicle_id . '/' . $data['checkinDate'] . '/' . $data['checkoutDate'] . '/' . $data['pickupTime'] . '/' . $data['price'] ?>/0" method="POST">
                                <div class="buttons">
                                    <button type="submit" class="payment-button">Make Payment</button>
                                </div>
                            </form> -->
                        <?php else : ?>
                            <?php

                            if ($data['type'] == 3) {
                                $date1 = strtotime($data['checkinDate']);
                                $date2 = strtotime($data['checkoutDate']);
                                $diffTime = abs($date2 - $date1);
                                $daysD = ceil($diffTime / (60 * 60 * 24)); // Convert seconds to days
                                $tot = $daysD * $data['furtherBookingDetails']->price;
                            } else if ($data['type'] == 5) {
                                $date1 = strtotime($data['checkinDate']);
                                $date2 = strtotime($data['checkoutDate']);
                                $diffTime = abs($date2 - $date1) + (60 * 60 * 24);
                                $daysD = ceil($diffTime / (60 * 60 * 24)); // Convert seconds to days
                                $tot = $daysD * $data['furtherBookingDetails']->pricePerDay;
                            }

                            ?>
                            <p><strong>Total : <?php echo $tot ?> LKR</strong></p>

                            <?php if ($data['type'] == 3) : ?>
                                <!-- <form action="<?php echo URLROOT ?>loggedTraveler/dopayment/<?php echo $data['furtherBookingDetails']->type . '/' . $data['furtherBookingDetails']->room_id . '/' . $data['checkinDate'] . '/' . $data['checkoutDate'] . '/' . $tot ?>">
                                    <div class="buttons">
                                        <button type="submit" class="payment-button">Make Payment</button>
                                    </div>
                                </form> -->
                            <?php elseif ($data['type'] == 5) : ?>
                                <!-- <form action="<?php echo URLROOT ?>loggedTraveler/dopaymentGuides/5/<?php echo $data['furtherBookingDetails']->user_id . '/' . $data['checkinDate'] . '/' . $data['checkoutDate'] . '/' . $tot . '/' . $data['pickupTime'] ?>">
                                    <div class="buttons">
                                        <button type="submit" class="payment-button">Make Payment</button>
                                    </div>
                                </form> -->
                            <?php endif; ?>
                        <?php endif; ?>



                    </div>

                </div>


            </div>

        </div>


    </div>
</body>

</html>