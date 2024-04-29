<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/driver/calender.css">
    <script src="<?php echo URLROOT; ?>/public/js/hotel/popup.js"></script>
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/popup.css">
    <!-- <link rel="stylesheet" href="<?php echo URLROOT ?>/css/hotel/navigation.css"> -->
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/hotel/availablerooms.css">
    <title><?php echo SITENAME ?></title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/driver/x-icon"
        href="<?php echo URLROOT; ?>/images/driver/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="<?php echo URLROOT ?>/public/js/driver/calender.js"></script>


</head>

<body>

    <nav class="left-menu">
        <div class="user-profile">
            <img src="<?php echo URLROOT; ?>/images/<?php echo $data['profileimage']->profile_picture ?>"
                alt="User Profile Photo">
            <span class="user-name"><?php echo $_SESSION['user_fname'].' '.$_SESSION['user_lname']?></span>
            <a class="" href="<?php echo URLROOT; ?>/driver/notification">
                <i class="bx bx-bell"></i>
            </a>
        </div>


        <div class="search-bar">
            <form action="#" method="GET">
                <input type="text" placeholder="Find a Setting">
                <button type="submit">Search</button>
            </form>
        </div>
        <ul>
            <li><a href="<?php echo URLROOT; ?>driver/index"><i class='bx bxs-dashboard bx-sm'></i> Overview</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/calender" class="active"><i class='bx bxs-book bx-sm'></i>
                    Availabily Calender</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/bookings"><i class='bx bxs-package bx-sm'></i></i> Bookings</a>
            </li>
            <li><a href="<?php echo URLROOT; ?>driver/vehicle"><i class='bx bxs-car bx-sm'></i> Vehicle Informaion </a>
            </li>
            <li><a href="<?php echo URLROOT; ?>driver/earings"><i class='bx bx-money-withdraw bx-sm'></i>Earings and
                    Payments</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/notification"><i
                        class='bx bxs-bell bx-sm bx-sm'></i>Notification</a></li>

            <li><a href="<?php echo URLROOT; ?>driver/reviews"><i class='bx bxs-star bx-sm bx-fw'></i> Reviews</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/settings"><i class='bx bxs-cog bx-sm'></i> Settings</a></li>
            <li> <a href="#" class="nav-button active" onclick="confirmLogout(event)"><i
                        class='bx bxs-log-out bx-sm bx-fw'></i> Logout</a></li>
        </ul>

        <!-- <div class="logout">
            <a href="<?php echo URLROOT; ?>pages/indes" class="active"><i class='bx bxs-log-out bx-sm bx-fw'></i>  Logout</a>
        </div> -->
    </nav>
    <main>
        <div class="logo-container">
            <img src="<?php echo URLROOT; ?>/images/hotel/TravelEase.png" alt="TravelEase Logo">
            <span class="logo-text">TravelEase</span>
        </div>

        <div class="dashboard-content">
            <div>
                <h1>Availability</h1>
            </div>
        </div>

        <div class="main-content">
            <div class="room-content">
                <h2>Vehicle Details</h2>
                <?php echo "Selected Date: " . $data['date']; ?>
                <table class="room-table">
                    <thead>
                        <tr>
                            <!-- <th>Vehicle ID</th> -->
                            <th>Plate Number</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $vehicleData = $data["vehicleData"];
                        $date = $data['date'];
                        $unavailableVehicles = $data['unavailableVehicles'] ?? []; // Set default value to empty array if $unavailableVehicles is null
                        // var_dump( $unavailableVehicles);
                        // var_dump($vehicleData);
                        foreach ($vehicleData as $agency_vehicles) :

                            
                        ?>
                        <tr>
                            <!-- <td><?php echo ucfirst($agency_vehicles->vehicle_id); ?></td> -->
                            <td><?php echo ucfirst($agency_vehicles->plate_number); ?></td>

                            <td>
                                <?php
                                    if (in_array($agency_vehicles->vehicle_id, $unavailableVehicles)) {
                                        echo "Unavailable";
                                    } else {
                                        echo "Available";
                                    }
                                    ?>
                            </td>


                            <td>
                                <button class="btn btn-make-unavailable"
                                    data-vehicle-id="<?php echo $agency_vehicles->vehicle_id; ?>"
                                    onclick="setUnavailableDate(<?php echo $agency_vehicles->vehicle_id; ?>, '<?php echo $data['date']; ?>')">
                                    <i class='bx bx-check'></i>
                                </button>
                                <button class="btn btn-make-available"
                                    data-vehicle-id="<?php echo $agency_vehicles->vehicle_id; ?>"
                                    onclick="removeUnavailableDate(<?php echo $agency_vehicles->vehicle_id; ?>, '<?php echo $data['date']; ?>')">
                                    <i class='bx bx-trash'></i>
                                </button>


                            </td>


                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>
</body>

</html>