<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/admin/hotel.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/popup.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/admin/hotel.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/popup.css">
    <script src="<?php echo URLROOT; ?>/public/js/hotel/popup.js"></script>
    <title>TravelEase</title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/admin/x-icon" href="<?php echo URLROOT?>/images/TravelEase_logo.png">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="<?php echo URLROOT?>/js/admin/script.js"></script>
    <title></title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/admin/x-icon" href="<?php echo URLROOT; ?>/images/admin/Images/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>



</head>
<!-- <?php var_dump($data)?> -->
<body>
    <nav class="left-menu">
        <div class="user-profile">
            <img src="<?php echo URLROOT; ?>/images/admin/wikum.jpg" alt="User Profile Photo">
            <span class="user-name"><?php echo ucfirst($data['fname'])?></span>
        </div>
        
        <div class="search-bar">
            <form action="#" method="GET">
                <input type="text" placeholder="Find a Setting">
                <button type="submit">Search</button>
            </form>
        </div>
        
            
    <ul>
            <li><a href="<?php echo URLROOT; ?>admin/index" ><i class='bx bxs-dashboard bx-sm'></i> Overview</a></li>
            <li><a href="<?php echo URLROOT; ?>admin/request" ><i class='bx bxs-book bx-sm'></i> Request</a></li>
            <li><a href="<?php echo URLROOT; ?>admin/traveler" ><i class='bx bx-child bx-sm'></i></i> Traveler</a></li>

            <li><a href="<?php echo URLROOT; ?>admin/hotel" class="active"><i class='bx bxs-hotel bx-sm'></i></i> Hotels</a></li>
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
            <h1>Hotels</h1>
        </div>

        <div class="dashboard-sub-content">
        <div class="top-boxes">
 
            <!-- Total Request Box -->
            <div class="box">
                <h2>Total Hotels</h2>
                <p><?php echo $data['no'] ?></p>
            </div>
        

        </div>
        </div>



        <div class="search-content">
        <div class="booking-search">
            <input type="text" id="booking-search" placeholder="Search Hotels">
            <button onclick="filterBookings()">
                <i class="bx bx-search"></i> <!-- Using the Boxicons search icon -->
            </button>
        </div>
        </div>
       
        <?php
if (!empty($data['hoteldetails']) && is_array($data['hoteldetails'])):
?>
<div class="table-content">
    <h2>Hotel Details</h2>
    <table class="booking-table">
        <thead>
            <tr>
                <th>No</th>
                <!-- <th>Registration Number</th> -->
                <th>Hotel Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count = 1;
            foreach ($data['hoteldetails'] as $hotel):
            ?>
            <tr class="t-row">
                <td><?php echo $count ?></td>
                <!-- <td><?php echo $hotel->id ?></td> -->
                <td><?php echo ucfirst($hotel->fname) . ' ' . ucfirst($hotel->lname) ?></td>
                <td>
                    <button class="view-button"
                        data-id="<?php echo $hotel->hotel_id ?>"
                        data-name="<?php echo ucfirst($hotel->fname) . ' ' . ucfirst($hotel->lname) ?>"
                        data-description="<?php echo $hotel->description ?>"
                        data-address="<?php echo $hotel->addr ?>"
                        data-no-rooms="<?php echo $hotel->no_rooms ?>"
                        data-alt-phone="<?php echo $hotel->alt_phone_number ?>"
                        data-manager-name="<?php echo $hotel->manager_name ?>"
                        data-manager-phone="<?php echo $hotel->manager_phone_number ?>"
                        data-street-address="<?php echo $hotel->street_address ?>"
                        data-city="<?php echo $hotel->city ?>"
                        data-state="<?php echo $hotel->state_province ?>"
                        data-website="<?php echo $hotel->website ?>"
                        data-facebook="<?php echo $hotel->facebook ?>"
                        data-twitter="<?php echo $hotel->twitter ?>"
                        data-instagram="<?php echo $hotel->instagram ?>"
                        data-additional-notes="<?php echo $hotel->additional_notes ?>"
                        data-card-holder-name="<?php echo $hotel->card_holder_name ?>"
                        data-account-number="<?php echo $hotel->account_number ?>"
                    >View</button>&nbsp;
                    <button class="delete-button"  onclick="DeletePopup(<?php echo $hotel->hotel_id ?>)">Delete</button>
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
    echo '<div class="table-content"><h2>Hotel Details</h2><table class="booking-table"><tbody><tr><td colspan="4">No data available</td></tr></tbody></table></div>';
endif;
?>



        <div class="more-content">
        <button class="next-page-btn" id="moreBtn">More Hotels <i class='bx bx-chevron-right'></i></button>

        </div>

        <div id="popup-container" class="popup" >
            <div class="popup-content">
                <span class="close">&times;</span>
                <div id="hotel-details"></div>
            </div>
        </div>



    </main>
</body>

<script>

document.addEventListener('DOMContentLoaded', function() {
const viewButtons = document.querySelectorAll('.view-button');
const popup = document.getElementById('popup-container');
const hotelDetailsContainer = document.getElementById('hotel-details');
viewButtons.forEach(button => {
            button.addEventListener('click', function() {
                const hotelId = this.getAttribute('data-id');
                const hotelName = this.getAttribute('data-name');
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
                </div>`;
                popup.style.display = 'block';
            });
        });

        const closeBtn = document.querySelector('.close');
        closeBtn.addEventListener('click', function() {
            popup.style.display = 'none';
        });
    });

    function DeletePopup(id) {
    // Create overlay div
    const overlay = document.createElement('div');
    overlay.className = 'overlay';

    const confirmDialog = document.createElement('div');
    confirmDialog.className = 'confirm-dialog';
    confirmDialog.innerHTML = `
        <div class="confirm-message">Are you sure you want to delete this hotel?</div>
        <div class="buttons">
            <button class="btn btn-yes" onclick="confirmDeleteHotel('${id}')">Yes</button>
            <button class="btn btn-no" onclick="cancelDelete()">No</button>
        </div>
    `;

    document.body.appendChild(overlay);
    document.body.appendChild(confirmDialog);
}

function cancelDelete() {
    document.body.removeChild(document.querySelector('.overlay'));
    document.body.removeChild(document.querySelector('.confirm-dialog'));
}

function confirmDeleteHotel(id) {
    // Prepare the data to send
    const formData = new FormData();
    formData.append('id', id);

    // Make an AJAX request using fetch
    fetch('http://localhost/TravelEase/Admin/deleteGuide', { // Update the URL to the correct endpoint for deleting guides
    method: 'POST',
    body: formData
})
.then(response => {
    if (response.ok) {
        console.log('Guide removed successfully');
        window.location.reload(); // Reload the page after successful removal
    } else {
        throw new Error('Error removing guide: ', response);
    }
})
.catch(error => {
    console.error('Error removing guide:', error);
});

}

</script>
</html>
