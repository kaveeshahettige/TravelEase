function showCancelPopup(vehicle_id, user_id, booking_id, startDate, endDate, temporyid, plate_number,payment_amount) {
    // Create overlay div
    const overlay = document.createElement('div');
    overlay.className = 'overlay';

    const confirmDialog = document.createElement('div');
    confirmDialog.className = 'confirm-dialog';
    confirmDialog.innerHTML = `
        <div class="confirm-message">Are you sure you want to cancel this booking?</div>
        <div class="buttons">
            <button class="btn btn-yes" onclick="cancelBooking('${vehicle_id}', '${user_id}', '${booking_id}', '${startDate}', '${endDate}', '${temporyid}', '${ plate_number}',${payment_amount} )">Yes</button>
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

function cancelBooking(vehicle_id, user_id, booking_id, startDate, endDate,temporyid, plate_number,payment_amount) {
    console.log(endDate);
    // Prepare the data to send
    var requestData = {
        vehicle_id: vehicle_id,
        user_id: user_id,
        booking_id: booking_id,
        startDate: startDate,
        endDate: endDate,
        temporyid: temporyid,
        plate_number: plate_number,
        payment_amount: payment_amount
    };

    const form = new FormData();
    form.append('vehicle_id', vehicle_id);
    form.append('user_id', user_id);
    form.append('booking_id', booking_id);
    form.append('startDate', startDate);
    form.append('endDate', endDate);
    form.append('temporyid', temporyid);
    form.append('plate_number', plate_number);
    form.append('payment_amount', payment_amount);


    // Make an AJAX request
    fetch(
        'http://localhost/TravelEase/driver/updateBookingStatus',
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