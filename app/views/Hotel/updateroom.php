<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/hotel/settingssub.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/navigation.css">
    <title>Hotel - Update Rooms</title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/hotel/x-icon" href="<?php echo URLROOT; ?>/images/hotel/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
<?php
$userData= $data['basicInfo']['userData'];
?>
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
            <?php
            $roomData = $data['roomData'];
            var_dump($roomData);
            ?>
            <h3>Add Rooms</h3>
            <div id="form">
                <form action="" method="POST" class="registration-form" enctype="multipart/form-data">
                    <div>
                        <div class="form-group">
                            <label for="roomType">Room Type</label>
                            <input type="text" id="roomType" name="roomType" placeholder="Enter Room Type" value="<?php echo $roomData['roomType'] ?? ''; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="numOfBeds">Number of Beds</label>
                            <input type="number" id="numOfBeds" name="numOfBeds" min="1" value="<?php echo $roomData['numOfBeds'] ?? ''; ?>" required>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="numAdults">Number of Adults</label>
                            <input type="number" id="numAdults" name="numAdults" min="1" value="<?php echo $roomData['numAdults'] ?? ''; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="numChildren">Number of Children</label>
                            <input type="number" id="numChildren" name="numChildren" min="0" value="<?php echo $roomData['numChildren'] ?? ''; ?>" required>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="price">Price (per night)</label>
                            <input type="number" id="price" name="price" value="<?php echo $roomData['price'] ?? ''; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="roomSize">Room Size:</label>
                            <input type="text" id="roomSize" name="roomSize" placeholder="Enter Room Size" value="<?php echo $roomData['roomSize'] ?? ''; ?>">
                        </div>
                    </div>

                    <h3>Room Facilities</h3>
                    <div>
                        <div class="form-group">
                            <label for="acAvailability">AC Availability:</label>
                            <select id="acAvailability" name="acAvailability">
                                <option value="yes" <?php echo $roomData['acAvailability'] === 'yes' ? 'selected' : ''; ?>>Yes</option>
                                <option value="no" <?php echo $roomData['acAvailability'] === 'no' ? 'selected' : ''; ?>>No</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tvAvailability">TV Availability:</label>
                            <select id="tvAvailability" name="tvAvailability">
                                <option value="yes" <?php echo $roomData['tvAvailability'] === 'yes' ? 'selected' : ''; ?>>Yes</option>
                                <option value="no" <?php echo $roomData['tvAvailability'] === 'no' ? 'selected' : ''; ?>>No</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="wifiAvailability">WiFi Availability:</label>
                            <select id="wifiAvailability" name="wifiAvailability">
                                <option value="yes" <?php echo $roomData['wifiAvailability'] === 'yes' ? 'selected' : ''; ?>>Yes</option>
                                <option value="no" <?php echo $roomData['wifiAvailability'] === 'no' ? 'selected' : ''; ?>>No</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="smokingPolicy">Smoking Policy:</label>
                            <select id="smokingPolicy" name="smokingPolicy">
                                <option value="smoking" <?php echo $roomData['smokingPolicy'] === 'smoking' ? 'selected' : ''; ?>>Smoking</option>
                                <option value="non-smoking" <?php echo $roomData['smokingPolicy'] === 'non-smoking' ? 'selected' : ''; ?>>Non-Smoking</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="petPolicy">Pet Policy:</label>
                            <select id="petPolicy" name="petPolicy">
                                <option value="allowed" <?php echo $roomData['petPolicy'] === 'allowed' ? 'selected' : ''; ?>>Allowed</option>
                                <option value="not-allowed" <?php echo $roomData['petPolicy'] === 'not-allowed' ? 'selected' : ''; ?>>Not Allowed</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="balconyAvailability">Balcony Availability:</label>
                            <select id="balconyAvailability" name="balconyAvailability">
                                <option value="yes" <?php echo $roomData['balconyAvailability'] === 'yes' ? 'selected' : ''; ?>>Yes</option>
                                <option value="no" <?php echo $roomData['balconyAvailability'] === 'no' ? 'selected' : ''; ?>>No</option>
                            </select>
                        </div>
                    </div>

                    <h3>Additional Facilities</h3>

                    <div>
                        <div class="form-group">
                            <label for="privatePoolAvailability">Private Pool Availability:</label>
                            <select id="privatePoolAvailability" name="privatePoolAvailability">
                                <option value="yes" <?php echo $roomData['privatePoolAvailability'] === 'yes' ? 'selected' : ''; ?>>Yes</option>
                                <option value="no" <?php echo $roomData['privatePoolAvailability'] === 'no' ? 'selected' : ''; ?>>No</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="hotTubAvailability">Hot Tub Availability:</label>
                            <select id="hotTubAvailability" name="hotTubAvailability">
                                <option value="yes" <?php echo $roomData['hotTubAvailability'] === 'yes' ? 'selected' : ''; ?>>Yes</option>
                                <option value="no" <?php echo $roomData['hotTubAvailability'] === 'no' ? 'selected' : ''; ?>>No</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="refrigeratorAvailability">Refrigerator Availability:</label>
                            <select id="refrigeratorAvailability" name="refrigeratorAvailability">
                                <option value="yes" <?php echo $roomData['refrigeratorAvailability'] === 'yes' ? 'selected' : ''; ?>>Yes</option>
                                <option value="no" <?php echo $roomData['refrigeratorAvailability'] === 'no' ? 'selected' : ''; ?>>No</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="hotShowerHeaterAvailability">Hot Shower Heater Availability:</label>
                            <select id="hotShowerHeaterAvailability" name="hotShowerHeaterAvailability">
                                <option value="yes" <?php echo $roomData['hotShowerHeaterAvailability'] === 'yes' ? 'selected' : ''; ?>>Yes</option>
                                <option value="no" <?php echo $roomData['hotShowerHeaterAvailability'] === 'no' ? 'selected' : ''; ?>>No</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="washingMachineAvailability">Washing Machine Availability:</label>
                            <select id="washingMachineAvailability" name="washingMachineAvailability">
                                <option value="yes" <?php echo $roomData['washingMachineAvailability'] === 'yes' ? 'selected' : ''; ?>>Yes</option>
                                <option value="no" <?php echo $roomData['washingMachineAvailability'] === 'no' ? 'selected' : ''; ?>>No</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="kitchenAvailability">Kitchen Availability:</label>
                            <select id="kitchenAvailability" name="kitchenAvailability">
                                <option value="yes" <?php echo $roomData['kitchenAvailability'] === 'yes' ? 'selected' : ''; ?>>Yes</option>
                                <option value="no" <?php echo $roomData['kitchenAvailability'] === 'no' ? 'selected' : ''; ?>>No</option>
                            </select>
                        </div>
                    </div>


                    <h3>Meal Options</h3>
                    <div>
                        <div class="form-group">
                            <label for="breakfastIncluded">Breakfast Included:</label>
                            <select id="breakfastIncluded" name="breakfastIncluded">
                                <option value="yes" <?php echo $roomData['breakfastIncluded'] === 'yes' ? 'selected' : ''; ?>>Yes</option>
                                <option value="no" <?php echo $roomData['breakfastIncluded'] === 'no' ? 'selected' : ''; ?>>No</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="lunchIncluded">Lunch Included:</label>
                            <select id="lunchIncluded" name="lunchIncluded">
                                <option value="yes" <?php echo $roomData['lunchIncluded'] === 'yes' ? 'selected' : ''; ?>>Yes</option>
                                <option value="no" <?php echo $roomData['lunchIncluded'] === 'no' ? 'selected' : ''; ?>>No</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="dinnerIncluded">Dinner Included:</label>
                            <select id="dinnerIncluded" name="dinnerIncluded">
                                <option value="yes" <?php echo $roomData['dinnerIncluded'] === 'yes' ? 'selected' : ''; ?>>Yes</option>
                                <option value="no" <?php echo $roomData['dinnerIncluded'] === 'no' ? 'selected' : ''; ?>>No</option>
                            </select>
                        </div>
                    </div>

                    <h3>Room Images</h3>

                    <div>
                        <div>
                            <div class="form-group">
                                <label for="roomImages1">Room Images 1:</label>
                                <input type="file" id="roomImages1" name="roomImages[]" accept="image/*" required>
                                <?php if (!empty($roomData['roomImages'][0])): ?>
                                    <?php $imagePath1 = '../public/images/' . $roomData['roomImages'][0]; ?>
                                    <img src="<?php echo $imagePath1; ?>" alt="Room Image 1">
                                <?php endif; ?>
                            </div>
                        </div>

                        <div>
                            <div class="form-group">
                                <label for="roomImages2">Room Images 2:</label>
                                <input type="file" id="roomImages2" name="roomImages[]" accept="image/*" required>
                                <?php if (!empty($roomData['roomImages'][1])): ?>
                                    <?php $imagePath2 = '../public/images/' . $roomData['roomImages'][1]; ?>
                                    <img src="<?php echo $imagePath2; ?>" alt="Room Image 2">
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div>
                            <div class="form-group">
                                <label for="roomImages3">Room Images 3:</label>
                                <input type="file" id="roomImages3" name="roomImages[]" accept="image/*" required>
                                <?php if (!empty($roomData['roomImages'][2])): ?>
                                    <?php $imagePath3 = '../public/images/' . $roomData['roomImages'][2]; ?>
                                    <img src="<?php echo $imagePath3; ?>" alt="Room Image 3">
                                <?php endif; ?>
                            </div>
                        </div>

                        <div>
                            <div class="form-group">
                                <label for="roomImages4">Room Images 4:</label>
                                <input type="file" id="image" name="roomImages[]" accept="image/*" required>
                                <?php if (!empty($roomData['roomImages'][3])): ?>
                                    <?php $imagePath4 = '../public/images/' . $roomData['roomImages'][3]; ?>
                                    <img src="<?php echo $imagePath4; ?>" alt="Room Image 4">
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>




                    <h3>Further Descriptions</h3>
                    <div>
                        <div class="form-group">
                            <label for="roomDescription">Room Description:</label>
                            <textarea id="description" name="description" rows="4" required><?php echo $roomData['description'] ?? ''; ?></textarea>
                            <?php echo "case"; ?>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="cancellationPolicy">Cancellation Policy:</label>
                            <textarea id="cancellationPolicy" name="cancellationPolicy" rows="4" required><?php echo $roomData['cancellationPolicy'] ?? ''; ?></textarea>
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

<script>
    // Get the input element
    var priceInput = document.getElementById('price');
    priceInput.addEventListener('input', function() {
        if (priceInput.value < 0) {
            priceInput.value = 0;
        }
    });
</script>
</body>

</html>
