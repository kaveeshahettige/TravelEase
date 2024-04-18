function confirmDelete(room_id) {
    // Create overlay div
    const overlay = document.createElement('div');
    overlay.className = 'overlay';

    const confirmDialog = document.createElement('div');
    confirmDialog.className = 'confirm-dialog';
    confirmDialog.innerHTML = `
        <div class="confirm-message">Are you sure you want to delete this room?</div>
        <div class="buttons">
            <button class="btn btn-yes" onclick="deleteRoom('${room_id}')">Yes</button>
            <button class="btn btn-no" onclick="cancelDelete()">No</button>
        </div>
    `;

    document.body.appendChild(overlay);
    document.body.appendChild(confirmDialog);
}

function deleteRoom(room_id) {
    // Prepare the data to send
    var requestData = {
        room_id: room_id,
    };

    const form = new FormData();
    form.append('room_id', room_id);

    // Make an AJAX request to delete the room
    fetch(
        `http://localhost/TravelEase/hotel/deleterooms/`,
        {
            method: 'POST',
            body: form
        }
    )
        .then(async function(response) {
            if (response.ok) {
                const data = await response.json();
                console.log('Room deleted successfully');
                window.location.reload();
            } else {
                console.error('Error deleting room: ', response);
            }
        })
        .catch(function(error) {
            console.error('Error deleting room:', error);
        })
        .finally(function() {
            // Close the pop-up after the operation is completed
            cancelDelete();
            window.location.reload();
        });
}

function cancelDelete() {
    document.body.removeChild(document.querySelector('.overlay'));
    document.body.removeChild(document.querySelector('.confirm-dialog'));
}



function confirmLogout(event) {
    event.preventDefault();

    const overlay = document.createElement('div');
    overlay.className = 'overlay';

    const confirmDialog = document.createElement('div');
    confirmDialog.className = 'confirm-dialog';
    confirmDialog.innerHTML = `
        <div class="confirm-message">Are you sure you want to logout?</div>
        <div class="buttons">
            <button class="btn btn-yes" onclick="logout()">Yes</button>
            <button class="btn btn-no" onclick="cancelLogout()">No</button>
        </div>
    `;

    document.body.appendChild(overlay);
    document.body.appendChild(confirmDialog);
}

function logout() {
    // Make an AJAX request or perform any necessary actions for logout
    window.location.href = "http://localhost/TravelEase/users/logout/";
}

function cancelLogout() {

    document.body.removeChild(document.querySelector('.overlay'));
    document.body.removeChild(document.querySelector('.confirm-dialog'));
}

