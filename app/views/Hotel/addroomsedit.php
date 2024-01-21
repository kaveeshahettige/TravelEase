<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/hotel/settingssub.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/navigation.css">
    <title>Hotel - Add Rooms</title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/hotel/x-icon" href="<?php echo URLROOT; ?>/images/hotel/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<?php
$activePage = 'hotel/settings'; // Set the active page dynamically based on your logic
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
            <h3>Add Rooms</h3>
            <!-- ... existing code ... -->

            <div id="form">
                <form action="" method="POST" class="registration-form">
                    <div>
                        <div class="form-group">
                            <label for="roomType">Room Type</label>
                            <input type="text" id="roomType" name="roomType" placeholder="Enter Room Type" required>
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

                        <div class="form-group">
                            <label for="roomImages">Room Images:</label>
                            <input type="file" id="roomImages" name="roomImages[]" accept="image/*" multiple required>
                        </div>
                    </div>

                    <!-- New attributes -->
                    <div>
                        <div class="form-group">
                            <label for="acAvailability">AC Availability:</label>
                            <select id="acAvailability" name="acAvailability">
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tvAvailability">TV Availability:</label>
                            <select id="tvAvailability" name="tvAvailability">
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>

                    </div>

                    <div>
                        <div class="form-group">
                            <label for="wifiAvailability">WiFi Availability:</label>
                            <select id="wifiAvailability" name="wifiAvailability">
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="smokingPolicy">Smoking Policy:</label>
                            <select id="smokingPolicy" name="smokingPolicy">
                                <option value="smoking">Smoking</option>
                                <option value="non-smoking">Non-Smoking</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="petPolicy">Pet Policy:</label>
                            <select id="petPolicy" name="petPolicy">
                                <option value="allowed">Allowed</option>
                                <option value="not-allowed">Not Allowed</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="roomDescription">Room Description:</label>
                            <textarea id="roomDescription" name="roomDescription" rows="4" required></textarea>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="cancellationPolicy">Cancellation Policy:</label>
                            <textarea id="cancellationPolicy" name="cancellationPolicy" rows="4" required></textarea>
                        </div>
                    </div>



                    <div>
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