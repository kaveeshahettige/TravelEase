<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/admin/request.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/popup.css">
    <script src="<?php echo URLROOT; ?>/public/js/hotel/popup.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->

    <script src="<?php echo URLROOT?>/js/admin/script.js"></script>
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
  background-color: rgba(0, 0, 0, 0.5);
  z-index: 9999;
}

.popup-content {
  position: relative;
  max-width: 600px;
  margin: 100px auto;
  padding: 20px;
  background-color: #fff;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

.popup-content .close {
  position: absolute;
  top: 10px;
  right: 10px;
  cursor: pointer;
  font-size: 20px;
  color: #333;
}

.popup-content .hotel_popup {
  display: flex;
}

.popup-content .popup-column {
  flex: 1;
}

.popup-content h2 {
  margin-bottom: 10px;
  font-size: 24px;
}

.popup-content p {
  margin-bottom: 5px;
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
                <a href="<?php echo URLROOT?>/admin/request"><button class="tablinks active">Hotel
                        Requests</button></a>
                <a href="<?php echo URLROOT?>/admin/agencyrequest"><button class="tablinks">Travel Agency 
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
        <?php
if (!empty($data['hotelRequests']) && is_array($data['hotelRequests'])):
?>
        <div class="table-content">
            <h2>Hotel Request</h2>
            <table class="booking-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <!-- <th>ID</th> -->
                        <th>Name</th>
                        <th>Details</th>
                        <th>Document</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
            $count = 1;
            foreach ($data['hotelRequests'] as $hotel):
            ?>
                    <tr class="t-row">
                        <td><?php echo $count ?></td>
                        <!-- <td><?php echo $hotel->id ?></td> -->
                        <td><?php echo ucfirst($hotel->fname) . ' ' . ucfirst($hotel->lname) ?></td>
                        <td>
                            <button class="view-button" class="1"
                                data-name="<?php echo $hotel->fname . ' ' . $hotel->lname ?>"
                            data-description="<?php echo $hotel->description ?>"
                                data-no-rooms="<?php echo $hotel->no_rooms ?>"
                                data-alt-phone="<?php echo $hotel->alt_phone_number ?>"
                                data-manager-name="<?php echo $hotel->manager_name ?>"
                                data-manager-phone="<?php echo $hotel->manager_phone_number ?>"
                                data-street-address="<?php echo $hotel->street_address ?>"
                                data-city="<?php echo $hotel->city ?>" data-state="<?php echo $hotel->state_province ?>"
                                data-website="<?php echo $hotel->website ?>"
                                data-facebook="<?php echo $hotel->facebook ?>"
                                data-twitter="<?php echo $hotel->twitter ?>"
                                data-instagram="<?php echo $hotel->instagram ?>"
                                data-additional-notes="<?php echo $hotel->additional_notes ?>"
                                data-card-holder-name="<?php echo $hotel->card_holder_name ?>"
                                data-account-number="<?php echo $hotel->account_number ?>"><i class='bx bx-show'></i> </button>
                        </td>
                        <td><button class="view-button" onclick="openDocument('<?php echo $hotel->document ?>')"><i class='bx bxs-file-doc'></i></button></td>
                        <td><button class="accept-button" onclick="acceptUser(<?php echo $hotel->id ?>)">Accept</button>
                            <button class="decline-button"
                                onclick="declineUser(<?php echo $hotel->id ?>)">Decline</button></td>
                    </tr>
                    <?php
            $count++;
            endforeach;
            ?>
                </tbody>
            </table>
        </div>
        <?php
else:
    echo '<div class="table-content"><h2>Hotel Details</h2><table class="booking-table"><tbody><tr><td colspan="6">No data available</td></tr></tbody></table></div>';
endif;
?>
<div id="popup-container" class="popup-container">
    <div class="popup-content">
        <span class="close">&times;</span>
        <div id="hotel-details" class="hotel-details"></div>
    </div>
</div>



       
<script>
document.addEventListener('DOMContentLoaded', function () {
        // JavaScript code to show the popup when the "View" button is clicked
        var popupContainer = document.getElementById('popup-container');
        var popupContent = document.querySelector('.popup-content');

        var viewButtons = document.querySelectorAll('.view-button');

        viewButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                popupContainer.style.display = 'block';
                popupContent.style.display = 'block';
            });
        });

        var closeButton = document.querySelector('.close');
        closeButton.addEventListener('click', function () {
            popupContainer.style.display = 'none';
            popupContent.style.display = 'none';
        });
    });

document.addEventListener('DOMContentLoaded', function() {
    const viewButtons = document.querySelectorAll('.view-button');
    const popup = document.getElementById('popup-container');
    const hotelDetailsContainer = document.getElementById('hotel-details'); // Corrected ID

    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const hotelId = this.closest('.t-row').querySelector('td:nth-child(2)').innerText;
            const hotelName = this.closest('.t-row').querySelector('td:nth-child(3)').innerText;
            const hotelDescription = this.getAttribute('data-description');
            const hotelAddress = this.getAttribute('data-address');
            const noRooms = this.getAttribute('data-no-rooms');
            const altPhoneNumber = this.getAttribute('data-alt-phone');
            const managerName = this.getAttribute('data-manager-name');
            const managerPhoneNumber = this.getAttribute('data-manager-phone');
            const streetAddress = this.getAttribute('data-street-address');
            const city = this.getAttribute('data-city');
            const state = this.getAttribute('data-state');
            const website = this.getAttribute('data-website');
            const facebook = this.getAttribute('data-facebook');
            const twitter = this.getAttribute('data-twitter');
            const instagram = this.getAttribute('data-instagram');
            const additionalNotes = this.getAttribute('data-additional-notes');
            const cardHolderName = this.getAttribute('data-card-holder-name');
            const accountNumber = this.getAttribute('data-account-number');

            hotelDetailsContainer.innerHTML = `
                <h2 style="text-align:center">${hotelName}</h2>
                <div class="hotel_popup" style="display: flex">
                    <div class="popup-column">
                        <p>ID: ${hotelId}</p>
                        <p>Address: ${hotelAddress}</p>
                        <p>No. of Rooms: ${noRooms}</p>
                        <p>Alt Phone Number: ${altPhoneNumber}</p>
                        <p>Manager Name: ${managerName}</p>
                        <p>Manager Phone Number: ${managerPhoneNumber}</p>
                        <p>Description: ${hotelDescription}</p>
                    </div>
                    <div class="popup-column">
                        <p>Street Address: ${streetAddress}</p>
                        <p>City: ${city}</p>
                        <p>State/Province: ${state}</p>
                        <p>Website: ${website}</p>
                        <p>Facebook: ${facebook}</p>
                        <p>Twitter: ${twitter}</p>
                        <p>Instagram: ${instagram}</p>
                        <p>Additional Notes: ${additionalNotes}</p>
                        <p>Card Holder Name: ${cardHolderName}</p>
                        <p>Account Number: ${accountNumber}</p>
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



</html>