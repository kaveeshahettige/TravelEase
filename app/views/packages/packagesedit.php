<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Packages-edit.css">
    <title>Package-Edit</title>
    <link rel="icon" type="image/x-icon" href="../Images/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <nav class="left-menu">
        <div class="user-profile">
            <img src="../settings images/Uththara.jpg" alt="User Profile Photo">
            <span class="user-name">Uththara Samadhi</span>
        </div>
        
        <div class="search-bar">
            <form action="#" method="GET">
                <input type="text" placeholder="Find a Setting">
                <button type="submit">Search</button>
            </form>
        </div>
        
            
        <ul>
            <li><a href="../../Dashboard/Packages-dashboard.html" class="nav-button"><i class='bx bxs-info-circle bx-tada-hover bx-sm bx-fw'></i> Dashboard</a></li>
            <li><a href="../../Availability/Packages-availability.html" class="nav-button"><i class='bx bxs-book bx-sm bx-fw'></i> Availability</a></li>
            <li><a href="../../Bookings/Packages-bookings.html" class="nav-button"><i class='bx bxs-calendar bx-sm bx-fw'></i>Bookings</a></li>
            <li><a href="../../Gallery/Packages-gallery.html" class="nav-button"><i class='bx bx-images bx-sm bx-fw'></i> Gallery</a></li>
            <li><a href="../../Revenue/Packages-revenue.html" class="nav-button"><i class='bx bxs-wallet bx-sm bx-fw'></i> Revenue</a></li>
            <li><a href="../../Packages/Packages.html" class="nav-button"><i class='bx bxs-star bx-sm bx-fw'></i>Packages</a></li>
            <li><a href="../../Review/Packages-review.html" class="nav-button"><i class='bx bxs-star bx-sm bx-fw'></i> Reviews</a></li>
            <li><a href="packages-edit.html" class="nav-button active"><i class='bx bxs-cog bx-sm bx-fw'></i> Settings</a></li>
        </ul>  
        
        
        <div class="logout">
            <a href="#" class="active"><i class='bx bxs-log-out bx-sm bx-fw'></i>  Logout</a>
        </div>
    </nav>
    <main>
        <div class="logo-container">
            <img src="../settings images/Logo.png" alt="TravelEase Logo">
            <span class="logo-text">TravelEase</span>
        </div>
        <div class="dashboard-content">
            <div><h1>Settings</h1> </div>
             
            <div id="base">
                <h3 style="padding-left:20px;">Basic Info</h3>
                <div id="form">
                    <form class="registration-form">
                        <div>
                            <div class="form-group">
                                <label for="First Name">Package Name</label>
                                <input type="text" id="packages-name" name="package-name" placeholder="package-Name"required>
                            </div>
                            <div class="form-group">
                                <label for="Last Name">Package Owner</label>
                                <input type="text" id="package-Owner" name="package-Owner" placeholder="package Owner" required>
                            </div>                       
                        </div>

                        <div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" id="email" name="email" placeholder="email@gmail.com" required>
                            </div>
                        
                            <div class="form-group">
                                <label for="phonenumber">Contact Number</label>
                                <input type="text" id="contact-number" name="contact-number" placeholder="0764532789" required>
                            </div>
                        </div>

                        <div>
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" id="location" name="location" placeholder="Location,Location">
                            </div>
                            <div class="form-group">
                                <label for="location">Facebook</label>
                                <input type="url" id="facebook" name="facebook" placeholder="Package Facebook">
                            </div>
                        </div>

                        <div>
                            <div class="form-group">
                                <label for="location">About</label>
                                <textarea id="PackageAbout" name="PackageAbout" rows="4" required></textarea>
                            </div>
                        </div>

                        <div >
                            <div class="baseButtons">
                                <button id="cancelBut">Cancel</button>
                                <button id="saveBut" type="submit">Save</button>
                            </div>
                        </div>
                       
                        
                    
                    
                    
                    </form>
                </div>
            </div>
           
            
        </div>
    </main>
</body>
</html>
