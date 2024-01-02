function viewBooking() {
    // Set the new URL you want to navigate to
    const newPageURL = "bookingdetails"; // Replace with your desired URL//wada krnne na login ek illnw56;pt[l0;;]
  
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

  function booking() {
    // Change the URL to the desired destination
    window.open("http://localhost/TravelEase//LoggedTraveler/bookingpayment", "_blank");
    //window.open = "bookingpayment";
}

function Tripdetails() {
  

  window.location.href = "tripfurtherdetail";
}

  /////////////////////

  function initMap() {
    // Map initialization code here
    var map = new google.maps.Map(document.querySelector('.map'), {
        center: { lat: -34.397, lng: 150.644 },
        zoom: 8
    });
}
