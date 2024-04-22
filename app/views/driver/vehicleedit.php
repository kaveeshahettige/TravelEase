<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/driver/vehicleedit.css">
    <title><?php echo SITENAME ?></title>
    <link rel="icon" type="image/x-icon" href="../Images/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
</head>

<body>
    <nav class="left-menu">
        <div class="user-profile">
        <img src="<?php echo URLROOT; ?>/images/<?php echo $data['profileimage']->profile_picture ?>" alt="User Profile Photo">
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
            <li><a href="<?php echo URLROOT; ?>driver/calender"><i class='bx bxs-book bx-sm'></i> Availabily
                    Calender</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/bookings"><i class='bx bxs-package bx-sm'></i></i> Bookings</a>
            </li>
            <li><a href="<?php echo URLROOT; ?>driver/vehicle" class="active"><i class='bx bxs-car bx-sm'></i> Vehicle
                    Informaion </a></li>
            <li><a href="<?php echo URLROOT; ?>driver/earings"><i class='bx bx-money-withdraw bx-sm'></i>Earings and
                    Payments</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/notification"><i class='bx bxs-bell bx-sm'></i>Notification</a>
            </li>
            <li><a href="<?php echo URLROOT; ?>driver/reviews"><i class='bx bxs-star bx-sm bx-fw'></i> Reviews</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/settings"><i class='bx bxs-cog bx-sm'></i> Settings</a></li>
            <li><a href="<?php echo URLROOT?>users/logout" class="active"><i class='bx bxs-log-out bx-sm bx-fw'></i>
                    Logout</a></li>
        </ul>

        <!-- <div class="logout">
            <a href="#" class="active"><i class='bx bxs-log-out bx-sm bx-fw'></i>  Logout</a>
        </div> -->
    </nav>
    <main>
        <div class="logo-container">
            <img src="<?php echo URLROOT; ?>/images/driver/TravelEase.png" alt="TravelEase Logo">
            <span class="logo-text">TravelEase</span>
        </div>
        <div class="dashboard-content">
            <div>
                <h1>Update Vehicle info</h1>
            </div>





            <div id="base">
                <div id="form">
                    <form class="registration-form" method="POST" enctype="multipart/form-data">



                        <h2>Change Vehicle images</h2>



                        <div class="container">
                            <div class="uploadContainer">
                                <div class="imagePreview" id="imagePreview1">
                                    <img src="<?php echo URLROOT; ?>/images/<?php echo $data['image']; ?>"
                                        alt="Main Image Preview">
                                </div>
                                <label for="image" class="uploadButton">Main Image</label>
                                <input type="file" id="image" name="image" class="imageUpload" accept="image/*">
                            </div>

                            <div class="uploadContainer">
                                <div class="imagePreview" id="imagePreview2">
                                    <img src="<?php echo URLROOT; ?>/images/<?php echo $data['vehi_img2']; ?>"
                                        alt="Front Image Preview">
                                </div>
                                <label for="vehi_img2" class="uploadButton">Front Image</label>
                                <input type="file" id="vehi_img2" name="vehi_img2" class="imageUpload" accept="image/*">
                            </div>

                            <div class="uploadContainer">
                                <div class="imagePreview" id="imagePreview3">
                                    <img src="<?php echo URLROOT; ?>/images/<?php echo $data['vehi_img3']; ?>"
                                        alt="Rear Image Preview">
                                </div>
                                <label for="vehi_img3" class="uploadButton">Rear Image</label>
                                <input type="file" id="vehi_img3" name="vehi_img3" class="imageUpload" accept="image/*">
                            </div>

                            <div class="uploadContainer">
                                <div class="imagePreview" id="imagePreview4">
                                    <img src="<?php echo URLROOT; ?>/images/<?php echo $data['vehi_img4']; ?>"
                                        alt="Side Image Preview">
                                </div>
                                <label for="vehi_img4" class="uploadButton">Side Image</label>
                                <input type="file" id="vehi_img4" name="vehi_img4" class="imageUpload" accept="image/*">
                            </div>


                        </div>

                        

                        <label for="description">Description :</label>
                        <textarea id="description" name="description"
                            rows="4"><?php echo $data['description']; ?></textarea>





                        <h2>Pricing</h2>
                        <div id="with_driver_fields">
                            <h3>With Driver Pricing:</h3>
                            <div class="form-group">
                                <label for="withDriverPerDayr">Per Day Price (LKR)*:</label>
                                <input type="number" id="withDriverPerDay" name="withDriverPerDay" min="0"
                                    value="<?php echo $data['withDriverPerDay']; ?>">
                            </div>
                        </div>

                        <div id="without_driver_fields">
                            <h3>Without Driver Pricing:</h3>
                            <div class="form-group">
                                <label for="priceperday">Per Day Price (LKR)*:</label>
                                <input type="number" id="priceperday" name="priceperday" min="0"
                                    value="<?php echo $data['priceperday']; ?>">
                            </div>
                        </div>







                        <h2>Extras</h2>
                        <div class="checkbox-group">
                            <div class="row">
                                <label><input type="checkbox" name="ac_type"
                                        <?php if ($data['ac_type'] == 1) echo 'checked'; ?>> AC</label>
                                <label><input type="checkbox" name="airbag"
                                        <?php if ($data['airbag'] == 1) echo 'checked'; ?>> Airbag</label>
                                <label><input type="checkbox" name="nav"
                                        <?php if ($data['nav'] == 1) echo 'checked'; ?>> NAV</label>
                                <label><input type="checkbox" name="tv" <?php if ($data['tv'] == 1) echo 'checked'; ?>>
                                    TV</label>
                                <label><input type="checkbox" name="usb"
                                        <?php if ($data['usb'] == 1) echo 'checked'; ?>> USB</label>
                            </div>
                        </div>











                        <p>If the vehicle owner name on the vehicle documents is different from mine, then I
                            hereby confirm that I have the vehicle owner's consent to drive this vehicle on the
                            TravelEase Platform. This declaration can be treated as a No-Objection Certificate
                            and releases TravelEase from any legal obligations and consequences.</p>

                        <div class="baseButtons">
                            <button id="saveBut" type="submit" name="submit" value="Upload">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>


        </div>
    </main>
</body>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.imageUpload').forEach(function(input) {
        input.addEventListener('change', function(event) {
            var file = event.target.files[0];
            var reader = new FileReader();
            var preview = event.target.parentElement.querySelector('.imagePreview');

            reader.onload = function(e) {
                preview.style.backgroundImage = 'url(' + e.target.result + ')';
            };

            reader.readAsDataURL(file);
        });
    });
});


    </script>


</html>