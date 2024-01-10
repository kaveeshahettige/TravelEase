<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/settings.css">    <title>Hotel Settings</title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/hotel/x-icon" href="<?php echo URLROOT; ?>/images/hotel/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <nav class="left-menu">
        <div class="user-profile">
            <img src="<?= isset($_SESSION['user_profile_picture']) ? $_SESSION['user_profile_picture'] : '../Images/wikum.jpg'; ?> " alt="User Profile Photo">
            <span class="user-name"><?=$_SESSION['user_fname']?></span>
        </div>

        <div class="search-bar">
            <form action="#" method="GET">
                <input type="text" placeholder="Find a Setting">
                <button type="submit">Search</button>
            </form>
        </div>

        <ul>
            <li><a href="<?php echo URLROOT; ?>hotel/index" class="nav-button "><i class='bx bxs-info-circle bx-tada-hover bx-sm bx-fw'></i> Dashboard</a></li>
            <li><a href="<?php echo URLROOT; ?>hotel/bookings" class="nav-button "><i class='bx bxs-book bx-sm bx-fw'></i> Bookings</a></li>
            <li><a href="<?php echo URLROOT; ?>hotel/calender" class="nav-button "><i class='bx bxs-calendar bx-sm bx-fw'></i> Availability</a></li>
            <li><a href="<?php echo URLROOT; ?>hotel/gallery" class="nav-button "><i class='bx bx-images bx-sm bx-fw'></i> Notifications</a></li>
            <li><a href="<?php echo URLROOT; ?>hotel/revenue" class="nav-button "><i class='bx bxs-wallet bx-sm bx-fw'></i> Revenue</a></li>
            <li><a href="<?php echo URLROOT; ?>hotel/reviews" class="nav-button "><i class='bx bxs-star bx-sm bx-fw'></i> Reviews</a></li>
            <li><a href="<?php echo URLROOT; ?>hotel/settings" class="nav-button active"><i class='bx bxs-cog bx-sm bx-fw'></i> Settings</a></li>
        </ul>

        <div class="logout">
            <a href="<?php echo URLROOT?>users/logout" class="nav-button active"><i class='bx bxs-log-out bx-sm bx-fw'></i>  Logout</a>
        </div>
    </nav>
    <main>
        <div class="logo-container">
            <img src="<?php echo URLROOT?>/images/hotel/TravelEase.png" alt="TravelEase Logo">
            <span class="logo-text">TravelEase</span>
        </div>

        <div class="dashboard-content">
            <h1>Settings</h1>
        </div>

        <div class="dashboard-subcontent">
        <div class="content-container">
            <div class="left-content">

                <div class="rectangle">
                    <!-- Rectangle 1: Basic Info -->
                    <div class="basic-info-content">
                        <div class="center-image" onclick="openPopup()">
                            <img id="profile-picture" src="<?= isset($_SESSION['user_profile_picture']) ? $_SESSION['user_profile_picture'] : '../Images/wikum.jpg'; ?>" alt="Profile Picture">
                            <div class="edit-icon">&#9998;</div>
                        </div>
                        <div class="hotel-details">
                            <h3><?=$_SESSION['user_fname']?></h3>
                            <h6>Contact Number</h6>
                            <p><?=$_SESSION['user_number']?></p>
                            <h6>Email</h6>
                            <p><?=$_SESSION['user_email']?></p>
                            <h6>Location</h6>
                        </div>
                        <a href="<?php echo URLROOT; ?>hotel/hoteledit">
                            <button class="edit-button">Edit</button>
                        </a>
                    </div>
                    <!-- Profile Picture Change Popup -->
                    <div id="profile-picture-form" class="popup">
                        <div class="popup-content">
                            <span class="close-icon" onclick="closePopup()">&times;</span>
                            <form method="POST" action="<?php echo URLROOT; ?>/hotel/changeProfilePicture" enctype="multipart/form-data">
                                <p>Change Profile Picture:</p>
                                <input type="file" name="profile-picture" accept="image/*" required>
                                <button type="submit">Upload</button>
                                <button type="button" onclick="closePopup()">Cancel</button>
                            </form>
                        </div>
                    </div>
                    <!-- JavaScript to handle the popup and image update -->
                    <script>
                        function openPopup() {
                            var formPopup = document.getElementById("profile-picture-form");
                            formPopup.style.display = "flex";
                        }

                        function closePopup() {
                            var formPopup = document.getElementById("profile-picture-form");
                            formPopup.style.display = "none";
                        }
                    </script>
                </div>







                <div class="rectangle">
                    <!-- Rectangle 2: Change Password -->
                    <div class="basic-info-content">
                        <h2>Change Password</h2>
                        <!-- Add change password form here -->
                            <a href="<?php echo URLROOT; ?>hotel/hotelpassword">
                                <button  class ="edit-button">Edit</button>
                            </a>
                    </div>
                </div>

                <div class="rectangle">
                    <!-- Rectangle 3: Service Validation -->
                    <div class="basic-info-content">
                        <h2>Service Validation</h2>
                        <form class="service-validation-form" method="POST" action="<?php echo URLROOT; ?>/hotel/processServiceValidation" enctype="multipart/form-data">
                            <p>Submit a PDF for Service Validation:</p>
                            <input type="file" id="service-validation-pdf" name="service-validation-pdf" accept=".pdf" required>
                            <button class="edit-button" type="submit">Submit</button>
                        </form>
                    </div>
                </div>


            </div>

            <div class="right-content">

                <div class="rectangle">
                    <!-- Rectangle 1: Image Slideshow -->
                    <img class="slideshow-image" src="<?php echo URLROOT?>/images/hotel/hotel-01.jpg" alt="Image 1">
                </div>


                <div class="rectangle">

                    <!-- Rectangle 2: Rooms Allocated -->
                    <div class="basic-info-content">
                        <div class="hotel-details">
                            <h2>Rooms Allocated</h2>
                            <h6>No.of Rooms</h6>
                            <?php
                            $roomCount = $data;
                            //                print_r($data);
                            ?>
                            <p><?php echo $roomCount['roomCount']; ?></p>
                        </div>
                        <a href="<?php echo URLROOT; ?>hotel/addrooms">
                            <button  class ="edit-button">Add</button>
                        </a>
                    </div>
                </div>

                <div class="rectangle">
                    <!-- Rectangle 3: Profile Deletion -->
                    <div class="basic-info-content">
                        <h2>Profile Deletion</h2>
                        <!-- Add profile deletion option here -->
                        <a href="<?php echo URLROOT; ?>hotel/hoteledit">
                            <button class ="delete-button">Delete</button></a>
                    </div>
            </div>

        </div>

        </div>
    </div>
    </main>
</body>
</html>
