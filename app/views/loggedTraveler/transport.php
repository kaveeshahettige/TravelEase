<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>TravelEase</title>
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT ?>/images/TravelEase_logo.png">
    <link rel="stylesheet" href="<?php echo URLROOT ?>css/loggedTraveler/styletr.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <script src="<?php echo URLROOT ?>/js/loggedTraveler/script.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.2/css/boxicons.min.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTDElEffBAws-JYjYaUELqmkOCpa6C5R8&libraries=places"></script>
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
            <img src="<?php echo URLROOT ?>/images/TravelEase_logo.png" alt="Logo">
            <label for="logoname">Travel<span style="color: #458A9E;">Ease</span> </label>
        </div>
        <ul>
            <li><a href="<?php echo URLROOT ?>loggedTraveler/index">Home</a></li>
            <li><a href="<?php echo URLROOT ?>loggedTraveler/hotel">Hotels</a></li>
            <li><a href="<?php echo URLROOT ?>loggedTraveler/transport" id="selected">Transport Providers</a></li>
            <li><a href="<?php echo URLROOT ?>loggedTraveler/package">Guides</a></li>
            <div class="rightcontent">
                <li><a href="<?php echo URLROOT ?>travelerDashboard/cart/<?php echo $_SESSION['user_id'] ?>"><i class='bx bxs-cart bx-lg bx-tada bx-rotate-90'></i></a></li>
                <li><a href="<?php echo URLROOT ?>travelerDashboard/index/<?php echo $_SESSION['user_id'] ?>"><img src="<?php echo empty($data['profile_picture']) ? URLROOT . 'images/user.jpg' : URLROOT . 'images1/' . $data['profile_picture']; ?>" alt="Profile Picture" alt="User Profile Photo"> </a></li>
                <li><a href="<?php echo URLROOT ?>users/logout" id="logout">Log Out</a></li>
            </div>
        </ul>
    </div>
    <section class="main1">
        <div class="main1img">
            <img src="<?php echo URLROOT ?>/images/tr.jpg" alt="">

            <div class="image-overlay"></div>
            <div class="onimagetext">
                <p id="txt1">Unlock Exceptional Transport Options Here</p>
                <p id="txt2">Embark on Your Ideal Journey!</p>

            </div>
        </div>
        <form id="bookingForm" action="<?php echo URLROOT ?>loggedTraveler/searchVehicles" method="POST">
            <div class="main1searchbar">
                <div class="search">
                    <div class="search1"><input type="text" placeholder="Location: " name="location" id="location-input"></div>
                    <div class="search2">Pick-up Date:<input type="date" placeholder="Pick-up Date" id="checkinDate" name="pickupdate" min="<?php echo date('Y-m-d'); ?>"></div>
                    <div class="search3">Time:<input type="time" placeholder="Pick-up Time" name="pickuptime"></div>
                    <div class="search4">Drop-off Date:<input type="date" placeholder="Drop-off Date" id="checkoutDate" name="dropoffdate" min="<?php echo date('Y-m-d'); ?>"></div>
                    <div class="search6"><button id="searchbtn">Search</button></div>
                    <!-- <div class="search6"><button id="searchbtn" onclick="clickSearchTransport()">Search</button></div> -->
                </div>

            </div>

        </form>

    </section>
    <!-- <?php echo var_dump($data) ?> -->
    <?php
    if (isset($data['agencies'])) {
        $agency_chunks = array_chunk($data['agencies'], 3);
    }

    ?>
    <section class="main2">
        <div class="main2buttons">
            <button id="but1">All</button>
            <button class="but2_3" id="mostPopularButton">Most Popular</button>
            <button class="but2_3" id="topRatedButton">Top-Rated</button>
        </div>

        <?php if (!empty($data['agencies']) && is_array($data['agencies'])) : ?>
            <div class="main2images" id="div1">
                <?php foreach ($data['agencies'] as $agency) : ?>
                    <div class="main2img1content">
                        <div><img src="<?php echo URLROOT ?>images/<?php echo $agency->profile_picture; ?>" alt=""></div>
                        <div class="c1">
                            <div>
                                <p style="font-size: 30px;margin:0px;font-weight:bold"><?php echo $agency->fname; ?></p>
                                <p><?php echo $agency->city; ?></p>
                                <div style="font-size: 24px;padding-left:10px"> <!-- Adjust font-size here -->
                                    <?php
                                    // Extract the rating value from the ratings object
                                    $rating = isset($agency->ratings->rating) ? $agency->ratings->rating : 0;

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
                            <div> <button onclick="Tripdetails(<?= $agency->user_id ?>)">View</button></div>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>
        <?php elseif (empty($data['agencies'])) : ?>
            <p>No transport agencies available.</p>
        <?php else : ?>
            <p>Error retrieving transport agency data.</p>
        <?php endif; ?>

    </section>
    <section class="main4">
        <div class="main4img">
            <img src="<?php echo URLROOT ?>images/5.jpg" alt="">
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
                <a href="<?php echo URLROOT ?>Landpage/termsofuse" target="_blank">Terms of Use</a> |
                <a href="">Contact</a>
            </div>

            <div class="copyright">
                &copy; 2023 Travelease. All rights reserved.
            </div>
        </div>
    </section>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const locationInput = document.getElementById("location-input");
            const options = {
                types: ['(cities)'],
                componentRestrictions: {
                    country: 'LK'
                } // Restrict to Sri Lanka (LK)
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

</body>

</html>