    // Get modal elements
    var modal = document.getElementById('myModal');
    var span = document.getElementsByClassName('close')[0];

    // Function to open the modal
    function openModal(title, date, review) {
    document.getElementById('modal-title').innerHTML = title;
    document.getElementById('modal-date').innerHTML = 'Date: ' + date;
    document.getElementById('modal-review').innerHTML = review;
    modal.style.display = 'block';
}

    // Close the modal when clicking on the close button (x)
    span.onclick = function () {
    modal.style.display = 'none';
};

    // Close the modal when clicking outside of it
    window.onclick = function (event) {
    if (event.target == modal) {
    modal.style.display = 'none';
}
};

