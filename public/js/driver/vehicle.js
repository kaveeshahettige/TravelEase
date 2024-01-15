// script.js
document.addEventListener("DOMContentLoaded", function () {
    // This event listener ensures that the code is executed when the page is fully loaded.

    // Close the edit popup by default
    closeEditWindow();
});

function openEditWindow() {
    var popup = document.getElementById("edit-popup");
    popup.style.display = "block";

    // Populate the form fields with current vehicle details
    document.getElementById("make").value = "Toyota";
    document.getElementById("model").value = "Camry";
    document.getElementById("plate").value = "ABC 123";
    document.getElementById("insurance").value = "Insurance details here...";
    document.getElementById("registration").value = "Registration details here...";

    // Display the current vehicle image
    var currentImageSrc = document.getElementById("vehicle-image").src;
    document.getElementById("vehicle-image-preview").src = currentImageSrc;
}

function closeEditWindow() {
    var popup = document.getElementById("edit-popup");
    popup.style.display = "none";
}

function saveEditedDetails() {
    // Retrieve and save the edited details here
    var make = document.getElementById("make").value;
    var model = document.getElementById("model").value;
    var plate = document.getElementById("plate").value;
    var insurance = document.getElementById("insurance").value;
    var registration = document.getElementById("registration").value;

    // Update the vehicle card with the edited details
    document.querySelector(".vehicle-details p:nth-child(1)").innerHTML = "<strong>Make:</strong> " + make;
    document.querySelector(".vehicle-details p:nth-child(2)").innerHTML = "<strong>Model:</strong> " + model;
    document.querySelector(".vehicle-details p:nth-child(3)").innerHTML = "<strong>Plate Number:</strong> " + plate;
    document.querySelector(".vehicle-details p:nth-child(4)").innerHTML = "<strong>Insurance Details:</strong> " + insurance;
    document.querySelector(".vehicle-details p:nth-child(5)").innerHTML = "<strong>Registration Details:</strong> " + registration;

    // Update the vehicle image if a new one is selected
    var newImageSrc = document.getElementById("vehicle-photo").value;
    if (newImageSrc) {
        document.getElementById("vehicle-image-preview").src = newImageSrc;
    }

    closeEditWindow(); // Close the popup
}

function readURL(input) {
    if (input.files && input.files[0]) {
  
      var reader = new FileReader();
  
      reader.onload = function(e) {
        $('.image-upload-wrap').hide();
  
        $('.file-upload-image').attr('src', e.target.result);
        $('.file-upload-content').show();
  
        $('.image-title').html(input.files[0].name);
      };
  
      reader.readAsDataURL(input.files[0]);
  
    } else {
      removeUpload();
    }
  }
  
  function removeUpload() {
    $('.file-upload-input').replaceWith($('.file-upload-input').clone());
    $('.file-upload-content').hide();
    $('.image-upload-wrap').show();
  }
  $('.image-upload-wrap').bind('dragover', function () {
          $('.image-upload-wrap').addClass('image-dropping');
      });
      $('.image-upload-wrap').bind('dragleave', function () {
          $('.image-upload-wrap').removeClass('image-dropping');
  });
  
