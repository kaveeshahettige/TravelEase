<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/driver/register.css">
    <title>Transport Provider Information</title>
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
        <h2>Register as a Transport Provider</h2>
        <form action="<?php echo URLROOT?>users/transportRegNew" method="POST">
            <div class="column">


                <h2>Personal Details</h2>
                <label for="fname">Transport Provider Name:</label>
                <input type="text" id="fname" name="fname" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <label for="contactNumber">Contact Number:</label>
                <input type="tel" id="contactNumber" name="number" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <label for="password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm_password" required> 
            </div>

            
            <div class="column">
                <h2>Agency Detailes</h2>

                <lable for="agencyname">Agency Name:</lable>
                <input type="text" id="agency_name" name="agency_name" required>

                <label for="agencyAddress">Agency Address:</label>
                <input type="text" id="address" name="address" required>

                <label for="agencyRegNumber">Agency Registration Number:</label>
                <input type="text" id="reg_number" name="reg_number" required>
                
                <label class="checkbox-label" for="terms">
                <input type="checkbox" id="terms" name="terms" required>
                I agree to the <a href="#">Terms and Conditions</a>
</label>

                
                            
                <button type="submit">Submit</button>          
            </div>
            
        </form>

        

    </div>
</body>
</html>
