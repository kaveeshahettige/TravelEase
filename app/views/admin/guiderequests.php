<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/admin/request.css">
    <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->

    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/popup.css">
    <script src="<?php echo URLROOT; ?>/public/js/hotel/popup.js"></script>


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

/* Additional styles for the popup content */
.container {
    display: flex;
    justify-content: space-between;
}

.column {
    flex: 1;
}

.guide-info {
    text-align: center;
    margin-bottom: 20px;
}

.guide-info h2 {
    margin-bottom: 10px;
}

.guide-text {
    margin-bottom: 20px;
}

.guide-description {
    margin-top: 20px;
}

#guide-image {
    width: 100%;
    max-width: 200px;
    height: auto;
    border-radius: 10px;
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
                <a href="<?php echo URLROOT?>/admin/request"><button class="tablinks ">Hotel
                        Requests</button></a>
                <a href="<?php echo URLROOT?>/admin/agencyrequest"><button class="tablinks">Travel Agency
                        Requests</button></a>
                <a href="<?php echo URLROOT?>/admin/guiderequests"><button class="tablinks active">Guide
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
if (!empty($data['guideRequests']) && is_array($data['guideRequests'])):
?>
        <div class="table-content">
            <h2>Guides Request</h2>
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
            foreach ($data['guideRequests'] as $guide):
            ?>
                    <tr class="t-row">
                        <td><?php echo $count ?></td>
                        <td><?php echo $guide->guide_id ?></td>
                        <td><?php echo ucfirst($guide->fname) . ' ' . ucfirst($guide->lname) ?></td>
                        <td>
                            <button class="view-button" data-description="<?php echo $guide->description ?>"
                                data-address="<?php echo $guide->address ?>" data-city="<?php echo $guide->city ?>"
                                data-province="<?php echo $guide->province ?>"
                                data-facebook="<?php echo $guide->facebook ?>"
                                data-instagram="<?php echo $guide->instagram ?>"
                                data-price-per-day="<?php echo $guide->pricePerDay ?>"
                                data-image="<?php echo $guide->image ?>" data-category="<?php echo $guide->category ?>"
                                data-languages="<?php echo $guide->languages ?>"
                                data-reg-number="<?php echo $guide->GuideRegNumber ?>"
                                data-license-exp-date="<?php echo $guide->LisenceExpDate ?>"
                                data-sites="<?php echo $guide->sites ?>"><i class='bx bx-show'></i></button>
                        </td>
                        <td><button class="view-button2" onclick="openDocument('<?php echo $guide->document ?>')"><i class='bx bxs-file-doc'></i></i></button></td>
                        <td><button class="accept-button" onclick="acceptUser(<?php echo $guide->id ?>)">Accept</button>
                            <button class="decline-button"
                                onclick="declineUser(<?php echo $guide->id ?>)">Decline</button>
                        </td>
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
    echo '<div class="table-content"><h2>Guides Details</h2><table class="booking-table"><tbody><tr><td colspan="4">No data available</td></tr></tbody></table></div>';
endif;
?>



<div id="popup-container" class="popup-container">
    <div class="popup-content">
        <span class="close">&times;</span>
        <div id="guide-details" class="guide-details"></div>
    </div>
</div>
</body>







<script>
document.addEventListener('DOMContentLoaded', function() {
    const viewButtons = document.querySelectorAll('.view-button');
    const popup = document.getElementById('popup-container'); // Changed ID to "guide-popup"
    const guideDetailsContainer = document.getElementById('guide-details');

    const closeBtn = document.querySelector('.close'); // Select the close button


    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const guideId = this.closest('.t-row').querySelector('td:nth-child(2)').innerText;
            const guideName = this.closest('.t-row').querySelector('td:nth-child(3)').innerText;
            const guideDescription = this.getAttribute('data-description');
            const guideAddress = this.getAttribute('data-address');
            const guideCity = this.getAttribute('data-city');
            const guideProvince = this.getAttribute('data-province');
            const guideFacebook = this.getAttribute('data-facebook');
            const guideInstagram = this.getAttribute('data-instagram');
            const guidePricePerDay = this.getAttribute('data-price-per-day');
            const guideCategory = this.getAttribute('data-category');
            const guideLanguages = this.getAttribute('data-languages');
            const guideRegNumber = this.getAttribute('data-reg-number');
            const guideLicenseExpDate = this.getAttribute('data-license-exp-date');
            const guideSites = this.getAttribute('data-sites');
            const guideImage = this.getAttribute('data-image');

            // Set the image source based on the condition
            const imageSrc = guideImage === null ? '<?php echo URLROOT; ?>/images/user.jpg' :
                '<?php echo URLROOT; ?>/images/' + guideImage;

            guideDetailsContainer.innerHTML = `
            <div class="container">
        <div class="column">
            <div class="guide-info">
                <h2>${guideName}</h2>
                <img id="guide-image" src="${imageSrc}" alt="${guideName} Image">
            </div>
            <div class="guide-text" >
                <p><strong>ID:</strong> ${guideId}</p>
                <p style="text-align:justify;padding-right:15px"><strong>Sites:</strong> ${guideSites}</p>
                <p><strong>Address:</strong> ${guideAddress}, ${guideCity}, ${guideProvince}</p>
                <p><strong>Facebook:</strong> ${guideFacebook}</p>
                <p><strong>Instagram:</strong> ${guideInstagram}</p>
                <p><strong>Price Per Day:</strong> ${guidePricePerDay}</p>
                
            </div>
        </div>
        <div class="column">
            <div class="guide-text">
                <p><strong>Category:</strong> ${guideCategory}</p>
                <p><strong>Languages:</strong> ${guideLanguages}</p>
                <p><strong>Guide Registration Number:</strong> ${guideRegNumber}</p>
                <p><strong>License Expiry Date:</strong> ${guideLicenseExpDate}</p>
            </div>
            <div class="guide-description">
                <p><strong>Description:</strong></p>
                <p style="text-align:justify">${guideDescription}</p>
            </div>
        </div>
    </div>


            `;

            popup.style.display = 'block';
        });
    });


    closeBtn.addEventListener('click', function() {
        popup.style.display = 'none'; // Close the popup when the close button is clicked

    });
});
</script>



</html>