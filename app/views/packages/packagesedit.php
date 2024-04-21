<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/settingssub.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/navigation.css">
    <title>Package - Edit</title>
    <link rel="icon" type="image/x-icon" href="../Images/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<?php
$userData = $data['userData'];
?>
<?php
$activePage = 'packages/settings'; // Set the active page dynamically based on your logic
include 'navigation.php';
?>
<main>
    <div class="logo-container">
        <img src="../Images/TravelEase.png" alt="TravelEase Logo">
        <span class="logo-text">TravelEase</span>
    </div>
    <div class="dashboard-content">
        <div><h1>Settings</h1> </div>


        <div id="base">
            <?php
            $userData = $data['userData'];
            ?>
            <h3 style="padding-left:20px;">Basic Info</h3>
            <div id="form">
                <form class="registration-form">
                    <div>
                        <div class="form-group">
                            <label for="hotel-name">Name</label>
                            <input type="text" id="hotel-name" name="hotel-name" placeholder="Hotel Name" value="<?php echo $userData->fname; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" id="email" name="email" placeholder="email@gmail.com" value="<?php echo $userData->email; ?>" required>
                        </div>
                    </div>
                    <div>
                        <div class="form-group">
                            <label for="phone-number">Phone Number</label>
                            <input type="text" id="phone-number" name="phone-number" placeholder="0764532789" value="<?php echo $userData->number; ?>" required>
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

            <?php
            $guideData = $data['guideData'];
            ?>
            <h3 style="padding-left:20px;">Additional Details</h3>
            <div id="form">
                <form class="registration-form" method="POST" action="<?php echo URLROOT; ?>/packages/updateGuideDetails/<?php echo $_SESSION['user_id']; ?>">
                    <div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" id="address" name="address" placeholder="Enter address" required value="<?php echo $guideData->address; ?>">
                        </div>
                        <div class="form-group">
                            <label for="pricePerDay">Price Per Day</label>
                            <input type="number" id="pricePerDay" name="pricePerDay" placeholder="Enter price per day" required value="<?php echo $guideData->pricePerDay; ?>">
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city" placeholder="Enter city" required value="<?php echo $guideData->city; ?>">
                        </div>
                        <div class="form-group">
                            <label for="province">Province</label>
                            <input type="text" id="province" name="province" placeholder="Enter province" required value="<?php echo $guideData->province; ?>">
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="facebook">Facebook</label>
                            <input type="text" id="facebook" name="facebook" placeholder="Enter Facebook URL" value="<?php echo $guideData->facebook; ?>">
                        </div>
                        <div class="form-group">
                            <label for="instagram">Instagram</label>
                            <input type="text" id="instagram" name="instagram" placeholder="Enter Instagram URL" value="<?php echo $guideData->instagram; ?>">
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <input type="text" id="category" name="category" placeholder="Enter category" value="<?php echo $guideData->category; ?>">
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label>Languages</label><br>
                            <div class="column">
                                <?php
                                $languages = explode(', ', $guideData->languages);
                                $allLanguages = ["Sinhala", "English", "Tamil", "Spanish", "French", "German", "Italian", "Chinese", "Japanese", "Korean", "Arabic", "Russian", "Hindi"];
                                $halfLength = ceil(count($allLanguages) / 2); // Split languages into two columns
                                $firstColumn = array_slice($allLanguages, 0, $halfLength);
                                foreach ($firstColumn as $language) {
                                    $checked = in_array(strtolower($language), $languages) ? 'checked' : '';
                                    echo '<div class="checkbox-container">';
                                    echo '<input type="checkbox" id="language-' . strtolower($language) . '" name="languages[]" value="' . strtolower($language) . '" ' . $checked . '>';
                                    echo '<label for="language-' . strtolower($language) . '">' . $language . '</label>';
                                    echo '</div>';
                                }
                                ?>
                            </div>
                            <div class="column">
                                <?php
                                $secondColumn = array_slice($allLanguages, $halfLength);
                                foreach ($secondColumn as $language) {
                                    $checked = in_array(strtolower($language), $languages) ? 'checked' : '';
                                    echo '<div class="checkbox-container">';
                                    echo '<input type="checkbox" id="language-' . strtolower($language) . '" name="languages[]" value="' . strtolower($language) . '" ' . $checked . '>';
                                    echo '<label for="language-' . strtolower($language) . '">' . $language . '</label>';
                                    echo '</div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="GuideRegNumber">Guide Registration Number</label>
                            <input type="text" id="GuideRegNumber" name="GuideRegNumber" placeholder="Enter registration number" value="<?php echo $guideData->GuideRegNumber; ?>">
                        </div>
                        <div class="form-group">
                            <label for="LisenceExpDate">License Expiry Date</label>
                            <input type="date" id="LisenceExpDate" name="LisenceExpDate" placeholder="Select expiry date" value="<?php echo $guideData->LisenceExpDate; ?>">
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" rows="4" placeholder="Enter description" required><?php echo $guideData->description; ?></textarea>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="sites">Sites</label>
                            <textarea id="sites" name="sites" rows="2" placeholder="Enter sites"><?php echo $guideData->sites; ?></textarea>
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
