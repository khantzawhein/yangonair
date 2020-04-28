var url;
self.addEventListener('push', function (e) {
    if (!(self.Notification && self.Notification.permission === 'granted')) {
        //notifications aren't supported or permission not granted!
        return;
    }

    if (e.data) {
        var msg = e.data.json();
        url = msg.data.url;
        // console.log(msg)
        e.waitUntil(self.registration.showNotification(msg.title, {
            body: msg.body,
            icon: msg.icon,
            actions: msg.actions,
            badge: msg.badge
        }));
    }
});
self.addEventListener('notificationclick', function(e) {
    e.waitUntil(self.clients.openWindow(url))
});