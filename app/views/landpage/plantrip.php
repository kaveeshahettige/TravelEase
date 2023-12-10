<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>TraveleEase Landpage</title>
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT?>images/TravelEase_logo.png">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/landpage/plantrip.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <script src="./script.js"></script>
    <style>

    </style>
</head>
<body>
    
    <div class="navbar">
        <div class="logo">
            <img src="<?php echo URLROOT?>images/TravelEase_logo.png" alt="Logo">
            <label for="logoname">Travel<span style="color: #458A9E;">Ease</span> </label>
        </div>
        <ul>
            <li><a href="<?php echo URLROOT?>Landpage">Home</a></li>
            <li><a href="<?php echo URLROOT?>Landpage/hotel">Hotels</a></li>
            <li><a href="<?php echo URLROOT?>Landpage/transport">Transport Providers</a></li>
            <li><a href="<?php echo URLROOT?>Landpage/package">Packages</a></li>
            <div class="buttons">
            <li><a href="<?php echo URLROOT?>Users/login" id="loginbut">Login</a></li>
            
            </div>
        </ul>
    </div>

    <section class="plantipResultm1">
        <div class="form">
            <div><h1>Plan a New Trip</h1></div>
            <form action="<?php echo URLROOT?>Landpage/searchPage">
                <div class="wherediv">
                    <label for="where">Where to go?</label>
                <input type="text" placeholder="eg. Galle/Kandy" required>
                </div>
                
                
                <div class="datediv">
                    <label for="where">Dates(optional) :</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <label for="where">Start Date</label>
                <input type="date" placeholder="start">
                <label for="where">End Date</label>
                <input type="date" placeholder="end">
                </div>
                <div class="buttondiv"><button id="startplan" type="submit">Start Planning</button></div>
            </form>
        </div>
    </section>
    
    
  
</body>
</html>



    