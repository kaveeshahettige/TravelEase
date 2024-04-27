<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/packages/navigation.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/popup.css">
    <script src="<?php echo URLROOT; ?>/public/js/hotel/popup.js"></script>
    <title>Guide Navigation</title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/packages/x-icon" href="<?php echo URLROOT; ?>/images/packages/PackageEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<?php
$userData = $data['userData'];
?>
<nav class="left-menu">
    <div class="user-profile">
        <img id="profile-picture" src="<?= isset($userData->profile_picture) ? '../public/images/' . $userData->profile_picture : '../images/profile.png'; ?>" alt="User Profile Photo">
        <span class="user-name"><?php echo isset($userData->fname) ? $userData->fname : ''; ?></span>
    </div>

    <div class="search-bar">
        <form action="#" method="GET">
            <input type="text" placeholder="Find a Setting">
            <button type="submit">Search</button>
        </form>
    </div>

    <?php
    $menuItems = [
        ['url' => 'packages/index', 'icon' => 'bx bxs-dashboard bx-sm bx-fw', 'text' => 'Dashboard'],
        ['url' => 'packages/calender', 'icon' => 'bx bxs-book bx-sm bx-fw', 'text' => 'Availability'],
        ['url' => 'packages/bookings', 'icon' => 'bx bxs-calendar bx-sm bx-fw', 'text' => 'Bookings'],
//        ['url' => 'packages/galllery', 'icon' => 'bx bx-images bx-sm bx-fw', 'text' => 'Gallery'],
        ['url' => 'packages/revenue', 'icon' => 'bx bxs-wallet bx-sm bx-fw', 'text' => 'Revenue'],
        ['url' => 'packages/notifications', 'icon' => 'bx bxs-bell bx-sm bx-fw', 'text' => 'Notifications'],
        ['url' => 'packages/review', 'icon' => 'bx bxs-star bx-sm bx-fw', 'text' => 'Reviews'],
        ['url' => 'packages/settings', 'icon' => 'bx bxs-cog bx-sm bx-fw', 'text' => 'Settings'],
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
        <a href="#" class="nav-button active" onclick="confirmLogout(event)"><i class='bx bxs-log-out bx-sm bx-fw'></i> Logout</a>
    </div>

</nav>
</body>
</html>
