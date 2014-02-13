YAHD
====

A really basic PHP help desk

The tickets are now saved in tickets.db by using SQLite3. The generation of the file can be done by visiting "setup.php" (The file can be deleted afterwards). If the generation fail, please consider activating php_display_errors for further information


YES, this help desk is not really a exemple of perfect code, but at least it's simple and -half- working.

You can either lock or mark as resolved a ticket.

	Common problem(s) :

		- The tickets.db is not created by setup.php: You may consider using the "chmod" command on YAHD's folder

(The UI is obviously made with the twitter bootstrap)
