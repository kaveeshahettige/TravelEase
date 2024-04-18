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
        </div>
    </div>
</main>
</body>
</html>
