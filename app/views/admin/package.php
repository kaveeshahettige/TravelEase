<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/admin/package.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/popup.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/admin/hotel.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/popup.css">
    <script src="<?php echo URLROOT; ?>/public/js/hotel/popup.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="<?php echo URLROOT?>/js/admin/script.js"></script>
    <title></title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/admin/x-icon"
        href="<?php echo URLROOT; ?>/images/admin/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

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
            <li><a href="<?php echo URLROOT; ?>admin/index"><i class='bx bxs-dashboard bx-sm'></i> Overview</a></li>
            <li><a href="<?php echo URLROOT; ?>admin/request"><i class='bx bxs-book bx-sm'></i> Request</a></li>
            <li><a href="<?php echo URLROOT; ?>admin/traveler"><i class='bx bx-child bx-sm'></i></i> Traveler</a></li>

            <li><a href="<?php echo URLROOT; ?>admin/hotel"><i class='bx bxs-hotel bx-sm'></i></i> Hotels</a></li>
            <li><a href="<?php echo URLROOT; ?>admin/agency"><i class='bx bxs-car bx-sm'></i> Travel Agencies </a></li>
            <li><a href="<?php echo URLROOT; ?>admin/package" class="active"><i
                        class='bx bx-package bx-sm'></i>Guide</a></li>
            <li><a href="<?php echo URLROOT; ?>admin/settings"><i class='bx bxs-cog bx-sm'></i> Settings</a></li>

        </ul>

        <div class="logout">
            <a href="#" class="nav-button active" onclick="confirmLogout(event)"><i
                    class='bx bxs-log-out bx-sm bx-fw'></i> Logout</a>
        </div>
    </nav>
    <main>
        <div class="logo-container">
            <img src="<?php echo URLROOT; ?>/images/admin/TravelEase.png" alt="TravelEase Logo">
            <span class="logo-text">TravelEase</span>
        </div>

        <div class="dashboard-content">
            <h1>Guides</h1>
        </div>

        <div class="dashboard-sub-content">
            <div class="top-boxes">

                <!-- Total Request Box -->
                <div class="box">
                    <h2>Total Guides</h2>
                    <p><?php echo $data['no']?></p>
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
if (!empty($data['guide']) && is_array($data['guide'])):
?>
        <div class="table-content">
            <h2>Guides Details</h2>
            <table class="booking-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <!-- <th>Registered Number</th> -->
                        <th>Guide Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
            $count = 1;
            foreach ($data['guide'] as $guide):
            ?>
                    <tr class="t-row">
                        <td><?php echo $count ?></td>
                        <!-- <td><?php echo $guide->guide_id ?></td> -->
                        <td><?php echo ucfirst($guide->fname) . ' ' . ucfirst($guide->lname) ?></td>
                        <td>
                            <button class="view-button" data-id="<?php echo $guide->guide_id ?>"
                                data-name="<?php echo ucfirst($guide->fname) . ' ' . ucfirst($guide->lname) ?>"
                                data-description="<?php echo $guide->description ?>"
                                data-address="<?php echo $guide->address ?>" data-city="<?php echo $guide->city ?>"
                                data-province="<?php echo $guide->province ?>"
                                data-facebook="<?php echo $guide->facebook ?>"
                                data-instagram="<?php echo $guide->instagram ?>"
                                data-price-per-day="<?php echo $guide->pricePerDay ?>"
                                data-image="<?php echo $guide->image ?>" data-category="<?php echo $guide->category ?>"
                                data-languages="<?php echo $guide->languages ?>"
                                data-reg-number="<?php echo $guide->GuideRegNumber ?>"
                                data-license-exp-date="<?php echo $guide->LisenceExpDate ?>"
                                data-sites="<?php echo $guide->sites ?>">View</button>&nbsp;
                                <button class="delete-button"  onclick="DeletePopup(<?php echo $guide->guide_id ?>)">Delete</button>

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

        </tbody>
        </table>
        </div>

        <div class="more-content">
            <button class="next-page-btn" id="moreBtn">More guides <i class='bx bx-chevron-right'></i></button>
        </div>
        <div id="popup-container" class="popup">
            <div class="popup-content">
                <span class="close">&times;</span>
                <div id="guide-details"></div>
            </div>
        </div>

    </main>
</body>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const viewButtons = document.querySelectorAll('.view-button');
    const popup = document.getElementById('popup-container');
    const guideDetailsContainer = document.getElementById('guide-details');

    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const guideId = this.getAttribute('data-id');
            const guideName = this.getAttribute('data-name');
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
function DeletePopup(id) {
    // Create overlay div
    const overlay = document.createElement('div');
    overlay.className = 'overlay';

    const confirmDialog = document.createElement('div');
    confirmDialog.className = 'confirm-dialog';
    confirmDialog.innerHTML = `
        <div class="confirm-message">Are you sure you want to delete this guide?</div>
        <div class="buttons">
            <button class="btn btn-yes" onclick="confirmDeleteUser('${id}')">Yes</button>
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

function confirmDeleteUser(id) {
    // Prepare the data to send
    const requestData = {
        id: id,
// Adjust variable name to match PHP controller
    };

    // Create a new FormData object and append data to it
    const formData = new FormData();
    formData.append('id', id);

    // Make an AJAX request using fetch
    fetch('http://localhost/TravelEase/Admin/deleteTraveler', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (response.ok) {
            console.log('Traveler removed successfully');
            window.location.reload(); // Reload the page after successful removal
        } else {
            throw new Error('Error removing traveler: ', response);
        }
    })
    .catch(error => {
        console.error('Error removing traveler:', error);
    });
}


</script>

</html>