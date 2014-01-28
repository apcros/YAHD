<?php
	$banned = array("<",">");
	$nick = $_POST['nick'];
	$msg = $_POST['msg'];
	$nick = str_replace($banned, ' ', $nick);
	$msg = str_replace($banned, ' ', $msg);
	$priority = $_POST['priority'];
	$back = "\n";
	$add = "<div class='alert $priority'>$back"."<b>$nick</b>"." : "."$msg</br></div>";
	$fp = fopen('tickets.data','r+');
	rewind($fp); 
	$lu = file_get_contents('tickets.data');
	$new = $add.$lu;
	rewind($fp);
	fputs($fp,$new);
	fclose($fp);
?>
<META http-EQUIV="Refresh" CONTENT="0; url=index.php">