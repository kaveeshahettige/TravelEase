function openPopup() {
    document.getElementById('popup').style.display = 'block';
}

function closePopup() {
    document.getElementById('popup').style.display = 'none';
}

function updatePopupDetails(profilePicture, guestName, providerType, providerName, paymentStatus) {

    // Update the profile picture
    var profilePictureDiv = document.getElementById('profile-picture');
    profilePictureDiv.style.backgroundImage = "url('" + profilePicture + "')";
    profilePictureDiv.title = 'Profile Picture';

    // Update other details
    document.getElementById('guestName').innerText = 'Guest Name: ' + guestName;

    // Ensure providerType is a number
    providerType = parseInt(providerType);

    // Translate provider type number to text
    var providerTypeText;
    switch (providerType) {
        case 0:
            providerTypeText = 'Admin';
            break;
        case 1:
            providerTypeText = 'Traveler';
            break;
        case 2:
            providerTypeText = 'Business Manager';
            break;
        case 3:
            providerTypeText = 'Hotel';
            break;
        case 4:
            providerTypeText = 'Transport Provider';
            break;
        case 5:
            providerTypeText = 'Guide';
            break;
        default:
            providerTypeText = 'Unknown';
            break;
    }

    // Update provider type in the popup
    var providerTypeElement = document.getElementById('providerType');
    if (providerTypeElement) {
        providerTypeElement.innerText = 'Provider Type: ' + providerTypeText;
    } else {
        console.error('Element with ID "providerType" not found.');
    }

    // Debugging: Log providerType to the console
    console.log("Provider Type:", providerType);
    console.log("Provider Type Text:", providerTypeText);
    document.getElementById('providerName').innerText = 'Provider Name: ' + providerName;
    document.getElementById('paymentStatus').innerText = 'Payment Status: ' + paymentStatus;
}