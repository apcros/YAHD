<?php
session_start();
if(empty($_SESSION["logged"]) || $_SESSION["logged"] != 1) {
	header('Location: login.php');
}
?>