<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>TravelEase</title>
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT?>images/TravelEase_logo.png">
    <link rel="stylesheet" href="<?php echo URLROOT?>css/loggedTraveler/stylepa.css">
    <script src="./scriptpa.js"></script>
    <style>

    </style>
</head>
<body>
    
    <div class="navbar">
        <div class="logo">
            <img src="<?php echo URLROOT?>images/TravelEase_logo.png"alt="Logo">
            <label for="logoname">Travel<span style="color: #458A9E;">Ease</span> </label>
        </div>
        <ul>
            <li><a href="<?php echo URLROOT?>loggedTraveler/index">Home</a></li>
            <li><a href="<?php echo URLROOT?>loggedTraveler/hotel">Hotels</a></li>
            <li><a href="<?php echo URLROOT?>loggedTraveler/transport">Transport Providers</a></li>
            <li><a href="<?php echo URLROOT?>loggedTraveler/package" id="selected">Packages</a></li>
            <div class="rightcontent">
                <li><a href="<?php echo URLROOT?>travelerDashboard/index"><img src="<?php echo URLROOT?>/images/5.jpg" alt="Profile Picture"></a></li>
                <li><a href="<?php echo URLROOT?>users/logout" id="logout">Log Out</a></li>
                </div>
        </ul>
        </ul>
    </div>
    <section class="main1">
        <div class="main1img">
            <img src="<?php echo URLROOT?>images/6.1.jpg" alt="">
        </div>
        <div class="main1searchbar">
            <div class="search">
                <div class="search1"><input type="text" placeholder="Location: "></div>
                <div class="search2"> Date:<input type="date" placeholder="Check in Date"></div>
                <div class="search4"><button id="searchbtn" onclick="clickSearchPackage()">Search</button></div>
            </div>
        </div>
    </section>
    <section class="main2">
        <div class="main2buttons">
            <button id="but1">All</button>
            <button class="but2_3" id="mostPopularButton">Most Popular</button>
            <button class="but2_3" id="topRatedButton">Top-Rated</button>
        </div>
        <div class="main2images" id="div1">
            <div class="main2img1content">
                <div><img src="<?php echo URLROOT?>images/4.jpg" alt=""></div>
                <div class="c1"> 
                    <div>
                        <p style="font-size: 30px;margin:0px;font-weight:bold">Wildlife in Yala</p>
                        <p>Hambantota</p>
                    </div>
                    <div> <button>Book Now</button></div>
                </div>
                
            </div>
            <div class="main2img2content">
                <div><img src="<?php echo URLROOT?>images/4.jpg" alt=""></div>
                <div class="c2">
                    <div>
                        <p style="font-size: 30px;margin:0px;font-weight:bold">Wildlife in Yala</p>
                        <p>Hambantota</p>
                    </div>
                    <div><button>Book Now</button></div>
                </div>
            </div>
            <div class="main2img3content">
                <div><img src="<?php echo URLROOT?>images/4.jpg" alt=""></div>
                <div class="c3">
                    <div>
                        <p style="font-size: 30px;margin:0px;font-weight:bold">Wildlife in Yala</p>
                        <p>Hambantota</p>
                    </div>
                    <div><button>Book Now</button></div>
                </div>
            </div>
        </div>
        <div class="main2images" id="div2">
            <div class="main2img1content">
                <div><img src="<?php echo URLROOT?>images/4.jpg" alt=""></div>
                <div class="c1"> 
                    <div>
                        <p style="font-size: 30px;margin:0px;font-weight:bold">Wildlife in Yala</p>
                        <p>Hambantota</p>
                    </div>
                    <div> <button>Book Now</button></div>
                </div>
                
            </div>
            <div class="main2img2content">
                <div><img src="<?php echo URLROOT?>images/4.jpg" alt=""></div>
                <div class="c2">
                    <div>
                        <p style="font-size: 30px;margin:0px;font-weight:bold">Wildlife in Yala</p>
                        <p>Hambantota</p>
                    </div>
                    <div><button>Book Now</button></div>
                </div>
            </div>
            <div class="main2img3content">
                <div><img src="<?php echo URLROOT?>images/4.jpg" alt=""></div>
                <div class="c3">
                    <div>
                        <p style="font-size: 30px;margin:0px;font-weight:bold">Wildlife in Yala</p>
                        <p>Hambantota</p>
                    </div>
                    <div><button>Book Now</button></div>
                </div>
            </div>
        </div>
    </section>
    <section class="main4">
        <div class="main4img">
            <img src="<?php echo URLROOT?>images/5.jpg" alt="">
            <div class="shade">
                <p>Is Your Service Ready to Shine?</p>
                <button>Register</button>
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