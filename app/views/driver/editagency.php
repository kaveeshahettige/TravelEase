<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/driver/settingssub.css">
    <title><?php echo SITENAME ?></title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/driver/x-icon"
        href="<?php echo URLROOT; ?>/images/driver/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <nav class="left-menu">
       <div class="user-profile">
            <img src="<?php echo URLROOT; ?>/images/<?php echo $data['profileimage']->profile_picture ?>" alt="User Profile Photo">
            <span class="user-name"><?php echo $_SESSION['user_fname'].' '.$_SESSION['user_lname']?></span>
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
            <li><a href="<?php echo URLROOT; ?>driver/vehicle"><i class='bx bxs-car bx-sm'></i> Vehicle Informaion </a>
            </li>
            <li><a href="<?php echo URLROOT; ?>driver/earings"><i class='bx bx-money-withdraw bx-sm'></i>Earings and
                    Payments</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/notification"><i class='bx bxs-bell bx-sm'></i>Notification</a>
            </li>
            <li><a href="<?php echo URLROOT; ?>driver/reviews"><i class='bx bxs-star bx-sm bx-fw'></i> Reviews</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/settings" class="active"><i class='bx bxs-cog bx-sm'></i>
                    Settings</a></li>
            <li><a href="<?php echo URLROOT?>users/logout" class="active"><i class='bx bxs-log-out bx-sm bx-fw'></i>
                    Logout</a></li>
        </ul>

        
    </nav>

    <main>

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
                <form class="registration-form" method="POST" action="<?php echo URLROOT; ?>/driver/edituser/<?php echo $_SESSION['user_id']; ?>">
                <div>
                    

                        <div class="form-group">
                            <label for="fname">First Name</label>
                            <input type="text" id="fname" name="fname" placeholder="fname" value="<?php echo $data['userDetails']->fname; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="reg_number">Last Name</label>
                            <input type="text" id="lname" name="lname" placeholder="lname" value="<?php echo$data['userDetails']->lname; ?>" required>
                        </div>
                    </div>
                    <div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" id="email" name="email" placeholder="email@gmail.com" value="<?php echo $data['userDetails']->email; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="number">Phone Number</label>
                            <input type="text" id="number" name="number" placeholder="0764532789" value="<?php echo $data['userDetails']->number; ?>" required>
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


        <div id="baseAgency">

            <h3 style="padding-left:20px;">Agency Details</h3>
            <div id="formAgency">
                <form class="registerForm" method="POST" action="<?php echo URLROOT; ?>/driver/editagency/<?php echo $_SESSION['user_id']; ?>">

                <div>
                        <div class="form-group">
                            <label for="agency_name">Agency Name</label>
                            <input type="text" id="agency_name" name="agency_name" placeholder="agency_name" value="<?php echo $data['agencyDetails']->agency_name; ?>">
                        </div>
                        <div class="form-group">
                            <label for="reg_number">Registration Number</label>
                            <input type="text" id="reg_number" name="reg_number" placeholder="reg_number" value="<?php echo $data['agencyDetails']->reg_number; ?>">
                        </div>
                    </div>

                    <div>
                    <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" id="address" name="address" placeholder="address" value="<?php echo $data['agencyDetails']->address; ?>" required>
                        </div>
                        
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" id="city" name="city" placeholder="city" value="<?php echo $data['agencyDetails']->city; ?>" required>
                            </div>
                        
                    </div>

                    <div>
                       
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" id="description" name="description" placeholder="description" value="<?php echo $data['agencyDetails']->description; ?>">
                        </div>
                    </div>

                   

                    <div>
                        <div class="form-group">
                            <label for="website">Website</label>
                            <input type="url" id="website" name="website" placeholder="Agency Website" value="<?php echo $data['agencyDetails']->website; ?>">
                        </div>
                        <div class="form-group">
                            <label for="facebook">Facebook</label>
                            <input type="url" id="facebook" name="facebook" placeholder="Agency Facebook" value="<?php echo $data['agencyDetails']->facebook; ?>">
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="twitter">Twitter Handle</label>
                            <input type="url" id="twitter" name="twitter" placeholder="Twitter Handle" value="<?php echo $data['agencyDetails']->twitter; ?>">
                        </div>
                        <div class="form-group">
                            <label for="instagram">Instagram Handle</label>
                            <input type="url" id="instagram" name="instagram" placeholder="Instagram Handle" value="<?php echo $data['agencyDetails']->instagram; ?>">
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

    </main>
</body>
</html>