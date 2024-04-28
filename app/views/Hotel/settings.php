<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/settings.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/navigation.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/popup.css">
    <script src="<?php echo URLROOT; ?>/public/js/hotel/popup.js"></script>
    <title>Hotel Settings</title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/hotel/x-icon" href="<?php echo URLROOT; ?>/images/hotel/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<?php
$activePage = 'hotel/settings'; 
include 'navigation.php';
?>
    <main>
        <div class="logo-container">
            <img src="<?php echo URLROOT?>/images/hotel/TravelEase.png" alt="TravelEase Logo">
            <span class="logo-text">TravelEase</span>
        </div>

        <div class="dashboard-content">
            <h1>Settings</h1>
        </div>

        <div class="settings-subcontent">
        <div class="content-container">
            <div class="left-content">

                <div class="rectangle">
                    <?php
////                    $userData = $data;
//                    $hotelData = $data2['hotelData'];
                    /**
                     * @param stdClass $add
                     * @param stdClass $profile_picture
                     *
                     * **/


                    $hotelData= $data['basicInfo']['hotelData'];
                    $userData= $data['basicInfo']['userData'];
//                    var_dump($hotelData);
//                    var_dump($userData);
                    $profile_picture = $userData->profile_picture;
                    ?>
                    <!-- Rectangle 1: Basic Info -->
                    <div class="basic-info-content">
                        <div class="center-image" onclick="openPopup()">
                            <img id="profile-picture" src="<?= isset($userData->profile_picture) ? '../public/images/' . $userData->profile_picture : '../images/profile.png'; ?>" alt="User Profile Photo">
                            <div class="edit-icon">&#9998;</div>
                        </div>

                        <div class="hotel-details">
                            <h3><?=($userData->fname)?></h3>
                            <h6>Hotel Type</h6>
                            <p><?=($hotelData->hotel_type)?></p>
                            <h6>Contact Number</h6>
                            <p><?=($userData->number)?></p>
                            <h6>Email</h6>
                            <p><?=($userData->email)?></p>
                            <h6>Location</h6>
                            <p><?=$hotelData->addr ?> </p>
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
                    <div class="basic-info-content">
                        <h2>Change Password</h2>
                            <a href="<?php echo URLROOT; ?>hotel/hotelpassword">
                                <button  class ="edit-button">Edit</button>
                            </a>
                    </div>
                </div>

                <!-- Assuming this is your 'hotel/settings' view file -->
                <?php
//                var_dump($data['verificationStatus']);
                ?>
                <div class="rectangle">
                    <div class="basic-info-content">
                        <h2>Insert Service Validations</h2>
                        <?php if ($data['verificationStatus'] === 0):                            ?>
                            <p style="color: orange;">Add your verification documents</p>
                        <?php elseif ($data['verificationStatus'] === 1): ?>
                            <p style="color: #2189ff;">Yet to be approved</p>
                        <?php elseif ($data['verificationStatus'] === 2): ?>
                            <p style="color: green;">Congratulations! Your verification has been approved</p>
                        <?php elseif ($data['verificationStatus'] === 3): ?>
                            <p style="color: red;">Your verification has been rejected</p>
                        <?php endif; ?>
                        <a href="<?php echo URLROOT; ?>hotel/hotelvalidation">
                            <button class="edit-button">Insert</button>
                        </a>
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
                            <p><?php echo $data['roomCount']; ?></p>
                        </div>
                        <a href="<?php echo URLROOT; ?>hotel/addrooms">
                            <button  class ="edit-button">Add</button>
                        </a>
                    </div>
                </div>

                <div class="rectangle">
                    <div class="basic-info-content">
                        <h2>Profile Deletion</h2>
                            <button class ="delete-button" onclick="onDeleteClick(event,<?= $_SESSION['user_id'] ?>)">Delete</button>
                    </div>
            </div>

        </div>

        </div>
    </div>
    </main>
</body>
</html>
