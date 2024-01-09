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

    cell.addEventListener("click", function () {
        handleDayClick(date);
    });

    return cell;
}

function handleDayClick(date) {
    const selectedDateElement = document.getElementById("selected-date");
    const availabilityInfoElement = document.getElementById("availability-info");

    selectedDateElement.innerText = getFormattedDateString(date);
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
