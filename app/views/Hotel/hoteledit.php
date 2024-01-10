<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/settingssub.css">
    <title>Hotel-Edit</title>
    <link rel="icon" type="image/x-icon" href="../Images/TravelEase.png">
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
        <li><a href="<?php echo URLROOT; ?>hotel/settings" class="nav-button active "><i class='bx bxs-cog bx-sm bx-fw'></i> Settings</a></li>

        <div class="logout">
            <a href="<?php echo URLROOT?>users/logout" class="nav-button active"><i class='bx bxs-log-out bx-sm bx-fw'></i>  Logout</a>
        </div>
    </ul>
</nav>
<main>
    <div class="logo-container">
        <img src="../Images/TravelEase.png" alt="TravelEase Logo">
        <span class="logo-text">TravelEase</span>
    </div>
    <div class="dashboard-content">
        <div><h1>Settings</h1> </div>

        <div id="base">
            <h3 style="padding-left:20px;">Basic Info</h3>
            <div id="form">
                <form class="registration-form">
                    <div>
                        <div class="form-group">
                            <label for="hotel-name">Hotel Name</label>
                            <input type="text" id="hotel-name" name="hotel-name" placeholder="Hotel Name" required>
                        </div>
                        <div class="form-group">
                            <label for="hotel-type">Hotel Type</label>
                            <input type="text" id="hotel-type" name="hotel-type" placeholder="Hotel Type" required>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" id="email" name="email" placeholder="email@gmail.com" required>
                        </div>

                        <div class="form-group">
                            <label for="phonenumber">Phone Number</label>
                            <input type="text" id="phone-number" name="phone-number" placeholder="0764532789" required>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="altPhoneNumber">Alternate Phone Number</label>
                            <input type="text" id="altPhoneNumber" name="altPhoneNumber" placeholder="Alternate Phone Number">
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="managerInfo">Manager's Name</label>
                            <input type="text" id="managerInfo" name="managerInfo" placeholder="Manager's name">
                        </div>
                        <div>
                            <div class="form-group">
                                <label for="managerPhonenumber">Manager's Phone Number</label>
                                <input type="text" id="manager-phone-number" name="manager-phone-number" placeholder="0764532789" required>
                            </div>
                        </div>

                    </div>

                    <div>
                        <div class="form-group">
                            <label for="Address">Street Address</label>
                            <input type="text" id="Address" name="Address" placeholder="Address">
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city" placeholder="City">
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="state">Province</label>
                            <input type="text" id="state" name="state" placeholder="Province">
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="website">Website</label>
                            <input type="url" id="website" name="website" placeholder="Hotel Website">
                        </div>
                        <div class="form-group">
                            <label for="facebook">Facebook</label>
                            <input type="url" id="facebook" name="facebook" placeholder="Hotel Facebook">
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="twitter">Twitter Handle</label>
                            <input type="url" id="twitter" name="twitter" placeholder="Twitter Handle">
                        </div>
                        <div class="form-group">
                            <label for="instagram">Instagram Handle</label>
                            <input type="url" id="instagram" name="instagram" placeholder="Instagram Handle">
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="additionalNotes">Additional Comments/Notes</label>
                            <textarea id="additionalNotes" name="additionalNotes" rows="4" placeholder="Any other relevant information or special requests"></textarea>
                        </div>
                    </div>

                    <div>
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
