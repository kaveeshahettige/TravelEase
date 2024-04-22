function openPopup() {
    document.getElementById('popup').style.display = 'block';
}

function closePopup() {
    document.getElementById('popup').style.display = 'none';
}

function updatePopupDetails(profilePicture, guestName, checkInDate, roomType) {
    // Update the profile picture
    var profilePictureDiv = document.getElementById('profile-picture');
    profilePictureDiv.style.backgroundImage = "url('" + profilePicture + "')";
    profilePictureDiv.title = 'Profile Picture';

    // Update other details
    document.getElementById('guestName').innerText = 'Guest Name: ' + guestName;
    document.getElementById('checkInDate').innerText = 'Check-in Date: ' + checkInDate;
    document.getElementById('roomType').innerText = 'Room Type: ' + roomType;
    // Add more details as needed
}

function showCancelPopup(room_id, user_id, booking_id, startDate, endDate, temporyid, roomType,amount) {
    // Create overlay div
    const overlay = document.createElement('div');
    overlay.className = 'overlay';

    const confirmDialog = document.createElement('div');
    confirmDialog.className = 'confirm-dialog';
    confirmDialog.innerHTML = `
        <div class="confirm-message">Are you sure you want to cancel this booking?</div>
        <div class="buttons">
            <button class="btn btn-yes" onclick="cancelBooking('${room_id}', '${user_id}', '${booking_id}', '${startDate}', '${endDate}', '${temporyid}', '${roomType}',${amount} )">Yes</button>
            <button class="btn btn-no" onclick="cancelCancel()">No</button>
        </div>
    `;

    document.body.appendChild(overlay);
    document.body.appendChild(confirmDialog);
}

// Function to cancel the cancel action
function cancelCancel() {
    // Hide the popup
    document.body.removeChild(document.querySelector('.overlay'));
    document.body.removeChild(document.querySelector('.confirm-dialog'));
}

function cancelBooking(room_id, user_id, booking_id, startDate, endDate,temporyid, roomType,amount) {
    console.log(endDate);
    // Prepare the data to send
    var requestData = {
        room_id: room_id,
        user_id: user_id,
        booking_id: booking_id,
        startDate: startDate,
        endDate: endDate,
        temporyid: temporyid,
        roomType: roomType,
        amount: amount
    };

    const form = new FormData();
    form.append('room_id', room_id);
    form.append('user_id', user_id);
    form.append('booking_id', booking_id);
    form.append('startDate', startDate);
    form.append('endDate', endDate);
    form.append('temporyid', temporyid);
    form.append('roomType', roomType);
    form.append('amount', amount);


    // Make an AJAX request
    fetch(
        'http://localhost/TravelEase/hotel/updateBookingStatus',
        {
            method: 'POST',
            body: form
        }
    )
        .then(async function(response) {
            if (response.ok) {
                const data = await response.json();
                console.log(data);
                console.log('Booking status updated successfully');
                // Optionally, perform additional actions here if needed
            } else {
                console.error('Error updating booking status:', response.status);
            }
        })
        .catch(function(error) {
            console.error('Error updating booking status:', error);
        })
        .finally(function() {
            // Close the pop-up after the operation is completed
            cancelCancel();
            window.location.reload();
        });
}




