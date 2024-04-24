<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>TravelEase</title>
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT?>/images/TravelEase_logo.png">
    <link rel="stylesheet" href="<?php echo URLROOT?>css/loggedTraveler/styleve.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <script src="<?php echo URLROOT?>/js/loggedTraveler/script.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCwpU1PTXuk_KMIDsXvXDjqiXUYCQZt2c&libraries=places"></script>
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
    
    <div class="navbar">
        <div class="logo">
            <img src="<?php echo URLROOT?>/images/TravelEase_logo.png"alt="Logo">
            <label for="logoname">Travel<span style="color: #458A9E;">Ease</span> </label>
        </div>
        <ul>
            <li><a href="<?php echo URLROOT?>loggedTraveler/index">Home</a></li>
            <li><a href="<?php echo URLROOT?>loggedTraveler/hotel" >Hotels</a></li>
            <li><a href="<?php echo URLROOT?>loggedTraveler/transport" id="selected">Transport Providers</a></li>
            <li><a href="<?php echo URLROOT?>loggedTraveler/package">Packages</a></li>
            <div class="rightcontent">
            <li><a href="<?php echo URLROOT ?>travelerDashboard/index/<?php echo $_SESSION['user_id'] ?>"><img src="<?php echo empty($data['profile_picture']) ? URLROOT.'images/user.jpg' : URLROOT.'images1/'.$data['profile_picture']; ?>" alt="Profile Picture" alt="User Profile Photo"> </a></li>
                <li><a href="<?php echo URLROOT?>users/logout" id="logout">Log Out</a></li>
                </div>
        </ul>
    </div>
    <section class="main1">
        <div class="main1img">
            <img src="<?php echo URLROOT?>/images/tr.jpg" alt="">
        </div>
        <form action="<?php echo URLROOT ?>loggedTraveler/searchVehicles" method="POST">
        <div class="main1searchbar">
        <div class="search">
    <div class="search1"><input type="text" id="location-input" placeholder="Location: <?php echo $data['location']; ?>" name="location" value="<?php echo $data['location']; ?>"></div>
    <div class="search2">Pick-up Date:<br><?php echo $data['checkinDate']; ?><input type="date" placeholder="Pick-up Date:" name="pickupdate" value="<?php echo $data['checkinDate']; ?>"></div>
    <div class="search3">Time:<br><?php echo $data['checkinTime']; ?><input id="pickupTime" type="time" placeholder="Pick-up Time:" name="pickuptime" value="<?php echo $data['checkinTime']; ?>"></div>
    <div class="search4">Drop-off Date:<br><?php echo $data['checkoutDate']; ?><input type="date" placeholder="Drop-off Date" name="dropoffdate" value="<?php echo $data['checkoutDate']; ?>"></div>
    <div class="search6"><button id="searchbtn">Search</button></div>
    <!-- <div class="search6"><button id="searchbtn" onclick="clickSearchTransport()">Search</button></div> -->
</div>

        </div>

        </form>
        
    </section>
    <!-- <?php echo var_dump($data) ?> -->
    <?php 
$agency_chunks = array_chunk($data['vehicles'], 3);
?>
    <section class="main2">
        <div class="main2buttons">
            <button id="but1">All</button>
            <button class="but2_3" id="mostPopularButton">Most Popular</button>
            <button class="but2_3"  id="topRatedButton">Top-Rated</button>
        </div>

        <?php if (!empty($data['vehicles']) && is_array($data['vehicles'])): ?>
        <div class="main2images" id="div1">
        <?php foreach ($data['vehicles'] as $vehicles): ?>
            <div class="main2img1content">
                <div><img src="<?php echo URLROOT ?>images/<?php echo $vehicles->image; ?>" alt=""></div>
                <div class="c1"> 
                    <div>
                        <p style="font-size: 30px;margin:0px;font-weight:bold"><?php echo $vehicles->brand . ' ' .ucfirst( $vehicles->model)?></p>
                        <p><?php echo $vehicles->city; ?></p>
                        <div style="font-size: 24px;padding-left:10px"> <!-- Adjust font-size here -->
        <?php
       // Extract the rating value from the ratings object
       $rating = isset($vehicles->vratings->rating) ? $vehicles->vratings->rating : 0;
                    
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
                    <div><button onclick="bookingV(4, <?php echo $vehicles->vehicle_id; ?>, '<?php echo $data['checkinDate']; ?>', '<?php echo $data['checkoutDate']; ?>','<?php echo $data['checkinTime']; ?>')">View</button></div>
                    <!-- <div> <button onclick="Tripdetails(<?= $vehicles->user_id?>)">View</button></div> -->
                </div>
                
            </div>
            <?php endforeach; ?>
        </div>
        <?php elseif (empty($data['agencies'])): ?>
        <p>No transport agencies available.</p>
    <?php else: ?>
        <p>Error retrieving transport agency data.</p>
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
                <a href="../index.html">Home</a> |
                <a href="">About Us</a> |
                <a href="<?php echo URLROOT?>Landpage/termsofuse" target="_blank">Terms of Use</a> | 
                <a href="">Contact</a>
            </div>
        
        <div class="copyright">
            &copy; 2023 Your Company Name. All rights reserved.
        </div>
        </div>
    </section>
    <script>
        // JavaScript code to scroll to section with ID "S1"
        window.onload = function() {
                // Scroll to the section with ID "S1"
                document.getElementById('location-input').scrollIntoView();
            
        };
    </script>
     <script>
        document.addEventListener("DOMContentLoaded", function() {
            const locationInput = document.getElementById("location-input");
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

</body>
</html>