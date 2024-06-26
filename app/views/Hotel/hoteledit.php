<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/settingssub.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/navigation.css">
    <title>Hotel-Edit</title>
    <link rel="icon" type="image/x-icon" href="../Images/TravelEase.png">
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
        <img src="../Images/TravelEase.png" alt="TravelEase Logo">
        <span class="logo-text">TravelEase</span>
    </div>
    <div class="dashboard-content">
        <div>
            <h1>Setting </h1>
        </div>



        <div id="base">
            <h3 style="padding-left:20px;">Basic Info</h3>
            <div id="form">
                <form class="registration-form" method="POST" action="<?php echo URLROOT; ?>/hotel/updateHotelSettings/<?php echo $_SESSION['user_id']; ?>">
<!--                --><?php //echo $_SESSION['user_id']; ?>
                <div>
                    <?php
                        $userData= $data['basicInfo']['userData'];
                        $hotelData= $data['basicInfo']['hotelData'];
                    ?>

                        <div class="form-group">
                            <label for="hotel-name">Hotel Name</label>
                            <input type="text" id="hotel-name" name="hotel-name" placeholder="Hotel Name" value="<?php echo $userData->fname; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="hotel-type">Hotel Type</label>
                            <input type="text" id="hotel-type" name="hotel-type" placeholder="Hotel Type" value="<?php echo $hotelData->hotel_type; ?>" required>
                        </div>
                    </div>
                    <div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" id="email" name="email" placeholder="email@gmail.com" value="<?php echo $userData->email; ?>" required>
                        </div>
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
        </div>


        <div id="base">

            <h3 style="padding-left:20px;">Add Details</h3>
            <div id="form">
                <form class="registerForm" method="POST" action="<?php echo URLROOT; ?>/hotel/updateAdditionalDetails/<?php echo $_SESSION['user_id']; ?>">

                <div>
                        <div class="form-group">
                            <label for="altPhoneNumber">Alternate Phone Number</label>
                            <input type="text" id="altPhoneNumber" name="altPhoneNumber" placeholder="Alternate Phone Number" value="<?php echo $hotelData->alt_phone_number; ?>">
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="managerInfo">Manager's Name</label>
                            <input type="text" id="managerInfo" name="managerInfo" placeholder="Manager's name" value="<?php echo $hotelData->manager_name; ?>">
                        </div>
                        <div>
                            <div class="form-group">
                                <label for="managerPhoneNumber">Manager's Phone Number</label>
                                <input type="text" id="managerPhoneNumber" name="managerPhoneNumber" placeholder="0764532789" value="<?php echo $hotelData->manager_phone_number; ?>" required>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="add">Address</label>
                            <input type="text" id="addr" name="addr" placeholder="Enter Street and Town" value="<?php echo $hotelData->addr; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="street_address">Street Address</label>
                            <input type="text" id="street_address" name="street_address" placeholder="Enter Street Address" value="<?php echo $hotelData->street_address; ?>">
                        </div>
                    </div>


                    <div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city" placeholder="City" value="<?php echo $hotelData->city; ?>">
                        </div>
                        <div class="form-group">
                            <label for="state">Province</label>
                            <input type="text" id="state" name="state" placeholder="Province" value="<?php echo $hotelData->state_province; ?>">
                        </div>
                    </div>

                    <h3>Check in/out Time</h3>

                    <div>
                        <div class="form-group">
                            <label for="check_in_time">Check in Time</label>
                            <input type="time" id="check_in_time" name="check_in_time" value="<?php echo $hotelData->check_in_time; ?>">
                        </div>

                        <div class="form-group">
                            <label for="check_out_time">Check out Time</label>
                            <input type="time" id="check_out_time" name="check_out_time" value="<?php echo $hotelData->check_out_time; ?>">
                        </div>
                    </div>

                    <h3>Social Media Accounts</h3>
                    <div>
                        <div class="form-group">
                            <label for="website">Website</label>
                            <input type="url" id="website" name="website" placeholder="Hotel Website" value="<?php echo $hotelData->website; ?>">
                        </div>
                        <div class="form-group">
                            <label for="facebook">Facebook</label>
                            <input type="url" id="facebook" name="facebook" placeholder="Hotel Facebook" value="<?php echo $hotelData->facebook; ?>">
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="twitter">Twitter Handle</label>
                            <input type="url" id="twitter" name="twitter" placeholder="Twitter Handle" value="<?php echo $hotelData->twitter; ?>">
                        </div>
                        <div class="form-group">
                            <label for="instagram">Instagram Handle</label>
                            <input type="url" id="instagram" name="instagram" placeholder="Instagram Handle" value="<?php echo $hotelData->instagram; ?>">
                        </div>
                    </div>

                    <h3>Bank Details</h3>
                    <div>
                        <div class="form-group">
                            <label for="bank_name">Bank Name</label>
                            <input type="text" id="bank_name" name="bank_name" placeholder="Bank Name" value="<?php echo $hotelData->bank_name; ?>">
                        </div>

                        <div class="form-group">
                            <label for="branch">Branch</label>
                            <input type="text" id="branch" name="branch" placeholder="Branch" value="<?php echo $hotelData->branch; ?>">
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="card_holder_name">Card Holder Name</label>
                            <input type="text" id="card_holder_name" name="card_holder_name" placeholder="Card Holder Name" value="<?php echo $hotelData->card_holder_name; ?>">
                        </div>
                        <div class="form-group">
                            <label for="account_number">Bank Account Number</label>
                            <input type="text" id="account_number" name="account_number" placeholder="Account Number" value="<?php echo $hotelData->account_number; ?>">
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="additionalNotes">Additional Comments/Notes</label>
                            <textarea id="additionalNotes" name="additionalNotes" rows="4" placeholder="Any other relevant information or special requests"><?php echo $hotelData->additional_notes; ?></textarea>
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
