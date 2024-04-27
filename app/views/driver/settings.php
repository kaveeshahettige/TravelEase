<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/driver/settings.css">
    <script src="<?php echo URLROOT; ?>/public/js/hotel/popup.js"></script>
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/popup.css">
    <title><?php echo SITENAME ?></title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/driver/x-icon"
        href="<?php echo URLROOT; ?>/images/driver/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
            <li><a href="<?php echo URLROOT; ?>driver/calender"><i class='bx bxs-book bx-sm'></i> Availabily
                    Calender</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/bookings"><i class='bx bxs-package bx-sm'></i></i> Bookings</a>
            </li>
            <li><a href="<?php echo URLROOT; ?>driver/vehicle"><i class='bx bxs-car bx-sm'></i> Vehicle Informaion </a>
            </li>
            <li><a href="<?php echo URLROOT; ?>driver/earings"><i class='bx bx-money-withdraw bx-sm'></i>Earings and
                    Payments</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/notification"><i class='bx bxs-bell bx-sm'></i>Notification</a>
            </li>
            <li><a href="<?php echo URLROOT; ?>driver/reviews"><i class='bx bxs-star bx-sm bx-fw'></i> Reviews</a></li>
            <li><a href="<?php echo URLROOT; ?>driver/settings" class="active"><i class='bx bxs-cog bx-sm'></i>
                    Settings</a></li>
            <li> <a href="#" class="nav-button active" onclick="confirmLogout(event)"><i class='bx bxs-log-out bx-sm bx-fw'></i> Logout</a></li>
        </ul>

        <!-- <div class="logout">
            <a href="<?php echo URLROOT; ?>pages/indes" class="active"><i class='bx bxs-log-out bx-sm bx-fw'></i>  Logout</a>
        </div> -->
    </nav>
    <main>

        <div class="main">
            <div class="logo-container">
                <img src="<?php echo URLROOT?>/images/driver/TravelEase.png" alt="TravelEase Logo">
                <span class="logo-text">TravelEase</span>
            </div>

            <div class="dashboard-content">
                <h1>Settings</h1>
            </div>

            <div class="dashboard-subcontent">
                <div class="content-container">
                    <div class="left-content">

                        <div class="rectangle">
                            <!-- Rectangle 1: Basic Info -->
                            <div class="basic-info-content">
                                <div class="center-image">
                                    <img src="<?php echo URLROOT; ?>/images/<?php echo $data['profileimage']->profile_picture;; ?>"
                                        alt="profile Picture">

                                </div>

                                <div class="hotel-details">


                                    <h3><?php echo  $data['userDetails']->fname . " " .  $data['userDetails']->lname ?>
                                    </h3>
                                    <?php if (!empty($data['agencyDetails']->manager_name)) : ?>
                                    <h6>Manager Name</h6>
                                    <p><?php echo $data['agencyDetails']->manager_name; ?></p>
                                    <?php endif; ?>

                                    <h6>Contact Number</h6>
                                    <p><?php echo $data['userDetails']->number?></p>
                                    <h6>Email</h6>
                                    <p><?php echo $data['userDetails']->email ?></p>


                                    <?php if (!empty($data['agencyDetails'])) : ?>

                                    <h6>Registration Number</h6>
                                    <p> <?php echo $data['agencyDetails']->reg_number; ?></p>
                                    <h6>Address </h6>
                                    <p><?php echo $data['agencyDetails']->address; ?></p>
                                    <h6>Description</h6>
                                    <p> <?php echo $data['agencyDetails']->description; ?></p>
                                    <h6>City</h6>
                                    <p><?php echo $data['agencyDetails']->city; ?></p>
                                    <h6>Web Site</h6>
                                    <p><?php echo $data['agencyDetails']->website; ?></p>
                                    <h6>Facebook</h6>
                                    <p><?php echo $data['agencyDetails']->facebook; ?></p>
                                    <h6>Instagram</h6>
                                    <p><?php echo $data['agencyDetails']->instagram; ?></p>
                                    <h6>Twitter</h6>
                                    <p><?php echo $data['agencyDetails']->twitter; ?></p>
                                    <?php else : ?>
                                    <p style="padding-top: 20px;">Add your agency details.</p>
                                    <?php endif; ?>


                                </div>
                                <?php if (!empty($data['agencyDetails']->manager_name)) : ?>
                                <a href="<?php echo URLROOT; ?>driver/editagency">
                                    <button class="edit-button">Edit</button>
                                </a>
                                <?php endif; ?>

                            </div>
                        </div>


                    </div>

                    <div class="right-content">




                        <div class="rectangle">
                            <div class="basic-info-content">
                                <?php if ($data['userDetails']->approval == 1 || $data['userDetails']->document != null) : ?>
                                <h2>Your documents have been submitted.</h2>
                                <?php else : ?>
                                <h2>Service Validation</h2>
                                <form class="service-validation-form" method="POST"
                                    action="<?php echo URLROOT; ?>/driver/settings" enctype="multipart/form-data">
                                    <p style="text-align: justify;">Please upload the following documents for
                                        verification of cab services offered by
                                        your agency:</p>
                                    <ul>
                                        <li>1. Certificate of Registration from the Sri Lanka Tourism Development
                                            Authority
                                            (SLTDA).</li>
                                        <h3>OR</h3>
                                        <li>2. Valid License for Operating Cab Services in Sri Lanka.</li>
                                    </ul>
                                    <p style="text-align: justify; margin-bottom: 50px;">Your uploaded documents will be
                                        reviewed promptly by our team for verification.
                                        Please ensure that all documents are clear, complete, and meet the requirements
                                        set by the SLTDA for cab services operation in Sri Lanka. Thank you for your
                                        cooperation.</p>

                                    <label for="service-validation-pdf" class="file-label">Choose File</label>
                                    <input type="file" id="service-validation-pdf" name="service-validation-pdf"
                                        accept=".pdf" required onchange="updateFileName(this)">
                                    <span id="file-name-display" class="file-name">No file chosen</span>
                                    <button class="edit-button" type="submit">Submit</button>
                                </form>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php var_dump($data['pendingBookingCount'])?>

                        <div class="rectangle">
                            <!-- Rectangle 2: Change Password -->
                            <div class="basic-info-content">
                                <h2>Change Password</h2>
                                <!-- Add change password form here -->
                                <a href="<?php echo URLROOT; ?>driver/vehiclepassword">
                                    <button class="edit-button">Edit</button>
                                </a>
                            </div>




                        </div>

                        <div class="rectangle">
                            <!-- Rectangle 3: Profile Deletion -->
                            <div class="basic-info-content">
                                <h2>Profile Deletion</h2>
                                <!-- Add an ID to the delete button -->
                                <button id="openDeleteConfirmation" class="edit-button">Delete</button>
                            </div>
                        </div>


                        <div id="deleteConfirmationModal" class="modal">
                            <div class="modal-content">
                                <h2>Confirm Deletion</h2>
                                <p>Are you sure you want to delete your profile?</p>
                                <div class="modal-buttons">
                                    <button id="cancelDelete" class="cancel-button">Cancel</button>
                                    <!-- Add an ID to the confirm delete button -->
                                    <button id="confirmDelete" class="delete-button">Delete</button>
                                </div>
                            </div>
                        </div>

                        <div id="popupMessage" class="popup">
                            <div class="popup-content">
                                <h2>Ongoing Bookings</h2>
                                <p>You can't delete your account because you have ongoing bookings.</p>
                                <button id="closePopup" class="close-button">Close</button>
                            </div>
                        </div>





                    </div>

                </div>

            </div>

        </div>

    </main>
</body>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const openDeleteConfirmation = document.getElementById('openDeleteConfirmation');
    const deleteConfirmationModal = document.getElementById('deleteConfirmationModal');
    const cancelDelete = document.getElementById('cancelDelete');
    const confirmDelete = document.getElementById('confirmDelete');
    const deleteForm = document.getElementById('deleteForm');
    const popupMessage = document.getElementById('popupMessage');
    const closePopup = document.getElementById('closePopup');

    openDeleteConfirmation.addEventListener('click', function() {
        if (parseInt('<?php echo $data['pendingBookingCount']; ?>') > 0) {
            // Show popup message
            popupMessage.style.display = 'block';
        } else {
            deleteConfirmationModal.style.display = 'block';
        }
    });

    cancelDelete.addEventListener('click', function() {
        deleteConfirmationModal.style.display = 'none';
    });

    confirmDelete.addEventListener('click', function() {
        if (deleteForm) {
            deleteForm.submit();
        } else {
            console.error('Delete form not found.');
        }
    });

    closePopup.addEventListener('click', function() {
        popupMessage.style.display = 'none';
    });
});

function updateFileName(input) {
    const fileNameDisplay = document.getElementById('file-name-display');
    if (input.files.length > 0) {
        fileNameDisplay.textContent = input.files[0].name;
    } else {
        fileNameDisplay.textContent = 'No file chosen';
    }
}
</script>

</html>