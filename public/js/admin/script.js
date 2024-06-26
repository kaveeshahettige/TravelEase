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

function confirmDelete() {
    // Use JavaScript to show a confirmation dialog
    return confirm('Are you sure you want to delete?');
}

function deleteTraveler(id) {
    // Use JavaScript to show a confirmation dialog
    if (confirm('Are you sure you want to delete?')) {
        // If the user confirms, navigate to the deletion controller
        window.location.href = 'deleteTraveler/'+id;
    }
    // If the user cancels, do nothing
}

//////////
function deleteHotel(id) {
    // Use JavaScript to show a confirmation dialog
    if (confirm('Are you sure you want to delete?')) {
        // If the user confirms, navigate to the deletion controller
        window.location.href = 'deleteHotel/'+id;
    }
    // If the user cancels, do nothing
}
//////
function deleteAgency(id) {
    // Use JavaScript to show a confirmation dialog
    if (confirm('Are you sure you want to delete?')) {
        // If the user confirms, navigate to the deletion controller
        window.location.href = 'deleteAgency/'+id;
    }
    // If the user cancels, do nothing
}
///////////
function deleteGuide(id) {
    // Use JavaScript to show a confirmation dialog
    if (confirm('Are you sure you want to delete?')) {
        // If the user confirms, navigate to the deletion controller
        window.location.href = 'deleteGuide/'+id;
    }
    // If the user cancels, do nothing
}

/////////////
function adminDelete(id) {
    // Use JavaScript to show a confirmation dialog
    if (confirm('Are you sure you want to delete?')) {
        // If the user confirms, navigate to the deletion controller
        window.location.href = 'adminDelete';
    }
    // If the user cancels, do nothing
}

/////////////
//------- not working----------
$(document).ready(function () {
    // Handle form submission
    $('#searchForm').submit(function (e) {
        e.preventDefault(); // Prevent the form from submitting normally

        // Get the search input value
        var searchTerm = $('#searchInput').val().toLowerCase();

        // Iterate through each list item
        $('ul li').each(function () {
            // Get the text content of the list item
            var listItemText = $(this).text().toLowerCase();

            // Check if the search term is present in the list item text
            if (listItemText.includes(searchTerm)) {
                // Show the matching item
                $(this).show();
            } else {
                // Hide non-matching items
                $(this).hide();
            }
        });
    });
});

//----------------------------

// function viewDocument($id){
    
//     window.location.href = 'viewDocument/'.$id;
// }

/////////////////////

// function viewDocument(id) {

    
//     window.location.href = 'viewDocument/'+id;

//     // Open the document in a new window or tab
//     window.open(documents, '_blank');
// }

/////////////////////


function openDocument(documentName) {
    // Add any necessary security checks here before constructing the URL

    // Construct the URL and open the document
    if(documentName == null || documentName == ""){
        alert("No document found");
    }else{
    const documentUrl = '../documents/' + encodeURIComponent(documentName);
    window.open(documentUrl, '_blank');
    }
}


function acceptUser(id) {
    // Display a confirmation dialog
    var confirmAccept = window.confirm('Are you sure you want to accept this user?');

    // Check if the user clicked "OK" in the confirmation dialog
    if (confirmAccept) {
        // If confirmed, navigate to the URL
        window.location.href = 'acceptUser/' + id;
    }
    // If canceled, do nothing or handle it as needed
}


function declineUser(id) {
    var confirmDecline = window.confirm('Are you sure you want to decline this user?');
    if (confirmDecline) {
        window.location.href = 'declineUser/'+id;
    }
    
}





