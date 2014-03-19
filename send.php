<?php

class dbmain extends SQLite3
{
	function __construct()
	{
		$this->open('tickets.db');
	}
}
$db = new dbmain();
$count = $db->querySingle('SELECT COUNT(*) as count FROM tickets;');
$q = $db->prepare('INSERT INTO tickets (msg, nick, priority) VALUES (:msg, :nick, :pri)');
$q->bindValue(':msg', $_POST['msg']);
$q->bindValue(':nick', $_POST['nick']);
$q->bindValue(':pri', $_POST['priority']);
$q->execute();
$db->close();
$id = ($count+1);
?>
<META http-EQUIV="Refresh" CONTENT="0; url=index.php">
