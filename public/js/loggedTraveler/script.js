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

  function booking(type, id) {
    // Change the URL to the desired destination, and append the type and id
    window.open("http://localhost/TravelEase/LoggedTraveler/bookingpayment/" + type + "/" + id, "_blank");
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
