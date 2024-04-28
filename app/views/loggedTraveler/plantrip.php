<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>TraveleEase</title>
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT?>images/TravelEase_logo.png">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/landpage/plantrip.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <script src=""></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCwpU1PTXuk_KMIDsXvXDjqiXUYCQZt2c&libraries=places"></script>
    <style>
        /* Style for the suggestions dropdown */
        .pac-container {
            background-color: #FFF;
            z-index: 1000;
            position: fixed;
            display: inline-block;
            float: left;
        }
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
            <li><a href="<?php echo URLROOT?>loggedTraveler/package">Guides</a></li>
            <div class="rightcontent">
            <!-- <li><a href="<?php echo URLROOT ?>travelerDashboard/index/<?php echo $_SESSION['user_id'] ?>"><img src="<?php echo empty($data['profile_picture']) ? URLROOT.'images/user.jpg' : URLROOT.'images1/'.$data['profile_picture']; ?>" alt="Profile Picture" alt="User Profile Photo"> </a></li> -->
            <!-- <li><a href="<?php echo URLROOT?>users/logout" id="logout">Log Out</a></li> -->
            </div>
        </ul>
    </div>

    <section class="plantipResultm1">
        <div class="form">
            <div><h1>Plan a New Trip</h1></div>
            <form id="planTripForm" action="<?php echo URLROOT?>loggedTraveler/plantrip" method="post"> 
                <div class="wherediv">
                    <label for="where" style="margin-left:100px;">Where to go?</label>
                <input type="text" placeholder="eg. Galle/Kandy" name="location" id="location-input" required>
                </div>
                
                
                <div class="datediv">
                
                <label for="where" style="margin-left:100px;">Start Date</label>
                <input type="date" placeholder="start" name="checkinDate" id="checkinDate" min="<?php echo date('Y-m-d'); ?>" required>
                <label for="where" style="margin-left:100px;" id="enddate">End Date</label>
                <input type="date" placeholder="end" name="checkoutDate" id="checkoutDate" min="<?php echo date('Y-m-d'); ?>" required>
                </div>
                <div class="buttondiv"><button id="startplan" type="submit">Start Planning</button></div>
            </form>
        </div>
    </section>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const locationInput = document.getElementById("location-input");
            const options = {
                types: ['(cities)'],
                componentRestrictions: { country: 'LK' } // Restrict to Sri Lanka (LK)
            };
            const autocomplete = new google.maps.places.Autocomplete(locationInput, options);

            // Listen for place selection
            autocomplete.addListener("place_changed", function() {
                const place = autocomplete.getPlace();
                if (!place.geometry) {
                    console.error("Place selection failed:", place);
                    return;
                }
                // Extract city name without country
                const city = place.address_components.find(component => {
                    return component.types.includes("locality");
                });
                if (city) {
                    locationInput.value = city.long_name;
                }
            });
        });
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the form and input elements
        const bookingForm = document.getElementById("planTripForm");
        const checkinDateInput = document.getElementById("checkinDate");
        const checkoutDateInput = document.getElementById("checkoutDate");

        // Add event listener for form submission
        bookingForm.addEventListener("submit", function(event) {
            // Prevent form submission if validation fails
            if (!validateDates()) {
                event.preventDefault();
            }
        });

        // Function to validate dates
        function validateDates() {
            const checkinDate = new Date(checkinDateInput.value);
            const checkoutDate = new Date(checkoutDateInput.value);
            const today = new Date();

            // Check if check-in date is after check-out date
            // if (checkinDate >= checkoutDate) {
            //     alert("Check-out date must be after check-in date.");
            //     return false;
            // }

            // Check if check-in date is in the past
            if (checkinDate < today) {
                alert("Check-in date cannot be in the past.");
                return false;
            }

            // Check if check-out date is in the past
            if (checkoutDate < today) {
                alert("Check-out date cannot be in the past.");
                return false;
            }

            // All validations passed
            return true;
        }
        checkinDateInput.addEventListener("change", function() {
            checkoutDateInput.min = checkinDateInput.value;
        });
    });
</script>

  
</body>
</html>



    