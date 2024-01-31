document.addEventListener('DOMContentLoaded', function () {
    // Fetch notifications from the server
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?php echo URLROOT; ?>/notifications.php', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var notifications = JSON.parse(xhr.responseText);
                notifications.forEach(function (notification) {
                    displayNotification(notification);
                });
            } else {
                console.error('Error fetching notifications:', xhr.statusText);
            }
        }
    };
    xhr.send();

    // Function to display a notification
    function displayNotification(notification) {
        var notificationItem = `
            <div class="notification-item">
                <img src="${notification.senderImage}" alt="Sender Image" class="sender-image">
                <div class="notification-text-container">
                    <span class="sender-name">${notification.senderName}</span>
                    <span class="notification-date">${notification.date}</span>
                    <p class="notification-text">${notification.text}</p>
                    <button class="mark-as-read-btn">Mark as Read</button>
                </div>
                <div class="read-status-dot ${notification.isRead ? 'read' : 'unread'}"></div>
            </div>
        `;

        document.querySelector(".notifications-content").insertAdjacentHTML('beforeend', notificationItem);
    }
});
