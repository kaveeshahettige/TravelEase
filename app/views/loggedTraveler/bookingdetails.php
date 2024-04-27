<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>TraveleEase</title>
    <link rel="icon" type="image/x-icon" href="../landpage/assets/TravelEase_logo.png">
    <link rel="stylesheet" href="<?php echo URLROOT?>css/loggedTraveler/booking.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <script src="<?php echo URLROOT?>js/loggedTraveler/script.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.2/css/boxicons.min.css">

    <style>

    </style>
</head>
<body>
    
    
    <div class="navbar">
        <div class="logo">
            <img src="<?php echo URLROOT?>/images/TravelEase_logo.png" alt="Logo">
            <label for="logoname">Travel<span style="color: #458A9E;">Ease</span> </label>
        </div>
        <ul>
        <li><a href="<?php echo URLROOT?>loggedTraveler/index">Home</a></li>
            <li><a href="<?php echo URLROOT?>loggedTraveler/hotel">Hotels</a></li>
            <li><a href="<?php echo URLROOT?>loggedTraveler/transport">Transport Providers</a></li>
            <li><a href="<?php echo URLROOT?>loggedTraveler/package">Guides</a></li>
            <div class="rightcontent">
            <li><a href="<?php echo URLROOT ?>travelerDashboard/cart/<?php echo $_SESSION['user_id'] ?>"><i class='bx bxs-cart bx-lg bx-tada bx-rotate-90' ></i></a></li>
            <li><a href="<?php echo URLROOT?>travelerDashboard/index"><img src="<?php echo empty($data['profile_picture']) ? URLROOT.'images/user.jpg' : URLROOT.'images1/'.$data['profile_picture']; ?>" alt="Profile Picture" alt="User Profile Photo"> </a></li>
                <li><a href="<?php echo URLROOT?>users/logout" id="logout">Log Out</a></li>
                </div>
        </ul>
    </div>
    <!-- <?php echo $data['Tid']; ?> -->
    <!-- <?php echo var_dump($data['booking'])?> -->
    <!-- <?php echo var_dump($$data['driver'])?> -->
    <section class="bookingResultm1">
    
        <?php if ($data['type']==3): ?>
        <div class="view">
            <div class="bookingtitles"><h1><?php echo ucfirst($data['serviceProviderName']) ?></h1>
            
                <h5>Booking details</h5>
                
            </div>
            <div class="images">
                <div class="mainimage">
                <img src="<?php echo URLROOT . '/images/' . $data['furtherBookingDetails']->image; ?>" alt="">

                </div>
                <!-- <div class="submimages">
                    <div><img src="<?php echo URLROOT . '/images/' . $data['furtherBookingDetails']->image; ?>" alt=""></div>
                    <div><img src="<?php echo URLROOT . '/images/' . $data['furtherBookingDetails']->image; ?>" alt=""></div>
                </div>
                <div class="submimages">
                    <div><img src="<?php echo URLROOT . '/images/' . $data['furtherBookingDetails']->image; ?>" alt=""></div>
                    <div><img src="<?php echo URLROOT . '/images/' . $data['furtherBookingDetails']->image; ?>" alt=""></div>
                </div> -->

            </div>
           
            <div class="des">
                <h5 style="margin: 0px;">Description</h5>
                <p><?php echo $data['mainbookingDetails']->description?></p> 
            </div> 
            <div class="bookingdetails">
                <div class="leftdiv">
                <div class="ldiv1">
    <div class="booking-label"><i class="fas fa-hotel"></i> Hotel name:</div>
    <div class="booking-value"><?php echo ucfirst($data['serviceProviderName']) ?></div>
</div>

<div class="ldiv1">
    <div class="booking-label"><i class="fas fa-bed"></i> Hotel type:</div>
    <div class="booking-value"><?php echo $data['mainbookingDetails']->hotel_type?></div>
</div>

<div class="ldiv1">
    <div class="booking-label"><i class="fas fa-map-marker-alt"></i> Address:</div>
    <div class="booking-value"><?php echo $data['mainbookingDetails']->addr?></div>
</div>

<div class="ldiv1">
    <div class="booking-label"><i class="fas fa-city"></i> City:</div>
    <div class="booking-value"><?php echo $data['mainbookingDetails']->city?></div>
</div>

<div class="ldiv1">
    <div class="booking-label"><i class="fas fa-door-open"></i> Room type:</div>
    <div class="booking-value"><?php echo $data['furtherBookingDetails']->roomType?></div>
</div>

<div class="ldiv1">
    <div class="booking-label"><i class="fas fa-info-circle"></i> Room detail:</div>
    <div class="booking-value"><?php echo $data['furtherBookingDetails']->description?></div>
</div>

<div class="ldiv1">
    <div class="booking-label"><i class="fas fa-snowflake"></i> A/C Availablility:</div>
    <div class="booking-value"><?php echo $data['furtherBookingDetails']->acAvailability?></div>
</div>

<div class="ldiv1">
    <div class="booking-label"><i class="fas fa-tv"></i> TV Availablility:</div>
    <div class="booking-value"><?php echo $data['furtherBookingDetails']->tvAvailability?></div>
</div>

<div class="ldiv1">
    <div class="booking-label"><i class="fas fa-wifi"></i> Wifi Availablility:</div>
    <div class="booking-value"><?php echo $data['furtherBookingDetails']->wifiAvailability?></div>
</div>

<div class="ldiv1">
    <div class="booking-label"><i class="fas fa-smoking-ban"></i> Smoking policy:</div>
    <div class="booking-value"><?php echo $data['furtherBookingDetails']->smokingPolicy?></div>
</div>

<div class="ldiv1">
    <div class="booking-label"><i class="fas fa-paw"></i> Pet policy:</div>
    <div class="booking-value"><?php echo $data['furtherBookingDetails']->petPolicy?></div>
</div>

                    
                </div>

                <div class="rightdiv">
                <div class="ldiv1">
    <div class="booking-label"><i class="fas fa-dollar-sign"></i> Price:</div>
    <div class="booking-value"><?php echo $data['furtherBookingDetails']->price?> &nbsp SLR</div>
</div>

<div class="ldiv1">
    <div class="booking-label"><i class="fas fa-phone"></i> Contact number :</div>
    <div class="booking-value"><?php echo $data['number']?></div>
</div>

<div class="ldiv1">
    <div class="booking-label"><i class="fas fa-globe"></i> Web Site:</div>
    <div class="booking-value"><?php echo $data['mainbookingDetails']->website?></div>
</div>

<div class="ldiv1">
    <div class="booking-label"><i class="fab fa-twitter"></i> Twitter :</div>
    <div class="booking-value"><?php echo $data['mainbookingDetails']->twitter?></div>
</div>

<div class="ldiv1">
    <div class="booking-label"><i class="fab fa-instagram"></i> Instagram :</div>
    <div class="booking-value"><?php echo $data['mainbookingDetails']->instagram?></div>
</div>

<div class="ldiv1">
    <div class="booking-label"><i class="far fa-calendar-alt"></i> Start date:</div>
    <div class="booking-value"><?php echo $data['booking']->startDate?></div>
</div>

<div class="ldiv1">
    <div class="booking-label"><i class="far fa-calendar-alt"></i> End date:</div>
    <div class="booking-value"><?php echo $data['booking']->endDate?></div>
</div>

<div class="ldiv1">
    <div class="booking-label"><i class="fas fa-user-times"></i> Cancellation eligibility:</div>
    <div class="booking-value"><?php echo  $data['cancellationEligibility']?></div>
</div>

                </div>

        </div>
        <?php elseif ($data['type']==4): ?>
            <div class="view">
            <div class="bookingtitles"><h1><?php echo ucfirst($data['serviceProviderName']) ?></h1>
            
                <h5>Booking details</h5>
            </div>
            <div class="images">
                <div class="mainimage">
                <img src="<?php echo URLROOT . '/images/' . $data['furtherBookingDetails']->image; ?>" alt="">

                </div>
                <!-- <div class="submimages">
                    <div><img src="<?php echo URLROOT . '/images/' . $element['furtherBookingDetails']['image']; ?>" alt=""></div>
                    <div><img src="<?php echo URLROOT . '/images/' . $element['furtherBookingDetails']['image']; ?>" alt=""></div>
                </div>
                <div class="submimages">
                    <div><img src="<?php echo URLROOT . '/images/' . $element['furtherBookingDetails']['image']; ?>" alt=""></div>
                    <div><img src="<?php echo URLROOT . '/images/' . $element['furtherBookingDetails']['image']; ?>" alt=""></div>
                </div> -->

            </div>
            <div class="des">
                <h5 style="margin: 0px;">Description</h5>
                <p><?php echo $data['mainbookingDetails']->description?></p> 
            </div> 
            <div class="bookingdetails">
                <div class="leftdiv">
                <div class="ldiv1">
    <div class="booking-label"><i class="fas fa-building"></i> Agency name:</div>
    <div class="booking-value"><?php echo ucfirst($data['serviceProviderName']) ?></div>
</div>

<div class="ldiv1">
    <div class="booking-label"><i class="fas fa-id-card"></i> Agency Registered Number:</div>
    <div class="booking-value"><?php echo $data['mainbookingDetails']->reg_number?></div>
</div>

<div class="ldiv1">
    <div class="booking-label"><i class="fas fa-map-marker-alt"></i> Address:</div>
    <div class="booking-value"><?php echo $data['mainbookingDetails']->address?></div>
</div>

<div class="ldiv1">
    <div class="booking-label"><i class="fas fa-city"></i> City:</div>
    <div class="booking-value"><?php echo $data['mainbookingDetails']->city?></div>
</div>

<div class="ldiv1">
    <div class="booking-label"><i class="fas fa-car"></i> Vehicle Brand:</div>
    <div class="booking-value"><?php echo $data['furtherBookingDetails']->brand?></div>
</div>

<div class="ldiv1">
    <div class="booking-label"><i class="fas fa-car-side"></i> Vehicle Model:</div>
    <div class="booking-value"><?php echo $data['furtherBookingDetails']->model?></div>
</div>

<div class="ldiv1">
    <div class="booking-label"><i class="fas fa-car-alt"></i> Plate Number:</div>
    <div class="booking-value"><?php echo $data['furtherBookingDetails']->plate_number?></div>
</div>

<div class="ldiv1">
    <div class="booking-label"><i class="fas fa-calendar-alt"></i> Year:</div>
    <div class="booking-value"><?php echo $data['furtherBookingDetails']->year?></div>
</div>

<div class="ldiv1">
    <div class="booking-label"><i class="fas fa-money-bill"></i> Price per day:</div>
    <div class="booking-value"><?php echo $data['furtherBookingDetails']->priceperday?>&nbsp SLR</div>
</div>

<div class="ldiv1">
    <div class="booking-label"><i class="fas fa-chair"></i> Seating capacity:</div>
    <div class="booking-value"><?php echo $data['furtherBookingDetails']->seating_capacity?></div>
</div>

<div class="ldiv1">
    <div class="booking-label"><i class="fas fa-snowflake"></i> Air condition:</div>
    <div class="booking-value">
        <?php if ($data['furtherBookingDetails']->ac_type == 1): ?>
            <?php echo "Available"; ?>
        <?php else: ?>
            <?php echo "Not available"; ?>
        <?php endif; ?>
    </div>
</div>

                    
                </div>
                
                <div class="rightdiv">
                <div class="ldiv1">
    <div class="booking-label"><i class="fas fa-money-bill"></i> Price:</div>
    <div class="booking-value">
        <?php echo $data['vehicleprice']->amount?> &nbsp SLR
    </div>
</div>

<div class="ldiv1">
    <div class="booking-label"><i class="fas fa-user"></i> Driver:</div>
    <div class="booking-value">
        <?php if ($data['driver']->withDriver== 1): ?>
            <?php echo "With"; ?>
        <?php else: ?>
            <?php echo "Without"; ?>
        <?php endif; ?>&nbspDriver
    </div>
</div>

<div class="ldiv1">
    <div class="booking-label"><i class="fas fa-phone"></i> Contact number :</div>
    <div class="booking-value"><?php echo $data['number']?></div>
</div>

<div class="ldiv1">
    <div class="booking-label"><i class="fas fa-globe"></i> Web Site:</div>
    <div class="booking-value"><?php echo $data['mainbookingDetails']->website?></div>
</div>

<div class="ldiv1">
    <div class="booking-label"><i class="fab fa-twitter"></i> Twitter :</div>
    <div class="booking-value"><?php echo $data['mainbookingDetails']->twitter?></div>
</div>

<div class="ldiv1">
    <div class="booking-label"><i class="fab fa-instagram"></i> Instagram :</div>
    <div class="booking-value"><?php echo $data['mainbookingDetails']->instagram?></div>
</div>

<div class="ldiv1">
    <div class="booking-label"><i class="fas fa-calendar-alt"></i> Start date:</div>
    <div class="booking-value"><?php echo $data['booking']->startDate?></div>
</div>

<div class="ldiv1">
    <div class="booking-label"><i class="fas fa-calendar-alt"></i> End date:</div>
    <div class="booking-value"><?php echo $data['booking']->endDate?></div>
</div>

<div class="ldiv1">
    <div class="booking-label"><i class="fas fa-exclamation-circle"></i> Cancellation eligibility:</div>
    <div class="booking-value"><?php echo  $data['cancellationEligibility']?></div>
</div>

                </div>

        </div>
        
       
            <?php elseif ($data['type'] == 5): ?>
        <div class="view">
            <div class="bookingtitles"><h1><?php echo ucfirst($data['serviceProviderName'])?></h1>
                <h5>Guide details</h5>
            </div>
            <div class="images">
                <div class="mainimage">
                <img src="<?php echo URLROOT . '/images/' . $data['furtherBookingDetails']->image; ?>" alt="">
                </div>

            </div>
            <div class="des">
                <h5 style="margin: 0px;">About</h5>
                <p><?php echo $data['furtherBookingDetails']->description ? ucfirst($data['furtherBookingDetails']->description) : '-----'; ?></p> 
            </div> 
            
            <div class="bookingdetails">
                <div class="leftdiv">
                <div class="ldiv1">
            <div class="booking-label"><i class="fas fa-user"></i> Guide name:</div>
            <div class="booking-value"><?php echo ucfirst($data['serviceProviderName'])?></div>
        </div>
        <div class="ldiv1">
            <div class="booking-label"><i class="fas fa-id-card"></i> Registration Number:</div>
            <div class="booking-value"><?php echo ucfirst($data['furtherBookingDetails']->GuideRegNumber)?></div>
        </div>
        <div class="ldiv1">
            <div class="booking-label"><i class="fas fa-tag"></i> Category:</div>
            <div class="booking-value"><?php echo ucfirst($data['furtherBookingDetails']->category)?></div>
        </div>
        <div class="ldiv1">
            <div class="booking-label"><i class="fas fa-language"></i> Languages:</div>
            <div class="booking-value"><?php echo ucfirst($data['furtherBookingDetails']->languages)?></div>
        </div>
        <div class="ldiv1">
            <div class="booking-label"><i class="fas fa-calendar-times"></i> Lisence Expiry Date:</div>
            <div class="booking-value"><?php echo ucfirst($data['furtherBookingDetails']->LisenceExpDate)?></div>
        </div>
        <div class="ldiv1">
            <div class="booking-label"><i class="fas fa-map-marker-alt"></i> Places:</div>
            <div class="booking-value"><?php echo ucfirst($data['furtherBookingDetails']->sites)?></div>
        </div>
                </div>

                <div class="rightdiv">
                <div class="ldiv1">
    <div class="booking-label"><i class="fas fa-map-marker-alt"></i> Address:</div>
    <div class="booking-value"><?php echo ucfirst($data['furtherBookingDetails']->address)?></div>
</div>
<div class="ldiv1">
    <div class="booking-label"><i class="fas fa-city"></i> City:</div>
    <div class="booking-value"><?php echo ucfirst($data['furtherBookingDetails']->city)?></div>
</div>
<div class="ldiv1">
    <div class="booking-label"><i class="fas fa-map"></i> Province:</div>
    <div class="booking-value"><?php echo ucfirst($data['furtherBookingDetails']->province)?></div>
</div>
<div class="ldiv1">
    <div class="booking-label"><i class="fab fa-facebook"></i> Facebook:</div>
    <div class="booking-value"><?php echo ucfirst($data['furtherBookingDetails']->facebook)?></div>
</div>
<div class="ldiv1">
    <div class="booking-label"><i class="fab fa-instagram"></i> Instagram:</div>
    <div class="booking-value"><?php echo ucfirst($data['furtherBookingDetails']->instagram)?></div>
</div>

                    
                </div>
                

            </div>
        <?php endif; ?>
        

        
        
            
        <?php if ($data['type'] == 3): ?>
            <div class="delbuttonContain">
                <div class="emergencydata">In Emergency: <?php echo $data['mainbookingDetails']->manager_phone_number." - ". $data['mainbookingDetails']->manager_name?></div>
                
    <div>
    
<?php endif; ?>
<?php if ($data['type'] == 4): ?>
            <div class="delbuttonContain">
                <div class="emergencydata">In Emergency: <?php echo $data['number']?></div>
                
    <div>
    
<?php endif; ?>
<!-- <?php if ($data['cancellationEligibility'] == "Available"): ?>
    <!-- <button id="delbutton" onclick="deleteBooking('<?php echo $data['booking']->booking_id; ?>')">Cancel Trip</button> -->
    <button id="delbutton" onclick="cancelBooking(<?php echo isset($data['Tid']) ? $data['Tid'] : 0; ?>, '<?php echo $data['booking']->booking_id; ?>')">Cancel Trip</button>
    
    </div>
<?php endif; ?> -->


                
            </div>
        </div>
    </section>
    <div id="confirmationModal" class="modal2">
  <div class="modal2-content">
    <span class="close2">&times;</span>
    <p>Are you sure you want to cancel this booking?</p>
    <button id="confirmCancelBtn">Yes, Cancel Booking</button>
    <button id="denyCancelBtn">No,Close</button>
    <div id="confirmationMessage"></div>
  </div>
</div>
<iframe id="cancelFrame" style="display: none;"></iframe>


    
    
  
</body>

<!-- ---------------js for cancel booking ----------->
<script>
    // Declare confirmBtn and confirmationMessage globally
var confirmBtn, confirmationMessage;

document.addEventListener("DOMContentLoaded", function(){
  // Get the confirmation button, deny button, and the <span> element that closes the modal
  confirmBtn = document.getElementById("confirmCancelBtn");
  var denyBtn = document.getElementById("denyCancelBtn");
  var span = document.getElementsByClassName("close2")[0];
  // Get the confirmation message element
  confirmationMessage = document.getElementById("confirmationMessage");

  // Event listener for the <span> element that closes the modal
  span.onclick = function() {
    closeModal();
  }

  // Event listener for clicks outside the modal to close it
  window.onclick = function(event) {
    var modal = document.getElementById("confirmationModal");
    if (event.target == modal) {
      closeModal();
    }
  }

  // Event listener for the deny button to close the modal
  denyBtn.onclick = function() {
    closeModal();
  }
});

// Function to open the confirmation modal
function openModal() {
  var modal = document.getElementById("confirmationModal");
  modal.style.display = "block";
}

// Function to close the confirmation modal after a delay
function closeModalWithDelay() {
  // Close the modal after a delay of 2 seconds
  setTimeout(function() {
    closeModal();
  }, 2000); // Adjust the delay as needed
}

// Function to close the confirmation modal
function closeModal() {
  var modal = document.getElementById("confirmationModal");
  modal.style.display = "none";
}

// Function to handle cancellation of booking
function cancelBooking(tid, bookingId){
  console.log("Traveler ID: " + tid);
  console.log("Cancelling booking with ID: " + bookingId);

  // Call the function to open the confirmation modal
  openModal();

  // Event listener for the confirmation button
  confirmBtn.onclick = function() {
    // Display the confirmation message
    confirmationMessage.innerHTML = "Deleting successful. Refund will be processed shortly.";

    // Execute the cancellation action using iframe
    var iframe = document.getElementById("cancelFrame");
    iframe.onload = function() {
      // After the cancellation action is completed, refresh the page
      //window.location.reload();
      window.location.href = "http://localhost/TravelEase/loggedTraveler/index";
    };
    iframe.src = "http://localhost/TravelEase/LoggedTraveler/cancelBooking/" + tid + "/" + bookingId;

    // Close the confirmation modal after action is performed with a delay
    closeModalWithDelay();
  }
}



// Function to simulate refund initiation
function initiateRefund() {
  // Simulate refund process (for demonstration purposes)
  setTimeout(function() {
    location.reload();
  }, 2000);
}
</script>

<!-- end of js for cancel booking -->
</html>



    