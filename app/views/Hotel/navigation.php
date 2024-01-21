<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/navigation.css">
    <title>Navigation</title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/hotel/x-icon" href="<?php echo URLROOT; ?>/images/hotel/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<nav class="left-menu">
    <div class="user-profile">
        <img src="<?= isset($_SESSION['user_profile_picture']) ? $_SESSION['user_profile_picture'] : '../Images/wikum.jpg'; ?> " alt="User Profile Photo">
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
    $menuItems = [
        ['url' => 'hotel/index', 'icon' => 'bx bxs-dashboard bx-sm bx-fw', 'text' => 'Dashboard'],
        ['url' => 'hotel/bookings', 'icon' => 'bx bxs-book bx-sm bx-fw', 'text' => 'Bookings'],
        ['url' => 'hotel/calender', 'icon' => 'bx bxs-calendar bx-sm bx-fw', 'text' => 'Availability'],
        ['url' => 'hotel/gallery', 'icon' => 'bx bxs-bell bx-fw', 'text' => 'Notification'],
        ['url' => 'hotel/revenue', 'icon' => 'bx bxs-wallet bx-sm bx-fw', 'text' => 'Revenue'],
        ['url' => 'hotel/reviews', 'icon' => 'bx bxs-star bx-sm bx-fw', 'text' => 'Reviews'],
        ['url' => 'hotel/settings', 'icon' => 'bx bxs-cog bx-sm bx-fw', 'text' => 'Settings'],
    ];

    $activePage = isset($activePage) ? $activePage : ''; // Default to empty string if not set
    ?>

    <ul>
        <?php foreach ($menuItems as $menuItem): ?>
            <li>
                <a href="<?php echo URLROOT . $menuItem['url']; ?>" class="nav-button <?php echo ($activePage === $menuItem['url']) ? 'active' : ''; ?>">
                    <i class='<?php echo $menuItem['icon']; ?>'></i> <?php echo $menuItem['text']; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>



    <div class="logout">
        <a href="<?php echo URLROOT?>users/logout" class="nav-button active"><i class='bx bxs-log-out bx-sm bx-fw'></i>  Logout</a>
    </div>


</nav>
</body>
</html>