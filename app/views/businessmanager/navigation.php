<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/businessmanager/navigation.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/popup.css">
    <script src="<?php echo URLROOT; ?>/public/js/hotel/popup.js"></script>
    <title>Businesss Manager Navigation</title>
    <link rel="icon" type="<?php echo URLROOT?>/images/x-icon" href="<?php echo URLROOT?>/images/TravelEase.png">
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

    <!-- left_menu.php -->
    <?php
    $businessManagerMenu = [
        ['url' => 'businessmanager/index', 'icon' => 'bx bxs-dashboard bx-sm', 'text' => 'Overview'],
        ['url' => 'businessmanager/bookings', 'icon' => 'bx bxs-book bx-sm', 'text' => 'Bookings'],
        ['url' => 'businessmanager/services', 'icon' => 'bx bxs-hotel bx-sm', 'text' => 'Services'],
        ['url' => 'businessmanager/reports', 'icon' => 'bx bxs-report bx-sm', 'text' => 'Reports'],
        ['url' => 'businessmanager/refund', 'icon' => 'bx bx-arrow-back bx-sm', 'text' => 'Refunds'],
        ['url' => 'businessmanager/financialmanagement', 'icon' => 'bx bx-line-chart bx-sm', 'text' => 'Financial Management'],
        ['url' => 'businessmanager/notifications', 'icon' => 'bx bx-bell bx-sm bx-fw', 'text' => 'Notifications'],
        ['url' => 'businessmanager/settings', 'icon' => 'bx bxs-cog bx-sm', 'text' => 'Settings'],
        // Uncomment the line below if you have a logout option
        // ['url' => 'users/logout', 'icon' => 'bx bxs-log-out bx-sm bx-fw', 'text' => 'Logout'],
    ];

    $activePage = isset($activePage) ? $activePage : ''; // Default to empty string if not set
    ?>

    <ul>
        <?php foreach (($businessManagerMenu ?? []) as $menuItem): ?>
            <li>
                <a href="<?php echo URLROOT . $menuItem['url']; ?>" class="nav-button <?php echo ($activePage === $menuItem['url']) ? 'active' : ''; ?>">
                    <i class='<?php echo $menuItem['icon']; ?>'></i> <?php echo $menuItem['text']; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <div class="logout">
        <a href="#" class="nav-button active" onclick="confirmLogout(event)"><i class='bx bxs-log-out bx-sm bx-fw'></i> Logout</a>
    </div>


</nav>
</body>
</html>