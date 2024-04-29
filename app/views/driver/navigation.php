<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/driver/navigation.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/hotel/popup.css">
    <script src="<?php echo URLROOT; ?>/public/js/hotel/popup.js"></script>
    <title>Add Package</title>
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT; ?>/images/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<nav class="left-menu">
    <div class="user-profile">
        <?php
        $profilePicture = $data["profilePicture"];
        ?>
        <img id="profile-picture" src="<?= isset($profilePicture->profile_picture) ? '../public/images/' . $profilePicture->profile_picture : '../public/images/profile.png'; ?>" alt="User Profile Photo">
        <span class="user-name"><?=$_SESSION['user_fname']?></span>
    </div>

    <div class="search-bar">
        <form action="#" method="GET">
            <input type="text" placeholder="Find a Setting">
            <button type="submit">Search</button>
        </form>
    </div>

    <!-- Driver Menu -->
    <?php
    $driverMenu = [
        ['url' => 'driver/index', 'icon' => 'bx bxs-dashboard bx-sm', 'text' => 'Overview'],
        ['url' => 'driver/calender', 'icon' => 'bx bxs-book bx-sm', 'text' => 'Availability Calendar'],
        ['url' => 'driver/bookings', 'icon' => 'bx bxs-package bx-sm', 'text' => 'Bookings'],
        ['url' => 'driver/vehicle', 'icon' => 'bx bxs-car bx-sm', 'text' => 'Vehicle Information'],
        ['url' => 'driver/earnings', 'icon' => 'bx bx-money-withdraw bx-sm', 'text' => 'Earnings and Payments'],
        ['url' => 'driver/notification', 'icon' => 'bx bxs-bell bx-sm', 'text' => 'Notifications'],
        ['url' => 'driver/reviews', 'icon' => 'bx bxs-star bx-sm bx-fw', 'text' => 'Reviews'],
        ['url' => 'driver/settings', 'icon' => 'bx bxs-cog bx-sm', 'text' => 'Settings'],
        ['url' => 'users/logout', 'icon' => 'bx bxs-log-out bx-sm bx-fw', 'text' => 'Logout'],
    ];

    $activePage = isset($activePage) ? $activePage : ''; // Default to empty string if not set
    ?>

    <ul>
        <?php foreach (($driverMenu ?? []) as $menuItem): ?>
            <li>
                <a href="<?php echo URLROOT . $menuItem['url']; ?>" class="nav-button <?php echo ($activePage === $menuItem['url']) ? 'active' : ''; ?>">
                    <i class='<?php echo $menuItem['icon']; ?>'></i> <?php echo $menuItem['text']; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <div class="logout">
        <a href="<?php echo URLROOT; ?>users/logout" class="nav-button active"><i class='bx bxs-log-out bx-sm bx-fw'></i> Logout</a>
    </div>
</nav>
</body>
</html>
