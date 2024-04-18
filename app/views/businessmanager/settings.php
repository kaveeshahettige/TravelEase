<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/businessmanager/manager-settings.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/businessmanager/navigation.css">
    <title>Business Manager Settings</title>
    <link rel="icon" type="<?php echo URLROOT?>/images/x-icon" href="<?php echo URLROOT?>/images/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<?php
$activePage = 'businessmanager/settings'; // Set the active page dynamically based on your logic
include 'navigation.php';
?>
    <main>
        <div class="logo-container">
            <img src="<?php echo URLROOT?>/images/TravelEase.png" alt="TravelEase Logo">
            <span class="logo-text">TravelEase</span>
        </div>
        
        <div class="dashboard-content">
            <h1>Settings</h1>
        </div>

        <div class="dashboard-subcontent">
        <div class="content-container">
            <div class="left-content">

                <div class="rectangle">

                    <?php
                    $profilePicture = $data["profilePicture"];
//                    var_dump($profilePicture);
                    ?>

                    <div class="basic-info-content">
                        <div class="center-image" onclick="openPopup()">
                            <img id="profile-picture" src="<?= isset($profilePicture->profile_picture) ? $profilePicture->profile_picture : '../Images/wikum.jpg'; ?>" alt="User Profile Photo">
                            <div class="edit-icon">&#9998;</div>
                        </div>
                    </div>


                    <div class="hotel-details">
                            <h3><?=$_SESSION['user_fname']?></h3>
                            <h6>Contact Number</h6>
                            <p><?=$_SESSION['user_number']?></p>
                            <h6>Email</h6>
                            <p><?=$_SESSION['user_email']?></p>
<!--                            <h6>Location</h6>-->
<!--                            <p>--><?php //=$hotelData->add ?><!-- </p>-->
                    </div>

                        <a href="<?php echo URLROOT; ?>businessmanager/businessmanageredit">
                            <button class="edit-button">Edit</button>
                        </a>

                    <div id="profile-picture-form" class="popup">
                        <div class="popup-content">
                            <span class="close-icon" onclick="closePopup()">&times;</span>
                            <form method="POST" action="<?php echo URLROOT; ?>/businessmanager/changeProfilePicture" enctype="multipart/form-data">
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
                    <div class="basic-info-content">
                        <h2>Change Password</h2>
                        <a href="<?php echo URLROOT; ?>businessmanager/businessmanagerpassword">
                            <button  class ="edit-button">Edit</button>
                        </a>
                    </div>
                </div>

        </div>

            <div class="right-content">

                <div class="rectangle">
                    <!-- Rectangle 1: Image Slideshow -->
                    <img class="slideshow-image" src="<?php echo URLROOT?>/images/hotel/bm-01.jpg" alt="Image 1">
                </div>

                <div class="rectangle">
                    <div class="basic-info-content">
                        <h2>Profile Deletion</h2>
                        <a href="<?php echo URLROOT; ?>businessmanager/hoteledit">
                            <button class ="delete-button">Delete</button></a>
                    </div>
                </div>

           </div>
                



    </div>
    </main>
</body>
</html>
