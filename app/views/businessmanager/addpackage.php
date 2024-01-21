<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/businessmanager/add-package.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/businessmanager/navigation.css">
    <title>Add Package</title>
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
            <div><h1>Settings</h1> </div>
        </div>
        
        <div class="main-content">
            <div class="room-container">
                <div class="room-box">
                    <h3>Package Name</h3>
                    <p>Description of the room goes here.</p>
                    <div class="icons">
                        <a href="<?php echo URLROOT; ?>businessmanager/packageedit"><i class='bx bx-edit'></i></a> 
                        <a href="#"><i class='bx bx-trash'></i></a> 
                    </div>
                </div>

                <div class="room-box">
                    <h3>Package Name</h3>
                    <p>Description of the room goes here.</p>
                    <div class="icons">
                        <a href="<?php echo URLROOT; ?>businessmanager/packageedit"><i class='bx bx-edit'></i></a> 
                        <a href="#"><i class='bx bx-trash'></i></a> 
                    </div>
                </div>

                <div class="room-box">
                    <h3>Package Name</h3>
                    <p>Description of the room goes here.</p>
                    <div class="icons">
                        <a href="<?php echo URLROOT; ?>businessmanager/packageedit"><i class='bx bx-edit'></i></a> 
                        <a href="#"><i class='bx bx-trash'></i></a> 
                    </div>
                </div>

                <div class="room-box">
                    <h3>Package Name</h3>
                    <p>Description of the room goes here.</p>
                    <div class="icons">
                        <a href="<?php echo URLROOT; ?>businessmanager/packageedit"><i class='bx bx-edit'></i></a> 
                        <a href="#"><i class='bx bx-trash'></i></a> 
                    </div>
                </div>

                <div class="room-box">
                    <h3>Package Name</h3>
                    <p>Description of the room goes here.</p>
                    <div class="icons">
                        <a href="<?php echo URLROOT; ?>businessmanager/packageedit"><i class='bx bx-edit'></i></a> 
                        <a href="#"><i class='bx bx-trash'></i></a> 
                    </div>
                </div>

                <div class="add-room">
                    <a href="<?php echo URLROOT; ?>businessmanager/packageedit" class="add-room-link">
                        <i class='bx bx-plus-circle' id="add-icon"></i>  
                        <p>Add New Pacakge</p>
                    </a>
                </div>
            
            </div>
           
            
        </div>
    </main>
</body>
</html>
