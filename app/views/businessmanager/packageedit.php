<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/businessmanager/package-edit.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/businessmanager/navigation.css">
    <title>Package Edit</title>
    <link rel="icon" type="image/x-icon" href="../Images/TravelEase.png">
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
             
            <div id="base">
                <h3 style="padding-left:20px;">Add Rooms</h3>
                <div id="form">
                    <form class="registration-form">
                        <div>
                            <div class="form-group">
                                <label for="roomType">Room Type</label>
                                <select id="roomType" name="roomType">
                                  <option value="standard">Standard</option>
                                  <option value="deluxe">Deluxe</option>
                                  <option value="suite">Suite</option>
                                  <option value="other">Other</option>
                                </select>
                            </div>
                        
                            <div class="form-group">
                                <label for="numOfBeds">Number of Beds</label>
                                <select id="numOfBeds" name="numOfBeds">
                                  <option value="1">1 Bed</option>
                                  <option value="2">2 Beds</option>
                                  <option value="3">3 Beds</option>
                                  <option value="4">4 Beds</option>
                                </select>
                            </div>
                        </div>
                        

                        <div>
                            <div class="form-group">
                                <label for="price">Price (per night)</label>
                                <input type="number" id="price" name="price" required>
                            </div> 
                            <div  class="form-group">
                                <label for="roomImages">Room Images:</label>
                                <input type="file" id="roomImages" name="roomImages[]" accept="image/*" multiple required>
                            </div>                           
                        </div>

                        <div>
                            
                            <div class="form-group">
                                <label for="current-password">Current Password</label>
                                <input type="text" id="current-password" name="current-password" placeholder="Current Password" required>
                            </div>                            
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
