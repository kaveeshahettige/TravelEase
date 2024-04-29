function openPopup() {
    document.getElementById('popup').style.display = 'block';
}

function closePopup() {
    document.getElementById('popup').style.display = 'none';
}

function updatePopupDetails(traveler_name,service_type, serviceprovider_name,startDate,endDate,service_detail, payment_amount) {
    console.log(traveler_name,service_type, serviceprovider_name,startDate,endDate,service_detail, payment_amount);

    // Update other details
    document.getElementById('traveler_name').innerText = 'Traveler Name: ' + traveler_name;
    document.getElementById('service_type').innerText = 'Service Type: ' + service_type;
    document.getElementById('serviceprovider_name').innerText = 'Service Provider: ' + serviceprovider_name;
    document.getElementById('startDate').innerText = 'Start Date: ' + startDate;
    document.getElementById('endDate').innerText = 'End Date: ' + endDate;
    document.getElementById('service_detail').innerText = 'Service Detail: ' + service_detail;
    document.getElementById('payment_amount').innerText = 'Payment Amount: ' + payment_amount;

}
