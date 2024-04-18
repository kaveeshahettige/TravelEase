function markAsRead(notification_id) {
    var form = new FormData();
    form.append('notification_id', notification_id);

    fetch('http://localhost/TravelEase/hotel/markNotificationAsRead', {
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
