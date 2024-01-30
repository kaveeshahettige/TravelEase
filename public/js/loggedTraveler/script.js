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

  function initMap() {
    // Map initialization code here
    var map = new google.maps.Map(document.querySelector('.map'), {
        center: { lat: 6.0329, lng: 80.2168 },
        zoom: 8
    });
}


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

