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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-NwdoN0yM5JcJJ4jX1KvJXrQhQ+6RMo3hV3brvytgePvVzSlc3PjMFbpL5T+VUAq7" crossorigin="anonymous">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCwpU1PTXuk_KMIDsXvXDjqiXUYCQZt2c&libraries=places"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.2/css/boxicons.min.css">


    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADD6_nBEr9ZJd44sKcqr0dj-JRvbt5ogo&libraries=places"></script> -->

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
    <!-- <?php echo var_dump($data['service1Name'])?> -->
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
            <li><a href="<?php echo URLROOT ?>travelerDashboard/cart/<?php echo $_SESSION['user_id'] ?>"><i class='bx bxs-cart bx-lg bx-tada bx-rotate-90' ></i></a></li>
            <li><a href="<?php echo URLROOT ?>travelerDashboard/index/<?php echo $_SESSION['user_id'] ?>"><img src="<?php echo empty($data['profile_picture']) ? URLROOT.'images/user.jpg' : URLROOT.'images1/'.$data['profile_picture']; ?>" alt="Profile Picture" alt="User Profile Photo"> </a></li>
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
    <button class="cta-button" id="plantrip" onclick="planNewTrip()">Plan New Trip</button>
</div>

        </div>
        <div class="main1searchbar" >
        <form id="bookingForm" action="<?php echo URLROOT ?>loggedTraveler/searchAllServices" method="POST">
            <div class="search">         
                <div class="search1"><input type="text" placeholder="Location: " name="location" id="location-input">
            </div>
                <div class="search2">Check in Date:<input type="date" placeholder="Check in Date" name="checkinDate" id="checkinDate" min="<?php echo date('Y-m-d'); ?>"></div>
                <div class="search3">Check out Date:<input type="date" placeholder="Check out Date" name="checkoutDate" id="checkoutDate" min="<?php echo date('Y-m-d'); ?>"></div>
                <div class="search4"><button type="submit" id="searchbtn">  Search</button></div>
            </div>
            </form>
        </div>
    </section>
    <section class="main2">
        <div class="topbar">
        <?php if (!empty($data['bookingDetailsArray'])): ?>
            <span id="upcoming">Upcoming Trips</span>
            <?php endif; ?>
            <button id="plantrip" onclick="planNewTrip()">Plan New Trip</button>
        </div>
        <!-- <?php echo var_dump($data['bookingDetailsArray'])?> -->
        <div class="main2trip-container">
    <div class="main2trip">
        <?php if (!empty($data['bookingDetailsArray'])): ?>
            <?php foreach ($data['bookingDetailsArray'] as $element): ?>
                <div class="main2img1content">
                    <?php $serviceProviderID = $element['serviceProviderID'];?>
                    <div style="width: 510px; height: 400px; overflow: hidden;">
                    <?php if ($element['type'] == 3): ?>
                        <img src="<?php echo URLROOT ?>images/rooms/<?php echo $element['furtherBookingDetails']->image ?>" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                        <?php elseif ($element['type'] == 4): ?>
                        <img src="<?php echo URLROOT ?>images/<?php echo $element['furtherBookingDetails']->image ?>" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                        <?php elseif ($element['type'] == 5): ?>
                        <img src="<?php echo URLROOT ?>images/<?php echo $element['furtherBookingDetails']->image ?>" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                        <?php endif; ?>
                    </div>
                    <div class="c1"> 
                        <div>
                            <?php if (!empty($element['serviceProviderName'])): ?>
                                <p style="font-size: 30px; margin: 0; font-weight: bold;"><?php echo ucfirst($element['serviceProviderName'])?></p>
                            <?php endif; ?>
                            <?php if (!empty($element['mainbookingDetails']->city)): ?>
                                <p><?php echo $element['mainbookingDetails']->city ?></p>
                            <?php endif; ?>
                        </div>
                        <div>
                        <button id="viewbooking" onclick="viewBooking(<?php echo $element['temporyIDs']; ?>, <?php echo $serviceProviderID; ?>, '<?php echo $element['bookingIDs']; ?>')">View</button>            
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
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
            <div><img src="<?php echo URLROOT . '/images/' . $data['service1pp'] ?>" alt=""></div>
                <div class="c1"> 
                    <div>
                        <p style="font-size: 30px;margin:0px;font-weight:bold"><?php echo $data['randomServiceProvider1Name']?></p>
                        <p><?php echo $data['randomServiceProvider1Location']?></p>
                        <div style="font-size: 24px;padding-left:10px"> <!-- Adjust font-size here -->
        <?php
                    
       // Round the rating value
       $filled_stars = $data['service1Ratings']->rating;
        
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
                    <div> <button id="bookingButton" onclick="Tripdetails(<?= $data['randomServiceProvider1Id'] ?>)">Book Now</button></div>
                    <!-- <?php echo $data['randomServiceProvider1Id']?> -->
                </div>
                
            </div>
            <div class="main3img2content">
            <div><img src="<?php echo URLROOT . '/images/' . $data['service2pp'] ?>" alt=""></div>
                <div class="c2">
                    <div>
                        <p style="font-size: 30px;margin:0px;font-weight:bold"><?php echo $data['randomServiceProvider2Name']?></p>
                        <p><?php echo $data['randomServiceProvider2Location']?></p>
                        <div style="font-size: 24px;padding-left:10px"> <!-- Adjust font-size here -->
        <?php
                    
       // Round the rating value
       $filled_stars = $data['service2Ratings']->rating;
        
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
                    <div> <button id="bookingButton" onclick="Tripdetails(<?= $data['randomServiceProvider2Id'] ?>)">Book Now</button></div>
                </div>
            </div>
            <div class="main3img3content">
            <div><img src="<?php echo URLROOT . '/images/' . $data['service3pp'] ?>" alt=""></div>
                <div class="c3">
                    <div>
                        <p style="font-size: 30px;margin:0px;font-weight:bold"><?php echo $data['randomServiceProvider3Name']?></p>
                        <p><?php echo $data['randomServiceProvider3Location']?></p>
                        <div style="font-size: 24px;padding-left:10px"> <!-- Adjust font-size here -->
        <?php
                    
       // Round the rating value
       $filled_stars = $data['service3Ratings']->rating;
        
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
                    <div> <button id="bookingButton" onclick="Tripdetails(<?= $data['randomServiceProvider3Id'] ?>)">Book Now</button></div>
                </div>
            </div>
        </div>
        <div id="notification" class="notification"></div> 
        
        <div id="checkingBigger" class="notification">Check-out date must be after check-in date</div> 
        
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
        <!-- modal -->
        <!-- Modal HTML -->
<div id="myModali" class="modali">
  <div class="modali-content">
    <span class="closei">&times;</span>
    <h2>No Matching Locations Found</h2>
    <p>We couldn't find any locations matching your search.</p>
    <p>Please try again or contact support for assistance.</p>
  </div>
</div>

        <!-- /// -->
        <script>
            // Get the modal element
var modali = document.getElementById("myModali");

// Get the <span> element that closes the modal
var spani = document.getElementsByClassName("closei")[0];

// When the user clicks on the button, open the modal
function openModal() {
  modali.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
spani.onclick = function() {
    modali.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modali) {
    modali.style.display = "none";
  }
}

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

    <!-- ///checkin checkoutdate validation// -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the form and input elements
        const bookingForm = document.getElementById("bookingForm");
        const checkinDateInput = document.getElementById("checkinDate");
        const checkoutDateInput = document.getElementById("checkoutDate");

        // Add event listener for form submission
        bookingForm.addEventListener("submit", function(event) {
            // Prevent form submission if validation fails
            if (!validateDates()) {
                event.preventDefault();
            }
        });

        // Function to validate dates
        function validateDates() {
            const checkinDate = new Date(checkinDateInput.value);
            const checkoutDate = new Date(checkoutDateInput.value);
            const today = new Date();

            //Check if check-in date is after check-out date
            if (checkinDate > checkoutDate) {
                
                document.getElementById("checkingBigger").style.display = "block";
                return false;
            }

            // Check if check-in date is in the past
            if (checkinDate < today) {
                alert("Check-in date cannot be in the past.");
                return false;
            }

            // Check if check-out date is in the past
            if (checkoutDate < today) {
                alert("Check-out date cannot be in the past.");
                return false;
            }

            // All validations passed
            return true;
        }
        checkinDateInput.addEventListener("change", function() {
            checkoutDateInput.min = checkinDateInput.value;
        });
    });
</script>

<script>
    document.getElementById("bookingForm").addEventListener("submit", function(event) {
        var locationInput = document.getElementById("location-input").value.trim();
        var checkinDate = document.getElementById("checkinDate").value;
        var checkoutDate = document.getElementById("checkoutDate").value;

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
        if (checkinDate === "") {
            // Location input is empty, show notification
            var notification = document.getElementById("notification");
            notification.innerText = "Please enter a Checkin Date!";
            notification.style.display = "block";

            // Hide notification after 3 seconds
            setTimeout(function() {
                notification.style.display = "none";
                notification.innerText = "";
            }, 3000);

            // Prevent form submission
            event.preventDefault();
        }
        if (checkoutDate === "") {
            // Location input is empty, show notification
            var notification = document.getElementById("notification");
            notification.innerText = "Please enter a Checkout Date!";
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

    </section>
  
</body>
</html>



    