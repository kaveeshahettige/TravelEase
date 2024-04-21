function PaymentPopup(serviceProvider_id,total_amount) {
    console.log(serviceProvider_id, total_amount);
    const overlay = document.createElement('div');
    overlay.className = 'overlay';

    const confirmDialog = document.createElement('div');
    confirmDialog.className = 'confirm-dialog';
    confirmDialog.innerHTML = `
        <div class="confirm-message">Are you sure you want to make this payment?</div>
        <div class="buttons">
            <button class="btn btn-yes" onclick="makePayment('${serviceProvider_id}', '${total_amount}')">Yes</button>
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

function makePayment(serviceProvider_id,total_amount) {
    console.log(serviceProvider_id);
    // Prepare the data to send
    var requestData = {
        serviceProvider_id: serviceProvider_id,
        total_amount: total_amount,
    };

    const form = new FormData();
    form.append('serviceProvider_id', serviceProvider_id);
    form.append('total_amount', total_amount);

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
