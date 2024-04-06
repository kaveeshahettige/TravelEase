<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>TraveleEase</title>
    <link rel="icon" type="image/x-icon" href="../landpage/assets/TravelEase_logo.png">
    <link rel="stylesheet" href="<?php echo URLROOT?>css/loggedTraveler/booking.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <script src="<?php echo URLROOT?>js/loggedTraveler/script.js"></script>
    <style>

    </style>
</head>
<body>
    
    <!-- <div class="navbar">
        <div class="logo">
            <img src="<?php echo URLROOT?>/images/TravelEase_logo.png" alt="Logo">
            <label for="logoname">Travel<span style="color: #458A9E;">Ease</span> </label>
        </div>
        <ul>
        <li><a href="<?php echo URLROOT?>loggedTraveler/index">Home</a></li>
            <li><a href="<?php echo URLROOT?>loggedTraveler/hotel">Hotels</a></li>
            <li><a href="<?php echo URLROOT?>loggedTraveler/transport">Transport Providers</a></li>
            <li><a href="<?php echo URLROOT?>loggedTraveler/package">Packages</a></li>
            <div class="rightcontent">
            <li><a href="<?php echo URLROOT?>travelerDashboard/index"><img src="<?php echo empty($data['profile_picture']) ? URLROOT.'images/user.jpg' : URLROOT.'images1/'.$data['profile_picture']; ?>" alt="Profile Picture" alt="User Profile Photo"> </a></li>
                <li><a href="<?php echo URLROOT?>users/logout" id="logout">Log Out</a></li>
                </div>
        </ul>
    </div> -->
    <!-- <?php echo var_dump($data['booking'])?> -->
    <!-- <?php echo $data['type']?> -->
    <section class="bookingResultm1">
    
        <?php if ($data['type']==3): ?>
        <div class="view">
            <div class="bookingtitles"><h1><?php echo ucfirst($data['serviceProviderName']) ?></h1>
            
                <h5>Booking details</h5>
            </div>
            <div class="images">
                <div class="mainimage">
                <img src="<?php echo URLROOT . '/images/' . $data['furtherBookingDetails']->image; ?>" alt="">

                </div>
                <!-- <div class="submimages">
                    <div><img src="<?php echo URLROOT . '/images/' . $data['furtherBookingDetails']->image; ?>" alt=""></div>
                    <div><img src="<?php echo URLROOT . '/images/' . $data['furtherBookingDetails']->image; ?>" alt=""></div>
                </div>
                <div class="submimages">
                    <div><img src="<?php echo URLROOT . '/images/' . $data['furtherBookingDetails']->image; ?>" alt=""></div>
                    <div><img src="<?php echo URLROOT . '/images/' . $data['furtherBookingDetails']->image; ?>" alt=""></div>
                </div> -->

            </div>
           
            <div class="des">
                <h5 style="margin: 0px;">Description</h5>
                <p><?php echo $data['mainbookingDetails']->description?></p> 
            </div> 
            <div class="bookingdetails">
                <div class="leftdiv">
                    <div class="ldiv1">
                        <div class="booking-label">Hotel name:</div>
                        <div class="booking-value"><?php echo ucfirst($data['serviceProviderName']) ?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Hotel type:</div>
                        <div class="booking-value"><?php echo $data['mainbookingDetails']->hotel_type?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Address:</div>
                        <div class="booking-value"><?php echo $data['mainbookingDetails']->add?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">City:</div>
                        <div class="booking-value"><?php echo $data['mainbookingDetails']->city?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Room type:</div>
                        <div class="booking-value"><?php echo $data['furtherBookingDetails']->roomType?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Room detail:</div>
                        <div class="booking-value"><?php echo $data['furtherBookingDetails']->description?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">A/C Availablility:</div>
                        <div class="booking-value"><?php echo $data['furtherBookingDetails']->acAvailability?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">TV Availablility:</div>
                        <div class="booking-value"><?php echo $data['furtherBookingDetails']->tvAvailability?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Wifi Availablility:</div>
                        <div class="booking-value"><?php echo $data['furtherBookingDetails']->wifiAvailability?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Smoking policy:</div>
                        <div class="booking-value"><?php echo $data['furtherBookingDetails']->smokingPolicy?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Pet policy:</div>
                        <div class="booking-value"><?php echo $data['furtherBookingDetails']->petPolicy?></div>
                    </div>
                    
                </div>

                <div class="rightdiv">
                    <div class="ldiv1">
                        <div class="booking-label">Price:</div>
                        <div class="booking-value"><?php echo $data['furtherBookingDetails']->price?> &nbsp SLR</div>
                    </div>
                     
                    <div class="ldiv1">
                        <div class="booking-label">Contact number :</div>
                        <div class="booking-value"><?php echo $data['number']?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">web Site:</div>
                        <div class="booking-value"><?php echo $data['mainbookingDetails']->website?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Twitter :</div>
                        <div class="booking-value"><?php echo $data['mainbookingDetails']->twitter?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Instargram :</div>
                        <div class="booking-value"><?php echo $data['mainbookingDetails']->instagram?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Start date:</div>
                        <div class="booking-value"><?php echo $data['booking']->startDate?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">End date:</div>
                        <div class="booking-value"><?php echo $data['booking']->endDate?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Cancellation eligibility:</div>
                        <div class="booking-value"><?php echo  $data['cancellationEligibility']?></div>
                    </div> 
                </div>

        </div>
        <?php elseif ($data['type']==4): ?>
            <div class="view">
            <div class="bookingtitles"><h1><?php echo ucfirst($data['serviceProviderName']) ?></h1>
            
                <h5>Booking details</h5>
            </div>
            <div class="images">
                <div class="mainimage">
                <img src="<?php echo URLROOT . '/images/' . $data['furtherBookingDetails']->image; ?>" alt="">

                </div>
                <!-- <div class="submimages">
                    <div><img src="<?php echo URLROOT . '/images/' . $element['furtherBookingDetails']['image']; ?>" alt=""></div>
                    <div><img src="<?php echo URLROOT . '/images/' . $element['furtherBookingDetails']['image']; ?>" alt=""></div>
                </div>
                <div class="submimages">
                    <div><img src="<?php echo URLROOT . '/images/' . $element['furtherBookingDetails']['image']; ?>" alt=""></div>
                    <div><img src="<?php echo URLROOT . '/images/' . $element['furtherBookingDetails']['image']; ?>" alt=""></div>
                </div> -->

            </div>
            <div class="des">
                <h5 style="margin: 0px;">Description</h5>
                <p><?php echo $data['mainbookingDetails']->description?></p> 
            </div> 
            <div class="bookingdetails">
                <div class="leftdiv">
                    <div class="ldiv1">
                        <div class="booking-label">Hotel name:</div>
                        <div class="booking-value"><?php echo ucfirst($data['serviceProviderName']) ?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Agency Registered Number:</div>
                        <div class="booking-value"><?php echo $data['mainbookingDetails']->reg_number?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Address:</div>
                        <div class="booking-value"><?php echo $data['mainbookingDetails']->address?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">City:</div>
                        <div class="booking-value"><?php echo $data['mainbookingDetails']->city?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Vehicle Brand:</div>
                        <div class="booking-value"><?php echo $data['furtherBookingDetails']->brand?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Vehicle Model:</div>
                        <div class="booking-value"><?php echo $data['furtherBookingDetails']->model?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Plate Number:</div>
                        <div class="booking-value"><?php echo $data['furtherBookingDetails']->plate_number?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Year:</div>
                        <div class="booking-value"><?php echo $data['furtherBookingDetails']->year?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Price per day:</div>
                        <div class="booking-value"><?php echo $data['furtherBookingDetails']->priceperday?>&nbsp SLR</div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Seating capacity:</div>
                        <div class="booking-value"><?php echo $data['furtherBookingDetails']->seating_capacity?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Air condition:</div>
                        <div class="booking-value">
                        <?php if ($data['furtherBookingDetails']->ac_type == 1): ?>
                            <?php echo "Available"; ?>
                            <?php else: ?>
                            <?php echo "Not available"; ?>
                            <?php endif; ?>
                        </div>

                    </div>
                    
                </div>
                
                <div class="rightdiv">
                    <div class="ldiv1">
                        <div class="booking-label">Price:</div>
                        <div class="booking-value">
                            <?php echo $data['vehicleprice']->amount?> &nbsp SLR</div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Driver:</div>
                        <div class="booking-value"><?php if ($data['driver']->withDriver== 1): ?>
                            <?php echo "With"; ?>
                            <?php else: ?>
                            <?php echo "Without"; ?>
                            <?php endif; ?>&nbspDriver</div>
                    </div>
                     
                    <div class="ldiv1">
                        <div class="booking-label">Contact number :</div>
                        <div class="booking-value"><?php echo $data['number']?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">web Site:</div>
                        <div class="booking-value"><?php echo $data['mainbookingDetails']->website?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Twitter :</div>
                        <div class="booking-value"><?php echo $data['mainbookingDetails']->twitter?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Instargram :</div>
                        <div class="booking-value"><?php echo $data['mainbookingDetails']->instagram?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Start date:</div>
                        <div class="booking-value"><?php echo $data['booking']->startDate?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">End date:</div>
                        <div class="booking-value"><?php echo $data['booking']->endDate?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Cancellation eligibility:</div>
                        <div class="booking-value"><?php echo  $data['cancellationEligibility']?></div>
                    </div> 
                </div>

        </div>
        
        <?php elseif ($data['type']==5): ?>
        <div class="view">
            <div class="bookingtitles"><h1><?php echo ucfirst($data['serviceProviderName']) ?></h1>
            
                <h5>Booking details</h5>
            </div>
            <div class="images">
                <div class="mainimage">
                <img src="<?php echo URLROOT . '/images/' . $element['furtherBookingDetails']['image']; ?>" alt="">

                </div>
                <div class="submimages">
                    <div><img src="<?php echo URLROOT . '/images/' . $element['furtherBookingDetails']['image']; ?>" alt=""></div>
                    <div><img src="<?php echo URLROOT . '/images/' . $element['furtherBookingDetails']['image']; ?>" alt=""></div>
                </div>
                <div class="submimages">
                    <div><img src="<?php echo URLROOT . '/images/' . $element['furtherBookingDetails']['image']; ?>" alt=""></div>
                    <div><img src="<?php echo URLROOT . '/images/' . $element['furtherBookingDetails']['image']; ?>" alt=""></div>
                </div>

            </div>
            <div class="des">
                <h5 style="margin: 0px;">Description</h5>
                <p><?php echo $data['mainbookingDetails']->description?></p> 
            </div> 
            <div class="bookingdetails">
                <div class="leftdiv">
                    <div class="ldiv1">
                        <div class="booking-label">Hotel name:</div>
                        <div class="booking-value"><?php echo ucfirst($data['serviceProviderName']) ?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Hotel type:</div>
                        <div class="booking-value"><?php echo $data['mainbookingDetails']->hotel_type?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Address:</div>
                        <div class="booking-value"><?php echo $element['mainbookingDetails']->add?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">City:</div>
                        <div class="booking-value"><?php echo $element['mainbookingDetails']->city?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Room type:</div>
                        <div class="booking-value"><?php echo $element['furtherBookingDetails']['roomType']?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Room detail:</div>
                        <div class="booking-value"><?php echo $element['furtherBookingDetails']['description']?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">A/C Availablility:</div>
                        <div class="booking-value"><?php echo $element['furtherBookingDetails']['acAvailability']?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">TV Availablility:</div>
                        <div class="booking-value"><?php echo $element['furtherBookingDetails']['tvAvailability']?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Wifi Availablility:</div>
                        <div class="booking-value"><?php echo $element['furtherBookingDetails']['wifiAvailability']?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Smoking policy:</div>
                        <div class="booking-value"><?php echo $element['furtherBookingDetails']['smokingPolicy']?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Pet policy:</div>
                        <div class="booking-value"><?php echo $element['furtherBookingDetails']['petPolicy']?></div>
                    </div>
                    
                </div>

                <div class="rightdiv">
                    <div class="ldiv1">
                        <div class="booking-label">Price:</div>
                        <div class="booking-value"><?php echo $data['furtherbookingDetails']->price?> &nbsp SLR</div>
                    </div>
                     
                    <div class="ldiv1">
                        <div class="booking-label">Contact number :</div>
                        <div class="booking-value"><?php echo $data['number']?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">web Site:</div>
                        <div class="booking-value"><?php echo $data['mainbookingDetails']->website?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Twitter :</div>
                        <div class="booking-value"><?php echo $data['mainbookingDetails']->twitter?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Instargram :</div>
                        <div class="booking-value"><?php echo $data['mainbookingDetails']->instagram?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Start date:</div>
                        <div class="booking-value"><?php echo $data['start_date']?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">End date:</div>
                        <div class="booking-value"><?php echo $data['end_date']?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Cancellation eligibility:</div>
                        <div class="booking-value"><?php echo $data['cancellationEligiblity']?></div>
                    </div> 
                </div>

        </div>
        <?php endif; ?>
        

        
        
            
        <!-- <?php if ($data['type'] == 3): ?>
            <div class="delbuttonContain">
                <div class="emergencydata">In Emergency: <?php echo $data['mainbookingDetails']->manager_phone_number." - ". $data['mainbookingDetails']->manager_name?></div>
                
    <div> -->
    
<?php endif; ?>
<?php if ($data['type'] == 4): ?>
            <div class="delbuttonContain">
                <div class="emergencydata">In Emergency: <?php echo $data['number']?></div>
                
    <div>
    
<?php endif; ?>
<!-- <?php if ($data['cancellationEligibility'] == "Available"): ?>
    <button id="delbutton" onclick="deleteBooking('<?php echo $data['booking']->booking_id; ?>')">Cancel Trip</button>
    </div>
<?php endif; ?> -->

                
            </div>
        </div>
    </section>
    
    
  
</body>
</html>



    