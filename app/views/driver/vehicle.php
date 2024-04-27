<?php                     var_dump($data['bookedVehicles']); ?>
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/driver/vehicle.css">
    <title><?php echo SITENAME ?></title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/driver/x-icon"
        href="<?php echo URLROOT; ?>/images/driver/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const sliders = document.querySelectorAll('.slider');
        const prevBtns = document.querySelectorAll('.prev-btn');
        const nextBtns = document.querySelectorAll('.next-btn');

        sliders.forEach((slider, index) => {
            const images = slider.querySelectorAll('img');
            let currentIndex = 0;

            // Function to show the current image
            function showImage(index) {
                images.forEach((img, idx) => {
                    if (idx === index) {
                        img.style.display = 'block';
                    } else {
                        img.style.display = 'none';
                    }
                });
            }

            // Show the initial image
            showImage(currentIndex);

            // Event listener for the next button
            nextBtns[index].addEventListener('click', function() {
                currentIndex++;
                if (currentIndex >= images.length) {
                    currentIndex = 0;
                }
                showImage(currentIndex);
            });

            // Event listener for the previous button
            prevBtns[index].addEventListener('click', function() {
                currentIndex--;
                if (currentIndex < 0) {
                    currentIndex = images.length - 1;
                }
                showImage(currentIndex);
            });
        });
    });
    </script>

</head>
<!-- <?php var_dump($data['profileimage']->profile_picture) ?> -->

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
            <li><a href="<?php echo URLROOT; ?>driver/calender"><i class='bx bxs-book bx-sm'></i> Availabily
                    Calender</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/bookings"><i class='bx bxs-package bx-sm'></i></i> Bookings</a>
            </li>
            <li><a href="<?php echo URLROOT; ?>driver/vehicle" class="active"><i class='bx bxs-car bx-sm'></i> Vehicle
                    Informaion </a></li>
            <li><a href="<?php echo URLROOT; ?>driver/earings"><i class='bx bx-money-withdraw bx-sm'></i>Earings and
                    Payments</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/notification"><i class='bx bxs-bell bx-sm'></i>Notification</a>
            </li>

            <li><a href="<?php echo URLROOT; ?>driver/reviews"><i class='bx bxs-star bx-sm bx-fw'></i> Reviews</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/settings"><i class='bx bxs-cog bx-sm'></i> Settings</a></li>
            <li><a href="<?php echo URLROOT?>users/logout" class="active"><i class='bx bxs-log-out bx-sm bx-fw'></i>
                    Logout</a></li>
        </ul>



    </nav>
    <main>
        <div class="logo-container">
            <img src="<?php echo URLROOT; ?>/images/driver/TravelEase.png" alt="TravelEase Logo">
            <span class="logo-text">TravelEase</span>
        </div>

        <div class="dashboard-content">
            <h1>Vehicle Informaion</h1>
        </div>

        <div class="search-content">
            <div class="booking-search">
                <input type="text" id="booking-search" placeholder="Search Vehicles">
                <button onclick="filterBookings()">
                    <i class="bx bx-search"></i> <!-- Using the Boxicons search icon -->
                </button>
            </div>
        </div>

        <div class="dashboard-sub-content">
            <div class="top-boxes">

                <!-- Total Request Box -->
                <div class="box">
                    <h2>Total Vehicles</h2>
                    <p><?php echo $data['vehicleCount'] ?></p>
                </div>

                <div class="box">
                    <!-- Rectangle 2: Change Password -->
                    <div class="basic-info-content">
                        <h2>Add a New Vehicle</h2>
                        <!-- Add change password form here -->
                        <a href="<?php echo URLROOT; ?>driver/vehiclereg/<?php echo $_SESSION['user_id']?>">
                            <button class="add-button">Add</button>
                        </a>
                    </div>
                </div>

            </div>
        </div>

        <!-- <?php var_dump($data);?> -->


        <div class="interim_container">
            <div class="dashboard-subcontent">
                <div class="content-container">
                    <?php if (!empty($data['vehicledetails'])): ?>
                    <?php foreach ($data['vehicledetails'] as $vehicle): ?>
                    <div class="vehicle-card">
                        <div class="card-image">
                            <div class="slider">
                                <img src="<?php echo URLROOT; ?>/images/<?php echo $vehicle['image']; ?>"
                                    alt="Vehicle Image 1">
                                <img src="<?php echo URLROOT; ?>/images/<?php echo $vehicle['vehi_img2']; ?>"
                                    alt="Vehicle Image 2">
                                <img src="<?php echo URLROOT; ?>/images/<?php echo $vehicle['vehi_img3']; ?>"
                                    alt="Vehicle Image 3">
                                <img src="<?php echo URLROOT; ?>/images/<?php echo $vehicle['vehi_img4']; ?>"
                                    alt="Vehicle Image 4">
                            </div>
                            <button class="prev-btn"></button>
                            <button class="next-btn">></button>
                        </div>
                        <div class="card-details">
                            <h1><?php echo $vehicle['brand']; ?> <?php echo $vehicle['model']; ?></h1>
                            <p><strong>Plate Number:</strong> <?php echo $vehicle['plate_number']; ?></p>
                            <p><strong>Year:</strong> <?php echo $vehicle['year']; ?></p>
                            <p><strong>Fuel Type:</strong> <?php echo $vehicle['fuel_type']; ?></p>
                            <p><strong>Seating Capacity:</strong> <?php echo $vehicle['seating_capacity']; ?></p>
                            <p><strong>Air Conditioning:</strong>
                                <?php echo ($vehicle['ac_type'] == 1) ? 'AC' : 'Non-AC'; ?></p>
                            <p><strong>Description:</strong> <?php echo $vehicle['description']; ?></p>
                            <div class="buttons">
                                <a href="<?php echo URLROOT; ?>driver/vehicleedit/<?php echo $vehicle['vehicle_id']; ?>"
                                    class="edit-button">Edit</a>
                                <form id="deleteForm" action="<?php echo URLROOT; ?>driver/vehicledelete" method="POST">
                                    <input type="hidden" id="vehicle_id" name="vehicle_id">
                                    <button type="button" onclick="confirmDelete(<?php echo $vehicle['vehicle_id']; ?>)"
                                        class="delete-button">
                                        <i class='bx bx-trash'></i> Delete
                                    </button>
                                </form>


                            </div>



                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>



        <div id="deleteConfirmationModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p>Are you sure you want to delete this vehicle?</p>
        <button id="confirmDeleteBtn">Yes</button>
        <button class="cancel-btn">Cancel</button>
    </div>
</div>


        <script src="<?php echo URLROOT?>/js/driver/vehicle.js"></script>
        <script>
    function confirmDelete(vehicleId) {
        // Check if the vehicleId is in the bookedVehicles array
        if (<?php echo json_encode($data['bookedVehicles']); ?>.includes(vehicleId)) {
            alert("This vehicle cannot be deleted as it has pending bookings.");
        } else {
            // Open the modal
            document.getElementById('deleteConfirmationModal').style.display = 'block';

            // Set the vehicleId in the hidden input field
            document.getElementById('vehicle_id').value = vehicleId;
        }
    }

    // Close the modal when the user clicks on the close button or outside the modal
    document.querySelector('.close').addEventListener('click', function() {
        document.getElementById('deleteConfirmationModal').style.display = 'none';
    });

    // Handle cancellation by closing the modal
    document.querySelector('.cancel-btn').addEventListener('click', function() {
        document.getElementById('deleteConfirmationModal').style.display = 'none';
    });

    // Handle deletion confirmation
    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        document.getElementById('deleteForm').submit();
    });
</script>


    </main>
</body>

</html>