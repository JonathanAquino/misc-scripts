// This bookmarklet for Chrome monitors the current Gihub page for the strings "All checks have passed",
// "Some checks were not successful", and "All checks have failed" and shows a Chrome notification.
// https://github.com/JonathanAquino/misc-scripts/tree/master/pr-monitor
if (Notification.permission !== 'granted') {
    Notification.requestPermission();
}
var notify = function (title, message, requireInteraction) {
    var notification = new Notification(title, {
        body: message,
        requireInteraction: requireInteraction
    });
    notification.onclick = function() {
        window.open(window.location.href);
    };
};
var handle = setInterval(function () {
    var elements = document.getElementsByClassName('status-heading');
    for (var i = 0; i < elements.length; i++) {
        if (elements[i].innerText.indexOf('All checks have passed') > -1) {
            notify('Passed', 'All checks have passed', true);
            clearInterval(handle);
            return;
        }
        if (elements[i].innerText.indexOf('Some checks were not successful') > -1) {
            notify('Failed', 'Some checks were not successful', true);
            clearInterval(handle);
            return;
        }
        if (elements[i].innerText.indexOf('All checks have failed') > -1) {
            notify('Failed', 'All checks have failed', true);
            clearInterval(handle);
            return;
        }
    }
}, 1000);
notify('Set up', 'You will be notified when the PR checks finish.', false);
