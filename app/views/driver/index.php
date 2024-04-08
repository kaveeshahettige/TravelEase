<!DOCTYPE html>
<html lang="en">
<head><?php 
var_dump($data);
?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/driver/dashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

    <nav class="left-menu">
        <div class="user-profile">
            <img src="<?php echo URLROOT; ?>/images/driver/wikum.jpg" alt="User Profile Photo">
            <span class="user-name"><?php echo $_SESSION['user_fname'].' '.$_SESSION['user_lname']?></span>
        </div>
        
        <div class="search-bar">
            <form action="#" method="GET">
                <input type="text" placeholder="Find a Setting">
                <button type="submit">Search</button>
            </form>
        </div>
        
        <ul>
            <li><a href="<?php echo URLROOT; ?>driver/index" class="active"><i class='bx bxs-dashboard bx-sm'></i> Overview</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/calender"><i class='bx bxs-book bx-sm'></i> Availabily Calender</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/bookings"><i class='bx bxs-package bx-sm'></i></i> Bookings</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/vehicle"><i class='bx bxs-car bx-sm'></i> Vehicle Informaion </a></li>
            <li><a href="<?php echo URLROOT; ?>driver/earings"><i class='bx bx-money-withdraw bx-sm'></i>Earings and Payments</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/notification"><i class='bx bxs-bell bx-sm'></i>Notification</a></li>
            
            <li><a href="<?php echo URLROOT; ?>driver/reviews"><i class='bx bxs-star bx-sm bx-fw'></i> Reviews</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/settings"><i class='bx bxs-cog bx-sm'></i> Settings</a></li>
            <li><a href="<?php echo URLROOT?>users/logout" class="active"><i class='bx bxs-log-out bx-sm bx-fw'></i> Logout</a></li>
        </ul>
        <!-- <div class="logout">
            <a href="<?php echo URLROOT; ?>pages/indes" class="active"><i class='bx bxs-log-out bx-sm bx-fw'></i>  Logout</a>
        </div> -->
    </nav>
    <div class="logo-container">
        <img src="<?php echo URLROOT; ?>/images/driver/TravelEase.png" alt="TravelEase Logo">
        <span class="logo-text">TravelEase</span>
    </div>
    
    <div class="dashboard-content">
        <h1>Overview</h1>
    </div>

    <div class="dashboard-subcontent">
        <div class="content-container">
            <div class="left-content">
            <div class="rectangle">
    <div class="basic-info-content">
        <div class="center-image">
            <img src="<?php echo URLROOT?>/images/driver/wikum.jpg" alt="Profile Picture" >
        </div>
        <div class="hotel-details">
    <h3><?php echo $_SESSION['user_fname'] . " " . $_SESSION['user_lname'] ?></h3>
    <h6>Contact Number</h6>
    <p><?php echo $_SESSION['user_number'] ?></p>
    <h6>Email</h6>
    <p><?php echo $_SESSION['user_email'] ?></p>
    
        </div>
    </div>
</div>



<div class="rectangle">
        <!-- Display Agency Details -->
        <div class="basic-info-content">
            <h2>Agency Details</h2>
            <?php if (!empty($data['agencyDetails'])) : ?>
                <p>Agency Name: <?php echo $data['agencyDetails']->agency_name; ?></p>
                <p>Registration Number: <?php echo $data['agencyDetails']->reg_number; ?></p>
                <p>Address: <?php echo $data['agencyDetails']->address; ?></p>
                <p>Description: <?php echo $data['agencyDetails']->description; ?></p>
                <p>City: <?php echo $data['agencyDetails']->city; ?></p>
                <p>Website: <?php echo $data['agencyDetails']->website; ?></p>
                <p>Facebook: <?php echo $data['agencyDetails']->facebook; ?></p>
                <p>Twitter: <?php echo $data['agencyDetails']->twitter; ?></p>
                <p>Instagram: <?php echo $data['agencyDetails']->instagram; ?></p>
            <?php else : ?>
                <p>No agency details found.</p>
            <?php endif; ?>

            <!-- Check if there are empty agency fields -->
            <?php if (!empty($data['emptyAgencyFields'])) : ?>
                <h3>Fill in Empty Fields</h3>
                <form method="post" action="">
                    <?php foreach ($data['emptyAgencyFields'] as $field => $value) : ?>
                        <label for="<?php echo $field; ?>"><?php echo ucfirst($field); ?>:</label>
                        <input type="text" id="<?php echo $field; ?>" name="<?php echo $field; ?>" value="<?php echo $value; ?>" required>
                    <?php endforeach; ?>
                    <input type="submit" value="Save">
                </form>
            <?php endif; ?>
        </div>
    </div>







            <div class="rectangle">
                    <!-- Rectangle 3: Service Validation -->
                    <div class="basic-info-content">
                        <h2>Service Validation</h2>
                        <form class="service-validation-form" method="POST" action="<?php echo URLROOT; ?>/driver/process-form" enctype="multipart/form-data">
                            <p>Submit a PDF for Service Validation:</p>
                            <input type="file" id="service-validation-pdf" name="service-validation-pdf" accept=".pdf" required>
                            <button class="edit-button" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
           
                </div>
                </div>
                </div>


                
</body>
</html>
