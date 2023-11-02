<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/register.css">
    <title>Hotel Registration</title>
    <link rel="icon" type="<?php echo URLROOT?>/images/x-icon" href="<?php echo URLROOT?>/images/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="logo-text">
            <img src="<?php echo URLROOT?>/images/TravelEase.png" alt="TravelEase Logo" class="logo">
            <h1>TravelEase</h1>
        </div>
        <p class="quote">Start your journey here</p>
        <h2>Hotel Information</h2>
        
        <form action="<?php echo URLROOT?>users/hotelreg" method="POST">
            <div class="column">
                <label for="hotelName">Hotel Name:</label>
                <input type="text" id="hotelName" name="hotelName" required>

                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>

                <label for="email">Email:</label>
                <input type="email" id="website" name="email" required>

                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="4" required></textarea>

		    <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

            </div>
            
            <div class="column">
                <label for="hotelType">Hotel Type:</label>
                <select id="hotelType" name="hotelType" required>
                    <option value="boutique">Boutique</option>
                    <option value="resort">Resort</option>
                    <option value="budget">Budget</option>
                    <option value="luxury">Luxury</option>
                </select>


                <label for="number">Contact number:</label>
                <input type="number" id="number" name="number" required>

                <label for="allocatedRooms">Number of Allocated Rooms:</label>
                <input type="number" id="allocatedRooms" name="allocatedRooms" required>
                
                <!-- <label for="photos">Photos:</label>
                <input type="file" id="photos" name="photos" accept="image/*" multiple required>  
		
		 <label for="license">License and Certifications:</label>
                <input type="file" id="license" name="license" accept=".pdf,.doc,.docx" required> -->

		        <label for="password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm_password" required> 

                <div class="submit"><br><input type="checkbox"><span>By registering, you agree to our <a href="">Terms & Conditions.</a></span>      
                <button type="submit">Submit</button>
		             
            </div>

        </form>
       
</body>
</html>
