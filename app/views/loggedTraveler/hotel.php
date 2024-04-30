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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-y4jl5lAxu7c0J0pQv4KzoUW0ojrYwMq2/wn7E5tlUCVgQFm/hhtIkV6uUavvB8sW" crossorigin="anonymous">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTDElEffBAws-JYjYaUELqmkOCpa6C5R8&libraries=places"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.2/css/boxicons.min.css">

    <style>
        /* Style for the suggestions dropdown */
        .pac-container {
            background-color: #FFF;
            z-index: 1000;
            position: fixed;
            display: inline-block;
            float: left;
        }
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
            <li><a href="<?php echo URLROOT?>loggedTraveler/package">Guides</a></li>
            <div class="rightcontent">
            <li><a href="<?php echo URLROOT ?>travelerDashboard/cart/<?php echo $_SESSION['user_id'] ?>"><i class='bx bxs-cart bx-lg bx-tada bx-rotate-90' ></i></a></li>
            <li><a href="<?php echo URLROOT ?>travelerDashboard/index/<?php echo $_SESSION['user_id'] ?>"><img src="<?php echo empty($data['profile_picture']) ? URLROOT.'images/user.jpg' : URLROOT.'images1/'.$data['profile_picture']; ?>" alt="Profile Picture" alt="User Profile Photo"> </a></li>
                <li><a href="<?php echo URLROOT?>users/logout" id="logout">Log Out</a></li>
                </div>
        </ul>
    </div>
    <section class="main1">
        <div class="main1img" >
            <img src="<?php echo URLROOT?>/images/7.1.jpg" alt="">
            <div class="image-overlay"></div>
            <div class="onimagetext">
    <p id="txt1">Unveil Unforgettable Hotels Here</p>
    <p id="txt2">Discover Your Dream Stay!</p>
    
</div>
        </div>
        <div class="main1searchbar">
    <form id="locationInputForm" action="<?php echo URLROOT ?>loggedTraveler/searchHotels" method="POST">
        <div class="search">
        <div class="search1">
    <input type="text" name="location" id="locationInput" placeholder=" <?php echo isset($data['location']) ? $data['location'] : 'Location:'; ?>">
        </div>

            <div class="search4"><button type="submit" id="searchbtn">Search</button></div>
        </div>
    </form>
</div>

<?php 
//echo var_dump($data['hotels']);
//$hotel_chunks = array_chunk($data['hotels'], 3);
?>
    </section>
    <section class="main2" id="S1">
    <div class="main2buttons">
        <button id="but1">All</button>
        <!-- <button class="but2_3" id="mostPopularButton">Most Popular</button>
        <button class="but2_3" id="topRatedButton">Top-Rated</button> -->
    </div>

    <?php if (!empty($data['hotels']) && is_array($data['hotels'])): ?>
        <div class="main2images" id="div1">
            <?php foreach ($data['hotels'] as $hotel): ?>
                <div class="main2img1content">
                    <div><img src="<?php echo URLROOT ?>images/<?php echo $hotel->profile_picture; ?>" alt=""></div>
                    <div class="c1">
                        <div>
                            <p style="font-size: 25px;margin:0px;font-weight:bold"><?php echo $hotel->fname; ?></p>
                            <p><?php echo $hotel->city ?></p>
                            <div style="font-size: 24px;padding-left:10px"> <!-- Adjust font-size here -->
        <?php
       // Extract the rating value from the ratings object
       $rating = isset($hotel->ratings->rating) ? $hotel->ratings->rating : 0;
                    
       // Round the rating value
       $filled_stars = $rating;
        
        // Output filled stars
        for ($i = 0; $i < $filled_stars; $i++) {
            echo '<span style="color: #FFD700;">★</span>';
        }
        
        // Output unfilled stars
        $unfilled_stars = 5 - $filled_stars;
        for ($i = 0; $i < $unfilled_stars; $i++) {
            echo '<span style="color: #ccc;">★</span>';
        }
        ?>
    </div>
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
            <p>Ready To Plan Your Trip?</p>
                <button onclick="gotoplantrip()">Plan Trip</button>
            </div>
            
        </div>
        <script>
            function gotoplantrip(){
                window.location.href='/TravelEase/loggedTraveler/plantrip';
            }
        </script>
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
            &copy; 2023 Travelease. All rights reserved.
        </div>
        </div>
    </section>
    <div id="notification" class="notification"></div> 

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const locationInput = document.getElementById("locationInput");
            const options = {
                types: ['(cities)'],
                componentRestrictions: { country: 'LK' } // Restrict to Sri Lanka (LK)
            };
            const autocomplete = new google.maps.places.Autocomplete(locationInput, options);

            // Listen for place selection
            autocomplete.addListener("place_changed", function() {
                const place = autocomplete.getPlace();
                if (!place.geometry) {
                    console.error("Place selection failed:", place);
                    return;
                }
                // Extract city name without country
                const city = place.address_components.find(component => {
                    return component.types.includes("locality");
                });
                if (city) {
                    locationInput.value = city.long_name;
                }
            });
        });
    </script>
    <script>
    document.getElementById("locationInputForm").addEventListener("submit", function(event) {
        var locationInput = document.getElementById("locationInput").value.trim();

        if (locationInput === "") {
            // Location input is empty, show notification
            var notification = document.getElementById("notification");
            notification.innerText = "Please enter a location!";
            notification.style.display = "block";

            // Hide notification after 3 seconds
            setTimeout(function() {
                notification.style.display = "none";
                notification.innerText = "";
            }, 3000);

            // Prevent form submission
            event.preventDefault();
        }
    });
</script>


</body>
</html>`