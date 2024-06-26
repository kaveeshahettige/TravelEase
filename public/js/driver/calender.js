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

function setUnavailableDate(vehicle_id, date) {

    console.log('Vehicle ID:', vehicle_id);
    console.log('Date:', date);
    const form = new FormData();
    form.append('vehicle_id', vehicle_id);
    form.append('date', date);

    fetch('http://localhost/travelEase/driver/setUnavailableDate', {
        method: 'POST',
        body: form
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        console.log(data);
        if (data.success) {
            console.log('Vehicle status updated successfully');
            window.location.reload(); // Reload the page to reflect changes (optional)
        } else {
            console.error('Failed to update vehicle status:', data.message);
            alert('Failed to update vehicle status. Please try again.');
        }
    })
    .catch(error => {
        console.error('Error updating vehicle status:', error);
        alert('Error updating vehicle status. Please check console for details.');
    });
}

function removeUnavailableDate(vehicle_id, date) {
    console.log('Vehicle ID:', vehicle_id);
    console.log('Date:', date);
    const form = new FormData();
    form.append('vehicle_id', vehicle_id);
    form.append('date', date);

    fetch('http://localhost/travelEase/driver/removeUnavailableDate', {
        method: 'POST',
        body: form
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        console.log(data);
        if (data.success) {
            console.log('Vehicle status updated successfully');
            window.location.reload(); // Reload the page to reflect changes (optional)
        } else {
            console.error('Failed to update vehicle status:', data.message);
            alert('Failed to update vehicle status. Please try again.');
        }
    })
    .catch(error => {
        console.error('Error updating vehicle status:', error);
        alert('Error updating vehicle status. Please check console for details.');
    });
}
