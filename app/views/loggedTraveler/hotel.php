<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>TravelEase</title>
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT?>/images/TravelEase_logo.png">
    <link rel="stylesheet" href="<?php echo URLROOT?>css/loggedTraveler/styleh.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="<?php echo URLROOT?>/js/loggedTraveler/script.js"></script>
    <style>

    </style>
</head>
<body>
 <!-- ggg    -->
 <!-- jhh -->
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
            <li><a href="<?php echo URLROOT ?>travelerDashboard/index/<?php echo $_SESSION['user_id'] ?>"><img src="<?php echo empty($data['profile_picture']) ? URLROOT.'images/user.jpg' : URLROOT.'images1/'.$data['profile_picture']; ?>" alt="Profile Picture" alt="User Profile Photo"> </a></li>
                <li><a href="<?php echo URLROOT?>users/logout" id="logout">Log Out</a></li>
                </div>
        </ul>
    </div>
    <section class="main1">
        <div class="main1img">
            <img src="<?php echo URLROOT?>/images/7.1.jpg" alt="">
        </div>
        <div class="main1searchbar">
    <form action="<?php echo URLROOT ?>loggedTraveler/searchHotels" method="POST">
        <div class="search">
        <div class="search1">
    <input type="text" name="location" id="locationInput" placeholder=" <?php echo isset($data['location']) ? $data['location'] : 'Location:'; ?>">
        </div>

            <div class="search4"><button type="submit" id="searchbtn">Search</button></div>
        </div>
    </form>
</div>

<!-- <?php 
// echo var_dump($data['hotels']);
$hotel_chunks = array_chunk($data['hotels'], 3);
?> -->
    </section>
    <section class="main2" id="S1">
    <div class="main2buttons">
        <button id="but1">All</button>
        <button class="but2_3" id="mostPopularButton">Most Popular</button>
        <button class="but2_3" id="topRatedButton">Top-Rated</button>
    </div>

    <?php if (!empty($data['hotels']) && is_array($data['hotels'])): ?>
        <div class="main2images" id="div1">
            <?php foreach ($data['hotels'] as $hotel): ?>
                <div class="main2img1content">
                    <div><img src="<?php echo URLROOT ?>images/<?php echo $hotel->profile_picture; ?>" alt=""></div>
                    <div class="c1">
                        <div>
                            <p style="font-size: 30px;margin:0px;font-weight:bold"><?php echo $hotel->fname; ?></p>
                            <p><?php echo $hotel->city ?></p>
                        </div>
                        <div><button onclick="Tripdetails(<?= $hotel->user_id?>)">View</button></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php elseif (empty($data['hotels'])): ?>
        <p>No hotels available.</p>
    <?php else: ?>
        <p>Error retrieving hotel data.</p>
    <?php endif; ?>
</section>
<script>
        // JavaScript code to scroll to section with ID "S1"
        window.onload = function() {
            // Check if the current URL matches the desired URL
            if (window.location.href === 'http://localhost/TravelEase/loggedTraveler/searchHotels') {
                // Scroll to the section with ID "S1"
                document.getElementById('locationInput').scrollIntoView();
            }
        };
    </script>



    <section class="main4">
        <div class="main4img">
            <img src="<?php echo URLROOT?>images/5.jpg" alt="">
            <div class="shade">
                <p>Is Your Hotel Ready to Shine?</p>
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