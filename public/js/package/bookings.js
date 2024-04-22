function showCancelPopup(package_id, user_id, booking_id, startDate, endDate, temporyid, meetTime) {
    console.log('showCancelPopup');
    // Create overlay div
    const overlay = document.createElement('div');
    overlay.className = 'overlay';

    const confirmDialog = document.createElement('div');
    confirmDialog.className = 'confirm-dialog';
    confirmDialog.innerHTML = `
        <div class="confirm-message">Are you sure you want to cancel this booking?</div>
        <div class="buttons">
            <button class="btn btn-yes" onclick="cancelBooking('${package_id}', '${user_id}', '${booking_id}', '${startDate}', '${endDate}', '${temporyid}', '${meetTime}')">Yes</button>
            <button class="btn btn-no" onclick="cancelCancel()">No</button>
        </div>
    `;

    document.body.appendChild(overlay);
    document.body.appendChild(confirmDialog);
}

function cancelCancel() {
    // Hide the popup
    const overlay = document.querySelector('.overlay');
    const confirmDialog = document.querySelector('.confirm-dialog');
    overlay.parentNode.removeChild(overlay);
    confirmDialog.parentNode.removeChild(confirmDialog);
}

function cancelBooking(package_id, user_id, booking_id, startDate, endDate, temporyid, meetTime) {
    console.log('cancelBooking');
    // Prepare the data to send
    const requestData = {
        package_id: package_id,
        user_id: user_id,
        booking_id: booking_id,
        startDate: startDate,
        endDate: endDate,
        temporyid: temporyid,
        meetTime: meetTime
    };

    const form = new FormData();
    form.append('package_id', package_id);
    form.append('user_id', user_id);
    form.append('booking_id', booking_id);
    form.append('startDate', startDate);
    form.append('endDate', endDate);
    form.append('temporyid', temporyid);
    form.append('meetTime', meetTime);

    // Make an AJAX request
    fetch('http://localhost/TravelEase/packages/updateBookingStatus', {
        method: 'POST',
        body: form
    })
        .then(async function(response) {
            if (response.ok) {
                const data = await response.json();
                console.log(data);
                console.log('Booking status updated successfully');
                // Optionally, perform additional actions here if needed
            } else {
                throw new Error('Error updating booking status');
            }
        })
        .catch(function(error) {
            console.error('Error updating booking status:', error.message);
        })
        .finally(function() {
            // Close the pop-up after the operation is completed
            cancelCancel();
            window.location.reload(); // Optionally reload the page
        });
}
