<?php
	
	require_once("auth.php");
	include("funcs.php");
	include("admin.funcs.php");

?>
<html>
	<header class='indicT'>
		<link rel="stylesheet" media="screen" type="text/css" href="css/bootstrap.css">
		<META charset='UTF-8'>
		<h1> YAHD 0.32 </h1>
		<h4> Yet Another Help Desk </h4>
    	
    	<?php echo returnStats(); ?>

	    <a href="admin.php?f=logout">
	    	<button class="btn btn-warning"><span class="glyphicon glyphicon-cog"></span>Logout</button>
	    </a>

	    <a href="admin.php?f=purge">
	    	<button class="btn btn-danger"><span class="glyphicon glyphicon-exclamation-sign"></span>DB Purge</button>
	    </a>

		<hr>
	</header>

	<body>
		<?php getTicketsAdmin(); ?>
	</body>	

<?php
/*
########## Calling the function 'f' via GET ######################
f can be : 

- status
- delete
- logout
- purge
- getTicketsAdmin

functions contained in admin.funcs.php
##################################################################

*/
if(isset($_GET['f']) && $_SESSION['logged'] == 1) {
	
	call_user_func($_GET['f']);
}

?>