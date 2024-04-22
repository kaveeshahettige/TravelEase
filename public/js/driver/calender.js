document.addEventListener("DOMContentLoaded", function () {
    const monthYearElement = document.getElementById("current-month-year");
    const daysElement = document.getElementById("calendar-days");

    let currentDate = new Date();

    monthYearElement.innerText = getMonthYearString(currentDate);

    // Clear previous days
    daysElement.innerHTML = "";

    // Add day names
    const dayNames = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
    dayNames.forEach((dayName) => {
        const dayNameCell = document.createElement("div");
        dayNameCell.classList.add("day", "day-name");
        dayNameCell.innerText = dayName;
        daysElement.appendChild(dayNameCell);
    });

    // Get the first day of the month
    const firstDayOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
    const daysInMonth = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0).getDate();

    // Add empty cells for days before the first day of the month
    for (let i = 0; i < firstDayOfMonth.getDay(); i++) {
        const emptyCell = createEmptyCell();
        daysElement.appendChild(emptyCell);
    }

    // Add cells for each day in the month
    for (let day = 1; day <= daysInMonth; day++) {
        const date = new Date(currentDate.getFullYear(), currentDate.getMonth(), day);
        const cell = createDayCell(date);

        // Highlight the current date
        if (date.toDateString() === new Date().toDateString()) {
            cell.classList.add("current-date");
        }

        // Check if the date is in the past
        if (date < new Date()) {
            cell.classList.add("disabled"); // Add a CSS class to visually disable past dates
            cell.removeEventListener("click", handleDayClick); // Remove click event listener for past dates
        }

        daysElement.appendChild(cell);
    }
});



let currentDate = new Date();


function createEmptyCell() {
    const cell = document.createElement("div");
    cell.classList.add("day", "empty-cell");
    return cell;
}

function createDayCell(date) {
    const cell = document.createElement("div");
    cell.classList.add("day");

    const dayNumber = document.createElement("span");
    dayNumber.classList.add("day-number");
    dayNumber.innerText = date.getDate();
    cell.appendChild(dayNumber);

    // Check if the date is the current date
    const today = new Date();
    if (date.toDateString() === today.toDateString()) {
        cell.classList.add("current-date"); // Add the current date styling
    }

    cell.addEventListener("click", function () {
        handleDayClick(date);
    });

    return cell;
}


function getFormattedDateStringForSQL(date) {
    const year = date.getFullYear();
    const month = (date.getMonth() + 1).toString().padStart(2, '0'); // Months are zero-based
    const day = date.getDate().toString().padStart(2, '0');

    return `${year}-${month}-${day}`;
}


function handleDayClick(date) {
    const selectedDateElement = document.getElementById("selected-date");
    const selectedDateInput = document.getElementById("selectedDate");
    const availabilityInfoElement = document.getElementById("availability-info");

    const formattedDateForSQL = getFormattedDateStringForSQL(date);

    selectedDateElement.innerText = getFormattedDateString(date);
    selectedDateInput.value = formattedDateForSQL;
    // Add logic here to fetch and display availability information for the selected date
    availabilityInfoElement.innerText = "Availability: Available";
}


function getFormattedDateString(date) {
    const options = { weekday: "short", day: "numeric" };
    return date.toLocaleDateString("en-US", options);
}

function getMonthYearString(date) {
    const options = { year: "numeric", month: "long" };
    return date.toLocaleDateString("en-US", options);
}

function prevMonth() {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar();
}

function nextMonth() {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar();
}

function navigateMonth(direction) {
    currentDate.setMonth(currentDate.getMonth() + direction);
    renderCalendar();
}

function handleButtonClick(action) {
    const availabilityInfoElement = document.getElementById("availability-info");
    const selectedDateElement = document.getElementById("selected-date");

    if (!selectedDateElement.innerText) {
        alert("Please select a date.");
        return;
    }

    const message = `${action} event on ${selectedDateElement.innerText}.`;
    availabilityInfoElement.innerText = message;
}

function handleDateSelection() {
    var selectedDate = document.getElementById('selectedDate').value;
    var checkAvailabilityBtn = document.getElementById('checkAvailabilityBtn');

    if (selectedDate) {
        checkAvailabilityBtn.disabled = false;
    } else {
        checkAvailabilityBtn.disabled = true;
    }
}

// Function to validate the form before submission
function validateForm() {
    var selectedDate = document.getElementById('selectedDate').value;

    if (!selectedDate) {
        alert("Please select a date.");
        return false;
    }

    return true;
}

// Attach the function to the change event of the date input (assuming you have a date input)
// Adjust this according to how your date is selected (e.g., through a date picker)
document.getElementById('selectedDate').addEventListener('change', handleDateSelection);

// Initial call to set the initial button state
handleDateSelection();

function makeAvailable(roomId) {
    updateRoomStatus('make_available', roomId);
}

function makeUnavailable(roomId) {
    updateRoomStatus('make_unavailable', roomId);
}

function deleteRoom(roomId) {
    updateRoomStatus('delete_room', roomId);
}


function handleFormSubmit() {
    // var selectedDate = document.getElementById('selectedDate').value;
    // if (!selectedDate) {
    //     alert('Please select a date.');
    //     return false; // Prevent form submission
    // }
}

 // Function to set the selected date as unavailable
 

// Function to remove the selected date from unavailability
function removeUnavailableDate(vehicle_id, date) {

    console.log('Vehicle ID:', vehicleId);
    console.log('Date:', date);
    fetch(
        'http://localhost/TravelEase/driver/removeUnavailableDate',
        {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                vehicle_id: vehicleId,
                date: date,
            }),
        }
    )
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        console.log(data);
        // Handle success or display a message to the user
        window.location.reload(); // Reload the page to reflect changes
    })
    .catch(error => {
        console.error('Error removing unavailable date:', error);
        alert('Error removing unavailable date. Please check console for details.'); // Display a generic error message
    });
}

    
function setUnavailableDate(vehicle_id, date) {
    // Prepare the data to send
    const requestData = {
        vehicle_id: vehicle_id,
        date: date // Adjust variable name to match PHP controller
    };

    // Create a new FormData object and append data to it
    const formData = new FormData();
    formData.append('vehicle_id', vehicle_id);
    formData.append('date', date); // Adjust variable name to match PHP controller

    // Make an AJAX request using fetch
    fetch('http://localhost/TravelEase/Driver/setUnavailableDate', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (response.ok) {
            return response.json();
        } else {
            throw new Error('Error updating room status:', response);
        }
    })
    .then(data => {
        console.log(data);
        console.log('Room status updated successfully');
        window.location.reload(); // Reload the page after successful update
    })
    .catch(error => {
        console.error('Error updating room status:', error);
    });
}


function removeUnavailableDate(vehicle_id, date) {
    // Prepare the data to send
    const requestData = {
        vehicle_id: vehicle_id,
        date: date // Adjust variable name to match PHP controller
    };

    // Create a new FormData object and append data to it
    const formData = new FormData();
    formData.append('vehicle_id', vehicle_id);
    formData.append('date', date); // Adjust variable name to match PHP controller

    // Make an AJAX request using fetch
    fetch('http://localhost/TravelEase/Driver/removeUnavailableDate', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (response.ok) {
            console.log('Unavailability removed successfully');
            window.location.reload(); // Reload the page after successful removal
        } else {
            throw new Error('Error removing unavailability: ', response);
        }
    })
    .catch(error => {
        console.error('Error removing unavailability:', error);
    });
}
