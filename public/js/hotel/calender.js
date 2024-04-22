document.addEventListener("DOMContentLoaded", function () {
    renderCalendar();
});

let currentDate = new Date();

function renderCalendar() {
    const monthYearElement = document.getElementById("current-month-year");
    const daysElement = document.getElementById("calendar-days");

    monthYearElement.innerText = getMonthYearString(currentDate);

    // Clear previous days
    daysElement.innerHTML = "";

    // Add day names
    const dayNames = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
    dayNames.forEach(dayName => {
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
        daysElement.appendChild(cell);
    }
}

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

    // Check if the date is today
    const today = new Date();
    if (isSameDate(date, today)) {
        cell.classList.add("today"); // Add the "today" class
    }

    // Check if the date is in the past
    if (date < today && !isSameDate(date, today)) {
        // If the date is in the past (excluding today), disable the click event handler
        cell.classList.add("disabled");
    } else {
        // If the date is today or in the future, attach the click event handler
        cell.addEventListener("click", function () {
            handleDayClick(date);
        });
    }

    return cell;
}

function isSameDate(date1, date2) {
    return (
        date1.getFullYear() === date2.getFullYear() &&
        date1.getMonth() === date2.getMonth() &&
        date1.getDate() === date2.getDate()
    );
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


function updateRoomPopup(room_id, startDate) {
    // Create overlay div
    const overlay = document.createElement('div');
    overlay.className = 'overlay';

    const confirmDialog = document.createElement('div');
    confirmDialog.className = 'confirm-dialog';
    confirmDialog.innerHTML = `
        <div class="confirm-message">Are you sure you want to unavailable this date?</div>
        <div class="buttons">
            <button class="btn btn-yes" onclick="updateRoomStatus('${room_id}','${startDate}')">Yes</button>
            <button class="btn btn-no" onclick="cancelCancel()">No</button>
        </div>
    `;

    document.body.appendChild(overlay);
    document.body.appendChild(confirmDialog);
}

function cancelCancel() {
    // Hide the popup
    document.body.removeChild(document.querySelector('.overlay'));
    document.body.removeChild(document.querySelector('.confirm-dialog'));
}

function updateRoomStatus(room_id, startDate) {
    // Prepare the data to send
    console.log(room_id, startDate);
    var requestData = {
        room_id: room_id,
        startDate: startDate // Adjust variable name to match PHP controller
    };
    const form = new FormData();
    form.append('room_id', room_id);
    form.append('startDate', startDate); // Adjust variable name to match PHP controller

    // Make an AJAX request
    fetch(
        'http://localhost/TravelEase/hotel/updateRoomStatus',
        {
            method: 'POST',
            body: form
        }
    )
        .then(async function(response) {
            if (response.ok) {
                const data = await response.json();
                console.log(data);
                console.log('Room status updated successfully');
                window.location.reload();
            } else {
                console.error('Error updating room status:', response);
            }
        })
        .catch(function(error) {
                console.error('Error updating room status:', error);
            }
        )
}

function deleteRoomPopup(room_id, startDate) {
    // Create overlay div
    const overlay = document.createElement('div');
    overlay.className = 'overlay';

    const confirmDialog = document.createElement('div');
    confirmDialog.className = 'confirm-dialog';
    confirmDialog.innerHTML = `
        <div class="confirm-message">Are you sure you want to make available this date again?</div>
        <div class="buttons">
            <button class="btn btn-yes" onclick="deleteRoomStatus('${room_id}','${startDate}')">Yes</button>
            <button class="btn btn-no" onclick="cancelCancel()">No</button>
        </div>
    `;

    document.body.appendChild(overlay);
    document.body.appendChild(confirmDialog);
}

function deleteRoomStatus(room_id, startDate) {
    // Prepare the data to send
    var requestData = {
        room_id: room_id,
        startDate: startDate // Adjust variable name to match PHP controller
    };
    const form = new FormData();
    form.append('room_id', room_id);
    form.append('startDate', startDate); // Adjust variable name to match PHP controller

    console.log(room_id, startDate);
    // Make an AJAX request
    fetch(
        'http://localhost/TravelEase/hotel/deleteRoomStatus',
        {
            method: 'POST',
            body: form
        }
    )
        .then(async function(response) {
            if (response.ok) {
                const data = await response.json();
                console.log('Room Status deleted successfully');
                window.location.reload();
            } else {
                console.error('Error deleting room: ', response);
            }
        })
        .catch(function(error) {
                console.error('Error deleting room:', error);
            }
        )
}


