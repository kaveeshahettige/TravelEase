<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/navigation.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/popup.css">
    <title>Navigation</title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/hotel/x-icon" href="<?php echo URLROOT; ?>/images/hotel/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<nav class="left-menu">

    <?php
    $userData= $data['basicInfo']['userData'];
    ?>

    <div class="user-profile">
        <img src="<?= isset($userData->profile_picture) ? $userData->profile_picture : '../Images/wikum.jpg'; ?>" alt="User Profile Photo">
        <span class="user-name"><?=($userData->fname)?></span>
        <button class="notification-button" onclick="showNotifications()">
            <i class="bx bx-bell"></i> <!-- Bell icon from Boxicons -->
        </button>
    </div>



    <div class="search-bar">
        <form id="searchForm" action="#" method="GET">
            <input type="text" id="searchInput" placeholder="Find a Setting">
            <button type="submit">Search</button>
        </form>
    </div>

    <script>
        // Check if the search form exists before adding event listener
        var searchForm = document.getElementById("searchForm");
        if (searchForm) {
            searchForm.addEventListener("submit", function(event) {
                event.preventDefault(); // Prevent default form submission behavior

                // Get the search input value
                var searchValue = document.getElementById("searchInput").value.trim().toLowerCase();

                // Perform search logic based on the current page
                var currentPage = window.location.pathname; // Get the current page URL

                // Perform different search actions based on the current page
                switch (currentPage) {
                    case "/hotel/bookings":
                        // Search logic for bookings page
                        alert("Searching bookings for: " + searchValue);
                        break;
                    case "/hotel/calender":
                        // Search logic for calendar page
                        alert("Searching availability for: " + searchValue);
                        break;
                    case "/hotel/gallery":
                        // Search logic for gallery page
                        alert("Searching gallery for: " + searchValue);
                        break;
                    // Add more cases for other pages as needed
                    default:
                        // Default search logic if page-specific logic is not defined
                        alert("Searching on: " + currentPage + " for: " + searchValue);
                }
            });
        }
    </script>


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
        <a href="#" class="nav-button active" onclick="confirmLogout(event)"><i class='bx bxs-log-out bx-sm bx-fw'></i> Logout</a>
    </div>

    <script src="<?php echo URLROOT; ?>/public/js/hotel/popup.js"></script>


</nav>
</body>
</html>