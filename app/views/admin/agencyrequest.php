<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <link rel="stylesheet" href="<?php echo URLROOT?>/css/admin/request.css">
    <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->

    <script src="<?php echo URLROOT?>/js/admin/script.js"></script>

    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/popup.css">
    <script src="<?php echo URLROOT; ?>/public/js/hotel/popup.js"></script>

    <title>TravelEase</title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/admin/x-icon"
        href="<?php echo URLROOT?>/images/TravelEase_logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


    <style>
        .popup-container {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black background */
            z-index: 9999; /* Ensure the popup appears on top of other elements */
        }

        .popup-content {
            background-color: #fff; /* White background for the popup content */
            width: 80%; /* Adjust the width as needed */
            max-width: 800px; /* Maximum width for the popup */
            margin: 20px auto; /* Center the popup vertically and horizontally */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Box shadow for a subtle depth effect */
            position: relative;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            font-size: 20px;
            color: #333;
        }

        .close:hover {
            color: #f00; /* Change color on hover if desired */
        }
    </style>

</head>

<body>
    <nav class="left-menu">
        <div class="user-profile">
            <img src="<?php echo URLROOT; ?>/images/admin/wikum.jpg" alt="User Profile Photo">
            <span class="user-name"><?php echo ucfirst($data['fname']); ?></span>
        </div>

        <div class="search-bar">
            <form action="#" method="GET">
                <input type="text" placeholder="Find a Setting">
                <button type="submit">Search</button>
            </form>
        </div>
        <ul>
            <li><a href="<?php echo URLROOT; ?>admin/index"><i class='bx bxs-dashboard bx-sm'></i> Overview</a></li>
            <li><a href="<?php echo URLROOT; ?>admin/request" class="active"><i class='bx bxs-book bx-sm'></i>
                    Request</a></li>
            <li><a href="<?php echo URLROOT; ?>admin/traveler"><i class='bx bx-child bx-sm'></i></i> Traveler</a></li>

            <li><a href="<?php echo URLROOT; ?>admin/hotel"><i class='bx bxs-hotel bx-sm'></i></i> Hotels</a></li>
            <li><a href="<?php echo URLROOT; ?>admin/agency"><i class='bx bxs-car bx-sm'></i> Travel Agencies </a></li>
            <li><a href="<?php echo URLROOT; ?>admin/package"><i class='bx bx-package bx-sm'></i>Guide</a></li>
            <li><a href="<?php echo URLROOT; ?>admin/settings"><i class='bx bxs-cog bx-sm'></i> Settings</a></li>

            
        </ul>

        <div class="logout">
        <a href="#" class="nav-button active" onclick="confirmLogout(event)"><i class='bx bxs-log-out bx-sm bx-fw'></i> Logout</a>
        </div>

    </nav>
    <main>
        <div class="logo-container">
            <img src="<?php echo URLROOT; ?>/images/admin/TravelEase.png" alt="TravelEase Logo">
            <span class="logo-text">TravelEase</span>
        </div>

        <div class="dashboard-content">
            <h1>Requests</h1>
        </div>

        <div class="dashboard-sub-content">
            <div class="top-boxes">

                <!-- Total Request Box -->
                <div class="box">
                    <h2>Total Requests</h2>
                    <p><?php echo $data['nore'] ?></p>
                </div>


            </div>
        </div>

        <div class="table-content-button">
            <div class="tab">
                <a href="<?php echo URLROOT?>/admin/request"><button class="tablinks">Hotel
                        Requests</button></a>

                <a href="<?php echo URLROOT?>/admin/agencyrequest"><button class="tablinks active">Travel Agency

                        Requests</button></a>
                <a href="<?php echo URLROOT?>/admin/guiderequests"><button class="tablinks">Guide
                        Requests</button></a>
            </div>
        </div>

        <div class="search-content">
            <div class="booking-search">
                <input type="text" id="booking-search" placeholder="Search for Requesting">
                <button onclick="filterBookings()">
                    <i class="bx bx-search"></i> <!-- Using the Boxicons search icon -->
                </button>
            </div>
        </div>



        <div class="table-content">
            <h2>Travel Agency Request</h2>
            <?php if (!empty($data['agencyRequests']) && is_array($data['agencyRequests'])): ?>
            <table class="booking-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Details</th>
                        <th>Document</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                $count = 1;
                foreach ($data['agencyRequests'] as $agency):
                ?>
                    <tr class="t-row">
                        <td><?php echo $count ?></td>
                        <td><?php echo $agency->id ?></td>
                        <td><?php echo ucfirst($agency->fname) . ' ' . ucfirst($agency->lname) ?></td>
                        <td>
                        <button class="view-button"
                        data-id="<?php echo $agency->id ?>"
                        data-name="<?php echo ucfirst($agency->fname) . ' ' . ucfirst($agency->lname) ?>"

                        data-description="<?php echo $agency->description ?>"
                        data-address="<?php echo $agency->address ?>"
                        data-phone="<?php echo $agency->number ?>"
                        data-manager-name="<?php echo $agency->manager_name ?>"
                        data-city="<?php echo $agency->city ?>"
                        data-website="<?php echo $agency->website ?>"
                        data-facebook="<?php echo $agency->facebook ?>"
                        data-twitter="<?php echo $agency->twitter ?>"
                        data-instagram="<?php echo $agency->instagram ?>"
                        data-card-holder-name="<?php echo $agency->card_holder_name ?>"
                        data-account-number="<?php echo $agency->account_number ?>"><i class='bx bx-show'></i></button>
                        </td>
                        <td><button class="view-button2"
                                onclick="openDocument('<?php echo isset($agency->document) ? $agency->document : '' ?>')"><i class='bx bxs-file-doc'></button></td>
                        <td><button class="accept-button"
                                onclick="acceptUser(<?php echo $agency->id ?>)">Accept</button> <button
                                class="decline-button" onclick="declineUser(<?php echo $agency->id ?>)">Decline</button>
                        </td>
                    </tr>
                    <?php
                $count++;
                endforeach;
                ?>
                </tbody>
            </table>
            <?php else: ?>
            <p>No pending requests</p>
            <?php endif; ?>
        </div>


        <div id="popup-container" class="popup-container">
        <div class="popup-content">
            <span class="close">&times;</span>
            <div id="agency-details"></div>
        </div>
    </div>

   
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
            const viewButtons = document.querySelectorAll('.view-button');
            const popup = document.getElementById('popup-container');
            const agencyDetailsContainer = document.getElementById('agency-details');

            viewButtons.forEach(button => {
                button.addEventListener('click', function() {
            // Log the button click to check if this function executes
            console.log('Button clicked');

            // Retrieve data attributes
            const agencyId = this.getAttribute('data-id');
            const agencyName = this.getAttribute('data-name');
            const agencyDescription = this.getAttribute('data-description');
            const agencyAddress = this.getAttribute('data-address');
            const agencyPhone = this.getAttribute('data-phone');
            const managerName = this.getAttribute('data-manager-name');
            const city = this.getAttribute('data-city');
            const website = this.getAttribute('data-website');
            const facebook = this.getAttribute('data-facebook');
            const twitter = this.getAttribute('data-twitter');
            const instagram = this.getAttribute('data-instagram');
            const cardHolderName = this.getAttribute('data-card-holder-name');
            const accountNumber = this.getAttribute('data-account-number');

            // Log retrieved data to check if it's correct
            console.log('Agency ID:', agencyId);
            console.log('Agency Name:', agencyName);
            console.log('Agency Description:', agencyDescription);
            // Add more logs for other data attributes

            // Populate the popup HTML
            agencyDetailsContainer.innerHTML = `
                <h2 style="text-align:center">${agencyName}</h2>
                <div class="agency_popup" style="display: flex">
                    <div class="popup-column">
                        <p>ID: ${agencyId}</p>
                        <p>Address: ${agencyAddress}</p>
                        <p>Phone: ${agencyPhone}</p>
                        <p>Manager Name: ${managerName}</p>
                       
                       
                        <p>City: ${city}</p>
                        <p>Website: ${website}</p>
                        <p>Facebook: ${facebook}</p>
                        <p>Twitter: ${twitter}</p>
                        <p>Instagram: ${instagram}</p>
                        </div><div class="popup-column">
                    
                        <p>Card Holder Name: ${cardHolderName}</p>
                        <p>Account Number: ${accountNumber}</p>
                        <p>Description: ${agencyDescription}</p>
                    </div>
                </div>
            `;
            popup.style.display = 'block';
                });
            });

            const closeBtn = document.querySelector('.close');
            closeBtn.addEventListener('click', function() {
                popup.style.display = 'none';
            });
        });

</script>

</body>



</html>