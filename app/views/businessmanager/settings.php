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
                    <div class="basic-info-content">
                        <div class="center-image">
                            <img src="<?php echo URLROOT?>/images/wikum.jpg" alt="Profile Picture">
                        </div>
                        <div class="hotel-details">
                            <h3><?=$_SESSION['user_fname']?></h3>
                            <h6>Contact Number</h6>
                            <p><?=$_SESSION['user_number']?></p>
                            <h6>Email</h6>
                            <p><?=$_SESSION['user_email']?></p>
                            <!-- <h6>Location</h6>
                            <p>City, Country</p> -->
                        </div>
                        <a href="<?php echo URLROOT; ?>businessmanager/businessmanageredit">
                        <button class ="edit-button">Edit</button>
                        </a>
                     </div>
                </div>

                
            </div>

            <div class="right-content">
                

                <div class="rectangle">
                    <div class="basic-info-content">
                    <div class="hotel-details">
                        <h2>Pacakge Details</h2>
                        <h6>No. Package Created</h6>
                        <p>5</p>
                    </div>
                        <a href="<?php echo URLROOT; ?>businessmanager/addpackage">  
                        <button  class ="edit-button">Add</button>
                        </a>
                    </div>
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

        </div>
        <div class="rectangle">
            <div class="basic-info-content">
            <h2>Profile Deletion</h2>
            <a href="<?php echo URLROOT; ?>businessmanager/hoteledit">
            <button class ="delete-button">Delete</button></a>
            </div>
        </div>
    </div>
    </main>
</body>
</html>
