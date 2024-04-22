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
        <div><h1>Settings</h1> </div>
    </div>

    <div class="dashboard-content">
        <div id="base">
            <h3 style="padding-left:20px;">Insert Service Validations</h3>
            <div id="form">
                <form class="service-validation-form" method="POST" action="<?php echo URLROOT; ?>/hotel/processServiceValidation" enctype="multipart/form-data">
                    <p>Submit a PDF for Service Validation:</p>
                    <input type="file" id="service-validation-pdf" name="service-validation-pdf" accept=".pdf" required>
                    <button class="edit-button" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</main>
</body>
</html>
