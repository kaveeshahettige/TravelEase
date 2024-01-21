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

