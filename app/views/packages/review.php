<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/Packages-review.css">
    <title>Hotel Reviews</title>
    <link rel="icon" type="image/x-icon" href="./Images/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <nav class="left-menu">
        <div class="user-profile">
            <img src="../Review/Review images/Uththara.jpg" alt="User Profile Photo">
            <span class="user-name">Uththara Samadhi</span>
        </div>
        
        <div class="search-bar">
            <form action="#" method="GET">
                <input type="text" placeholder="Find a Setting">
                <button type="submit">Search</button>
            </form>
        </div>
        
        <ul>
            <li><a href="../Dashboard/hotel-dashboard.html" class="nav-button"><i class='bx bxs-dashboard bx-sm'></i> Dashboard</a></li>
            <li><a href="../Availability/Packages-availability.html" class="nav-button"><i class='bx bxs-calendar bx-sm bx-fw'></i>Availability</a></li>
            <li><a href="../Bookings/Packages-bookings.html" class="nav-button"><i class='bx bxs-book bx-sm bx-fw'></i>Bookings</a></li>
            <li><a href="../Gallery/Packages-gallery.html" class="nav-button"><i class='bx bx-images bx-sm bx-fw'></i> Gallery</a></li>
            <li><a href="../Revenue/Packages-revenue.html" class="nav-button"><i class='bx bxs-wallet bx-sm bx-fw'></i> Revenue</a></li>
            <li><a href="../Packages/Packages.html" class="nav-button"><i class='bx bxs-package bx-sm'></i>Packages</a></li>
            <li><a href="../Review/Packages-review.html" class="nav-button active"><i class= 'bx bxs-star bx-sm bx-fw'></i> Review</a></li>
            <li><a href="../Settings/Packages-settings.html" class="nav-button"><i class=  'bx bxs-cog bx-sm bx-fw'></i> Settings</a></li>
        </ul>
        
        <div class="logout">
            <a href="#" class="nav-button active"><i class='bx bxs-log-out bx-sm bx-fw'></i>  Logout</a>
        </div>
    </nav>
    <main>
        <div class="logo-container">
            <img src="../Review/Review images/TravelEase.png" alt="TravelEase Logo">
            <span class="logo-text">TravelEase</span>
        </div>
        
        <div class="dashboard-content">
            <h1>Reviews</h1>
        </div>

        <div class="dashboard-sub-content">
        <div class="top-boxes">
            <!-- Small Image Boxes -->
            <div class="img-box">
                <img src="../Review/Review images/image1.jpg" alt="hotel Image">
            </div>
           

            <!-- Total Bookings Box -->
            <div class="box">
                <h2>Total Reviews</h2>
                <p>160</p>
            </div>
        
            <!-- Ongoing Bookings Box -->
            <div class="box">
                <h2>Total Package Bookings</h2>
                <p>150</p>
            </div>
        
            <!-- Customers Box -->
            <div class="box">
                <h2>Total Customers</h2>
                <p>50</p>
            </div>
        </div>
        </div>

        <div class="search-content">
            <div class="review-search">
                <input type="text" id="review-search" placeholder="Search for Reviews">
                <button onclick="filterBookings()">
                    <i class="bx bx-search"></i> <!-- Using the Boxicons search icon -->
                </button>
            </div>
        </div>

        <div class="review-content">

            <div class="review-box">
                <div class="review-sub-content">
                    <div class="review-image">
                        <img src="../Review/Review images/profile.png" alt="Guest Photo">
                    </div>
                    <h2>Uththara Samadhi</h2>
                    <p>Date: March 17, 2023</p>
                    <p class="review-text">Review:Package Review .......</p>
                    <button class="read-more-btn">Read More</button>
                </div>
            </div>

            <div class="review-box">
                <div class="review-sub-content">
                    <div class="review-image">
                        <img src="../Review/Review images/profile.png" alt="Guest Photo">
                    </div>
                    <h2>Dilanga Niroshan</h2>
                    <p>Date: October 15, 2023</p>
                    <p class="review-text">Review:Package Review....</p>
                    <button class="read-more-btn">Read More</button>
                </div>
            </div>
        </div>
        
        <div class="more-content">
            <button class="next-page-btn">More Reviews <i class='bx bx-chevron-right'></i></button>
        </div>

    </main>
</body>
</html>