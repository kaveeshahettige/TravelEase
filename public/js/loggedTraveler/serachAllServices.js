function booking(type, id, checkinDate, checkoutDate) {
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