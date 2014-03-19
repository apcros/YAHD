<?php

class dbmain extends SQLite3
{
	function __construct()
	{
		$this->open('tickets.db');
	}
}
$db = new dbmain();

$idticket = $_GET['id'];

$q = $db->prepare('UPDATE tickets SET priority = \'closed\' WHERE id=:id');
$q->bindValue(':id', $idticket);
$q->execute();
$db->close();

?>
<META http-EQUIV="Refresh" CONTENT="0; url=index.php">
