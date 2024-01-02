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