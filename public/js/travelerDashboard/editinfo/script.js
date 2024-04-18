function editInfo() {
  // Replace 'https://example.com' with the URL of the page you want to navigate to
  window.location.href = 'editInfo';
}
function deleteProfile() {
  // Replace 'https://example.com' with the URL of the page you want to navigate to
  window.location.href = '<?php echo APPROOT?>/users/delete';
}

/////////////////////////
// function uploadProfilePicture() {
//   // Trigger click on the hidden file input
//   document.getElementById('newProfilePicture').click();

//   // When a new picture is selected, update the profile picture
//   document.getElementById('newProfilePicture').addEventListener('change', function() {
//       var fileInput = this;
//       var profilePicture = document.getElementById('profilePicture');

//       if (fileInput.files && fileInput.files[0]) {
//           var reader = new FileReader();

//           reader.onload = function(e) {
//               // Update the source of the profile picture
//               profilePicture.src = e.target.result;
//           };

//           // Read the selected file as a data URL
//           reader.readAsDataURL(fileInput.files[0]);
//       }
//   });
// }
////////////////////////

// function uploadProfilePicture(){
//   // Trigger click on the hidden file input
//   document.getElementById('newProfilePicture').click();

//   // When a new picture is selected, update the profile picture and upload to the server
//   document.getElementById('newProfilePicture').addEventListener('change', function() {
//       var fileInput = this;

//       if (fileInput.files && fileInput.files[0]) {
//           var reader = new FileReader();

//           reader.onload = function(e) {
//               // Update the source of the profile picture
//               $('#profilePicture').attr('src', e.target.result);

//               // Call a function to send the file to the server for storage
//               uploadProfilePictureToServer(fileInput.files[0]);
//           };

//           // Read the selected file as a data URL
//           reader.readAsDataURL(fileInput.files[0]);
//       }
//   });
// }

//////////////////
// function uploadProfilePictureToServer(file) {
//   // Using jQuery for simplicity, you can use vanilla JavaScript or other libraries
//   var formData = new FormData();
//   formData.append('profilePicture', file);

//   $.ajax({
//     type: 'POST',
//     url: 'http://localhost/TravelEase/travelerDashboard/changeProfilePicture',
//     data: formData,
//     processData: false,
//     contentType: false,
//     dataType: 'json', // Add this line
//     success: function (response) {
//         console.log(response);
//         // Handle the server's response, if needed
//     },
//     error: function (error) {
//         console.error(error);
//     }
// });

// }

function triggerClick() {
  // Replace 'https://example.com' with the URL of the page you want to navigate to
  // window.location.href = 'localhost/TravelEase/Users/delete';
  var profileDisplay = document.getElementById('profileDisplay');
        profileDisplay.style.border = '2px solid #ff0000';
        
  document.querySelector('#newProfilePicture').click();
  


}

function displayImage(e) {
  if(e.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
      document.querySelector('#confirmationMessage').style.display = 'block';
    }
    reader.readAsDataURL(e.files[0]);
  }   
}

function changePassword() {
  // Replace 'https://example.com' with the URL of the page you want to navigate to
  window.location.href = '../changePassword';
}

function gotoHome() {
  // Replace 'https://example.com' with the URL of the page you want to navigate to
  window.location.href = '../../loggedTraveler/index';
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
  window.location.href = 'http://localhost/TravelEase/Landpage';
}

// Function to close the confirmation modal
function closeModal() {
  var modal = document.getElementById("confirmationModal");
  modal.style.display = "none";
}

// Function to handle cancellation of booking
function deactivateUser(id){
  console.log("Traveler ID: " + id);

  // Call the function to open the confirmation modal
  openModal();

  // Event listener for the confirmation button
  confirmBtn.onclick = function() {
    // Display the confirmation message
    confirmationMessage.innerHTML = "Deactivation successful.";

    // Execute the cancellation action using iframe
    var iframe = document.getElementById("cancelFrame");
    iframe.onload = function() {
      // After the cancellation action is completed, refresh the page
      window.location.reload();
    };
    iframe.src = "http://localhost/TravelEase/TravelerDashboard/deactivateUser/" + id ;

    // Close the confirmation modal after action is performed with a delay
    closeModalWithDelay();
  }
}




