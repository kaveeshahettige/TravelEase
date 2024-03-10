<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>TraveleEase</title>
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT?>/images/TravelEase_logo.png">
    <link rel="stylesheet" href="<?php echo URLROOT?>css/loggedTraveler/searchAll.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <script src="<?php echo URLROOT?>js/loggedTraveler/script.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <style>
        
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .modal-content {
            background-color: #fefefe;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }

        iframe {
            width: 100%;
            height: 90vh;
            border: none;
        }
        
    </style>
    
    <!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize the map
        var map = L.map('map').setView([7.8731, 80.7718], 12); // Set the initial coordinates and zoom level

        // Add OpenStreetMap tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Add markers for your places
        L.marker([6.0329, 80.2170])
            .addTo(map)
            .bindPopup("<b>Sample Place Name</b><br>Sample Place Description");
    });
    </script> -->

    <style>
    /* Your CSS styles here */
    </style>
</head>
<body>
    <!-- <?php echo var_dump($data['vehicles'])?> -->

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

    <section class="resultPagem1">
        <div class="results">
            <img src="<?php echo URLROOT . '/images/' . $data['city']->city_photo; ?>" alt="">
            <div class="dark-overlay"></div>
            <div class="textonimage">
                <p><?php echo $data['city']->city_description?></p>
            </div>
        </div>
        <!-- below id should be map -->
        <div id="" class="map" style="height: 400px;"></div>
    </section>

    <section class="resultsPage1_1">
        <div class="Buttons">
            <a href="#B1"><button>what to do</button></a>
            <a href="#B2"><button>where to stay</button></a>
            <a href="#B3"><button>how to go there</button></a>
        </div>
    </section>

    <section class="resultPagem2" id="B1">
    <h1 class="ResultTopics">Top Places to Visit</h1>
    <div class="whatToDo">
        <?php if (!empty($data['places']) && is_array($data['places'])): ?>
            <?php $chunks = array_chunk($data['places'], ceil(count($data['places']) / 2)); ?>
            <div class="divleft">
                <?php foreach ($chunks[0] as $place) : ?>
                    <div class="divleft1">
                        <h1><?php echo $place->place_name; ?></h1>
                        <div class="divleft1_1">
                            <div>
                                <p><?php echo $place->place_description; ?></p>
                            </div>
                            <div>
                                <img src="<?php echo URLROOT . '/images/' . $place->place_photo; ?>" alt="">
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="divright">
                <?php if (!empty($chunks[1]) && is_array($chunks[1])): ?>
                    <?php foreach ($chunks[1] as $place) : ?>
                        <div class="divright1">
                            <h1><?php echo $place->place_name; ?></h1>
                            <div class="divright1_1">
                                <div>
                                    <p><?php echo $place->place_description; ?></p>
                                </div>
                                <div>
                                    <img src="<?php echo URLROOT . '/images/' . $place->place_photo; ?>" alt="">
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <p>No places to visit right now.</p>
        <?php endif; ?>
    </div>  
</section>


    <section class="main2" id="S1">
        <h1 class="ResultTopics">Top Places to Stay</h1>
        <?php if (!empty($data['hotelrooms']) && is_array($data['hotelrooms'])): ?>
            <div class="main2images" id="div1">
            <?php foreach ($data['hotelrooms'] as $hotelroom): ?>
    <div class="main2img1content">
        <div><img src="<?php echo URLROOT ?>images/<?php echo $hotelroom->image; ?>" alt=""></div>
        <div class="c1">
            <div>
                <p style="font-size: 30px; margin: 0px; font-weight: bold;"><?php echo ($hotelroom ? $hotelroom->fname . ' ' . $hotelroom->lname : ' '); ?></p>
                <p><?php echo $hotelroom->roomType ?>&nbsp;Room</p>
                <p><?php echo $hotelroom->add ?></p>
                <button class="add-to-cart-button" style="margin-top:0px;margin-left:10px;background-color: #45a049;color: white; border: none; cursor: pointer;transition: background-color 0.3s;" onclick="addToCart(3,<?php echo $hotelroom->room_id ?>,this)">&#x271A;&nbsp;Cart</button>
                
                <!-- Add to Cart button -->
                
            </div>
            
            <div>
                <button style="margin-top: 10px; margin-bottom: 10px;" onclick="bookingHas(3, <?php echo $hotelroom->room_id; ?>, '<?php echo $data['checkinDate']; ?>', '<?php echo $data['checkoutDate']; ?>')">
                    &rarr; View Deal
                </button>
                <button style="margin-top: 10px; margin-bottom: 10px;" class="view-button" onclick="booking(3, '<?php echo $hotelroom->room_id; ?>', '<?php echo $data['checkinDate']; ?>', '<?php echo $data['checkoutDate']; ?>')">
                    &#x1F4C5; Book Now
                </button>
               
            </div>
        </div>
    </div>
<?php endforeach; ?>


</div>
<?php elseif (empty($data['hotels'])): ?>
    <p>No hotels available Right Now</p>
<?php else: ?>
    <p>Error retrieving hotel data.</p>
<?php endif; ?>
</section>

<section class="resultPagem4" id="B3">
    <h1 class="ResultTopics">Roar your journey with</h1>
    <div class="pickupTimeField">
        <label for="pickupTime">Pickup Time:</label>
        <input type="time" id="pickupTime" name="pickupTime">
    </div>
    <div class="vehicles">
        <?php if (!empty($data['vehicles']) && is_array($data['vehicles'])): ?>
            <?php foreach ($data['vehicles'] as $vehicle): ?>
                <div class="vehicledetails">
                    <div style="display: flex;margin-bottom: 10px;align-items: center; justify-content: center;flex-direction: column; ">
                        <img src="<?php echo URLROOT?>/images/<?php echo $vehicle->image; ?>" alt="">
                        <div>
                            <br>
                            <button class="add-to-cart-button" style="padding: 10px 20px;border-radius: 20px;margin-top:0px;margin-left:10px;background-color: #45a049;color: white; border: none; cursor: pointer;transition: background-color 0.3s;" onclick="addToCart(4,<?php echo $vehicle->vehicle_id; ?>,this)">&#x271A;&nbsp;Cart</button>
                        </div>
                    </div>

                    <div class="vehicleIndetails">
                        <div><strong><?php echo $vehicle->brand; ?> <?php echo $vehicle->model; ?></strong>&nbsp;by  <?php echo $vehicle->agency_name; ?></div>
                        <div style="padding: 10px;">
                            <ul>
                                <li><?php echo $vehicle->fuel_type; ?>&nbsp;Vehicle</li>
                                <li><?php echo $vehicle->seating_capacity; ?>&nbsp;Persons</li>
                                <?php if ($vehicle->ac_type == 1) : ?>
                                    <li>AC :&nbsp;Available</li>
                                <?php else: ?>
                                    <li>AC :&nbsp;Not Available</li>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <div>Price : <strong><?php echo $data['vehiclePrices'][$vehicle->vehicle_id]; ?> LkR</strong></div>
                    </div>

                    <div class="vehicleBookButton"><button onclick="bookingHas(4, <?php echo $vehicle->vehicle_id; ?>, '<?php echo $data['checkinDate']; ?>', '<?php echo $data['checkoutDate']; ?>')">View Deal</button></div>

                    <div class="vehicleBookButton">
                        <!-- <div><button class="view-button" onclick="openPopup(4, <?php echo $vehicle->vehicle_id; ?>, '<?php echo $data['checkinDate']; ?>', '<?php echo $data['checkoutDate']; ?>')">View</button></div>  -->
                        <button onclick="booking(4, <?php echo $vehicle->vehicle_id; ?>, '<?php echo $data['checkinDate']; ?>', '<?php echo $data['checkoutDate']; ?>')">Book now</button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No vehicles available right now.</p>
        <?php endif; ?>
    </div>

    <br><br><br>

    <div id="checkoutSection">
        <button class="continue-button" 
                data-checkin="<?php echo $data['checkinDate']; ?>" 
                data-checkout="<?php echo $data['checkoutDate']; ?>"
                onclick="continueToCheckoutAndRefresh()">Continue to Checkout</button>
    </div>
</section>

<!-- <div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span> 
        <p id="popupContent">Modal content goes here...</p>
    </div>
</div> -->




<br><br><br>

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
        <a href="<?php echo URLROOT?>LoggedTraveler/index">Home</a> |
        <a href="">About Us</a> |
        <a href="<?php echo URLROOT?>Landpage/termsofuse" target="_blank">Terms of Use</a> | 
        <a href="">Contact</a>
    </div>
    <br><br>
    <div class="copyright">
        &copy; 2023 Your Company Name. All rights reserved.
    </div>
</div>


</body>
</html>
