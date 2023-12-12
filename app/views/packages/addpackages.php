<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< Updated upstream
    <link rel="stylesheet" href="css/add-packages.css">
    <title>Packages-Add packages</title>
    <link rel="icon" type="image/x-icon" href="../Images/TravelEase.png">
=======
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/packages/add-packages.css">
    <title>Packages-Add packages</title>
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT;?>images/packages/Logo.png">
>>>>>>> Stashed changes
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <nav class="left-menu">
        <div class="user-profile">
<<<<<<< Updated upstream
            <img src="../settings images/Uththara.jpg" alt="User Profile Photo">
            <span class="user-name">Uththara Samadhi</span>
=======
            <img src="<?php echo URLROOT;?>images/packages/uththara.jpg" alt="User Profile Photo">
            <span class="user-name"><?=$_SESSION['user_fname']?></span>
>>>>>>> Stashed changes
        </div>
        
        <div class="search-bar">
            <form action="#" method="GET">
                <input type="text" placeholder="Find a Setting">
                <button type="submit">Search</button>
            </form>
        </div>
<<<<<<< Updated upstream
        
            
        <ul>
            <li><a href="../../Dashboard/Packages-dashboard.html" class="nav-button"><i class='bx bxs-info-circle bx-tada-hover bx-sm bx-fw'></i> Dashboard</a></li>
            <li><a href="../../Availability/Packages-availability.html" class="nav-button"><i class='bx bxs-book bx-sm bx-fw'></i> Availability</a></li>
            <li><a href="../../Bookings/Packages-bookings.html" class="nav-button"><i class='bx bxs-calendar bx-sm bx-fw'></i> Bookings</a></li>
            <li><a href="../../Gallery/Packages-gallery.html" class="nav-button"><i class='bx bx-images bx-sm bx-fw'></i> Galeery</a></li>
            <li><a href="../../Revenue/Packages-revenue.html" class="nav-button"><i class='bx bxs-wallet bx-sm bx-fw'></i> Revenue</a></li>
            <li><a href="../../Packages/Packages.html" class="nav-button"><i class='bx bxs-star bx-sm bx-fw'></i> Packages</a></li>
            <li><a href="../../Review/Packages-review.html" class="nav-button"><i class='bx bxs-star bx-sm bx-fw'></i> Reviews</a></li>
            <li><a href="add-packages.html" class="nav-button active"><i class='bx bxs-cog bx-sm bx-fw'></i> Settings</a></li>
=======


        <ul>
            <li><a href="<?php echo URLROOT;?>packages/index" class="nav-button"><i class='bx bxs-dashboard bx-sm'></i> Dashboard</a></li>
            <li><a href="<?php echo URLROOT;?>packages/availability" class="nav-button"><i class='bx bxs-calendar bx-sm bx-fw'></i> Availability</a></li>
            <li><a href="<?php echo URLROOT;?>packages/bookings" class="nav-button"><i class='bx bxs-book bx-sm bx-fw'></i> Bookings</a></li>
            <li><a href="<?php echo URLROOT;?>packages/gallery" class="nav-button"><i class='bx bx-images bx-sm bx-fw'></i> Gallery</a></li>
            <li><a href="<?php echo URLROOT;?>packages/revenue" class="nav-button"><i class='bx bxs-wallet bx-sm bx-fw'></i> Revenue</a></li>
            <li><a href="<?php echo URLROOT;?>packages/packages" class="nav-button"><i class= 'bx bxs-package bx-sm'></i> Packages</a></li>
            <li><a href="<?php echo URLROOT;?>packages/review" class="nav-button"><i class='bx bxs-star bx-sm bx-fw'></i> Review</a></li>
            <li><a href="<?php echo URLROOT;?>packages/settings" class="nav-button active"><i class='bx bxs-cog bx-sm bx-fw'></i> Settings</a></li>
>>>>>>> Stashed changes
        </ul>  
        
        
        <div class="logout">
<<<<<<< Updated upstream
            <a href="#" class="nav-button active"><i class='bx bxs-log-out bx-sm bx-fw'></i>  Logout</a>
=======
            <a href="<?php echo URLROOT;?>users/logout" class="nav-button active"><i class='bx bxs-log-out bx-sm bx-fw'></i>  Logout</a>
>>>>>>> Stashed changes
        </div>
    </nav>
    <main>
        <div class="logo-container">
<<<<<<< Updated upstream
            <img src="../settings images/TravelEase.png" alt="TravelEase Logo">
=======
            <img src="<?php echo URLROOT;?>images/packages/TravelEase.png" alt="TravelEase Logo">
>>>>>>> Stashed changes
            <span class="logo-text">TravelEase</span>
        </div>
        <div class="dashboard-content">
            <div><h1>Settings</h1> </div>
        </div>
        
        <div class="main-content">
            <div class="room-container">
<<<<<<< Updated upstream
                <div class="room-box">
                    <h3>Package Name</h3>
                    <p>Description of the package.</p>
                    <div class="icons">
                        <a href="add-packages-edit.html"><i class='bx bx-edit'></i></a> 
                        <a href="#"><i class='bx bx-trash'></i></a> 
                    </div>
                </div>

                <div class="room-box">
                    <h3>Package Name</h3>
                    <p>Description of the Package.</p>
                    <div class="icons">
                        <a href="add-packages-edit.html"><i class='bx bx-edit'></i></a> 
                        <a href="#"><i class='bx bx-trash'></i></a> 
                    </div>
                </div>

                <div class="room-box">
                    <h3>Package Name</h3>
                    <p>Description of the package.</p>
                    <div class="icons">
                        <a href="add-packages-edit.html"><i class='bx bx-edit'></i></a> 
                        <a href="#"><i class='bx bx-trash'></i></a> 
                    </div>
                </div>

                <div class="room-box">
                    <h3>Package Name</h3>
                    <p>Description of the package.</p>
                    <div class="icons">
                        <a href="add-packages-edit.html"><i class='bx bx-edit'></i></a> 
                        <a href="#"><i class='bx bx-trash'></i></a> 
                    </div>
                </div>

                <div class="room-box">
                    <h3>Package Name</h3>
                    <p>Description of the room goes here.</p>
                    <div class="icons">
                        <a href="add-packages-edit.html"><i class='bx bx-edit'></i></a> 
                        <a href="#"><i class='bx bx-trash'></i></a> 
                    </div>
                </div>

                <div class="add-room">
                    <a href="add-packages-edit.html" class="add-package-link">
                        <i class='bx bx-plus-circle' id="add-icon"></i>  
                        <p>Add New Package</p>
                    </a>
                </div>
            
            </div>
           
            
=======
                <?php
                $packageData = $data["packageData"];
                foreach ($packageData as $packageUnits):
                    ?>

                    <div class="room-box">
                        <h2><?php echo ucfirst($packageUnits->name);?></h2>
                        <h3><?php echo ucfirst($packageUnits->Price);?></h3>
                        <h3><?php echo ucfirst($packageUnits->description);?></h3>

                        <div class="icons">
                            <a href="<?php echo URLROOT; ?>packages/updatePackages/<?= $packageUnits->PackageID ?>"><i class='bx bx-edit'></i></a>
                            <a href="<?php echo URLROOT; ?>packages/deletepackages/<?=$packageUnits->PackageID?>"><i class='bx bx-trash'></i></a>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="add-room">
                    <a href="<?php echo URLROOT; ?>packages/addpackagesedit" class="add-package-link">
                        <i class='bx bx-plus-circle' id="add-icon"></i>
                        <p>Add New Package</p>
                    </a>
                </div>

            </div>
>>>>>>> Stashed changes
        </div>
    </main>
</body>
</html>
