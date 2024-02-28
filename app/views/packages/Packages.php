<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/Packages.css">
    <title>Packages</title>
    <link rel="icon" type="image/x-icon" href="./Images/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <nav class="left-menu">
        <div class="user-profile">
            <img src="packages images/Uththara.jpg" alt="User Profile Photo">
            <span class="user-name">Uththara Samadhi</span>
        </div>
        
        <div class="search-bar">
            <form action="#" method="GET">
                <input type="text" placeholder="Find a Setting">
                <button type="submit">Search</button>
            </form>
        </div>
        
            
            <ul>
                <li><a href="../Dashboard/Packages-dashboard.html" class="nav-button"><i class='bx bxs-dashboard bx-sm'></i>Dashboard</a></li>
                <li><a href="../Availability/Packages-availability.html"class="nav-button"><i class='bx bxs-book bx-sm'></i> Availability</a></li>
                <li><a href="../Bookings/Packages-bookings.html" class="nav-button"><i class='bx bxs-package bx-sm'></i></i> Bookings</a></li>
                <li><a href="../Gallery/Packages-gallery.html" class="nav-button"><i class='bx bxs-report bx-sm'></i> Gallery</a></li>
                <li><a href="../Revenue/Packages-revenue.html" class="nav-button"><i class='bx bx-line-chart bx-sm'></i> Revenue</a></li>
                <li><a href="../Packages/Packages.html" class="nav-button active"><i class= 'bx bxs-package bx-sm'></i>Packages</a></li>
                <li><a href="../Review/Packages-review.html" class="nav-button"><i class='bx bxs-star bx-sm bx-fw'></i> Review</a></li>
                <li><a href="../Settings/Packages-settings.html" class="nav-button"><i class='bx bxs-cog bx-sm'></i> Settings</a></li>
            </ul>
            
            
        
        
        <div class="logout">
            <a href="#"class="nav-button active"><i class='bx bxs-log-out bx-sm bx-fw'></i>  Logout</a>
        </div>
    </nav>
    <main>
        <div class="logo-container">
            <img src="packages images/TravelEase.png" alt="TravelEase Logo">
            <span class="logo-text">TravelEase</span>
        </div>
        
        <div class="dashboard-content">
            <h1>Packages</h1>
        </div>

        <div class="dashboard-sub-content">
            <div class="top-boxes">
                <!-- Small Image Boxes -->
                <div class="img-box">
                    <img src="packages images/profile.png" alt="hotel Image">
                </div>
               
    
                <!-- Total Bookings Box -->
                <div class="box">
                    <h2>Total Packages</h2>
                    <p>20</p>
                </div>
            
                <!-- Ongoing Bookings Box -->
                <div class="box">
                    <h2>Ongoing Packages</h2>
                    <p>18</p>
                </div>
            
                <!-- Customers Box -->
                <div class="box">
                    <h2>Total Customers</h2>
                    <p>15</p>
                </div>
            </div>
        </div>

        <div class="search-content">
            <div class="booking-search">
                <input type="text" id="booking-search" placeholder="Search for Pacakges">
                <button onclick="filterBookings()">
                    <i class="bx bx-search"></i> <!-- Using the Boxicons search icon -->
                </button>
            </div>
            </div>
           
            <div class="table-content">
            <h2>All Packages</h2>
                <table class="booking-table">
                    <thead>
                        <tr>
                            <th>Package Name</th>
                            <th>Package Owner</th>
                            <th>Description</th>
                            <th>Location</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                            
                        <tr>
                            <td>Aqua Adventure</td>
                            <td>Wikum Preethika</td>
                            <td>Exploration of underwater life</td>
                            <td>Galle</td>
                            <td>25000 LKR</td>
                            <td class="pending">Pending</td>
                            <td>
                                <button class="view-button">View</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Aqua Adventure</td>
                            <td>Wikum Preethika</td>
                            <td>Exploration of underwater life</td>
                            <td>Galle</td>
                            <td>25000 LKR</td>
                            <td class="pending">Pending</td>
                            <td>
                                <button class="view-button">View</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Aqua Adventure</td>
                            <td>Wikum Preethika</td>
                            <td>Exploration of underwater life</td>
                            <td>Galle</td>
                            <td>25000 LKR</td>
                            <td class="approved">Approved</td>
                            <td>
                                <button class="view-button">View</button>
                            </td>
                        </tr>   
                    </tbody>
                </table>
            </div>
    
            <div class="more-content">
                <button class="next-page-btn">See More <i class='bx bx-chevron-right'></i></button>
            </div>

    </main>
</body>
</html>
