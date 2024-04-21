function editInfo() {
    // Replace 'https://example.com' with the URL of the page you want to navigate to
    window.location.href = 'localhost/TravelEase/travelerDashboard/editinfo';
  }

  //gotoHome
  function gotoHome() {
    // Replace 'https://example.com' with the URL of the page you want to navigate to
    window.location.href = '../../loggedTraveler/index';
  }

  /////////////
  
//   $(document).ready(function () {
//     // Initially hide all rows except the first 10
//     $(".t-row").slice(10).hide();

//     $(".next-page-btn").click(function () {
//         $(".t-row").toggle(); // Toggle the visibility of all rows
//         if ($(this).text() === "More Bookings") {
//             $(this).text("Show Less"); // Change button text to "Show Less" when all rows are displayed
//         } else {
//             $(this).text("More Bookings"); // Change button text back to "More Bookings" when hiding rows
//         }
//     });
// });



  /////

  $(document).ready(function () {
    // Set the number of rows to display initially
    var rowsToShowInitially = 5;

    // Hide all rows initially except the first set
    $('.t-row').hide();
    $('.t-row:lt(' + rowsToShowInitially + ')').show();

    // On button click, show all rows
    $('.next-page-btn').click(function () {
        $('.t-row').show();
        $(this).hide(); // Hide the "More Bookings" button after showing all rows
    });
});

/////////////////
/// Function to open the feedback popup


function openFeedbackPopup(tid,Spid,bookingId, Name) {
  console.log("Opening feedback popup for: " + Name);
  // Display the modal
  var modal = document.getElementById("feedbackModal");
  var bookingNameSpan = document.getElementById("bookingNameSpan");
  var submitFeedbackButton = document.getElementById("submitFeedbackButton");


  bookingNameSpan.innerText = Name; // Set booking name in the modal
  submitFeedbackButton.dataset.bookingId = bookingId; // Set booking ID as a data attribute
  submitFeedbackButton.dataset.tid = tid; // Set tid as a data attribute
  submitFeedbackButton.dataset.Spid = Spid; // Set Spid as a data attribute
  modal.style.display = "block";
}

function submitFeedback() {
  var feedback = document.getElementById("feedback").value;
  var rating = document.querySelector('input[name="rating"]:checked').value;
  var bookingId = document.getElementById("submitFeedbackButton").dataset.bookingId;
  var tid= document.getElementById("submitFeedbackButton").dataset.tid;// Retrieve booking ID from data attribute
  var Spid= document.getElementById("submitFeedbackButton").dataset.Spid;// Retrieve booking ID from data attribute

  console.log("Tid: "+tid);
  console.log("Spid: "+Spid);
  console.log("bid: " + bookingId);
  // AJAX request
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "http://localhost/TravelEase/travelerDashboard/submitFeedback", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
      if (xhr.readyState === 4) {
          if (xhr.status === 200) {
              // Display success message
              var successMessage = document.createElement("div");
              successMessage.className = "success-message";
              successMessage.textContent = "Feedback submitted successfully!";
              document.querySelector(".modal-content").appendChild(successMessage);
              
              // Close the modal after a delay
              setTimeout(function() {
                  closeFeedbackPopup();
              }, 2000); // Close after 2 seconds
          } else {
              // Display error message if submission failed
              console.error("Error submitting feedback");
          }
      }
  };
  
  var data = "feedback=" + encodeURIComponent(feedback) + "&rating=" + encodeURIComponent(rating) + "&bookingId=" + encodeURIComponent(bookingId) + "&tid=" + encodeURIComponent(tid) + "&Spid=" + encodeURIComponent(Spid);
  xhr.send(data);
}


function closeFeedbackPopup() {
  console.log("Closing feedback popup");
  // Hide the modal
  var modal = document.getElementById("feedbackModal");
  modal.style.display = "none";
  setTimeout(function() {
    location.reload();
  }, 2000);
}

window.onclick = function(event) {
  var modal = document.getElementById("feedbackModal");
  if (event.target == modal) {
      console.log("Clicked outside the modal");
      modal.style.display = "none";
  }
}

function openPopup(Tid,Sid, Bid) {
  // Get the modal
  var modal1 = document.getElementById("myModal");

  // Get the iframe
  var iframe = document.getElementById("popupFrame");

  // Set the URL you want to open in the iframe
  if(Tid==0){
    var newPageURL = `../bookingdetails/${Sid}/${Bid}`;
  }else{
    //alert("Tid is not 0!");
     //console.log("Tid", Tid);
    var newPageURL = `../bookingdetailsCart/${Tid}/${Sid}/${Bid}`;
  }
  

  // Set the iframe source
  iframe.src = newPageURL;

  // Display the modal
  modal1.style.display = "block";

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close1")[0];

  // When the user clicks on <span> (x), close the modal
  span.onclick = function () {
    modal1.style.display = "none";
  };

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function (event) {
    if (event.target == modal1) {
      modal1.style.display = "none";
    }
  };
  var elements = document.getElementsByClassName('navbar');

}


///////////////////////////

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
      window.location.reload();
    };
    iframe.src = "http://localhost/TravelEase/TravelerDashboard/cancelBooking/" + tid + "/" + bookingId;

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

///////////////////////
function viewBookings(id){
  window.location.href = `http://localhost/TravelEase/travelerDashboard/bookings/${id}`;
}
function viewPayments(id){
  window.location.href = `http://localhost/TravelEase/travelerDashboard/payments/${id}`;
}


///////////////

//markAsRead
function markAsRead(nid) {
  // Send an AJAX request to mark the notification as read
  $.ajax({
      url: `http://localhost/TravelEase/travelerDashboard/markAsRead/${nid}`,
      type: 'GET', // Assuming it's a GET request, adjust if it's a POST request
      dataType: 'json', // Specify the expected data type of the response
      success: function(response) {
          // Check if the mark operation was successful
          if (response.success) {
              // Reload the current page after a short delay
              setTimeout(function() {
                  location.reload();
              }, 1000);
          } else {
              // Handle the case where marking the notification as read failed
              console.error('Failed to mark notification as read');
              // Optionally, display an error message to the user
          }
      },
      error: function(xhr, status, error) {
          // Handle error if needed
          console.error(error);
      }
  });
}


/////////////
function removeCart(bookingId){
  console.log("Cancelling booking with ID: " + bookingId);

  // Call the function to open the confirmation modal
  openModal();

  // Event listener for the confirmation button
  confirmBtn.onclick = function() {
    // Display the confirmation message
    confirmationMessage.innerHTML = "Removed successfully.";

    // Execute the cancellation action using iframe
    var iframe = document.getElementById("cancelFrame");
    iframe.onload = function() {
      // After the cancellation action is completed, refresh the page
      window.location.reload();
    };
    //iframe.src = "http://localhost/TravelEase/TravelerDashboard/cancelBooking/" + tid + "/" + bookingId;
    iframe.src = `http://localhost/TravelEase/travelerDashboard/removeCart/${bookingId}`;

    // Close the confirmation modal after action is performed with a delay
    closeModalWithDelay();
  }
}

function openCart(Bid) {
  window.location.href = `../myCartDetails/${Bid}`;
}

//proceedCart(Bid)
function proceedCart(Bid) {
  window.location.href = `../myCartDetails/${Bid}`;
}

