<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>TravelEase</title>
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT?>images/TravelEase_logo.png">
    <link rel="stylesheet" href="<?php echo URLROOT?>css/loggedTraveler/stylepa.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="<?php echo URLROOT?>/js/loggedTraveler/script.js"></script>
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
            <li><a href="<?php echo URLROOT ?>travelerDashboard/index/<?php echo $_SESSION['user_id'] ?>"><img src="<?php echo empty($data['profile_picture']) ? URLROOT.'images/user.jpg' : URLROOT.'images1/'.$data['profile_picture']; ?>" alt="Profile Picture" alt="User Profile Photo"> </a></li>
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
    
    <section class="main2" id="S1">
    <div class="main2buttons">
        <button id="but1">All</button>
        <button class="but2_3" id="mostPopularButton">Most Popular</button>
        <button class="but2_3" id="topRatedButton">Top-Rated</button>
    </div>

    <?php if (!empty($data['packages']) && is_array($data['packages'])): ?>
        <div class="main2images" id="div1">
    <?php foreach ($data['packages'] as $package): ?>
        <div class="main2img1content">
            <div class="image-container">
                <img src="<?php echo URLROOT ?>images/<?php echo $package->image; ?>" alt="">
            </div>
            <div class="c1">
                <div>
                    <p style="font-size: 30px;margin:0px;font-weight:bold"><?php echo $package->fname; ?></p>
                    <p><?php echo $package->city ?></p>
                </div>
                <div><button onclick="Tripdetails(<?= $package->user_id?>)">View</button></div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

    <?php elseif (empty($data['packages'])): ?>
        <p>No Guides available.</p>
    <?php else: ?>
        <p>Error retrieving guide data.</p>
    <?php endif; ?>
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