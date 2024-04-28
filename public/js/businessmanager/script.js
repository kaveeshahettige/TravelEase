function PaymentPopup(serviceProvider_id,totalAmount) {
    console.log(serviceProvider_id, totalAmount);
    const overlay = document.createElement('div');
    overlay.className = 'overlay';

    const confirmDialog = document.createElement('div');
    confirmDialog.className = 'confirm-dialog';
    confirmDialog.innerHTML = `
        <div class="confirm-message">Are you sure you want to make this payment?</div>
        <div class="buttons">
            <button class="btn btn-yes" onclick="makePayment('${serviceProvider_id}', '${totalAmount}')">Yes</button>
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

function makePayment(serviceProvider_id,totalAmount) {
    console.log(serviceProvider_id);
    // Prepare the data to send
    var requestData = {
        serviceProvider_id: serviceProvider_id,
        totalAmount: totalAmount,
    };

    const form = new FormData();
    form.append('serviceProvider_id', serviceProvider_id);
    form.append('totalAmount', totalAmount);

    // Make an AJAX request
    fetch(
        'http://localhost/TravelEase/businessmanager/makePayment',
        {
            method: 'POST',
            body: form
        }
    )
        .then(async function(response)  {

            if (response.ok) {
                // console.log(await response.json());
                const data = await response.json();
                // console.log(data);
                // console.log('Payment Done successfully');
                window.location.href= data.url;
                // Optionally, perform additional actions here if needed
            } else {
                console.error('Error in doing Payment:', response.status);
            }
        })
        .catch(function(error) {
            console.error('Error in doing Payment:', error);
        });
        // .finally(function() {
        //     // Close the pop-up after the operation is completed
        //     cancelCancel();
        //     // window.location.reload();
        // });
}

function InvoicePopup(serviceProvider_id,totalAmount) {
    console.log(serviceProvider_id, totalAmount);
    const overlay = document.createElement('div');
    overlay.className = 'overlay';

    const confirmDialog = document.createElement('div');
    confirmDialog.className = 'confirm-dialog';
    confirmDialog.innerHTML = `
        <div class="confirm-message">Are you sure you want to make the Invoice?</div>
        <div class="buttons">
            <button class="btn btn-yes" onclick="makeInvoice('${serviceProvider_id}', '${totalAmount}')">Yes</button>
            <button class="btn btn-no" onclick="cancelCancel()">No</button>
        </div>
    `;

    document.body.appendChild(overlay);
    document.body.appendChild(confirmDialog);

}

function makeInvoice(serviceProvider_id, totalAmount) {
    console.log(serviceProvider_id);
    // Prepare the data to send
    var requestData = {
        serviceProvider_id: serviceProvider_id,
        total_amount: totalAmount,
    };

    const form = new FormData();
    form.append('serviceProvider_id', serviceProvider_id);
    form.append('totalAmount', totalAmount);

    // Make an AJAX request
    fetch(
        'http://localhost/TravelEase/businessmanager/makeInvoice',
        {
            method: 'POST',
            body: form
        }
    )
        .then(async function(response) {
            if (response.ok) {
                // Handle successful response
                const data = await response.blob(); // Get the PDF blob
                const url = window.URL.createObjectURL(data); // Create a URL for the blob
                window.open(url); // Open the PDF in a new tab
            } else {
                console.error('Error in generating invoice:', response.status);
            }
        })
        .catch(function(error) {
            console.error('Error in generating invoice:', error);
        })

        .finally(function() {
            // Close the pop-up after the operation is completed
            cancelCancel();
        });
}

function markAsRead(notification_id) {
    var form = new FormData();
    form.append('notification_id', notification_id);

    fetch('http://localhost/TravelEase/businessmanager/markNotificationAsRead', {
        method: 'POST',
        body: form
    })
        .then(async function(response) {
            if (response.ok) {
                const data = await response.json();
                console.log(data);
                console.log('Notification marked as read successfully');
                window.location.reload();
            } else {
                console.error('Error marking notification as read:', response.status);
            }
        })
        .catch(function(error) {
            console.error('Error marking notification as read:', error);
        });
}


function showConfirmPopup(booking_id,refund_id) {
    // Create overlay div
    const overlay = document.createElement('div');
    overlay.className = 'overlay';

    const confirmDialog = document.createElement('div');
    confirmDialog.className = 'confirm-dialog';
    confirmDialog.innerHTML = `
        <div class="confirm-message">Did you complete the Refund?</div>
        <div class="buttons">
            <button class="btn btn-yes" onclick="confirmRefund('${booking_id}','${refund_id}' )">Yes</button>
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

function confirmRefund(booking_id,refund_id) {
    console.log(booking_id);
    // Prepare the data to send
    var requestData = {
        booking_id: booking_id,
        refund_id: refund_id,
    };

    const form = new FormData();
    form.append('booking_id', booking_id);
    form.append('refund_id', refund_id);


    // Make an AJAX request
    fetch(
        'http://localhost/TravelEase/businessmanager/confirmRefund',
        {
            method: 'POST',
            body: form
        }
    )
        .then(async function (response) {
            if (response.ok) {
                const data = await response.json();
                console.log(data);
                console.log('Refund is successfully completed');
                // Optionally, perform additional actions here if needed
            } else {
                console.error('Error updating refund status:', response.status);
            }
        })
        .catch(function (error) {
            console.error('Error updating refund status:', error);
        })
        .finally(function () {
            // Close the pop-up after the operation is completed
            cancelCancel();
            window.location.reload();
        });

}

    document.getElementById("generate-report-btn").addEventListener("click", function() {
        // Gather form data
        var reportType = document.getElementById("report-type").value;
        var startDate = document.getElementById("start-date").value;
        var endDate = document.getElementById("end-date").value;

        // Call the reportPop function with the form data
        reportPop(reportType, startDate, endDate);
    });

    function reportPop(reportType, startDate, endDate) {
        // Create overlay div
        const overlay = document.createElement('div');
        overlay.className = 'overlay';

        const confirmDialog = document.createElement('div');
        confirmDialog.className = 'confirm-dialog';
        confirmDialog.innerHTML = `
        <div class="confirm-message">Are you sure you want to generate the report?</div>
        <div class="buttons">
            <button class="btn btn-yes" onclick="generateReport('${reportType}', '${startDate}', '${endDate}')">Yes</button>
            <button class="btn btn-no" onclick="cancelReport()">No</button>
        </div>
    `;

        document.body.appendChild(overlay);
        document.body.appendChild(confirmDialog);
    }

    function generateReport(reportType, startDate, endDate) {
        // Prepare the data to send
        var requestData = {
            reportType: reportType,
            startDate: startDate,
            endDate: endDate,
        };

        const form = new FormData();
        form.append('reportType', reportType);
        form.append('startDate', startDate);
        form.append('endDate', endDate);

        // Make an AJAX request
        fetch(
            'http://localhost/TravelEase/businessmanager/generateReport',
            {
                method: 'POST',
                body: form
            }
        )
            .then(async function(response) {
                if (response.ok) {
                    const data = await response.blob(); // Get the PDF blob
                    const url = window.URL.createObjectURL(data); // Create a URL for the blob
                    window.open(url); // Open the PDF in a new tab
                } else {
                    console.error('Error generating report:', response.status);
                }
            })
            .catch(function(error) {
                console.error('Error generating report:', error);
            })
            .finally(function() {
                // Close the pop-up after the operation is completed
                cancelReport();
            });
    }

    function cancelReport() {

        document.body.removeChild(document.querySelector('.overlay'));
        document.body.removeChild(document.querySelector('.confirm-dialog'));
    }



