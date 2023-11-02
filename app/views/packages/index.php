<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/Packages-dashboard.css">
    <title>Hotel Dashboard</title>
    <link rel="icon" type="image/x-icon" href="./Images/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <nav class="left-menu">
        <div class="user-profile">
            <img src="dashboard images/profile.png" alt="User Profile Photo">
            <span class="user-name">Package Name</span>
        </div>
        
        <div class="search-bar">
            <form action="#" method="GET">
                <input type="text" placeholder="Find a Setting">
                <button type="submit">Search</button>
            </form>
        </div>
        
        <ul>
            <li><a href="Packages-dashboard.html" class="nav-button active"><i class= 'bx bxs-dashboard bx-sm'></i> Dashboard</a></li>
            <li><a href="../Availability/Packages-availability.html" class="nav-button"><i class='bx bxs-calendar bx-sm bx-fw'></i> Availability</a></li>
            <li><a href="../Bookings/Packages-bookings.html" class="nav-button"><i class= 'bx bxs-book bx-sm bx-fw'></i> Bookings</a></li>
            <li><a href="../Gallery/Packages-gallery.html" class="nav-button"><i class='bx bx-images bx-sm bx-fw'></i> Gallery</a></li>
            <li><a href="../Revenue/Packages-revenue.html" class="nav-button"><i class= 'bx bxs-wallet bx-sm bx-fw'></i> Revenue</a></li>
            <li><a href="../Packages/Packages.html" class="nav-button"><i class='bx bxs-package bx-sm'></i> Packages</a></li>
            <li><a href="../Review/Packages-review.html" class="nav-button"><i class='bx bxs-star bx-sm bx-fw'></i> Reviews</a></li>
            <li><a href="../Settings/Packages-settings.html" class="nav-button"><i class='bx bxs-cog bx-sm bx-fw'></i> Settings</a></li>
        </ul>
        
        <div class="logout">
            <a href="#" class="nav-button active"><i class='bx bxs-log-out bx-sm bx-fw'></i>  Logout</a>
        </div>
    </nav>
    <main>
        <div class="logo-container">
            <img src="Images/TravelEase.png" alt="TravelEase Logo">
            <span class="logo-text">TravelEase</span>
        </div>
        
        <div class="dashboard-content">
            <h1>Dashboard</h1>
        </div>

        <div class="dashboard-sub-content">
        <div class="top-boxes">
            <!-- Small Image Boxes -->
            <div class="img-box">
                <img src="Images/dashboard.jpg" alt="hotel Image">
            </div>
           

            <!-- Total Bookings Box -->
            <div class="box">
                <h2>Total Bookings</h2>
                <p>120</p>
            </div>
        
            <!-- Ongoing Bookings Box -->
            <div class="box">
                <h2>Total Revenue</h2>
                <p>65,000 LKR</p>
            </div>
        
            <!-- Customers Box -->
            <div class="box">
                <h2>Total Customers</h2>
                <p>10</p>
            </div>
        </div>
        </div>            

    </main>
</body>
</html>
