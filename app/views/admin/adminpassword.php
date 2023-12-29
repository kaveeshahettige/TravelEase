<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/admin/adminpassword.css">
    
    <title>Admin-Password</title>
    <link rel="icon" type="image/x-icon" href="../Images/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <nav class="left-menu">
        <div class="user-profile">
            <img src="<?php echo URLROOT; ?>/images/admin/wikum.jpg" alt="User Profile Photo">
            <span class="user-name">Admin</span>
        </div>
        
        <div class="search-bar">
            <form action="#" method="GET">
                <input type="text" placeholder="Find a Setting">
                <button type="submit">Search</button>
            </form>
        </div>
        
            
        <ul>
        <li><a href="<?php echo URLROOT; ?>admin/index" ><i class='bx bxs-dashboard bx-sm'></i> Overview</a></li>
            <li><a href="<?php echo URLROOT; ?>admin/request" ><i class='bx bxs-book bx-sm'></i> Request</a></li>
            <li><a href="<?php echo URLROOT; ?>admin/traveler" ><i class='bx bx-child bx-sm'></i></i> Traveler</a></li>

            <li><a href="<?php echo URLROOT; ?>admin/hotel"><i class='bx bxs-hotel bx-sm'></i></i> Hotels</a></li>
            <li><a href="<?php echo URLROOT; ?>admin/agency"><i class='bx bxs-car bx-sm'></i> Travel Agencies </a></li>
            <li><a href="<?php echo URLROOT; ?>admin/package"><i class='bx bx-package bx-sm'></i>Packages</a></li>
            <li><a href="<?php echo URLROOT; ?>admin/settings"class="active"><i class='bx bxs-cog bx-sm'></i> Settings</a></li>
        </ul>  
        
        
        <div class="logout">
            <a href="<?php echo URLROOT?>users/logout" class="active"><i class='bx bxs-log-out bx-sm bx-fw'></i>  Logout</a>
        </div>
    </nav>
    <main>
        <div class="logo-container">
            <img src="../Images/TravelEase.png" alt="TravelEase Logo">
            <span class="logo-text">TravelEase</span>
        </div>
        <div class="dashboard-content">
            <div><h1>Settings</h1> </div>
             
            <div id="base">
                <h3 style="padding-left:20px;">Password</h3>
                <div id="form">
                    <form class="registration-form" method="POST" action="<?php echo URLROOT?>/admin/adminpassword">
                        <div>
                            <div class="form-group">
                                <label for="current-password">Current Password</label>
                                <input type="password" id="current-password" name="current-password" placeholder="Current Password" <?php echo (!empty($data['current-password_err'])) ? 'is-invalid' : ''; ?>required>
                                <span class="invalid-feedback"><?php echo $data['current-password_err']; ?></span>
                            </div>
                            <div>
                                
                            </div>
                        </div>
                        

                        <div>
                            <div class="form-group">
                                <label for="passowrd">New Password</label>
                                <input type="password" id="new-password" name="new-password" placeholder="New Password" <?php echo (!empty($data['new-password_err'])) ? 'is-invalid' : ''; ?> >
                                <span class="invalid-feedback"><?php echo $data['new-password_err']; ?></span>
                                
                            </div>                            
                        </div>

                        <div>
                            <div class="form-group">
                                <label for="password">Confirm Password</label>
                                <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm Password"  <?php echo (!empty($data['confirm-password_err'])) ? 'is-invalid' : ''; ?>>
                                <span class="invalid-feedback"><?php echo $data['confirm-password_err']; ?></span>
                            </div>                            
                        </div>

                        <div >
                            <div class="baseButtons">
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
