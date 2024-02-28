<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/hotel/settingssub.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/navigation.css">
    <title>Packages - Add Packages</title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/hotel/x-icon" href="<?php echo URLROOT; ?>/images/hotel/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<?php
$activePage = 'packages/settings'; // Set the active page dynamically based on your logic
include 'navigation.php';
?>
<main>
    <div class="logo-container">
        <img src="<?php echo URLROOT; ?>/images/hotel/TravelEase.png" alt="TravelEase Logo">
        <span class="logo-text">TravelEase</span>
    </div>
    <div class="dashboard-content">
        <div>
            <h1>Settings</h1>
        </div>


        <div id="base">
            <h1 style="padding-left:20px;">Add Packages</h1>
            <div id="form">
                <form class="registration-form">

                    <h2 style="padding-left: 10px;">Package Details</h2>


                    <div>
                        <div class="form-group">
                            <label for="packageName">Package Name</label>
                            <input type="text" id="PackageName" name="PackageName" required>

                        </div>

                        <div class="form-group">
                            <label for="PackageType">Package Type</label>
                            <select id="PackageType" name="PackageType" required>
                                <option value="Solo">Solo</option>
                                <option value="Couple">Couple</option>
                                <option value="Family">Family</option>
                                <option value="Group">Group</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="PackageDuration">Package Duration(days)</label>
                            <input type="number" id="PackageDuration(days)" name="PackageDuration(days)" required>
                        </div>

                        <div class="form-group">
                            <label for="price">Price of Package</label>
                            <input type="PriceOfPackage" id="PriceOfPackage" name="PriceOfPackage" required>
                        </div>
                    </div>


                    <div>
                        <div class="form-group">
                            <label for="Location">Location</label>
                            <select id="Location" name="Location">
                                <option value="Anuradhapura">Anuradhapura</option>
                                <option value="Galle">Galle</option>
                                <option value="Kandy">Kandy</option>
                                <option value="Nuwara Eliya">Nuwara Eliya</option>
                                <option value="Trincomalee">Trincomalee</option>
                                <option value="Jaffna">Jaffna</option>
                                <option value="other">other</option>
                            </select>
                        </div>
                        <div  class="form-group">
                            <label for="PackageImages">Package Images:</label>
                            <input type="file" id="PackageImages" name="PackageImages[]" accept="image/*">
                        </div>
                    </div>

                    <h2 style="padding: left 10px;">Accomadation</h2>



                    <div>
                        <div class="form-group">
                            <label for="TypeOfTheAccomadation">Type of the Accomadation</label>
                            <select id="TypeOfTheAccomadation" name="TypeOfTheAccomadation" required>
                                <option value="Hotel">Hotel</option>
                                <option value="Resort">Resort</option>
                                <option value="Guest House">Guest House</option>
                                <option value="Vacation Rental">Vacation Rental</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="RoomType">Room Type</label>
                            <select id="RoomType" name="RoomType" required>
                                <option value="Single">Single</option>
                                <option value="Double">Double</option>
                                <option value="Family">Family</option>
                                <option value="Suite">Suite</option>
                            </select>
                        </div>
                    </div>


                    <div>
                        <div class="form-group">
                            <label for="Facilities">Facilities</label><br>

                            <select id="Facilities" name="Facilities" required>
                                <option value="Common areas">Common areas</option>
                                <option value="Dining options">Dining options</option>
                                <option value="Fitness Center ">Fitness Center</option>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="OtherFacilities">Other Facilities</label>
                            <select id="OtherFacilities" name="OtherFacilities" required>
                                <option value="WiFi">WiFi</option>
                                <option value="Air Conditioning">Air Conditioning</option>
                                <option value="TV">TV</option>

                            </select>


                        </div>
                    </div>





                    <div>
                        <div class="form-group">
                            <label for="Meals">Meals</label>
                            <select id="Meals" name="Meals" required>
                                <option value="SelfCatering">Self Catering</option>
                                <option value="BreakfastIncluded">Breakfast Included</option>
                                <option value="AllMeals">All Meals</option>
                                <option value="BreakfastAndDinner">Breakfast And Dinner</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Policies">Policies</label>
                            <select id="Policies" name="Policies" required>
                                <option value="Cancellation">Cancellation</option>
                                <option value="PetPolicy">Pet Policy</option>
                                <option value="SmokingPolicy">Smoking Policy</option>

                            </select>
                        </div>
                    </div>


                    <h2 style="padding: left 10px;">Transportation</h2>

                    <div>
                        <div class="form-group">
                            <label for="TransportProvider">Transport Provider</label>
                            <select id="TransportProvider" name="TransportProvider" required>
                                <option value="Agency 1">Agency 1</option>
                                <option value="Agency 2">Agency 2</option>
                                <option value="Agency 3">Agency 3</option>
                                <option value="Agency 4">Agency 4</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="TransporMode">Transport Mode</label>
                            <select id="TransportMode" name="TransportMode" required>
                                <option value="Bus">Bus</option>
                                <option value="Bicycle">Bicycle</option>
                                <option value="Van">Van</option>
                                <option value="Car">Car</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                    </div>
                    <h2 style="padding: left 10px;">Activities</h2>

                    <div>
                        <div class="form-group">
                            <label>Activities</label>
                            <select id="Activities" name="Activities">
                                <option value="Local Culture">Local Culture</option>
                                <option value="Wellness&Spas">Wellness & Spas</option>
                                <option value="OutDoors">OutDoors</option>
                                <option value="Shopping">Shopping</option>
                                <option value="History">History</option>
                                <option value="IndigenousPeople&Traditions">Indigenous People & Traditions</option>
                                <option value="Safari">Safari</option>
                                <option value="LocalBeer">Local Beer</option>
                                <option value="Arts&Theatre">Arts & Theatre</option>
                                <option value="SportingEvents">Sporting Events</option>
                                <option value="Parks&Greenspaces">Parks & Greenspaces</option>
                                <option value="Hiking">Hiking</option>
                                <option value="BirdWatching">Bird Watching</option>
                                <option value="Camping">Camping</option>
                                <option value="Fishing">Fishing</option>
                                <option value="MotorSports">Motor Sports</option>
                                <option value="Surfing">Surfing</option>
                            </select>
                        </div>
                    </div>
                    <div class="baseButtons">
                        <button id="cancelBut">Cancel</button>
                        <button id="saveBut" type="submit">Save</button>
                    </div>

                    <div >

                    </div>
            </div>



            </form>

        </div>
        </div>
</main>
</body>
</html>