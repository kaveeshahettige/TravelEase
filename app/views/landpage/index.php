<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>TraveleEase</title>
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT?>/images/TravelEase_logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/landpage/style.css">
    <script src="<?php echo URLROOT?>/js/landpage/index.js"></script>
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
            <li><a href="<?php echo URLROOT?>Landpage/index" id="selected">Home</a></li>
            <li><a href="<?php echo URLROOT?>Landpage/hotel">Hotels</a></li>
            <li><a href="<?php echo URLROOT?>Landpage/transport">Transport Providers</a></li>
            <li><a href="<?php echo URLROOT?>Landpage/package">Packages</a></li>
            <div class="buttons">
            <li><a href="<?php echo URLROOT?>Users/login" id="loginbut">Login</a></li>
            
            </div>
        </ul>
    </div>
    <section class="main1">
        <div class="grid1" >
            <div class="paragraph1" >
                <div><p id="text1"><br>Explore the <br>World with Ease</p></div>
                <div id="para1div2"><p id="text3">Your All-in-One Travel Companion</p></div>
                <div><button id="planbutton" onclick=StartPlan()>Plan a Trip</button></div>
            </div>
            <div class="image1">
                <div class="circle"></div>
                <img src="<?php echo URLROOT?>/images/1.png" alt="image" width="100%" height="100%">
            </div>
        </div>
        <form action="<?php echo URLROOT?>Landpage/searchPage" method="GET">
        <div class="searchbar1">
            <input type="text" class="search-input" name="location" placeholder="Place you want to go..." required>
            <button type="submit" class="search-button">Search</button>
        </div>
        </form>
        <br>
    </section>
    <section class="main2">
        <div class="image2">
            <img src="<?php echo URLROOT?>/images/2.png" alt="image2">
        </div>
        <div class="main2-content">
            <div class="heading">
                <p class="head1">Why Choose Us</p>
                <p class="head2">Discover the Travelease Difference</p>
            </div>
            <div class="detail">
                <div class="detailL">
                    <div><img src="<?php echo URLROOT?>/images/allinone.png" alt=""></div>
                    <div><img src="<?php echo URLROOT?>/images/travel.png" alt=""></div>
                    <div><img src="<?php echo URLROOT?>/images/coin.png" alt=""></div>
                </div>
                <div class="detailR">
                    <div class="p1">
                        <h1>Everything in One Place</h1>
                        <p>Find accommodations, transportation and guides all on our platform.</p>
                    </div>
                    <div class="p2">
                        <h1>Travel Your Way</h1>
                        <p>Create trips that match your preferences and interests.</p>
                    </div>
                    <div class="p3">
                        <h1>Pay with Ease</h1>
                        <p>Book and pay for services securely on our site.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="main3">
        <div class="main3heading">
            <p>Explore Your Favorite Destinations</p>
        </div>
        <div class="main3images">
            <div class="main3img1content">
                <div><img src="<?php echo URLROOT?>/images/4.jpg" alt=""></div>
                <div class="c1"> 
                    <div>
                        <p style="font-size: 30px;margin:0px;font-weight:bold">Wildlife in Yala</p>
                        <p>Hambantota</p>
                    </div>
                    <div><button id="bookNowButton">Book Now</button></div>
                </div>
                
            </div>
            <div class="main3img2content">
                <div><img src="<?php echo URLROOT?>/images/jaffna.jpg" alt=""></div>
                <div class="c2">
                    <div>
                        <p style="font-size: 30px;margin:0px;font-weight:bold">Wonder of Jaffna</p>
                        <p>Jaffna</p>
                    </div>
                    <div><button id="bookNowButton1">Book Now</button></div>
                </div>
            </div>
            <div class="main3img3content">
                <div><img src="<?php echo URLROOT?>/images/nuwaraeliya.jpg" alt=""></div>
                <div class="c3">
                    <div>
                        <p style="font-size: 30px;margin:0px;font-weight:bold">Nuwara Eliya</p>
                        <p>Nuwara Eliya</p>
                    </div>
                    <div><button id="bookNowButton2">Book Now</button></div>
                </div>
            </div>
        </div>

    </section>
    <section class="main4">
        <div class="main4img">
            <img src="<?php echo URLROOT?>/images/5.jpg" alt="">
            <div class="shade">
                <p>Let's Plan your Trip !</p>
                <button id="startPlanning" onclick=StartPlan()>Start Planning</button>
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
            <div class="site-links">
                <a href="<?php echo URLROOT?>Landpage">Home</a> |
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



    