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
        <div class="view">
            <div class="bookingtitles"><h1><?php echo ucfirst($data['serviceProviderName'])?></h1>
                <h5>Booking details</h5>
            </div>
            <div class="images">
                <div class="mainimage">
                    <img src="<?php echo URLROOT?>/images/4.jpg" alt="">
                </div>
                <div class="submimages">
                    <div><img src="<?php echo URLROOT?>/images/yala2.jpg" alt=""></div>
                    <div><img src="<?php echo URLROOT?>/images/yala3.jpg" alt=""></div>
                </div>
                <div class="submimages">
                    <div><img src="<?php echo URLROOT?>/images/yala4.jpg" alt=""></div>
                    <div><img src="<?php echo URLROOT?>/images/yala5.jpg" alt=""></div>
                </div>

            </div>
            <div class="des">
                <h5 style="margin: 0px;">Description</h5>
                <p><?php echo $data['description'] ? ucfirst($data['description']) : '-----'; ?></p> 
            </div> 
            <div class="bookingdetails">
                <div class="leftdiv">
                    <!-- <div class="ldiv1">
                        <div class="booking-label">Booking:</div>
                        <div class="booking-value"><?php echo ucfirst($data['serviceProviderName'])?></div>
                    </div> -->
                    <div class="ldiv1">
                        <div class="booking-label">Service provider:</div>
                        <div class="booking-value"><?php echo ucfirst($data['serviceProviderName'])?></div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">District:</div>
                        <div class="booking-value"><?php echo ucfirst($data['location'])?></div>
                    </div>
                    
                    <!-- <div class="ldiv1">
                        <div class="booking-label">Cancellation eligibility:</div>
                        <div class="booking-value">Available</div>
                    </div>  -->
                </div>

                <div class="rightdiv">
                    <div class="ldiv1">
                        <div class="booking-label">Price:</div>
                        <div class="booking-value">50 000 Rupees(...)</div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Contact details :</div>
                        <div class="booking-value"><?php echo $data['serviceProvideNumber']?></div>
                    </div>
                    <!-- <div class="ldiv1">
                        <div class="booking-label">Start date:</div>
                        <div class="booking-value">10/3/2023</div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">End date:</div>
                        <div class="booking-value">10/6/2023</div>
                    </div>  -->
                </div>

            </div>
            <div class="delbuttonContain">
                
                <div><button id="delbutton" onclick="booking()">Book Now</button></div>
                
            </div>
        </div>
    </section>
    
    
  
</body>
</html>



    