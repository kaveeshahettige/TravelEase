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
//$userData= $data['basicInfo']['userData'];
//?>
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
            <?php $roomData = $data; ?>
            <h3>Add Rooms</h3>
            <div id="form">
                <form class="registration-form" action="" method="POST">
                    <div>
                        <div class="form-group">
                            <label for="roomType">Room Type</label>
                            <input type="text" id="roomType" name="roomType" value="<?php echo $roomData['roomType']; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="numOfBeds">Number of Beds</label>
                            <select id="numOfBeds" name="numOfBeds">
                                <option value="1" <?php echo ($roomData['numOfBeds'] === '1') ? 'selected' : ''; ?>>1 Bed</option>
                                <option value="2" <?php echo ($roomData['numOfBeds'] === '2') ? 'selected' : ''; ?>>2 Beds</option>
                                <option value="3" <?php echo ($roomData['numOfBeds'] === '3') ? 'selected' : ''; ?>>3 Beds</option>
                                <option value="4" <?php echo ($roomData['numOfBeds'] === '4') ? 'selected' : ''; ?>>4 Beds</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="price">Price (per night)</label>
                            <input type="number" id="price" name="price" required value="<?php echo $roomData['price'] ?>">
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="acAvailability">AC Availability</label>
                            <select id="acAvailability" name="acAvailability">
                                <option value="1" <?php echo ($roomData['acAvailability'] === '1') ? 'selected' : ''; ?>>Yes</option>
                                <option value="0" <?php echo ($roomData['acAvailability'] === '0') ? 'selected' : ''; ?>>No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tvAvailability">TV Availability</label>
                            <select id="tvAvailability" name="tvAvailability">
                                <option value="1" <?php echo ($roomData['tvAvailability'] === '1') ? 'selected' : ''; ?>>Yes</option>
                                <option value="0" <?php echo ($roomData['tvAvailability'] === '0') ? 'selected' : ''; ?>>No</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="wifiAvailability">WiFi Availability:</label>
                            <select id="wifiAvailability" name="wifiAvailability">
                                <option value="yes" <?php echo ($roomData['wifiAvailability'] === 'yes') ? 'selected' : ''; ?>>Yes</option>
                                <option value="no" <?php echo ($roomData['wifiAvailability'] === 'no') ? 'selected' : ''; ?>>No</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="smokingPolicy">Smoking Policy</label>
                            <select id="smokingPolicy" name="smokingPolicy">
                                <option value="smoking" <?php echo ($roomData['smokingPolicy'] === 'smoking') ? 'selected' : ''; ?>>Smoking</option>
                                <option value="non-smoking" <?php echo ($roomData['smokingPolicy'] === 'non-smoking') ? 'selected' : ''; ?>>Non-Smoking</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="petPolicy">Pet Policy</label>
                            <select id="petPolicy" name="petPolicy">
                                <option value="pets-allowed" <?php echo ($roomData['petPolicy'] === 'pets-allowed') ? 'selected' : ''; ?>>Pets Allowed</option>
                                <option value="no-pets-allowed" <?php echo ($roomData['petPolicy'] === 'no-pets-allowed') ? 'selected' : ''; ?>>No Pets Allowed</option>
                            </select>
                        </div>
                    </div>

                    <div>

                        <div class="form-group">
                            <label for="cancellationPolicy">Cancellation Policy</label>
                            <textarea id="cancellationPolicy" name="cancellationPolicy" rows="4" required><?php echo $roomData['cancellationPolicy']; ?></textarea>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="roomDescription">Room Description:</label>
                            <textarea id="roomDescription" name="roomDescription" rows="4" required><?php echo $roomData["roomDescription"]; ?></textarea>
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
