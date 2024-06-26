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
    <script src="https://maps.googleapis.com/maps/api/js?key=YOURAPIKEY&callback=initMap" async defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.2/css/boxicons.min.css">
    
    <style>
    #loginbut{
    background-color: #706F6C;
    padding: 10px 25px 10px 25px;
    border-radius: 20px;
    color: #FDFFFF;
}
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
            <li><a href="<?php echo URLROOT?>Landpage" >Home</a></li>
            <li><a href="<?php echo URLROOT?>Landpage/hotel">Hotels</a></li>
            <li><a href="<?php echo URLROOT?>Landpage/transport">Transport Providers</a></li>
            <li><a href="<?php echo URLROOT?>Landpage/package">Guides</a></li>
            <div class="rightcontent">
            <li><a href="<?php echo URLROOT?>Users/login" id="loginbut">Login</a></li>
                </div>
        </ul>
    </div>

    <section class="resultPagem1">
        <div class="results">
        <?php
            // Random image URL
        $randomImageURL = 'https://picsum.photos/1000/650'; // Random image from Lorem Picsum

        // Check if city photo is available, if not, use the random image URL
        $cityPhoto = !empty($data['city']->city_photo) ? URLROOT . '/images/' . $data['city']->city_photo : $randomImageURL;?>

        <img src="<?php echo $cityPhoto; ?>" alt="">

            <div class="dark-overlay"></div>
            <div class="textonimage">
                <p><?php echo $data['city']->city_description?$data['city']->city_description:$data['city']->city?></p>
            </div>
        </div>
        
        <div id="map"></div>
        <!-- script for map -->
        <script>
    // Initialize and add the map
    function initMap() {
        // The location of your initial map center
        var myLatLng = { lat: <?php echo $data['city']->lat ?>, lng: <?php echo $data['city']->lng ?> };
        
        // Create a map object and specify the DOM element for display.
        var map = new google.maps.Map(document.getElementById('map'), {
            center: myLatLng,
            zoom: 15 // Adjust the initial zoom level as needed
        });

        // Define an array to store all the places
        <?php if (!empty($data['places'])): ?>
    var places = [
        <?php foreach ($data['places'] as $place): ?>
            '<?php echo addslashes($place->place_name) ?>',
        <?php endforeach; ?>
    ];
<?php else: ?>
    var places = ['<?php echo addslashes($data['city']->city) ?>'];
<?php endif; ?>

        
        // Geocode each place and create markers
        places.forEach(function(place) {
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({ 'address': place + ', Sri Lanka' }, function(results, status) {
                if (status === 'OK') {
                    var marker = new google.maps.Marker({
                        map: map,
                        position: results[0].geometry.location,
                        title: place
                    });

                    // Create an infowindow for each marker
                    var infowindow = new google.maps.InfoWindow({
                        content: '<strong>' + place + '</strong><br>' + 'Description goes here' // Replace 'Description goes here' with actual descriptions if available
                    });

                    // Add click event listener to show infowindow on marker click
                    marker.addListener('click', function() {
                        infowindow.open(map, marker);
                    });
                } else {
                    console.error('Geocode was not successful for the following reason: ' + status);
                }
            });
        });
    }
</script>
       <!-- -------------- -->

    </section>

    <section class="resultsPage1_1">
        <div class="Buttons">
        <a href="#B1"><button>what to do</button></a>
            <a href="#B2"><button>where to stay</button></a>
            <a href="#B3"><button>How to go there</button></a>
            <a href="#B4"><button>Join with</button></a>
        </div>
    </section>

    <section class="resultPagem2" id="B1">
    <h1 class="ResultTopics">Top Places to Stay</h1>
<div class="whatToDo">
    <?php if (!empty($data['places']) && is_array($data['places'])): ?>
        <?php $chunks = array_chunk($data['places'], ceil(count($data['places']) / 2)); ?>
        <div class="divleft">
            <?php if (isset($chunks[0]) && is_array($chunks[0])): ?>
                <?php foreach ($chunks[0] as $place) : ?>
                    <div class="divleft1">
                        <h1><?php echo $place->place_name; ?></h1>
                        <div class="divleft1_1">
                            <div>
                                <p style="margin-top:0px"><?php echo $place->place_description; ?></p>
                            </div>
                            <div>
                                <img src="<?php echo URLROOT . '/images/' . $place->place_photo; ?>" alt="">
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="divright">
            <?php if (isset($chunks[1]) && is_array($chunks[1])): ?>
                <?php foreach ($chunks[1] as $place) : ?>
                    <div class="divright1">
                        <h1><?php echo $place->place_name; ?></h1>
                        <div class="divright1_1">
                            <div>
                                <p style="margin-top:0px"><?php echo $place->place_description; ?></p>
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
        <p>No places available right now.</p>
    <?php endif; ?>
</div>

</section>
            

    <section class="main2" id="B2">
        <h1 class="ResultTopics" style="margin-left:5%">Top Places to Stay</h1>
       
        <?php if (!empty($data['hotelrooms']) && is_array($data['hotelrooms'])): ?>
            <div class="main2images" id="div1">
    <?php foreach ($data['hotelrooms'] as $hotelroom): ?>
        <div class="main2img1content">
            <div><img src="<?php echo URLROOT ?>images/<?php echo $hotelroom->image; ?>" alt=""></div>
            <div class="c1" style="padding-bottom:10px;">
                <div>
                    <p style="font-size: 30px; margin: 0px; font-weight: bold;"><?php echo ($hotelroom ? $hotelroom->fname . ' ' . $hotelroom->lname : ' '); ?></p>
                    <p><?php echo $hotelroom->roomType ?>&nbsp;Room</p>
                    <!-- <p><?php echo $hotelroom->addr ?></p> -->
                    <div style="font-size: 24px;padding-left:10px;padding-bottom:10px;" > <!-- Adjust font-size here -->
        <?php
       // Extract the rating value from the ratings object
       $rating = isset($hotelroom->ratings->rating) ? $hotelroom->ratings->rating : 0;
                    
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
                <div><button style="margin-top:50px;margin-right:0px" class="view-button" onclick="gotologin()">&rarr; View</button></div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php elseif (empty($data['hotels'])): ?>
    <p style="margin-left:5%">No hotels available Right Now</p>
<?php else: ?>
    <p>Error retrieving hotel data.</p>
<?php endif; ?>

</section>

<section class="resultPagem4" id="B3">
    <h1 class="ResultTopics">Roar your journey with</h1>
    <div class="vehicles">
    <?php if (is_array($data['vehicles']) && !empty($data['vehicles'])): ?>
        <?php foreach ($data['vehicles'] as $vehicle): ?>
            <div class="vehicledetails">
                <div> <img src="<?php echo URLROOT?>/images/<?php echo $vehicle->image; ?>" alt="">
                <div style="font-size: 24px;padding-left:100px"> <!-- Adjust font-size here -->
        <?php
       // Extract the rating value from the ratings object
       $rating = isset($vehicle->vratings->rating) ? $vehicle->vratings->rating : 0;
                    
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
    </div></div>
                <div class="vehicleIndetails" style="margin:10px;" >
                    <div><strong><?php echo $vehicle->brand; ?> <?php echo $vehicle->model; ?></strong>&nbsp;by  <?php echo $vehicle->fname; ?></div>
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
                    
                </div>
                <div class="vehicleBookButton"> 
                    <button style="" onclick="gotologin()">&rarr; View</button>
                </div>
            </div>
        <?php endforeach; ?>
        <?php else: ?>
    <div >No vehicles available right now.</div>
<?php endif; ?>
    </div>
</section>
<section class="main2" id="B4">
        <h1 class="ResultTopics" style="margin-left:5%">Get Guidance from</h1>
        <?php if (!empty($data['guides']) && is_array($data['guides'])): ?>
            <div class="main2images" id="div1">
            <?php foreach ($data['guides'] as $guide): ?>
    <div class="main2img1content">
        <div><img src="<?php echo URLROOT ?>images/<?php echo $guide->image; ?>" alt=""></div>
        <div class="c1">
            <div>
                <p style="font-size: 30px; margin: 0px; font-weight: bold;"><?php echo ($guide ? $guide->fname . ' ' . $guide->lname : ' '); ?></p>
                <p><?php echo $guide->category ?>&nbsp;guide</p>
                <!-- <p><?php echo $hotelroom->ratings->rating ?></p> -->
                <div style="font-size: 24px;padding-left:10px"> <!-- Adjust font-size here -->
        <?php
       // Extract the rating value from the ratings object
       $rating = isset($guide->gratings->rating) ? $guide->gratings->rating : 0;
                    
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

                <!-- Add to Cart button -->
                
            </div>
            
            <div>
                <button style="margin-top:50px;margin-right:0px" class="view-button" onclick="gotologin()">
                &rarr; View
                </button>
               
            </div>
        </div>
    </div>
    <script>
        function gotologin(){
            window.location.href='/TravelEase/Users/login';
        }
    </script>
<?php endforeach; ?>


</div>
<?php elseif (empty($data['hotels'])): ?>
    <p style="margin-left:5%">No guides available Right Now</p>
<?php else: ?>
    <p style="margin-left:5%">Error retrieving guide data.</p>
<?php endif; ?>
<!-- Vehicle Pickup Time Popup -->
<div id="pickupTimePopup" class="popup">Please enter a pickup time.</div>

<!-- Guide Meet Time Popup -->
<div id="meetTimePopup" class="popup">Please enter a time to meet the guide.</div>

</section>

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
    <br><br>
    <div class="copyright">
        &copy; 2023 Travelease. All rights reserved.
    </div>
</div>

</body>


</html>
