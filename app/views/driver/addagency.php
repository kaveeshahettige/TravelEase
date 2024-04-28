<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/driver/settingssub.css">
    <script src="<?php echo URLROOT; ?>/public/js/hotel/popup.js"></script>
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/popup.css">
    <title><?php echo SITENAME ?></title>
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT; ?>/images/driver/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <nav class="left-menu">
        <div class="user-profile">
            <img src="<?php echo URLROOT; ?>/images/<?php echo $data['profileimage']->profile_picture ?>" alt="User Profile Photo">
            <span class="user-name"><?php echo $_SESSION['user_fname'].' '.$_SESSION['user_lname']?></span>
            <a class="" href="<?php echo URLROOT; ?>/driver/notification">
    <i class="bx bx-bell"></i>
</a>
        </div>

        <div class="search-bar">
            <form action="#" method="GET">
                <input type="text" placeholder="Find a Setting">
                <button type="submit">Search</button>
            </form>
        </div>

        <ul>
            <li><a href="<?php echo URLROOT; ?>driver/index" class="active"><i class='bx bxs-dashboard bx-sm'></i> Overview</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/calender"><i class='bx bxs-book bx-sm'></i> Availability Calendar</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/bookings"><i class='bx bxs-package bx-sm'></i> Bookings</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/vehicle"><i class='bx bxs-car bx-sm'></i> Vehicle Information</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/earings"><i class='bx bx-money-withdraw bx-sm'></i> Earnings and Payments</a></li>
            
            <li><a href="<?php echo URLROOT; ?>driver/notification"><i class='bx bxs-bell bx-sm'></i> Notification</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/reviews"><i class='bx bxs-star bx-sm bx-fw'></i> Reviews</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/settings"><i class='bx bxs-cog bx-sm'></i> Settings</a></li>
        </ul>

        <li> <a href="#" class="nav-button active" onclick="confirmLogout(event)"><i class='bx bxs-log-out bx-sm bx-fw'></i> Logout</a></li>
    </nav>

    <main>
        <div class="logo-container">
            <img src="../Images/TravelEase.png" alt="TravelEase Logo">
            <span class="logo-text">TravelEase</span>
        </div>
        <div class="dashboard-content">
            <div>
                <h1>Travel Agency Registration</h1>
            </div>

            <div id="baseAgency">
                <h2 style="padding-left:20px;">Agency Details</h2>
                <div id="formAgency">
                <form class="registerForm" method="POST" action="<?php echo URLROOT; ?>/driver/addagency/<?php echo $_SESSION['user_id']; ?>" onsubmit="return validateForm();">

                        <div>
                            <div class="form-group">
                                <label for="manager_name">Manager Name</label>
                                <input type="text" id="manager_name" name="manager_name" required>
                            </div>
                            <div class="form-group">
                                <label for="reg_number">Registration Number</label>
                                <input type="text" id="reg_number" name="reg_number" required>
                            </div>
                        </div>

                        <div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" id="address" name="address" required>
                            </div>

                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" id="city" name="city" required>
                            </div>
                        </div>

                        <div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" id="description" name="description" required>
                            </div>
                        </div>

                        <h2 style="padding-left:20px;">Bank Details</h2>
                        <p>Please enter the following bank details</p><br>

                        <div>
                            <div class="form-group">
                                <label for="card_holder_name">Card Holder Name</label>
                                <input type="text" id="card_holder_name" name="card_holder_name" required>
                            </div>
                            <div class="form-group">
                                <label for="account_number">Bank Account Number</label>
                                <input type="text" id="account_number" name="account_number" required>
                            </div>
                        </div>

                        <h2 style="padding-left:20px;">Social Media Details</h2>
                        <p>Share your agency's online presence by providing the following social media details</p><br>

                        <div>
                            <div class="form-group">
                                <label for="website">Website</label>
                                <input type="url" id="website" name="website" >
                            </div>
                            <div class="form-group">
                                <label for="facebook">Facebook</label>
                                <input type="url" id="facebook" name="facebook" >
                            </div>
                        </div>

                        <div>
                            <div class="form-group">
                                <label for="twitter">Twitter</label>
                                <input type="url" id="twitter" name="twitter" >
                            </div>
                            <div class="form-group">
                                <label for="instagram">Instagram</label>
                                <input type="url" id="instagram" name="instagram" >
                            </div>
                        </div>

                        <div class="baseButtons">
                            <button id="cancelBut">Cancel</button>
                            <button id="saveBut" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.getElementById('cancelBut').addEventListener('click', function() {
            window.history.back(); // Navigate back in the browser's history
        });
   
    function validateCardNumber() {
        var cardNumber = document.getElementById('account_number').value;
        
        // Remove spaces and dashes from the card number
        var cleanedCardNumber = cardNumber.replace(/[\s-]/g, '');

        // Check if the card number is numeric and has a valid length
        if (/^\d{13,16}$/.test(cleanedCardNumber)) {
            return true; // Card number is valid
        } else {
            alert('Please enter a valid bank account number.'); // Show error message
            return false; // Card number is invalid
        }
    }
</script>

<!-- Include this JavaScript function call in your form -->
<form class="registerForm" method="POST" action="<?php echo URLROOT; ?>/driver/addagency/<?php echo $_SESSION['user_id']; ?>" onsubmit="return validateCardNumber();">
    <!-- Your form fields here -->
</form>

</body>

</html>
