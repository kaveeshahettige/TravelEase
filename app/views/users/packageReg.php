<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/register.css">
    <title>Guiding Packages Owner Information</title>
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT?>/images/TravelEase_logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="logo-text">
            <img src="<?php echo URLROOT?>/images/TravelEase_logo.png" alt="TravelEase Logo" class="logo">
            <h1>TravelEase</h1>
        </div>
        <p class="quote">Start your journey here</p>
        <h2>Register as a Guid</h2>
        <form action="<?php echo URLROOT?>users/packagereg" method="POST">
            <div class="column">
                <label for="packageOwnerName">Guide Name:</label>
                <input type="text" id="packageOwnerName" name="packageOwnerName" required>

                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>

            
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="4" required></textarea>
                <label for="contactNumber">Contact Number:</label>
                <input type="tel" id="contactNumber" name="number" required>
                
            </div>
            
            <div class="column">
                <!-- <label for="PackageType">Package Type:</label>
                <select id="packageType" name="packageType" required>
                    <option value="Solo">Solo</option>
                                  <option value="Couple">Couple</option>
                                  <option value="Family">Family</option>
                                  <option value="Group">Group</option>
                                  <option value="Other">Other</option>
                </select> -->
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <label for="password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm_password" required> 
                

                <!-- <label for="socialMedia">Social Media Links:</label>
                <input type="url" id="socialMedia" name="socialMedia" required> -->
                
                <!-- <label for="photos">Photos:</label>
                <input type="file" id="photos" name="photos" accept="image/*" multiple required>
                             -->
                             <button type="submit">Submit</button>          
            </div>
            
        </form>

        

    </div>
</body>
</html>
