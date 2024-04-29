<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/admin/hotel.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/popup.css">
    <script src="<?php echo URLROOT; ?>/public/js/hotel/popup.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="<?php echo URLROOT?>/js/admin/script.js"></script>

    <title>TravelEase</title>
    <link rel="icon" type="" href="<?php echo URLROOT; ?>/images/admin/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

   


</head>

<body>
    <nav class="left-menu">
        <div class="user-profile">
            <img src="<?php echo URLROOT; ?>/images/admin/wikum.jpg" alt="User Profile Photo">
            <span class="user-name"><?php echo ucfirst($data['fname'])?> </span>
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
            <li><a href="<?php echo URLROOT; ?>admin/traveler" class="active"><i class='bx bx-child bx-sm'></i></i>
                    Traveler</a></li>
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
            <h1>Travelers</h1>
        </div>

        <div class="dashboard-sub-content">
            <div class="top-boxes">

                <!-- Total Request Box -->
                <div class="box">
                    <h2>Total Travelers</h2>
                    <p><?php echo $data['no'] ?></p>
                </div>


            </div>
        </div>

        <div class="search-content">
            <div class="booking-search">
                <input type="text" id="booking-search" placeholder="Search Travelers">
                <button onclick="filterBookings()">
                    <i class="bx bx-search"></i> <!-- Using the Boxicons search icon -->
                </button>
            </div>
        </div>
        <?php
if (!empty($data['traveler']) && is_array($data['traveler'])):
?>
        <div class="table-content">
            <h2>Traveler Details</h2>
            <table class="booking-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <!-- <th>Registration Number</th> -->
                        <th>Name</th>
                        
                      
                        <th>Action</th>
                       
                    </tr>
                </thead>
                <tbody>
                    <?php
            $count = 1;
            foreach ($data['traveler'] as $user):
                ?>
                    <tr class="t-row">
                        <td><?php echo $count ?></td>
                        <!-- <td><?php echo $user->id ?></td> -->
                        <td><?php echo ucfirst($user->fname) . ' ' . ucfirst($user->lname) ?></td>
                        
                        <td>
    <button class="view-button" 
                data-id="<?php echo $user->id ?>"
    data-email="<?php echo $user->email ?>"
        data-number="<?php echo $user->number ?>"
        data-image="<?php echo $user->profile_picture ?>">View</button>&nbsp;
        <button class="delete-button"  onclick="DeletePopup(<?php echo $user->id ?>)">Delete</button>
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
    echo '<div class="table-content"><h2>Traveler Details</h2><table class="booking-table"><tbody><tr><td colspan="7">No data available</td></tr></tbody></table></div>';
endif;
?>



        <div class="more-content">
            <button class="next-page-btn" id="moreBtn">More Travelers <i class='bx bx-chevron-right'></i></button>

        </div>


        <div id="popup-container" class="popup" >
            <div class="popup-content" >
                <span class="close">&times;</span>
                <div id="user-details"></div>
            </div>
        </div>

     





    </main>
</body>

<script>
 document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-button');
        const customPopup = document.getElementById('customPopup');
        let deleteUserId = null; // Variable to store the user ID for deletion

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-userid');
                deleteUserId = userId; // Store the user ID to be deleted
                showCustomPopup();
            });
        });

        function showCustomPopup() {
    var popupElement = document.getElementById('yourPopupElementId');
    console.log(popupElement); // Check if popupElement is null or the actual element
    if (popupElement) {
        popupElement.style.display = 'block';
    } else {
        console.error('Popup element not found or null.');
    }
}

        function hideCustomPopup() {
            customPopup.style.display = 'none';
        }

       

       
    });

document.addEventListener('DOMContentLoaded', function() {
    const viewButtons = document.querySelectorAll('.view-button');
    const popup = document.getElementById('popup-container');
    const userDetailsContainer = document.getElementById('user-details');

    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-id');
            const userName = this.closest('.t-row').querySelector('td:nth-child(2)').innerText;
            const userEmail = this.getAttribute('data-email');
            const userNumber = this.getAttribute('data-number');
            const userImage = this.getAttribute('data-image');

            // Set the image source based on the condition
            const imageSrc = userImage === null ? '<?php echo URLROOT; ?>/images1/user.jpg' : '<?php echo URLROOT; ?>/images1/' + userImage;

            userDetailsContainer.innerHTML = `
                <img src="${imageSrc}" class="popupimg">
                <h2>${userName}</h2>
                <p>ID: ${userId}</p>
                <p>Email: ${userEmail}</p>
                <p>Contact Number: ${userNumber}</p>
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
        <div class="confirm-message">Are you sure you want to delete this room?</div>
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