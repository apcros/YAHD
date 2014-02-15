YAHD 0.21
====

A really basic PHP help desk

The tickets are now saved in tickets.db by using SQLite3. The generation of the file can be done by visiting "setup.php" (The file can be deleted afterwards). If the generation fail, please consider activating php_display_errors for further information

You can now lock a ticket with the lockpad icon, or mark it as resolved with the check icon.

There is a ticket overview at the top of the page.

Following update : Password protection for both lock and resolved. And also a basic admin page to save/purge the database.

YES, this help desk is not really a exemple of perfect code, but at least it's simple and -half- working.

	Common problem(s) :

	- The tickets.db is not created by setup.php: You may consider using the "chmod" command on YAHD's folder

(The UI is obviously made with the twitter bootstrap)
