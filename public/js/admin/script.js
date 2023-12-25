$(document).ready(function () {
    // Set the number of rows to display initially
    var rowsToShowInitially = 5;

    // Hide all rows initially
    $('.t-row').hide();

    // Show the first set of rows
    $('.t-row:lt(' + rowsToShowInitially + ')').show();

    // Track the last visible row
    var lastVisibleRow = rowsToShowInitially;

    // Function to show all rows
    function showAllRows() {
        $('.t-row').show();
        $('#moreBtn').hide(); // Hide the "More Travelers" button after showing all rows
    }

    // On scroll, check if more rows should be loaded
    $(window).scroll(function () {
        // Check if scrolled to the bottom of the page
        if ($(window).scrollTop() + $(window).height() == $(document).height()) {
            // Load more rows
            var nextRows = lastVisibleRow + rowsToShowInitially; // You can adjust the number of rows to load
            $('.t-row:lt(' + nextRows + ')').show();
            lastVisibleRow = nextRows;
        }
    });

    // On button click, show all rows
    $('#moreBtn').click(function () {
        showAllRows();
    });
});
