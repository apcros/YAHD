YAHD 0.30
====

A really basic PHP help desk

The tickets are now saved in tickets.db by using SQLite3. The generation of the file can be done by visiting "setup.php" (The file can be deleted afterwards). If the generation fail, please consider activating php_display_errors for further information

You can now lock a ticket with the lockpad icon, or mark it as resolved with the check icon.

There is a ticket overview at the top of the page.

Administration page for deleting, closing or resolving tickets. (The login is not very secure, will optimize later...I pinky swear)
(Will add a ban ip option later)


YES, this help desk is not really a exemple of perfect code, but at least it's simple and -half- working.

*You should Read the following text :  

	- If the tickets.db is not created by setup.php 
	You may consider using the "chmod" command on YAHD's folder
	- You need to set a password and a user in the login.php file. (The password need to be wrote in md5)

(The UI is obviously made with the twitter bootstrap)
