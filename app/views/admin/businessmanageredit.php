<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/admin/addbusinessedit.css">
    <title>Edit Business Manager</title>
    <link rel="icon" type="image/x-icon" href= "<?php echo URLROOT; ?>/images/TravelEase_logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <nav class="left-menu">
        <div class="user-profile">
            <img src="<?php echo URLROOT; ?>/images/admin/wikum.jpg" alt="User Profile Photo">
            <span class="user-name"><?php echo ucfirst($data['afname'])?></span>
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
            <li><a href="<?php echo URLROOT; ?>admin/package"><i class='bx bx-package bx-sm'></i>Guide</a></li>
            <li><a href="<?php echo URLROOT; ?>admin/settings"class="active"><i class='bx bxs-cog bx-sm'></i> Settings</a></li>
            <li><a href="<?php echo URLROOT; ?>users/logout"class="active"><i class='bx bxs-log-out bx-sm bx-fw'></i> Logout</a></li>

        </ul>  
        
        
        <div class="logout">
            <a href="<?php echo URLROOT?>users/logout" class="nav-button active"><i class='bx bxs-log-out bx-sm bx-fw'></i>  Logout</a>
        </div>
    </nav>
    <main>
        <div class="logo-container">
            <img src="<?php echo URLROOT; ?>/images/admin/TravelEase.png" alt="TravelEase Logo">
            <span class="logo-text">TravelEase</span>
        </div>
        <div class="dashboard-content">
            <div><h1>Settings</h1> </div>
             
            <div id="base">
                <h3 style="padding-left:20px;">Basic Info</h3>
                <div id="form">
                    <form class="registration-form" method="POST" action="<?php echo URLROOT?>/admin/businessmanageredit/<?php echo $data['id']; ?>" >
                        <div>
                            <div class="form-group">
                                <label for="First Name">Business Manager Name</label>
                                <input type="text" id="business-manager-name" name="fname"  value="<?php echo $data['fname'];?>" required>
                            </div>
                         
                        </div>

                        <div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" value="<?php echo $data['email'];?>" required>
                            </div>
                        
                            <div class="form-group">
                                <label for="phonenumber">Phone Number</label>
                                <input type="text" id="phone-number" name="number" value="<?php echo $data['number'];?>" required>
                            </div>
                        </div>

                        

                        <div>
                            <!-- <div class="form-group">
                                <label for="passowrd">Password</label>
                                <input type="password" id="password" name="password" placeholder="Password" >
                            </div>

                            <div class="form-group">
                                <label for="confirm-passowrd">Confirm Password</label>
                                <input type="password" id="confirm-passowrd" name="confirm_password" placeholder="Confirm Passowrd" >
                            </div> -->

                        </div>

                        <div >
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
