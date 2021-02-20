This bookmarklet for Chrome monitors the current Gihub page for the strings "All checks have passed",
"Some checks were not successful", and "All checks have failed" and shows a Chrome notification.

It is useful for letting you know when your PR build is done.

To use:

1. Create a new bookmark in your browser.
2. For the Name you might use PR Monitor. Put it in the Bookmarks Bar folder.
3. For the URL, enter the contents of [this code](https://raw.githubusercontent.com/JonathanAquino/misc-scripts/master/pr-monitor/pr-monitor.bookmarklet.js).
4. When you are waiting for PR checks to finish, click the bookmarklet. Do not navigate away from the page. When the PR checks are done, you should see a Chrome notification.

After the notification is shown, monitoring will stop.
So you'll need to click the bookmarkel again to start monitoring
again after the notification is shown.

Formatted [source code](https://github.com/JonathanAquino/misc-scripts/blob/master/pr-monitor/pr-monitor.js).
