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
	$banned = array("<",">");
	$nick = $_POST['nick'];
	$msg = $_POST['msg'];
	$nick = str_replace($banned, ' ', $nick);
	$msg = str_replace($banned, ' ', $msg);
	$priority = $_POST['priority'];
	$id = ($count+1);
	$db->exec("INSERT INTO tickets (id, msg, nick, priority) VALUES ($id, '$msg', '$nick', '$priority');");
	$db->close();
?>
<META http-EQUIV="Refresh" CONTENT="0; url=index.php">