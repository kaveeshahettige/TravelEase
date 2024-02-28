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
    var rowsToShowInitially = 10;

    // Hide all rows initially except the first set
    $('.t-row').hide();
    $('.t-row:lt(' + rowsToShowInitially + ')').show();

    // On button click, show all rows
    $('.next-page-btn').click(function () {
        $('.t-row').show();
        $(this).hide(); // Hide the "More Bookings" button after showing all rows
    });
});
