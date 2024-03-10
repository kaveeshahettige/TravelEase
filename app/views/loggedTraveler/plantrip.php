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
    <script src=""></script>
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
            <li><a href="<?php echo URLROOT?>loggedTraveler/index" id="selected">Home</a></li>
            <li><a href="<?php echo URLROOT?>loggedTraveler/hotel">Hotels</a></li>
            <li><a href="<?php echo URLROOT?>loggedTraveler/transport">Transport Providers</a></li>
            <li><a href="<?php echo URLROOT?>loggedTraveler/package">Packages</a></li>
            <div class="rightcontent">
            <!-- <li><a href="<?php echo URLROOT ?>travelerDashboard/index/<?php echo $_SESSION['user_id'] ?>"><img src="<?php echo empty($data['profile_picture']) ? URLROOT.'images/user.jpg' : URLROOT.'images1/'.$data['profile_picture']; ?>" alt="Profile Picture" alt="User Profile Photo"> </a></li> -->
            <!-- <li><a href="<?php echo URLROOT?>users/logout" id="logout">Log Out</a></li> -->
            </div>
        </ul>
    </div>

    <section class="plantipResultm1">
        <div class="form">
            <div><h1>Plan a New Trip</h1></div>
            <form action="<?php echo URLROOT?>loggedTraveler/plantrip" method="post"> 
                <div class="wherediv">
                    <label for="where">Where to go?</label>
                <input type="text" placeholder="eg. Galle/Kandy" name="location" required>
                </div>
                
                
                <div class="datediv">
                
                <label for="where">Start Date</label>
                <input type="date" placeholder="start" name="checkinDate">
                <label for="where" id="enddate">End Date</label>
                <input type="date" placeholder="end" name="checkoutDate">
                </div>
                <div class="buttondiv"><button id="startplan" type="submit">Start Planning</button></div>
            </form>
        </div>
    </section>
    
    
  
</body>
</html>



    