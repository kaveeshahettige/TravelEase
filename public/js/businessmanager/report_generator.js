document.getElementById("generate-report-btn").addEventListener("click", function() {
    var serviceType = document.getElementById("service-type").value;
    var reportType = document.getElementById("report-type").value;
    var startDate = document.getElementById("start-date").value;
    var endDate = document.getElementById("end-date").value;

    // Make sure both start and end dates are provided
    if (!startDate || !endDate) {
        alert("Please select both start and end dates.");
        return;
    }

    // Make AJAX request to the controller to generate the report
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/businessmanager/generateReport", true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                // Redirect to the report page
                window.location.href = response.redirect;
            } else {
                alert(response.message);
            }
        }
    };
    xhr.send(JSON.stringify({
        serviceType: serviceType,
        reportType: reportType,
        startDate: startDate,
        endDate: endDate
    }));

});

