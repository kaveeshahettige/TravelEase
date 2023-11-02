<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>TraveleEase Landpage</title>
    <link rel="icon" type="image/x-icon" href="../landpage/assets/TravelEase_logo.png">
    <link rel="stylesheet" href="<?php echo URLROOT?>css/loggedTraveler/booking.css">
    <script src="./script.js"></script>
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
            <li><a href="<?php echo URLROOT?>loggedTraveler/hotel" id="selected">Hotels</a></li>
            <li><a href="<?php echo URLROOT?>loggedTraveler/transport">Transport Providers</a></li>
            <li><a href="<?php echo URLROOT?>loggedTraveler/package">Packages</a></li>
            <div class="rightcontent">
                <li><a href="<?php echo URLROOT?>travelerDashboard/index"><img src="<?php echo URLROOT?>/images/5.jpg" alt="Profile Picture"></a></li>
                <li><a href="<?php echo URLROOT?>users/logout" id="logout">Log Out</a></li>
                </div>
        </ul>
    </div>

    <section class="bookingResultm1">
        <div class="view">
            <div class="bookingtitles"><h1>Wildlife in Yala</h1>
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
                <p>Our comprehensive package offers a hassle-free experience for your three-day adventure in the park.
                     You can relax and enjoy your trip knowing that it includes all the essential facilities you need.
                      From comfortable accommodations to delightful dining options,
                       experienced guides, and efficient transport, we've got you covered.
                        Explore every corner of the park with confidence, as our package ensures you have access to all areas, making your journey truly unforgettable</p> 
            </div> 
            <div class="bookingdetails">
                <div class="leftdiv">
                    <div class="ldiv1">
                        <div class="booking-label">Booking:</div>
                        <div class="booking-value">Wildlife in Yala</div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">District:</div>
                        <div class="booking-value">Hambantota</div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Start date:</div>
                        <div class="booking-value">10/3/2023</div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">End date:</div>
                        <div class="booking-value">10/6/2023</div>
                    </div> 
                </div>

                <div class="rightdiv">
                    <div class="ldiv1">
                        <div class="booking-label">Price:</div>
                        <div class="booking-value">50 000 Rupees</div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Service provider:</div>
                        <div class="booking-value">Yala Residencies</div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Contact details :</div>
                        <div class="booking-value">0766244356</div>
                    </div>
                    <div class="ldiv1">
                        <div class="booking-label">Cancellation eligibility:</div>
                        <div class="booking-value">Available</div>
                    </div> 
                </div>

            </div>
            <div class="delbuttonContain">
                <div class="emergencydata">In Emergency: 0766245650 | 0112781867</div>
                <div><button id="delbutton">Delete Trip</button></div>
                
            </div>
        </div>
    </section>
    
    
  
</body>
</html>



    