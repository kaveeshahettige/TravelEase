<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>TraveleEase</title>
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT?>/images/TravelEase_logo.png">
    <link rel="stylesheet" href="<?php echo URLROOT?>css/loggedTraveler/searchAll.css">
    <script src="./script.js"></script>
    <style>

    </style>
</head>
<body>
    
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
            <img src="<?php echo URLROOT?>/images/galle.jpg" alt="">
            <div class="dark-overlay"></div>
            <div class="textonimage">
                <p>Galle is a beautiful coastal city in southern Sri Lanka. Declared a UNESCO World Heritage Site, Galle is an old trading port blessed with imposing Dutch-colonial buildings, ancient mosques and churches, and grand mansions.Today, the fort's surroundings are now a busy commercial district with many shops, restaurants, and hotels.</p>
            </div>
        </div>
        <div class="map">
            <img src="<?php echo URLROOT?>/images/mappic.png" alt="">
        </div>
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
            <div class="divleft">
                <div class="divleft1">
                    <h1>Galle Fort</h1>
                    <div class="divleft1_1">
                        <div><p>This Dutch fort, located in the city of Galle in Sri Lanka, is a UNESCO World Heritage site and contains a number of museums and tourist attractions. The intricate architecture and history of the fortress is unique and interesting.</p></div>
                    <div><img src="<?php echo URLROOT?>/images/galle.jpg" alt=""></div> </div>        
                </div>
                <div class="divleft1">
                    <h1>Old Dutch Hospital</h1>
                    <div class="divleft1_1">
                        <div><p>The Old Dutch Hospital building was once used as a hospital, but now it has been transformed into an upscale shopping centre with 21 stores and cafes. The mall is a new experience for when you need to take a break from the heat.</p></div>
                    <div><img src="<?php echo URLROOT?>/images/dutchHo.jpeg" alt=""></div> </div>
                </div>
                <div class="divleft1">
                    <h1>Yatagala Raja Maha Viharaya</h1>
                    <div class="divleft1_1">
                        <div><p>The Yatagala Raja Maha Viharaya is an ancient Buddhist temple complex that features many statues and a serene atmosphere. It is located in the hills of Sri Lanka, and can be visited for its museum that gives an in-depth story of the structure. The temple is home to one of the few remaining statues of the Buddha.</p></div>
                    <div><img src="<?php echo URLROOT?>/images/yatagala.jpeg" alt=""></div> </div>
                </div>
                
            </div>
        <div class="divright">
            <div class="divright1">
                    <h1>Galle Fort Clock Tower</h1>
                    <div class="divright1_1">
                        <div><p>This imposing tower, built in 1883, is a testament to the charitable work of Dr. Peter Anthonisz. The clock on its top is a beautiful example of Victorian engineering, and it's a popular tourist destination.</p></div>
                    <div><img src="<?php echo URLROOT?>/images/clocktower.jpeg" alt=""></div> </div>        
                </div>
                <div class="divright1">
                    <h1>Martin Wickramasinghe Folk Museum</h1>
                    <div class="divright1_1">
                        <div><p>The Martin Wickramasinghe House & Folk Museum is an intriguing attraction located in a serene setting with lush trees. This museum showcases the birthplace of the respected Sri Lankan author, Martin Wickramasinghe, which is a traditional southern structure with Dutch architectural influences that dates back 200 years.</p></div>
                    <div><img src="<?php echo URLROOT?>/images/martin.jpeg" alt=""></div> </div>
                </div>
                <div class="divright1">
                    <h1>Galle International Cricket Stadium</h1>
                    <div class="divright1_1">
                        <div><p>The Galle International Cricket Stadium is a beautiful cricket ground located in southern Sri Lanka. It is used for test matches and is one of the best international cricket stadiums in the world.</p></div>
                    <div><img src="<?php echo URLROOT?>/images/cricekt.jpeg" alt=""></div> </div>
                </div>
           
        </div>
        </div>  
        
    </section>
    <section class="resultPagem3" id="B2">
        <h1 class="ResultTopics">Top Places to Stay</h1>
        <div class="main2images" id="div1">
            <div class="main2img1content">
                <div><img src="<?php echo URLROOT?>/images/gingaga.jpg" alt=""></div>
                <div class="c1"> 
                    <div>
                        <p style="font-size: 20px;margin:0px;font-weight:bold">Ginganga Lodge</p>
                        <p>4-star hotel</p>
                    </div>
                    <div> <button id="bookButton" onclick="booking()">Book Now</button></div>
                </div>
                
            </div>
            <div class="main2img2content">
                <div><img src="<?php echo URLROOT?>/images/aro.jpg" alt=""></div>
                <div class="c2">
                    <div>
                        <p style="font-size: 20px;margin:0px;font-weight:bold">Villa Aroshina</p>
                        <p>1-star hotel</p>
                    </div>
                    <div><button>Book Now</button></div>
                </div>
            </div>
            <div class="main2img3content">
                <div><img src="<?php echo URLROOT?>/images/neo.jpg" alt=""></div>
                <div class="c3">
                    <div>
                        <p style="font-size: 20px;margin:0px;font-weight:bold">Neo Grand Villa</p>
                        <p>3-star hotel</p>
                    </div>
                    <div><button>Book Now</button></div>
                </div>
            </div>
        </div>
        <div class="main2images" id="div1">
            <div class="main2img1content">
                <div><img src="<?php echo URLROOT?>/images/delt.jpg" alt=""></div>
                <div class="c1"> 
                    <div>
                        <p style="font-size: 20px;margin:0px;font-weight:bold">Deltora Villa</p>
                        <p>4-star hotel</p>
                    </div>
                    <div> <button>Book Now</button></div>
                </div>
                
            </div>
            <div class="main2img2content">
                <div><img src="<?php echo URLROOT?>/images/coco.jpg" alt=""></div>
                <div class="c2">
                    <div>
                        <p style="font-size: 20px;margin:0px;font-weight:bold">Coco Lodge Galle,</p>
                        <p>1-star hotel</p>
                    </div>
                    <div><button>Book Now</button></div>
                </div>
            </div>
            <div class="main2img3content">
                <div><img src="<?php echo URLROOT?>/images/gign.jpg" alt=""></div>
                <div class="c3">
                    <div>
                        <p style="font-size: 20px;margin:0px;font-weight:bold">Ging View Villa</p>
                        <p>3-star hotel</p>
                    </div>
                    <div><button>Book Now</button></div>
                </div>
            </div>
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



    