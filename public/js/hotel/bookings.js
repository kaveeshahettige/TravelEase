function openPopup() {
    document.getElementById('popup').style.display = 'block';
}

function closePopup() {
    document.getElementById('popup').style.display = 'none';
}

function updatePopupDetails(guestName, checkInDate, roomType) {
    document.getElementById('guestName').innerText = 'Guest Name: ' + guestName;
    document.getElementById('checkInDate').innerText = 'Check-in Date: ' + checkInDate;
    document.getElementById('roomType').innerText = 'Room Type: ' + roomType;
    // Add more details as needed
}
