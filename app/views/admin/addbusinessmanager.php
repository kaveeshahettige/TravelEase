<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/admin/addbusinessmanager.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="<?php echo URLROOT?>/js/admin/script.js"></script>
    <title>TravelEase</title>
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT; ?>/images/admin/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <nav class="left-menu">
        <div class="user-profile">
            <img src="<?php echo URLROOT; ?>/images/admin/wikum.jpg" alt="User Profile Photo">
            <span class="user-name"><?php echo ucfirst($data['fname']) ?></span>
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
            <li><a href="<?php echo URLROOT; ?>admin/settings" class="active"><i class='bx bxs-cog bx-sm'></i> Settings</a></li>
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
            <div><h1 style="font-weight: bold;">Business Managers</h1></div>
        </div>
        
        <div class="main-content">
            <div class="room-container">
            <?php if (!empty($data['manager'])): ?>
                <?php foreach ($data['manager'] as $manager): ?>
                <div class="room-box">
                    <h3><?php echo $manager->id?></h3>
                    <h3><?php echo ucfirst($manager->fname);?></h3>
                    <h3><?php echo $manager->email?></h3>
                    <p>Contact Number : <?php echo $manager->number?></p>
                    <div class="icons">
                        <a href="<?php echo URLROOT; ?>admin/businessmanageredit/<?php echo $manager->id;?>"><i class='bx bx-edit'></i></a> 
                        <a href="<?php echo URLROOT; ?>users/deleteManager/<?php echo $manager->id;?>" onclick="return confirmDelete();"><i class='bx bx-trash'></i></a> 
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>    
                

                <div class="add-room">
                    <a href="<?php echo URLROOT; ?>admin/businessmanageraddform" class="add-room-link">
                        <i class='bx bx-plus-circle' id="add-icon"></i>  
                        <p>Add New Business Manager</p>
                    </a>
                </div>
            
            </div>
           
            
        </div>
    </main>
</body>
</html>
