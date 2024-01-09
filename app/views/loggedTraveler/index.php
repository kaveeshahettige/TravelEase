<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>TravelEase</title>
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT?>/images/TravelEase_logo.png">
    <link rel="stylesheet" href="<?php echo URLROOT?>css/loggedTraveler/style.css">
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
            <li><a href="<?php echo URLROOT?>loggedTraveler/index" id="selected">Home</a></li>
            <li><a href="<?php echo URLROOT?>loggedTraveler/hotel">Hotels</a></li>
            <li><a href="<?php echo URLROOT?>loggedTraveler/transport">Transport Providers</a></li>
            <li><a href="<?php echo URLROOT?>loggedTraveler/package">Packages</a></li>
            <div class="rightcontent">
            <li><a href="<?php echo URLROOT?>travelerDashboard/index"><img src="<?php echo empty($data['profile_picture']) ? URLROOT.'images/user.jpg' : URLROOT.'images1/'.$data['profile_picture']; ?>" alt="Profile Picture" alt="User Profile Photo"> </a></li>
            <li><a href="<?php echo URLROOT?>users/logout" id="logout">Log Out</a></li>
            </div>
        </ul>
    </div>
    <section class="main1">
        <div class="main1img">
            <img src="<?php echo URLROOT?>/images/1.jpg" alt="">
            <div class="onimagetext">
                <p id="txt1">Embrace the Wonders of Sri Lanka with Travelease</p>
                <p id="txt2">Discover, Indulge, and Create Memories. Your Adventure Awaits.</p>
            </div>
        </div>
        <div class="main1searchbar" >
            <div class="search">
               
                <div class="search1"><input type="text" placeholder="Location: "></div>
                <div class="search2">Check in Date:<input type="date" placeholder="Check in Date"></div>
                <div class="search3">Check out Date:<input type="date" placeholder="Check out Date"></div>
                <div class="search4"><button id="searchbtn" onclick="SearchAll()">  Search</button></div>
            </div>
        </div>
    </section>
    <section class="main2">
        <div class="topbar">
        <?php if (!empty($data['serviceProviderName']) && !empty($data['location'])): ?>
            <span id="upcoming">Upcoming Trips</span>
            <?php endif; ?>
            <button id="plantrip">Plan New Trip</button>
        </div>
        <div class="main2trip">
    <?php if (!empty($data['serviceProviderName']) && !empty($data['location'])): ?>
        <div class="main2img1content">
            <div><img src="<?php echo URLROOT ?>images/<?php echo $data['picture'] ?>" alt=""></div>
            <div class="c1"> 
                <div>
                    <p style="font-size: 30px; margin: 0; font-weight: bold;"><?php echo $data['serviceProviderName'] ?></p>
                    <p><?php echo $data['location'] ?></p>
                </div>
                <div> <button id="viewbooking" onclick="viewBooking(<?php echo $data['serviceProviderID']; ?>)">View</button></div>
            </div>
        </div>
    <!--  <?//php else: ?> 
        <p>No upcoming trips</p> -->
    <?php endif; ?>
</div>

           
        </div>
    </section>
    <section class="main3">
        <div class="main3heading">
            <p>Explore Your Favorite Destinations</p>
        </div>
        <div class="main3images">
            <div class="main3img1content">
                <div><img src="<?php echo URLROOT?>images/car 7.jpg" alt=""></div>
                <div class="c1"> 
                    <div>
                        <p style="font-size: 30px;margin:0px;font-weight:bold"><?php echo $data['randomServiceProvider1Name']?></p>
                        <p><?php echo $data['randomServiceProvider1Location']?></p>
                    </div>
                    <div> <button id="bookingButton" onclick="Tripdetails()">Book Now</button></div>
                </div>
                
            </div>
            <div class="main3img2content">
                <div><img src="<?php echo URLROOT?>images/car 5.jpg" alt=""></div>
                <div class="c2">
                    <div>
                        <p style="font-size: 30px;margin:0px;font-weight:bold"><?php echo $data['randomServiceProvider2Name']?></p>
                        <p><?php echo $data['randomServiceProvider2Location']?></p>
                    </div>
                    <div><button>Book Now</button></div>
                </div>
            </div>
            <div class="main3img3content">
                <div><img src="<?php echo URLROOT?>images/4.jpg" alt=""></div>
                <div class="c3">
                    <div>
                        <p style="font-size: 30px;margin:0px;font-weight:bold"><?php echo $data['randomServiceProvider3Name']?></p>
                        <p><?php echo $data['randomServiceProvider3Location']?></p>
                    </div>
                    <div><button>Book Now</button></div>
                </div>
            </div>
        </div>
        <div class="footer">
            
                <div class="contact-info">
                    
                    <p>Phone: 011 456-7890</p>
                    <p>Email: travelEase@gmail.com</p>
                </div>
                <div class="social-links">
                    <a href="#" target="_blank"><i class="fab fa-facebook"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-linkedin"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                </div>
                <br><br>
                <div class="site-links">
                    <a href="<?php echo URLROOT?>loggedTraveler/index">Home</a> |
                    <a href="">About Us</a> |
                    <a href="<?php echo URLROOT?>Landpage/termsofuse" target="_blank">Terms of Use</a> | 
                    <a href="">Contact</a>
                </div>
            
            <div class="copyright">
                &copy; 2023 Your Company Name. All rights reserved.
            </div>
            
        </div>

    </section>
  
</body>
</html>



    