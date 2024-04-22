<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/hotel/navigation.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/settingssub.css">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/hotel/availablerooms.css">
    <title>Guide - Update Availability</title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/hotel/x-icon" href="<?php echo URLROOT; ?>/images/hotel/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
<?php
$userData = $data['userData'];
?>

<?php
$activePage = 'packages/calender'; // Set the active page dynamically based on your logic
include 'navigation.php';
?>
<main>
    <div class="logo-container">
        <img src="<?php echo URLROOT; ?>/images/hotel/TravelEase.png" alt="TravelEase Logo">
        <span class="logo-text">TravelEase</span>
    </div>

    <div class="dashboard-content">
        <div>
            <h1>Availability</h1>
        </div>
    </div>

    <main>
    <div class="dashboard-content">
        <div id="base">
            <h3 style="padding-left:20px;">Update Availability</h3>
            <div id="form">
                <p style="margin-left: 20px;">Confirm your Availability on:<?php echo $data['date']; ?> </p>
                <p style="margin-left: 20px;">
                        <?php if ($data['availability']) : ?>
                            Unavailable
                        <?php else : ?>
                            Available
                        <?php endif; ?>
                    </p>

                    <button  style="margin-left: 20px;" class="available-button" onclick="updateStatus (<?php echo $_SESSION['user_id']; ?> , '<?php echo $data['date']; ?>')">Unavailable</button>
                    <button  style="margin-left: 20px;" class="unavailable-button" onclick="deleteStatus(<?php echo $_SESSION['user_id']; ?> , '<?php echo $data['date']; ?>')">Available</button>

            </div>
        </div>
    </div>

</main>
</body>
<script src="<?php echo URLROOT ?>/public/js/package/calender.js"></script>

</html>