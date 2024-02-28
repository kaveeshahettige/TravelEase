<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/settingssub.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/navigation.css">
    <title>Package-Password</title>
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
        <div><h1>Settings</h1> </div>

        <div id="base">
            <h3 style="padding-left:20px;">Password</h3>
            <div id="form">
                <form class="registration-form">
                    <div>
                        <div class="form-group">
                            <label for="current-password">Current Password</label>
                            <input type="password" id="current-password" name="current-password" placeholder="Current Password" required>
                        </div>
                        <div>

                        </div>
                    </div>


                    <div>
                        <div class="form-group">
                            <label for="passowrd">New Password</label>
                            <input type="password" id="new-password" name="new-password" placeholder="New Password" required>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="password">Confirm Password</label>
                            <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm Password">
                        </div>
                    </div>

                    <div >
                        <div class="baseButtons">
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
