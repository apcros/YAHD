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

$querycmd = "UPDATE tickets SET priority = 'resolved' WHERE id=$idticket";
$db->query($querycmd);
$db->close();

?>
<META http-EQUIV="Refresh" CONTENT="0; url=index.php">