<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/driver/vehicle.css">
    <title>Business Financial Management</title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/driver/x-icon" href="<?php echo URLROOT; ?>/images/driver/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
   
</head>
<body>
    <nav class="left-menu">
        <div class="user-profile">
            <img src="<?php echo URLROOT; ?>/images/driver/wikum.jpg" alt="User Profile Photo">
            <span class="user-name">Travel Agency 1</span>
        </div>
        
        <div class="search-bar">
            <form action="#" method="GET">
                <input type="text" placeholder="Find a Setting">
                <button type="submit">Search</button>
            </form>
        </div>
        <ul>
            <li><a href="<?php echo URLROOT; ?>driver/index"><i class='bx bxs-dashboard bx-sm'></i> Overview</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/calender"><i class='bx bxs-book bx-sm'></i> Availabily Calender</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/bookings"><i class='bx bxs-package bx-sm'></i></i> Bookings</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/vehicle" class="active"><i class='bx bxs-car bx-sm'></i> Vehicle Informaion </a></li>
            <li><a href="<?php echo URLROOT; ?>driver/earings"><i class='bx bx-money-withdraw bx-sm'></i>Earings and Payments</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/notification"><i class='bx bxs-bell bx-sm'></i>Notification</a></li>
            
            <li><a href="<?php echo URLROOT; ?>driver/reviews"><i class='bx bxs-star bx-sm bx-fw'></i> Reviews</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/settings"><i class='bx bxs-cog bx-sm'></i> Settings</a></li>
            <li><a href="<?php echo URLROOT; ?>pages/indes" class="active"><i class='bx bxs-log-out bx-sm bx-fw'></i> Logout</a></li>
        </ul> 
        
        
        <!-- <div class="logout">
            <a href="<?php echo URLROOT; ?>pages/indes" class="active"><i class='bx bxs-log-out bx-sm bx-fw'></i>  Logout</a>
        </div> -->
    </nav>
    <main>
        <div class="logo-container">
            <img src="<?php echo URLROOT; ?>/images/driver/TravelEase.png" alt="TravelEase Logo">
            <span class="logo-text">TravelEase</span>
        </div>
        
        <div class="dashboard-content">
            <h1>Vehicle Informaion</h1>
        </div>

        <div class="search-content">
            <div class="booking-search">
                <input type="text" id="booking-search" placeholder="Search Vehicles">
                <button onclick="filterBookings()">
                    <i class="bx bx-search"></i> <!-- Using the Boxicons search icon -->
                </button>
            </div>
            </div>

        <div class="dashboard-sub-content">
        <div class="top-boxes">
 
            <!-- Total Request Box -->
            <div class="box">
                <h2>Total Vehicles</h2>
                <p>2</p >
            </div>
        

        </div>
        </div>


        
        <div class="Vehicle-content">
            <div class="Vehicle-box">
                <div class="Vehicle-sub-content">
                    <div class="Vehicle-image">
                        <img src="<?php echo URLROOT; ?>/images/driver/vehicle_1.jpg" alt="Guest Photo">
                    </div>
                    <h2>Benz ABC 123</h2>
                    <div class="detail"><strong>Make:</strong>Toyota</div>
                    <div class="detail"><strong>Model:</strong> Camry</div >
                    <div class="detail"><strong>Plate Number:</strong> ABC 123</div >
                    <div class="detail"><strong>Insurance Details:</strong> Insurance details here...</div >
                    <div class="detail"><strong>Registration Details:</strong> Registration details here...</div >
                    <div class="detail"><strong>Capacity:</strong> 4 passengers</div >
                    <div class="detail"><strong>Fuel Type:</strong> Gasoline</div >
                    <div class="detail"><strong>Mileage:</strong> 30 MPG</div >
                    <div class="detail"><strong>Year:</strong> 2021</div >
                    <div class="detail"><strong>License Plate State:</strong> CA</div >
                    <div class="detail"><strong>Vehicle Class:</strong> Sedan</div >
                    <div class="detail"><strong>Additional Features:</strong> Wi-Fi, Air Conditioning</div >
                    <div class="detail"><strong>Maintenance History:</strong> Recent oil change, new tires</div >
                    <button class="read-more-btn" onclick="openEditWindow()">Edit Details</button>
                </div>
            </div>

            <div class="Vehicle-box">
                <div class="Vehicle-sub-content">
                    <div class="Vehicle-image">
                        <img src="<?php echo URLROOT; ?>/images/driver/vehicle_2.png" alt="Guest Photo">
                    </div>
                    <h2>BMW CDE 3233</h2>
                    <div class="detail"><strong>Make:</strong> Toyota</div >
                    <div class="detail"><strong>Model:</strong> Camry</div >
                    <div class="detail"><strong>Plate Number:</strong> ABC 123</div >
                    <div class="detail"><strong>Insurance Details:</strong> Insurance details here...</div >
                    <div class="detail"><strong>Registration Details:</strong> Registration details here...</div >
                    <div class="detail"><strong>Capacity:</strong> 4 passengers</div >
                    <div class="detail"><strong>Fuel Type:</strong> Gasoline</div >
                    <div class="detail"><strong>Mileage:</strong> 30 MPG</div >
                    <div class="detail"><strong>Year:</strong> 2021</div >
                    <div class="detail"><strong>License Plate State:</strong> CA</div >
                    <div class="detail"><strong>Vehicle Class:</strong> Sedan</div >
                    <div class="detail"><strong>Additional Features:</strong> Wi-Fi, Air Conditioning</div >
                    <div class="detail"><strong>Maintenance History:</strong> Recent oil change, new tires</div >
                    <button class="read-more-btn" onclick="openEditWindow()">Edit Details</button>
                </div>
            </div>
            <div id="edit-popup" class="popup">
                <h2>Edit Vehicle Details</h2>
                <form onsubmit="saveEditedDetails()">
                    <div class="form-group">
                        <label for="make">Make:</label>
                        <input type="text" id="make" name="make" value="Toyota">
                    </div>
                    <div class="form-group">
                        <label for="model">Model:</label>
                        <input type="text" id="model" name="model" value="Camry">
                    </div>
                    <div class="form-group">
                        <label for="plate">Plate Number:</label>
                        <input type="text" id="plate" name="plate" value="ABC 123">
                    </div>
                    <div class="form-group">
                        <label for="insurance">Insurance Details:</label>
                        <textarea id="insurance" name="insurance">Insurance details here...</textarea>
                    </div>
                    <div class="form-group">
                        <label for="registration">Registration Details:</label>
                        <textarea id="registration" name="registration">Registration details here...</textarea>
                    </div>
                    <div class="form-group">
                        <label for="capacity">Capacity:</label>
                        <input type="text" id="capacity" name="capacity" value="4 passengers">
                    </div>
                    <div class="form-group">
                        <label for="fuel-type">Fuel Type:</label>
                        <input type="text" id="fuel-type" name="fuel-type" value="Gasoline">
                    </div>
                    <div class="form-group">
                        <label for="mileage">Mileage:</label>
                        <input type="text" id="mileage" name="mileage" value="30 MPG">
                    </div>
                    <div class="form-group">
                        <label for="year">Year:</label>
                        <input type="text" id="year" name="year" value="2021">
                    </div>
                    <div class="form-group">
                        <label for="license-state">License Plate State:</label>
                        <input type="text" id="license-state" name="license-state" value="CA">
                    </div>
                    <div class="form-group">
                        <label for="vehicle-class">Vehicle Class:</label>
                        <input type="text" id="vehicle-class" name="vehicle-class" value="Sedan">
                    </div>
                    <div class="form-group">
                        <label for="additional-features">Additional Features:</label>
                        <textarea id="additional-features" name="additional-features">Wi-Fi, Air Conditioning</textarea>
                    </div>
                    <div class="form-group">
                        <label for="maintenance-history">Maintenance History:</label>
                        <textarea id="maintenance-history" name="maintenance-history">Recent oil change, new tires</textarea>
                    </div>
                    <div class="form-group">
                        <label for="vehicle-photo">Vehicle Photo:</label>
                        <input type="file" id="vehicle-photo" name="vehicle-photo">
                    </div>
                    <div class="image-preview">
                        <img id="vehicle-image-preview" src="vehicle_image.jpg" alt="Vehicle Image Preview">
                    </div>
                    <div class="form-group">
                        <button type="submit">Save Changes</button>
                        <button type="button" onclick="closeEditWindow()">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="more-content">
            <button class="next-page-btn">More<i class='bx bx-chevron-right'></i></button>
        </div>
        <script src="<?php echo URLROOT?>/js/driver/vehicle.js"></script>
    </main>
</body>
</html>
