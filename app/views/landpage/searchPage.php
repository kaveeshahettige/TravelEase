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
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="<?php echo URLROOT?>js/loggedTraveler/script.js"></script>
    

    <script>
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

</script>
    <style>

    </style>
</head>
<body>
    <!-- <?php echo var_dump($data['hotels'])?> -->
    <div class="navbar">
        <div class="logo">
            <img src="<?php echo URLROOT?>/images/TravelEase_logo.png" alt="Logo">
            <label for="logoname">Travel<span style="color: #458A9E;">Ease</span> </label>
        </div>
        <ul>
            <li><a href="<?php echo URLROOT?>Landpage">Home</a></li>
            <li><a href="<?php echo URLROOT?>Landpage/hotel">Hotels</a></li>
            <li><a href="<?php echo URLROOT?>Landpage/transport">Transport Providers</a></li>
            <li><a href="<?php echo URLROOT?>Landpage/package">Packages</a></li>
            <div class="rightcontent">
               
            <li><a href="<?php echo URLROOT?>Users/login" id="loginbut">Login</a></li>
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
       <?php $chunks = array_chunk($data['places'], ceil(count($data['places']) / 2))?>
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
</div>
        </div>  
        
    </section>
    <?php $hotelchunks = array_chunk($data['hotels'], ceil(count($data['hotels']) / 2))?>
    <section class="resultPagem3" id="B2">
        <h1 class="ResultTopics">Top Places to Stay</h1>
        <?php
    if (isset($hotelchunks[0]) && is_array($hotelchunks[0])) :
        foreach ($hotelchunks[0] as $hotel) :
    ?>
        <div class="main2images" id="div1">
            <div class="main2img1content">
                <div><img src="<?php echo URLROOT?>/images/gingaga.jpg" alt=""></div>
                <div class="c1"> 
                    <div>
                        <p style="font-size: 20px;margin:0px;font-weight:bold"><?php echo ucfirst($hotel->fname." ".$hotel->lname); ?></p>
                        <p> <?php echo $hotel->street_address?></p>
                    </div>
                    <div> <button id="bookButton" onclick="booking()">Visit</button></div>
                    
                </div>
                <?php
        endforeach;
    else :
        echo "<p></p>";
    endif;
    ?>
           
            
        </div>
        
        <div class="main2images" id="div1">
        <div class="main2img1content">
        <?php
    if (isset($hotelchunks[1]) && is_array($hotelchunks[1])) :
        foreach ($hotelchunks[1] as $hotel) :
    ?>
        <div class="main2images" id="div1">
            <div class="main2img1content">
                <div><img src="<?php echo URLROOT?>/images/gingaga.jpg" alt=""></div>
                <div class="c1"> 
                    <div>
                        <p style="font-size: 20px;margin:0px;font-weight:bold"><?php echo ucfirst($hotel->fname." ".$hotel->lname); ?></p>
                        <p> <?php echo $hotel->street_address?></p>
                    </div>
                    <div> <button id="bookButton" onclick="booking()">Visit</button></div>
                    
                </div>
                <?php
        endforeach;
    else :
        echo "<p></p>";
    endif;
    ?>
           
            
        </div>
    </section>
    <section class="resultPagem4" id="B3">
        <h1 class="ResultTopics">Roar your journey with</h1>
        <div class="vehicles">
            <div class="vehicledetails">
                <div> <img src="<?php echo URLROOT?>/images/prius.jpg" alt=""></div>
                <div class="vehicleIndetails">
                    <div><strong>Toyota Prius</strong> or similar large car</div>
                    <div style="padding: 10px;"><ul>
                        <li>4 seats</li>
                        <li>Automatic</li>
                        <li>1 Large bag</li>
                        <li>Unlimited mileage</li>
                    </ul></div>
                    <div>Price for 3 days:
                        <strong>US$151.30</strong> 
                        </div>
                </div>
                <div class="vehicleBookButton"><button>Book now</button></div>
            </div>
            <div class="vehicledetails">
                <div> <img src="<?php echo URLROOT?>/images/corolla_estate_lrg.jpg" alt=""></div>
                <div class="vehicleIndetails">
                    <div><strong>Toyota Corolla Fielder</strong> or similar large car</div>
                    <div style="padding: 10px;"><ul>
                        <li>4 seats</li>
                        <li>Automatic</li>
                        <li>1 Large bag</li>
                        <li>1 Small bag</li>
                        <li>Unlimited mileage</li>
                    </ul></div>
                    <div>Price for 3 days:
                        <strong>US$161.30</strong> 
                        </div>
                </div>
                <div class="vehicleBookButton"><button>Book now</button></div>
            </div>
            <div class="vehicledetails">
                <div> <img src="<?php echo URLROOT?>/images/kicks.jpg" alt=""></div>
                <div class="vehicleIndetails">
                    <div><strong>Nissan Kicks</strong>or similar SUV</div>
                    <div style="padding: 10px;"><ul>
                        <li>5 seats</li>
                        <li>Automatic</li>
                        <li>3 Large bag</li>
                        <li>Unlimited mileage</li>
                    </ul></div>
                    <div>Price for 3 days:
                        <strong>US$217.61</strong> 
                        </div>
                </div>
                <div class="vehicleBookButton"><button>Book now</button></div>
            </div>
            <div class="vehicledetails">
                <div> <img src="<?php echo URLROOT?>/images/prius.jpg" alt=""></div>
                <div class="vehicleIndetails">
                    <div><strong>Toyota Prius</strong> or similar large car</div>
                    <div style="padding: 10px;"><ul>
                        <li>4 seats</li>
                        <li>Automatic</li>
                        <li>1 Large bag</li>
                        <li>Unlimited mileage</li>
                    </ul></div>
                    <div>Price for 3 days:
                        <strong>US$151.30</strong> 
                        </div>
                </div>
                <div class="vehicleBookButton"><button>Book now</button></div>
            </div>
           
        </div>
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
            &copy; 2023 Your Company Name. All rights reserved.
        </div>
        </div>
</body>
</html>



    