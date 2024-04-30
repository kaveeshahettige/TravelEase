function viewBooking($Tid, $Sid, $Bid) {
    // Set the new URL you want to navigate to
    let newPageURL;
  
    if ($Tid == 0) {
      newPageURL = `bookingdetails/${$Sid}/${$Bid}`;
    } else {
      //alert("Tid is not 0!");
      //console.log("Tid", Tid);
      newPageURL = `bookingdetailsCart/${$Tid}/${$Sid}/${$Bid}`;
    }
  
    // Use window.location to navigate to the new page
    window.location.href = newPageURL;
  }
  

  
  // Attach the clickSearch function to the button's click event
  const kbutton = document.getElementById("viewbooking");
  kbutton.addEventListener("click", viewBooking);
  /////////////////////////

  function plan() {
    // Set the new URL you want to navigate to
    const newPageURL = "bookingdetails"; // Replace with your desired URL//wada krnne na login ek illnw56;pt[l0;;]
  
    // Use window.location to navigate to the new page
    window.location.href = newPageURL;
  }
  
  // Attach the clickSearch function to the button's click event
  const kbutton1 = document.getElementById("plantrip");
  kbutton1.addEventListener("click", plan);
  /////////////////////////

//   function booking(type, id, checkinDate, checkoutDate) {
//     console.log("Booking Type:", type, "ID:", id, "Check-in:", checkinDate, "Check-out:", checkoutDate);
//     if(type==4){
//       var pickupTime = document.getElementById('pickupTime').value;
//     }
    
//     // Change the URL to the desired destination, and append the type and id
//     window.open("http://localhost/TravelEase/LoggedTraveler/bookingpayment/" + type + "/" + id + "/" + checkinDate + "/" + checkoutDate, "_blank");
// }

////////////



////////

function booking(type, id, checkinDate, checkoutDate) {
  console.log("Booking Type:", type, "ID:", id, "Check-in:", checkinDate, "Check-out:", checkoutDate);
  var pickupTime = ''; // Initialize pickupTime variable
  var meetTime = '';
  
  
  if (type == 4) {
      pickupTime = document.getElementById('pickupTime').value; // Get pickupTime value only when type is 4
      if (!pickupTime) {
        // Display an alert or message indicating that pickupTime is required
        showPopup('pickupTimePopup');
        return; // Stop execution if pickupTime is not provided
    }
  }
  if (type == 5) {
    meetTime = document.getElementById('meetTime').value; // Get pickupTime value only when type is 4
    if (!meetTime) {
      // Display an alert or message indicating that pickupTime is required
      showPopup('meetTimePopup');
      return; // Stop execution if pickupTime is not provided
  }
}
  
  // Construct the URL to include the pickupTime conditionally
  var url = "http://localhost/TravelEase/LoggedTraveler/bookingpayment/" + type + "/" + id + "/" + checkinDate + "/" + checkoutDate;
  if (type == 4) {
      url += "/" + pickupTime; // Append pickupTime to the URL only when type is 4
  }
  if (type == 5) {
    url += "/" + meetTime; // Append pickupTime to the URL only when type is 4
}
  
  // Open the URL in a new window
  window.open(url, "_blank");
}
function bookingGuide() {
  var checkinDate = document.getElementById('pickup').value;
    var meetTime = document.getElementById('ptime').value;
    var checkoutDate = document.getElementById('dropoff').value;
    var guideID = document.getElementById('search-button').dataset.guideId;
  console.log("Booking Type:", 5, "ID:", guideID, "Check-in:", checkinDate, "Check-out:", checkoutDate, "Meet Time:", meetTime);
  // var pickupTime = ''; // Initialize pickupTime variable
  
  
      if (!meetTime) {
        // Display an alert or message indicating that pickupTime is required
        alert("Please enter pickup time.");
        return; // Stop execution if pickupTime is not provided
    }
  
  
  // Construct the URL to include the pickupTime conditionally
  var url = "http://localhost/TravelEase/LoggedTraveler/bookingpayment/" + 5 + "/" + guideID + "/" + checkinDate + "/" + checkoutDate;
  
      url += "/" + meetTime; // Append pickupTime to the URL only when type is 4
  
  
  // Open the URL in a new window
  window.open(url, "_blank");
}

/////////
function bookingV(type, id, checkinDate, checkoutDate, pickupTime) {
  console.log("Booking Type:", type, "ID:", id, "Check-in:", checkinDate, "Check-out:", checkoutDate, "Pickup Time:", pickupTime);
  // var pickupTime = ''; // Initialize pickupTime variable
  
  // if (type == 4) {
  //     pickupTime = document.getElementById('pickupTime').value; // Get pickupTime value only when type is 4
  // }
  
  // Construct the URL to include the pickupTime conditionally
  var url = "http://localhost/TravelEase/LoggedTraveler/bookingpayment/" + type + "/" + id + "/" + checkinDate + "/" + checkoutDate+"/"+pickupTime;
  
  
  // Open the URL in a new window
  window.open(url, "_blank");
}


///////


/*
function booking(type, id, checkinDate, checkoutDate) {
    console.log("Booking Type:", type, "ID:", id, "Check-in:", checkinDate, "Check-out:", checkoutDate);
    var pickupTime = document.getElementById('pickupTime').value;
    // Change the URL to the desired destination, and append the type, id, checkinDate, checkoutDate, and pickupTime
    window.open("http://localhost/TravelEase/LoggedTraveler/bookingpayment/" + type + "/" + id + "/" + checkinDate + "/" + checkoutDate + "/" + pickupTime, "_blank");
}
*/





function Tripdetails(id) {
  // Corrected implementation
  window.location.href = `tripfurtherdetail/${id}`;
}

//planNewTrip
function planNewTrip() {
  window.location.href = `plantrip`;

}


  /////////////////////

//   function initMap() {
//     // Map initialization code here
//     var map = new google.maps.Map(document.querySelector('.map'), {
//         center: { lat: 6.0329, lng: 80.2168 },
//         zoom: 8
//     });
// }


///////////////////

function searchRooms(event) {
  event.preventDefault(); // Prevent the default form submission behavior

  var checkinDate = document.getElementById('checkin').value;
  var checkoutDate = document.getElementById('checkout').value;
  var hotelId = document.getElementById('search-button').dataset.hotelId;

    console.log("Checkin Date:", checkinDate);
    console.log("Checkout Date:", checkoutDate);
    console.log("Hotel ID:", hotelId);
  // You may want to perform some validation on the input dates

  // Send a request to the server to fetch available rooms based on the dates
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
          // Update the table with the fetched data
          document.getElementById('available-rooms').innerHTML = xhr.responseText;
      }
  };
  xhr.open('GET', 'http://localhost/TravelEase//LoggedTraveler/fetchAvailableRooms?action=fetchAvailableRooms&checkin=' + checkinDate + '&checkout=' + checkoutDate + '&hotelid=' + hotelId, true);
  xhr.send();
}


///////////////
//deleteBooking()

// function deleteBooking(bookingid) {
//   // Corrected implementation
//   window.location.href = `../../cancelBooking/${bookingid}`;
// }
//////////////////
///////////////////////////



/////////////////



    // Initialize the map
    // var map = L.map('map').setView([7.8731, 80.7718], 12); // Set the initial coordinates and zoom level

    // // Add OpenStreetMap tile layer
    // L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    //     attribution: '© OpenStreetMap contributors'
    // }).addTo(map);

    // Add markers for your places
    // <?php foreach ($data['places'] as $place) : ?>
    //     L.marker([<?php echo $place->latitude; ?>, <?php echo $place->longitude; ?>])
    //         .addTo(map)
    //         .bindPopup("<b><?php echo $place->place_name; ?></b><br><?php echo $place->place_description; ?>");
    // <?php endforeach; ?>


    //////
    function clickSearchHotel() {
      // Get the location input value
      var location = $('#locationInput').val();

      // Send an AJAX request to your controller
      $.ajax({
          type: 'POST',
          url: 'http://localhost/TravelEase/loggedTraveler/searchHotels', // Replace with your controller URL
          data: { location: location },
          success: function (response) {
              // Handle the response from the server
              console.log(response);
          },
          error: function (error) {
              // Handle the error
              console.error(error);
          }
      });
  }

  /////////////

  $(document).ready(function() {
    // Handle form submission with AJAX
    $('#searchForm').submit(function(event) {
        // Prevent default form submission
        event.preventDefault();
        
        // Get the search query
        var location = $('#locationInput').val();

        // Make AJAX request
        $.ajax({
            type: 'POST',
            url: '<?php echo URLROOT ?>LoggedTraveler/searchHotels',
            data: { location: location },
            success: function(response) {
                // Update the DOM with the new data
                $('.main2').html(response);
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error(xhr.responseText);
            }
        });
    });
});


///////////////////////
function searchVehicles(event) {
  event.preventDefault(); // Prevent the default form submission behavior

  var pickupDate = document.getElementById('pickup').value;
  var pickupTime = document.getElementById('ptime').value;
  var dropoffDate = document.getElementById('dropoff').value;
  // var dropoffTime = document.getElementById('dtime').value;
  var agencyId = document.getElementById('search-button').dataset.agencyId;

  // Send a request to the server to fetch available vehicles based on the dates
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
          // Update the table with the fetched data
          document.getElementById('available-vehicles').innerHTML = xhr.responseText;
      }
  };
  xhr.open('GET', 'http://localhost/TravelEase//LoggedTraveler/fetchAvailableVehicles?action=fetchAvailableVehicles&pickupDate=' + pickupDate + '&pickupTime=' + pickupTime + '&dropoffDate=' + dropoffDate + '&agencyId=' + agencyId, true);
  xhr.send();
}


document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('withDriver').addEventListener('change', function() {
        handleCheckboxClick('withDriver', this.checked);
    });
});
// function updateTotalAmount() {
//     var total = 0;
//     <?php foreach ($data['resultArray'] as $bookingData): ?>
//         <?php if ($bookingData['type'] == 4): ?>
//             var price = parseFloat(document.getElementById('totalPrice').innerText);
//             total += price;
//         <?php elseif ($bookingData['type'] == 3): ?>
//             var price = parseFloat(document.getElementById('roomPrice').innerText);
//             total += price;
//         <?php endif; ?>
//     <?php endforeach; ?>
//     document.getElementById('totalAmount').innerText = total.toFixed(2) + " LKR";
// }
var servicePrices=[];
function handleCheckboxClick(checkboxId, vehicleId, days) {
  // Determine the driver type based on the checkbox ID
  const driverType = checkboxId === 'withDriver' ? 'withDriver' : 'withoutDriver';
  
  // Check the clicked checkbox
  document.getElementById(checkboxId).checked = true;

  // Uncheck the other checkbox
  const otherCheckboxId = checkboxId === 'withDriver' ? 'withoutDriver' : 'withDriver';
  document.getElementById(otherCheckboxId).checked = false;

  // Fetch the updated price
  fetchUpdatedPrice(driverType, vehicleId, days);
  updateFormAction(driverType, vehicleId, days);
  updateTotalAmount();
}


function fetchUpdatedPrice(driverType, vehicleId, days) {
  const xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
              const response = JSON.parse(xhr.responseText);
              const updatedPrice = response.price;
              document.getElementById('totalPrice').innerHTML = '<strong>Price : ' + updatedPrice + '&nbsp;LKR</strong>';
              handlePriceUpdate(updatedPrice);
              updateTotalAmount(); // Call updateTotalAmount() here to update the total amount
          } else {
              console.error('Error fetching price: ' + xhr.status);
              document.getElementById('totalPrice').innerHTML = '<strong>Error fetching price</strong>'; // Display error message to the user
          }
      }
  };

  // Construct the URL with the parameters as query parameters
  let url;
  if (driverType === 'withDriver') {
      url = 'http://localhost/TravelEase/LoggedTraveler/fetchPriceWithDriver?driverType=' + encodeURIComponent(driverType) + '&vehicleId=' + encodeURIComponent(vehicleId) + '&days=' + encodeURIComponent(days);
  } else {
      // Use the initial price value for withoutDriver
      const initialPrice = parseFloat(document.getElementById('totalPrice').dataset.initialPrice);
      document.getElementById('totalPrice').innerHTML = '<strong>Price : ' + initialPrice + '&nbsp;LKR</strong>';
      handlePriceUpdate(initialPrice);
      updateTotalAmount(); // Call updateTotalAmount() here for consistency
      return;
  }

  xhr.open('GET', url, true);
  xhr.send();
}


///
function updateTotalAmount() {
    // Fetch all the price elements for each booking
    const priceElements = document.querySelectorAll('.t-price');

    // Initialize total amount variable
    let totalAmount = 0;

    // Iterate through each price element and sum up the prices
    priceElements.forEach((element) => {
        const priceText = element.innerText.replace('Price : ', '').replace(' LKR', '');
        const price = parseFloat(priceText);
        totalAmount += price;
    });

    // Update the total amount element
    const totalAmountElement = document.querySelector('.total-amount');
totalAmountElement.innerHTML = '<strong>Total : </strong>' + totalAmount.toFixed(2) + ' LKR';

// Update the value of the hidden input field
const totalAmountInput = document.getElementById('totalAmountInput');
totalAmountInput.value = totalAmount.toFixed(2); // Set the value of the hidden input field

}


//////


const buttons = document.querySelectorAll(".booking-button");
buttons.forEach(button => {
    button.addEventListener("click", function() {
        const type = 3; // Assuming type is always 3
        const id = button.dataset.roomId;
        const checkinDate = button.dataset.checkinDate;
        const checkoutDate = button.dataset.checkoutDate;
        bookingH(type, id, checkinDate, checkoutDate);
    });
});

///////////
function bookingH(type, id, checkinDate, checkoutDate) {
  console.log("Booking Type:", type, "ID:", id, "Check-in:", checkinDate, "Check-out:", checkoutDate);
  var pickupTime = ''; // Initialize pickupTime variable
  
  if (type == 4) {
      pickupTime = document.getElementById('pickupTime').value; // Get pickupTime value only when type is 4
  }
  
  // Construct the URL to include the pickupTime conditionally
  var url = "http://localhost/TravelEase/LoggedTraveler/bookingpayment/" + type + "/" + id + "/" + checkinDate + "/" + checkoutDate;
  if (type == 4) {
      url += "/" + pickupTime; // Append pickupTime to the URL only when type is 4
  }
  
  // Open the URL in a new window
  window.open(url, "_blank");
}

//openPopup

// function openPopup(type, id, checkinDate, checkoutDate) {
//   var pickupTime = document.getElementById('pickupTime').value;
//   if (type == 4 && !pickupTime) {
//       alert("Please enter pickup time.");
//       return;
//   }
//   var popupContent = "Booking Type: " + type + "<br>ID: " + id + "<br>Check-in: " + checkinDate + "<br>Check-out: " + checkoutDate;
//   if (type == 4) {
//       popupContent += "<br>Pickup Time: " + pickupTime;
//   }
//   document.getElementById("popupContent").innerHTML = popupContent;
//   document.getElementById("myModal").style.display = "block";
// }

// // Function to close the modal
// function closeModal() {
//   document.getElementById("myModal").style.display = "none";
// }


///
function bookingHas(type, id, checkinDate, checkoutDate) {
  console.log("Booking Type:", type, "ID:", id, "Check-in:", checkinDate, "Check-out:", checkoutDate);
  var pickupTime = ''; // Initialize pickupTime variable

  if (type == 4) {
    pickupTime = document.getElementById('pickupTime').value; // Get pickupTime value only when type is 4
  }
  if (type == 5) {
    meetTime = document.getElementById('meetTime').value; // Get meetTime value only when type is 5
  }

  // Construct the URL to include the pickupTime or meetTime conditionally
  var url = "http://localhost/TravelEase/LoggedTraveler/viewDeal/" + type + "/" + id + "/" + checkinDate + "/" + checkoutDate;
  if (type == 4) {
    url += "/" + pickupTime; // Append pickupTime to the URL only when type is 4
  }
  if (type == 5) {
    url += "/" + meetTime; // Append meetTime to the URL only when type is 5
  }
  //window.location.href = url;same page
  window.open(url, '_blank');//anothe page
  // // Open the URL in a pop-up modal
  // var customModal = document.createElement('div');
  // customModal.classList.add('modal');
  // customModal.innerHTML = `
  //   <div class="modal-content">
  //     <span class="close" onclick="closeCustomModal()">&times;</span>
  //     <iframe src="${url}" frameborder="0"></iframe>
  //   </div>
  // `;
  // document.body.appendChild(customModal);
}

// Function to close the custom modal
function closeCustomModal() {
  var modal = document.querySelector('.modal');
  if (modal) {
    modal.remove();
  }
}

// Add event listeners for the close button
document.addEventListener('click', function(event) {
  if (event.target.classList.contains('close')) {
    closeCustomModal();
  }
});

// Function to show and hide popup
function showPopup(popupId) {
  var popup = document.getElementById(popupId);
  popup.style.display = 'block'; // Show popup

  // Hide popup after 3 seconds (adjust as needed)
  setTimeout(function() {
      popup.style.display = 'none'; // Hide popup
  }, 3000); // 3 seconds
}
//
function addToCart(type, id, button) {
  // Ensure that the button is defined
  if (button) {
      // Get the computed style of the button
      var computedStyle = window.getComputedStyle(button);
      // Get the background color from the computed style
      var backgroundColor = computedStyle.backgroundColor;

      // Check if the background color is green
      if (backgroundColor === 'rgb(69, 160, 73)') { // Green color
          // Change background color to red
          button.style.backgroundColor = '#FF0000';
          // Change the button text to 'Remove'
          button.innerHTML = '&#x2212;&nbsp;Remove';

          // Check if the type is related to vehicles
          if (type === 4) {
              // Retrieve the pickup time entered by the user
              var pickupTime = document.getElementById('pickupTime').value;
              // Check if pickup time is provided and not empty
              if (pickupTime.trim() !== '') {
                  // Proceed with adding the item to the cart
                  addToCartBackend(type, id, true);
                  // Optionally, you can display a confirmation message here
                  // alert("Vehicle added to cart successfully!");
              } else {
                  // If pickup time is not provided, notify the user
                  showPopup('pickupTimePopup');
                  // Reset the button state to Cart
                  button.style.backgroundColor = '#45a049';
                  button.innerHTML = '&#x271A;&nbsp;Cart';
                  // Return without adding the item to the cart
                  return;
              }
          }else if(type === 5){
            // Retrieve the pickup time entered by the user
            var meetTime = document.getElementById('meetTime').value;
            // Check if pickup time is provided and not empty
            if (meetTime.trim() !== '') {
                // Proceed with adding the item to the cart
                addToCartBackend(type, id, true);
                // Optionally, you can display a confirmation message here
                // alert("Vehicle added to cart successfully!");
            } else {
                // If pickup time is not provided, notify the user
                showPopup('meetTimePopup');
                // Reset the button state to Cart
                button.style.backgroundColor = '#45a049';
                button.innerHTML = '&#x271A;&nbsp;Cart';
                // Return without adding the item to the cart
                return;
            }
          } else {
              // For items other than vehicles, proceed with adding to cart without checking pickup time
              addToCartBackend(type, id, true);
          }

      } else {
          // Change background color to green
          button.style.backgroundColor = '#45a049';
          // Change the button text to 'Cart'
          button.innerHTML = '&#x271A;&nbsp;Cart';
          addToCartBackend(type, id, false);
      }
      // Implement the logic to add/remove the item to/from the cart here
  }
}
function showAddedCartNotification() {
  var notification = document.getElementById('cartNotification');
  notification.style.display = 'block'; // Show notification

  // Hide notification after 3 seconds (adjust as needed)
  setTimeout(function() {
      notification.style.display = 'none'; // Hide notification
  }, 3000); // 3 seconds
}
function showRemovedCartNotification() {
  var notification = document.getElementById('removecartNotification');
  notification.style.display = 'block'; // Show notification

  // Hide notification after 3 seconds (adjust as needed)
  setTimeout(function() {
      notification.style.display = 'none'; // Hide notification
  }, 3000); // 3 seconds
}
function cartisEmpty() {
  var notificationE = document.getElementById('cartIsEmptyNotification');
  notificationE.style.display = 'block'; // Show notification

  // Hide notification after 3 seconds (adjust as needed)
  setTimeout(function() {
    notificationE.style.display = 'none'; // Hide notification
  }, 3000); // 3 seconds
}

function addToCartBackend(type, id, add) {
  // Simulated cart storage
  var cart = JSON.parse(localStorage.getItem('cart')) || {};

  if (add) {
      // Add item to cart
      if (!cart[type]) {
          cart[type] = [];
      }
      cart[type].push(id);
      console.log('Adding item to cart:', type, id);
      showAddedCartNotification() 
  } else {
      // Remove item from cart
      if (cart[type]) {
          var index = cart[type].indexOf(id);// finds the index of the id 
          if (index !== -1) {
              cart[type].splice(index, 1);//removes one element from the array stored under the key type 
              console.log('Removing item from cart:', type, id);
              showRemovedCartNotification()
          }
      }
  }

  // Update localStorage with the modified cart
  localStorage.setItem('cart', JSON.stringify(cart));
  

  // // Toggle checkout button visibility
  // toggleCheckoutButton();
}
//////////////

    function continueToCheckoutAndRefresh() {
        // Call the original function to continue to checkout
        var reply=continueToCheckout();
        // Reload the page after a slight delay
        if(reply){
          setTimeout(function() {
            location.reload();
        }, 1000); // Adjust the delay time as needed
        }
        
    }



//continueToCheckout()
//checkthis function cgeckindate and checkoutdate are wrongly printed in here
function continueToCheckout() {
  // Retrieve cart data from localStorage
  var cartData = JSON.parse(localStorage.getItem('cart'));
  var checkinDate = document.querySelector('.continue-button').getAttribute('data-checkin');
  var checkoutDate = document.querySelector('.continue-button').getAttribute('data-checkout');

  // Print cart data in console
  console.log('checkinDate:', checkinDate);
  console.log('checkoutDate:', checkoutDate);

  // Check if cartData is not null
  if (cartData) {
    // Iterate over each type in the cart
    Object.keys(cartData).forEach(function(type) {
      // Print type of item
      console.log('Type:', type);

      // Check if cartData[type] is an array
      if (Array.isArray(cartData[type])) {
        // Print each item ID in the type
        cartData[type].forEach(function(id) {
          console.log('ID:', id);
        });
      } else {
        console.log('Invalid data format for type', type);
      }
    });

    // Retrieve pickupTime value
    var pickupTime = document.getElementById('pickupTime').value;
    var meetTime = document.getElementById('meetTime').value;

    // Check if the pickup time and/or meet time have values
    if (pickupTime && !meetTime) {
      // If only pickup time is provided, append pickupTime to the URL parameters
      var encodedCartData = encodeURIComponent(JSON.stringify(cartData));
      window.open(`bookingcart/${encodedCartData}/${checkinDate}/${checkoutDate}/${pickupTime}`, '_blank');
    } else if (!pickupTime && meetTime) {
      // If only meet time is provided, append meetTime to the URL parameters
      var encodedCartData = encodeURIComponent(JSON.stringify(cartData));
      window.open(`bookingcart/${encodedCartData}/${checkinDate}/${checkoutDate}/null/${meetTime}`, '_blank');
    } else if (pickupTime && meetTime) {
      // If both pickup time and meet time are provided, append both to the URL parameters
      var encodedCartData = encodeURIComponent(JSON.stringify(cartData));
      window.open(`bookingcart/${encodedCartData}/${checkinDate}/${checkoutDate}/${pickupTime}/${meetTime}`, '_blank');
    } else {
      // If neither pickup time nor meet time is provided, exclude them from the URL parameters
      var encodedCartData = encodeURIComponent(JSON.stringify(cartData));
      window.open(`bookingcart/${encodedCartData}/${checkinDate}/${checkoutDate}`, '_blank');
    }

    // Clear the cart after checkout
    localStorage.removeItem('cart');
    return true;
  } else {
    // Cart is empty, show alert
    //alert('Your cart is empty. Please add items before proceeding to checkout.');
    cartisEmpty();
    return false;
    
  }
}

///////////
// Get the modal element
var modali = document.getElementById("myModali");

// Get the <span> element that closes the modal
var spani = document.getElementsByClassName("closei")[0];

// Function to open the modal
function openModal() {
  if (modali) {
    modali.style.display = "block";
  } else {
    console.error("Modal element not found.");
  }
}

// Function to close the modal
function closeModal() {
  if (modali) {
    modali.style.display = "none";
  } else {
    console.error("Modal element not found.");
  }
}

// When the user clicks on <span> (x), close the modal
if (spani) {
  spani.onclick = function() {
    closeModal();
  };
} else {
  console.error("Close button element not found.");
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modali) {
    closeModal();
  }
};

//////////////////
/////////////
var modalguide = document.getElementById('modalguide');
var spanguide = document.getElementsByClassName('closeguide')[0];

// When the user clicks on the button, open the modal
// Define the openModalGuide function
function openModalGuide() {
  var modal = document.getElementById('modalguide');
  if (modal) {
    modal.style.display = 'block';
    // Automatically close the modal after 5 seconds
    setTimeout(function() {
      modal.style.display = 'none';
    }, 2000); // 2000 milliseconds = 5 seconds
  } else {
    console.error('Modal element not found');
  }
}

// The rest of your code remains the same



// When the user clicks on <span> (x), close the modal
spanguide.onclick = function () {
  modalguide.style.display = 'none';
};

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
  if (event.target == modalguide) {
    modalguide.style.display = 'none';
  }
};





////////////////
function searchGuide(event) {
  event.preventDefault(); // Prevent the default form submission behavior

  var pickupDate = document.getElementById('pickup').value;
  var pickupTime = document.getElementById('ptime').value;
  var dropoffDate = document.getElementById('dropoff').value;
  var guideID = document.getElementById('search-button').dataset.guideId;

  // Send a request to the server to fetch guide availability
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
          // Parse the JSON response
          var response = JSON.parse(xhr.responseText);
          // Check if guide is available
          if (response.isAvailable) {
              // Guide is available, show the "Book Now" button
              document.getElementById('book-now-button').style.display = 'block';
              document.getElementById('search-button').style.display = 'none';
          } else {
              // Guide is not available, hide the "Book Now" button or show a message
              //need a modal pop saying tht guide is not available
              openModalGuide();
              document.getElementById('search-button').style.display = 'block';
              // You can also display a message to the user indicating that the guide is not available
          }
      }
  };
  // Send the request to fetch guide availability
  xhr.open('GET', 'http://localhost/TravelEase/LoggedTraveler/fetchGuideAvaialbility?action=fetchGuideAvaialbility&pickupDate=' + pickupDate + '&pickupTime=' + pickupTime + '&dropoffDate=' + dropoffDate + '&guideId=' + guideID, true);
  xhr.send();
}





//////////////////////

























