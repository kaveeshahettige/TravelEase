<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/admin/request.css">
    <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->

    <script src="<?php echo URLROOT?>/js/admin/script.js"></script>
    <title>TravelEase</title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/admin/x-icon"
        href="<?php echo URLROOT?>/images/TravelEase_logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
            <li><a href="<?php echo URLROOT; ?>admin/package"><i class='bx bx-package bx-sm'></i>Packages</a></li>
            <li><a href="<?php echo URLROOT; ?>admin/settings"><i class='bx bxs-cog bx-sm'></i> Settings</a></li>
            <li><a href="<?php echo URLROOT; ?>users/logout" class="active"><i class='bx bxs-log-out bx-sm bx-fw'></i>
                    Logout</a></li>
        </ul>

        <!-- <div class="logout">
            <a href="<?php echo URLROOT; ?>pages/indes" class="active"><i class='bx bxs-log-out bx-sm bx-fw'></i>  Logout</a>
        </div> -->
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
            foreach ($data['hotelRequests'] as $hotel):
            ?>
                    <tr class="t-row">
                        <td><?php echo $count ?></td>
                        <td><?php echo $hotel->id ?></td>
                        <td><?php echo ucfirst($hotel->fname) . ' ' . ucfirst($hotel->lname) ?></td>
                        <td>
                            <button class="view-button" data-description="<?php echo $hotel->description ?>"
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
                                data-account-number="<?php echo $hotel->account_number ?>">View</button>
                        </td>
                        <td><button class="view-button" onclick="openDocument('<?php echo $hotel->document ?>')">View
                                Document</button></td>
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





        <div id="popup-container" class="popup">
            <div class="popup-content">
                <span class="close">&times;</span>
                <div id="hotel-details"></div>
            </div>
        </div>
        <div class="table-content">
            <h2>Travel agency Request</h2>
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
                            <button class="view-button" data-description="<?php echo $agency->description ?>"
                                data-address="<?php echo $agency->address ?>" data-phone="<?php echo $agency->number ?>"
                                data-manager-name="<?php echo $agency->manager_name ?>"
                                data-city="<?php echo $agency->city ?>" data-website="<?php echo $agency->website ?>"
                                data-facebook="<?php echo $agency->facebook ?>"
                                data-twitter="<?php echo $agency->twitter ?>"
                                data-instagram="<?php echo $agency->instagram ?>"
                                data-card-holder-name="<?php echo $agency->card_holder_name ?>"
                                data-account-number="<?php echo $agency->account_number ?>">View</button>
                        </td>
                        <td><button class="view-button" onclick="openDocument('<?php echo $agency->document ?>')">View
                                Document</button></td>
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
        </div>






        <?php
if (!empty($data['guideRequests']) && is_array($data['guideRequests'])):
?>
        <div class="table-content">
            <h2>Guides Details</h2>
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
                                data-sites="<?php echo $guide->sites ?>">View</button>
                        </td>
                        <td><button class="view-button" onclick="openDocument('<?php echo $guide->document ?>')">View
                                Document</button></td>
                        <td><button class="accept-button" onclick="acceptUser(<?php echo $guide->id ?>)">Accept</button>
                            <button class="decline-button"
                                onclick="declineUser(<?php echo $guide->id ?>)">Decline</button></td>
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



<!-- Hotel Details Popup -->
<div id="hotel-popup" class="popup">
    <div class="popup-content">
        <span class="close close-hotel-popup">&times;</span>
        <div id="hotel-details"></div>
    </div>
</div>

<!-- Agency Details Popup -->
<div id="agency-popup" class="popup">
    <div class="popup-content">
        <span class="close close-agency-popup">&times;</span>
        <div id="agency-details"></div>
    </div>
</div>

<!-- Guide Details Popup -->
<div id="guide-popup" class="popup">
    <div class="popup-content">
        <span class="close close-guide-popup">&times;</span>
        <div id="guide-details"></div>
    </div>
</div>
    </main>
</body>







<script>
//   document.addEventListener('DOMContentLoaded', function() {
//     const hotelViewButtons = document.querySelectorAll('.hotel-view-button');
//     const hotelPopup = document.getElementById('hotel-popup');
//     const hotelDetailsContainer = document.getElementById('hotel-details');

//     hotelViewButtons.forEach(button => {
//         button.addEventListener('click', function() {
//         const hotelId = this.closest('.t-row').querySelector('td:nth-child(2)').innerText;
//         const hotelName = this.closest('.t-row').querySelector('td:nth-child(3)').innerText;
//         const hotelDescription = this.getAttribute('data-description');
//         const hotelAddress = this.getAttribute('data-address');
//         const hotelNoRooms = this.getAttribute('data-no-rooms');
//         const hotelAltPhone = this.getAttribute('data-alt-phone');
//         const hotelManagerName = this.getAttribute('data-manager-name');
//         const hotelManagerPhone = this.getAttribute('data-manager-phone');
//         const hotelStreetAddress = this.getAttribute('data-street-address');
//         const hotelCity = this.getAttribute('data-city');
//         const hotelState = this.getAttribute('data-state');
//         const hotelWebsite = this.getAttribute('data-website');
//         const hotelFacebook = this.getAttribute('data-facebook');
//         const hotelTwitter = this.getAttribute('data-twitter');
//         const hotelInstagram = this.getAttribute('data-instagram');
//         const hotelAdditionalNotes = this.getAttribute('data-additional-notes');
//         const hotelCardHolderName = this.getAttribute('data-card-holder-name');
//         const hotelAccountNumber = this.getAttribute('data-account-number');

//         hotelDetailsContainer.innerHTML = `
//             <h2>${hotelName}</h2>
//             <div class="hotel_popup" style="display: flex">
//                 <div class="popup-column">
//                     <p>ID: ${hotelId}</p>
//                     <p>Address: ${hotelAddress}</p>
//                     <p>No. of Rooms: ${hotelNoRooms}</p>
//                     <p>Alt Phone Number: ${hotelAltPhone}</p>
//                     <p>Manager Name: ${hotelManagerName}</p>
//                     <p>Manager Phone Number: ${hotelManagerPhone}</p>
//                     <p>Description: ${hotelDescription}</p>
//                 </div>
//                 <div class="popup-column">
//                     <p>Street Address: ${hotelStreetAddress}</p>
//                     <p>City: ${hotelCity}</p>
//                     <p>State/Province: ${hotelState}</p>
//                     <p>Website: ${hotelWebsite}</p>
//                     <p>Facebook: ${hotelFacebook}</p>
//                     <p>Twitter: ${hotelTwitter}</p>
//                     <p>Instagram: ${hotelInstagram}</p>
//                     <p>Additional Notes: ${hotelAdditionalNotes}</p>
//                     <p>Card Holder Name: ${hotelCardHolderName}</p>
//                     <p>Account Number: ${hotelAccountNumber}</p>
//                 </div>
//             </div>
//         `;
//         hotelPopup.style.display = 'block';
//         });
//     });

//     const agencyViewButtons = document.querySelectorAll('.agency-view-button');
//     const agencyPopup = document.getElementById('agency-popup');
//     const agencyDetailsContainer = document.getElementById('agency-details');

//     agencyViewButtons.forEach(button => {
//         button.addEventListener('click', function() {
//         const agencyId = this.closest('.t-row').querySelector('td:nth-child(2)').innerText;
//         const agencyName = this.closest('.t-row').querySelector('td:nth-child(3)').innerText;
//         const agencyDescription = this.getAttribute('data-description');
//         const agencyAddress = this.getAttribute('data-address');
//         const agencyPhone = this.getAttribute('data-phone');
//         const agencyManagerName = this.getAttribute('data-manager-name');
//         const agencyCity = this.getAttribute('data-city');
//         const agencyWebsite = this.getAttribute('data-website');
//         const agencyFacebook = this.getAttribute('data-facebook');
//         const agencyTwitter = this.getAttribute('data-twitter');
//         const agencyInstagram = this.getAttribute('data-instagram');
//         const agencyCardHolderName = this.getAttribute('data-card-holder-name');
//         const agencyAccountNumber = this.getAttribute('data-account-number');

//         agencyDetailsContainer.innerHTML = `
//             <h2>${agencyName}</h2>
//             <div class="agency_popup" style="display: flex">
//                 <div class="popup-column">
//                     <p>ID: ${agencyId}</p>
//                     <p>Address: ${agencyAddress}</p>
//                     <p>Phone: ${agencyPhone}</p>
//                     <p>Manager Name: ${agencyManagerName}</p>
//                     <p>Description: ${agencyDescription}</p>
//                 </div>
//                 <div class="popup-column">
//                     <p>City: ${agencyCity}</p>
//                     <p>Website: ${agencyWebsite}</p>
//                     <p>Facebook: ${agencyFacebook}</p>
//                     <p>Twitter: ${agencyTwitter}</p>
//                     <p>Instagram: ${agencyInstagram}</p>
//                     <p>Card Holder Name: ${agencyCardHolderName}</p>
//                     <p>Account Number: ${agencyAccountNumber}</p>
//                 </div>
//             </div>
//         `;
//         agencyPopup.style.display = 'block';
//         });
//     });
//     const guideViewButtons = document.querySelectorAll('.guide-view-button');
//     const guidePopup = document.getElementById('guide-popup');
//     const guideDetailsContainer = document.getElementById('guide-details');

//     guideViewButtons.forEach(button => {
//         button.addEventListener('click', function() {
//             const guideId = this.closest('.t-row').querySelector('td:nth-child(2)').innerText;
//             const guideName = this.closest('.t-row').querySelector('td:nth-child(3)').innerText;
//             const description = this.getAttribute('data-description');
//             const address = this.getAttribute('data-address');
//             const city = this.getAttribute('data-city');
//             const province = this.getAttribute('data-province');
//             const facebook = this.getAttribute('data-facebook');
//             const instagram = this.getAttribute('data-instagram');
//             const pricePerDay = this.getAttribute('data-price-per-day');
//             const image = this.getAttribute('data-image');
//             const category = this.getAttribute('data-category');
//             const languages = this.getAttribute('data-languages');
//             const regNumber = this.getAttribute('data-reg-number');
//             const licenseExpDate = this.getAttribute('data-license-exp-date');
//             const sites = this.getAttribute('data-sites');

//             guideDetailsContainer.innerHTML = `
//                 <h2>${guideName}</h2>
//                 <div class="guide_popup" style="display: flex">
//                     <div class="popup-column">
//                         <p>ID: ${guideId}</p>
//                         <p>Address: ${address}</p>
//                         <p>City: ${city}</p>
//                         <p>Province: ${province}</p>
//                         <p>Description: ${description}</p>
//                     </div>
//                     <div class="popup-column">
//                         <p>Facebook: ${facebook}</p>
//                         <p>Instagram: ${instagram}</p>
//                         <p>Price per Day: ${pricePerDay}</p>
//                         <p>Image: ${image}</p>
//                         <p>Category: ${category}</p>
//                         <p>Languages: ${languages}</p>
//                         <p>Guide Registration Number: ${regNumber}</p>
//                         <p>License Expiry Date: ${licenseExpDate}</p>
//                         <p>Sites: ${sites}</p>
//                     </div>
//                 </div>
//             `;
//             guidePopup.style.display = 'block';
//         });
//     });

//     // Close popup functionality
//     const closePopupButtons = document.querySelectorAll('.close');
//     closePopupButtons.forEach(closeBtn => {
//         closeBtn.addEventListener('click', function() {
//             this.closest('.popup').style.display = 'none';
//         });
//     });
// });
document.addEventListener('DOMContentLoaded', function() {
    const viewButtons = document.querySelectorAll('.view-button');
    const popup = document.getElementById('popup-container');
    const agencyDetailsContainer = document.getElementById('agency-details');

    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Log the button click to check if this function executes
            console.log('Button clicked');

            // Retrieve data attributes
            const agencyId = this.closest('.t-row').querySelector('td:nth-child(2)').innerText;
            const agencyName = this.closest('.t-row').querySelector('td:nth-child(3)').innerText;
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
                <h2>${agencyName}</h2>
                <div class="agency_popup" style="display: flex">
                    <div class="popup-column">
                        <p>ID: ${agencyId}</p>
                        <p>Address: ${agencyAddress}</p>
                        <p>Phone: ${agencyPhone}</p>
                        <p>Manager Name: ${managerName}</p>
                        <p>Description: ${agencyDescription}</p>
                        </div><div class="popup-column">
                        <p>City: ${city}</p>
                        <p>Website: ${website}</p>
                        <p>Facebook: ${facebook}</p>
                        <p>Twitter: ${twitter}</p>
                        <p>Instagram: ${instagram}</p>
                   
                    
                        <p>Card Holder Name: ${cardHolderName}</p>
                        <p>Account Number: ${accountNumber}</p>
                    </div>
                </div>
            `;

            // Show the popup
            popup.style.display = 'block';
        });
    });

    const closeBtn = document.querySelector('.close');
    closeBtn.addEventListener('click', function() {
        // Hide the popup when close button is clicked
        popup.style.display = 'none';
    });
});


document.addEventListener('DOMContentLoaded', function() {
    const viewButtons = document.querySelectorAll('.view-button');
    const popup = document.getElementById('popup-container');
    const hotelDetailsContainer = document.getElementById('hotel-details');

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
            <h2>${hotelName}</h2>
            <div class="hotel_popup" style="display: flex">
            
            <div class="popup-column"  >
        
        <p>ID: ${hotelId}</p>
        <p>Address: ${hotelAddress}</p>
        <p>No. of Rooms: ${noRooms}</p>
        <p>Alt Phone Number: ${altPhoneNumber}</p>
        <p>Manager Name: ${managerName}</p>
        <p>Manager Phone Number: ${managerPhoneNumber}</p>
        <p>Description: ${hotelDescription}</p>

    </div>
    <div class="popup-column" >
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

document.addEventListener('DOMContentLoaded', function() {
    const viewButtons = document.querySelectorAll('.view-button');
    const popup = document.getElementById('popup-container');
    const guideDetailsContainer = document.getElementById('guide-details');

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
   
    <div class="guide-info">
    <h2>${guideName}</h2>
    <img id="guide-image" src="${imageSrc}" alt="${guideName} Image">

    
        <div class="guide-text">

        
            <p><strong>ID:</strong> ${guideId}</p>
            <p><strong>Sites:</strong> ${guideSites}</p>
            <p><strong>Address:</strong> ${guideAddress}, ${guideCity}, ${guideProvince}</p>
            <p><strong>Facebook:</strong> ${guideFacebook}</p>
            <p><strong>Instagram:</strong> ${guideInstagram}</p>
            <p><strong>Price Per Day:</strong> ${guidePricePerDay}</p>
            <p><strong>Category:</strong> ${guideCategory}</p>
            <p><strong>Languages:</strong> ${guideLanguages}</p>
            <p><strong>Guide Registration Number:</strong> ${guideRegNumber}</p>
            <p><strong>License Expiry Date:</strong> ${guideLicenseExpDate}</p>
            <p><strong>Description:</strong> ${guideDescription}</p>
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