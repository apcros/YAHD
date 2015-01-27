<?php

$user = "admin";
$password = "admin"; //

if(isset($_POST['user']) && isset($_POST['pwd'])) {
	if($user == $_POST['user'] && $password == $_POST['pwd']) {
		session_start();
		$_SESSION["logged"] = 1;
		header('Location: admin.php');
	}
	else {
		echo "<div class='alert alert-danger'>Wrong password and/or user</div>";
	}
}

?>
<html>
	<header class='indicT'>
		<link rel="stylesheet" media="screen" type="text/css" href="css/bootstrap.css">
		<MEAT charset='UTF-8'>
		<h1> YAHD 0.30</h1>
		<h4> Yet Another Help Desk </h4>
		<hr>
		<h2 class="text-center">Administration Login page</h2>
		<hr>
	</header>
	<body>
		<form class="form-horizontal yahd" role="form" method="post" action="login.php">
  <div class="form-group">
    <label for="nick" class="col-sm-2 control-label">Username : </label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="user">
    </div>
  </div>
  </div>
  	  <div class="form-group">
    <label for="msg" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
     <input type="password" class="form-control" name="pwd">
    </div>
  </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-1 col-sm-10">
      <button type="submit" class="btn btn-info">Login</button>
    </div>
  </div>
</form>
<hr>
</body>
</html>