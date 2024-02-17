function viewBooking($Sid,$Bid) {
  // Set the new URL you want to navigate to
  const newPageURL = `bookingdetails/${$Sid}/${$Bid}`; // Replace with your desired URL

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

  function booking(type, id, checkinDate, checkoutDate) {
    console.log("Booking Type:", type, "ID:", id, "Check-in:", checkinDate, "Check-out:", checkoutDate);
    // Change the URL to the desired destination, and append the type and id
    window.open("http://localhost/TravelEase/LoggedTraveler/bookingpayment/" + type + "/" + id + "/" + checkinDate + "/" + checkoutDate, "_blank");
}





function Tripdetails(id) {
  // Corrected implementation
  window.location.href = `tripfurtherdetail/${id}`;
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

function deleteBooking(bookingid) {
  // Corrected implementation
  window.location.href = `../../cancelBooking/${bookingid}`;
}



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


