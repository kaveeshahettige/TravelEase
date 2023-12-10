<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/hotel/settingssub.css">
    <title>Hotel - Add Rooms</title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/hotel/x-icon" href="<?php echo URLROOT; ?>/images/hotel/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<nav class="left-menu">
    <div class="user-profile">
        <img src="<?php echo URLROOT; ?>/images/hotel/wikum.jpg" alt="User Profile Photo">
        <span class="user-name"><?=$_SESSION['user_fname']?></span>
    </div>

    <div class="search-bar">
        <form action="#" method="GET">
            <input type="text" placeholder="Find a Setting">
            <button type="submit">Search</button>
        </form>
    </div>

    <ul>
        <li><a href="<?php echo URLROOT; ?>hotel/index" class="nav-button"><i class='bx bxs-info-circle bx-tada-hover bx-sm bx-fw'></i> Dashboard</a></li>
        <li><a href="<?php echo URLROOT; ?>hotel/bookings" class="nav-button "><i class='bx bxs-book bx-sm bx-fw'></i> Bookings</a></li>
        <li><a href="<?php echo URLROOT; ?>hotel/calender" class="nav-button "><i class='bx bxs-calendar bx-sm bx-fw'></i> Availability</a></li>
        <li><a href="<?php echo URLROOT; ?>hotel/gallery" class="nav-button "><i class='bx bx-images bx-sm bx-fw'></i> Notifications</a></li>
        <li><a href="<?php echo URLROOT; ?>hotel/revenue" class="nav-button "><i class='bx bxs-wallet bx-sm bx-fw'></i> Revenue</a></li>
        <li><a href="<?php echo URLROOT; ?>hotel/reviews" class="nav-button "><i class='bx bxs-star bx-sm bx-fw'></i> Reviews</a></li>
        <li><a href="<?php echo URLROOT; ?>hotel/settings" class="nav-button active "><i class='bx bxs-cog bx-sm bx-fw'></i> Settings</a></li>
    </ul>
</nav>
<main>
    <div class="logo-container">
        <img src="<?php echo URLROOT; ?>/images/hotel/TravelEase.png" alt="TravelEase Logo">
        <span class="logo-text">TravelEase</span>
    </div>
    <div class="dashboard-content">
        <div>
            <h1>Settings</h1>
        </div>


        <div id="base">
            <?php
                $roomData = $data;
//                print_r($data);
            ?>
            <h3>Add Rooms</h3>
            <div id="form">
                <form class="registration-form" action="" method="POST">
                    <div>
                        <div class="form-group">
                            <label for="roomType">Room Type</label>
                            <select id="roomType" name="roomType">
                                <option value="standard" <?php echo ($roomData['roomType'] === 'standard') ? 'selected' : ''; ?>>Standard</option>
                                <option value="deluxe" <?php echo ($roomData['roomType'] === 'deluxe') ? 'selected' : ''; ?>>Deluxe</option>
                                <option value="suite" <?php echo ($roomData['roomType'] === 'suite') ? 'selected' : ''; ?>>Suite</option>
                            </select >
                        </div>

                        <div class="form-group">
                            <label for="numOfBeds">Number of Beds</label>
                            <select id="numOfBeds" name="numOfBeds">
                                <option value="1"><?php echo ($roomData['numOfBeds'] === '1') ? 'selected' : ''; ?>1 Bed</option>
                                <option value="2"><?php echo ($roomData['numOfBeds'] === '2') ? 'selected' : ''; ?>2 Beds</option>
                                <option value="3"><?php echo ($roomData['numOfBeds'] === '3') ? 'selected' : ''; ?>3 Beds</option>
                                <option value="4"><?php echo ($roomData['numOfBeds'] === '4') ? 'selected' : ''; ?>4 Beds</option>
                            </select>
                        </div>
                    </div>
                    <div>

                        <div class="form-group">
                            <label for="price">Price (per night)</label>
                            <input type="number" id="price" name="price" required value=<?php echo $roomData["price"]?>>
                        </div>


                    </div>

                    <div>
                        <div class="form-group">
                            <label for="roomDescription">Room Description:</label>
                            <textarea id="roomDescription" name="roomDescription" rows="4" required ><?php echo $roomData["roomDescription"]; ?></textarea>
                        </div>
                    </div>


                    <div>
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