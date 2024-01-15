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
        <br>
        <p class="quote">Start your journey here</p>
        <h2>Register as a Transport Provider</h2>
        <p class="description">Please fill in the following details to register as a transport provider</p>
        
        <form action="<?php echo URLROOT?>users/transportRegNew" method="POST">
            <div class="column">
                <label for="fname">First Name:</label>
                <input type="text" id="fname" name="fname" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="column">
                <label for="fname">Last Name:</label>
                <input type="text" id="lname" name="lname" required>
                <label for="contactNumber">Contact Number:</label>
                <input type="tel" id="contactNumber" name="number" required>
                <label for="password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm_password" required> 

                <div class="checkbox-container">
            <label class="checkbox-label" for="terms">
                <input type="checkbox" id="terms" name="terms" required>
                <p>I agree to the <a href="#" class="terms-link">Terms and Conditions</a></p>   
            </label>
        </div>

        <div >
                            <div class="baseButtons">
                                <button id="cancelBut">Cancel</button>
                                <button id="saveBut" type="submit">Save</button>
                            </div>
                
                </div>

            </div>
            
        </form>

       
    </div>
</body>
</html>
