<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>css/packages/add-packages-edit.css">
    <title>Packages-Add packages</title>
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT;?>images/packages/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <nav class="left-menu">
        <div class="user-profile">
            <img src="<?php echo URLROOT;?>images/packages/Uththara.jpg" alt="User Profile Photo">
            <span class="user-name"><?=$_SESSION['user_fname']?></span>
        </div>

        <div class="search-bar">
            <form action="#" method="GET">
                <input type="text" placeholder="Find a Setting">
                <button type="submit">Search</button>
            </form>
        </div>


        <ul>
            <li><a href="<?php echo URLROOT;?>packages/index" class="nav-button"><i class='bx bxs-dashboard bx-sm'></i> Dashboard</a></li>
            <li><a href="<?php echo URLROOT;?>packages/availability" class="nav-button"><i class='bx bxs-calendar bx-sm bx-fw'></i> Availability</a></li>
            <li><a href="<?php echo URLROOT;?>packages/bookings" class="nav-button"><i class='bx bxs-book bx-sm bx-fw'></i> Bookings</a></li>
            <li><a href="<?php echo URLROOT;?>packages/gallery" class="nav-button"><i class='bx bx-images bx-sm bx-fw'></i> Gallery</a></li>
            <li><a href="<?php echo URLROOT;?>packages/revenue" class="nav-button"><i class='bx bxs-wallet bx-sm bx-fw'></i> Revenue</a></li>
            <li><a href="<?php echo URLROOT;?>packages/packages" class="nav-button"><i class= 'bx bxs-package bx-sm'></i> Packages</a></li>
            <li><a href="<?php echo URLROOT;?>packages/review" class="nav-button"><i class='bx bxs-star bx-sm bx-fw'></i> Review</a></li>
            <li><a href="<?php echo URLROOT;?>packages/settings" class="nav-button active"><i class='bx bxs-cog bx-sm bx-fw'></i> Settings</a></li>
        </ul>  
        
        
        <div class="logout">
            <a href="<?php echo URLROOT;?>users/logout" class="nav-button active"><i class='bx bxs-log-out bx-sm bx-fw'></i>  Logout</a>
        </div>
    </nav>
    <main>
        <div class="logo-container">
            <img src="<?php echo URLROOT;?>images/packages/TravelEase.png" alt="TravelEase Logo">
            <span class="logo-text">TravelEase</span>
        </div>
        <div class="dashboard-content">
            <div><h1>Settings</h1> </div>

            <div id="base">
                <h3 style="padding-left:20px;">Add Packages</h3>
                <div id="form">
                    <form class="registration-form" action="" method="POST">
                        <div>
                            <div class="form-group">

                                <label for="packageName">Package Name</label>
                                <input type="text" id="PackageName" name="PackageName" required>

                            </div>

                            <div class="form-group">
                                <label for="PackageType">Package Type</label>
                                <select id="PackageType" name="PackageType">
                                  <option value="Solo">Solo</option>
                                  <option value="Couple">Couple</option>
                                  <option value="Family">Family</option>
                                  <option value="Group">Group</option>
                                  <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>





                        <div>
                            <div class="form-group">
                                <label for="Package Duration">Package Duration(days)</label>
                                <input type="number" id="Duration" name="duration" required>
                            </div>

                            <div class="form-group">
                                <label for="TransportProvider">Transport Provider</label>
                                <select id="TransportProvider" name="TransportProvider">
                                  <option value="Agency 1">Agency 1</option>
                                  <option value="Agency 2">Agency 2</option>
                                  <option value=" Agency3">Agency 3</option>
                                  <option value="Agency 4">Agency 4</option>
                                </select>
                            </div>
                        </div>





                        <div>
                            <div class="form-group">
                                <label for="AccomadationProvider">Accomadation Provider</label>
                                <select id="AccomadationProvider" name="AccomadationProvider">
                                  <option value="Hotel 1">Hotel 1</option>
                                  <option value="Hotel 2">Hotel 2</option>
                                  <option value="Hotel 3">Hotel 3</option>
                                  <option value="Hotel 4">Hotel 4</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="price">Price of Package</label>
                                <input type="number" id="PriceOfPackage" name="PriceOfPackage" required>
                            </div>
                        </div>





                        <div>
                            <div class="form-group">
                                <label for="Location">Location</label>
                                <select id="Location" name="Location">
                                  <option value="Anuradhapura">Anuradhapura</option>
                                  <option value="Galle">Galle</option>
                                  <option value="Kandy">Kandy</option>
                                  <option value="Nuwara Eliya">Nuwara Eliya</option>
                                  <option value="Trincomalee">Trincomalee</option>
                                  <option value="Jaffna">Jaffna</option>
                                  <option value="other">other</option>
                                </select>
                            </div>
                            <div  class="form-group">
                                <label for="PackageImages">Package Images:</label>
                                <input type="file" id="PackageImages" name="PackageImages[]" accept="image/*">
                            </div>
                        </div>





                        <div>
                            <div class="form-group">
                                <label for="PackageDescription">Package Description:</label>
                                <textarea id="PackageDescription" name="PackageDescription" rows="4"></textarea>
                            </div>


                        </div>




                        <div >
                            <div class="baseButtons">
                                <button id="cancelBut">Cancel</button>
                                <button id="saveBut" type="submit">Save</button>
                            </div>
                        </div>





                    </form>
                </div>
            </div>


        </div>
    </main>
</body>
</html>
