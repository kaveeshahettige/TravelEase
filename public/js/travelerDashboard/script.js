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


function openFeedbackPopup(bookingId, Name) {
  console.log("Opening feedback popup for: " + Name);
  // Display the modal
  var modal = document.getElementById("feedbackModal");
  var bookingNameSpan = document.getElementById("bookingNameSpan");
  var submitFeedbackButton = document.getElementById("submitFeedbackButton");

  bookingNameSpan.innerText = Name; // Set booking name in the modal
  submitFeedbackButton.dataset.bookingId = bookingId; // Set booking ID as a data attribute
  modal.style.display = "block";
}

function submitFeedback() {
  var feedback = document.getElementById("feedback").value;
  var rating = document.querySelector('input[name="rating"]:checked').value;
  var bookingId = document.getElementById("submitFeedbackButton").dataset.bookingId; // Retrieve booking ID from data attribute

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
  
  var data = "feedback=" + encodeURIComponent(feedback) + "&rating=" + encodeURIComponent(rating) + "&bookingId=" + encodeURIComponent(bookingId);
  xhr.send(data);
}


function closeFeedbackPopup() {
  console.log("Closing feedback popup");
  // Hide the modal
  var modal = document.getElementById("feedbackModal");
  modal.style.display = "none";
}

window.onclick = function(event) {
  var modal = document.getElementById("feedbackModal");
  if (event.target == modal) {
      console.log("Clicked outside the modal");
      modal.style.display = "none";
  }
}



