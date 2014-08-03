<?php
require_once('auth.php');
include "funcs.php";
?>
<html>
	<header class='indicT'>
		<link rel="stylesheet" media="screen" type="text/css" href="css/bootstrap.css">
		<META charset='UTF-8'>
		<h1> YAHD 0.30 </h1>
		<h4> Yet Another Help Desk </h4>
    <?php echo returnStats(); ?>
    <a href="admin.php?f=logout"><button class="btn btn-warning"><span class="glyphicon glyphicon-cog"></span> Logout</button></a><a href="admin.php?f=purge"><button class="btn btn-danger"><span class="glyphicon glyphicon-exclamation-sign"></span>DB Purge</button></a>
		<hr>
	</header>
	<body>
		<?php 
    getTicketsAdmin();
		?>
	</body>	
<?php
if(isset($_GET['f']) && $_SESSION['logged'] == 1) {
	
	call_user_func($_GET['f']);
}
function status() {
if($_SESSION['logged'] == 1 && isset($_GET['op']) && isset($_GET['id'])) {
	$db = new dbmain();
	$status = $_GET['op'];
	$idticket = $_GET['id'];

	$q = $db->prepare('UPDATE tickets SET status = :status WHERE id=:id');
	$q->bindValue(':id', $idticket);
	$q->bindValue(':status', $status);
	$q->execute();
	$db->close();
	header("Location: admin.php");
	header("Refresh: 0");
	}

}

function delete() {
	if($_SESSION['logged'] == 1 && isset($_GET['id'])) {
		$db = new dbmain();
		$q = $db->prepare('DELETE FROM tickets WHERE id=:id');
		$q->bindValue(':id',$_GET['id']);
		$q->execute();
		$db->close();

		header("Location: admin.php");
		header("Refresh: 0");
	}
}

function logout() {
	$_SESSION['logged'] = 0;
	header('Location: index.php');
	header("Refresh: 0");
}
function purge() {
	$db = new dbmain();
	$db->exec("DROP TABLE tickets;");
	$db->exec("CREATE TABLE tickets (id INTEGER PRIMARY KEY, msg VARCHAR(500), nick VARCHAR(45), priority VARCHAR(10), status VARCHAR(10));");
	$db->close();
	header("Location: admin.php");
	header("Refresh: 0");
}
function getTicketsAdmin() {

              $db = new dbmain();

              $query = "SELECT DISTINCT * FROM tickets;";
              $result = $db->query($query);

             while($res = $result->fetchArray(SQLITE3_ASSOC)) {
              
              if (!isset($res['id'])) continue;
              
              $id = htmlspecialchars($res['id']);
              $msg = htmlspecialchars($res['msg']);
              $priority = htmlspecialchars($res['priority']);
              $nick = htmlspecialchars($res['nick']);
               $status = htmlspecialchars($res['status']);


              $alertColor = getAlertColor($priority, $status);
              echo "<div class='alert $alertColor'><span class='badge'>Ticket #$id</span><br>";
              echo "<b>$nick</b> : $msg </br> <a href='admin.php?f=status&op=closed&id=$id'><span class='glyphicon glyphicon-lock'></span></a><a href='admin.php?f=status&op=resolved&id=$id'><span class='glyphicon glyphicon-ok'></span></a>
              <a href='admin.php?f=delete&id=$id'><span class='glyphicon glyphicon-trash'></span></a></div><hr>";
            }
            
        		$db->close();
}




?>