<?php

/*
################# Status function. ##############

Used to change de status of a ticket : Locked or Resolved

The status choosen is contained the op GET variable
The id of the ticket to be modified is in the id GET variable

The function also change the priority of the ticket to prevent false statistics. (For ex : Counting an high priority ticket, even if it's closed )

*/
function status() {
if($_SESSION['logged'] == 1 && isset($_GET['op']) && isset($_GET['id'])) {
	$db = new dbmain();
	$status = $_GET['op'];
	$idticket = $_GET['id'];

	$q = $db->prepare('UPDATE tickets SET status = :status, priority = "Unlisted" WHERE id=:id');
	$q->bindValue(':id', $idticket);
	$q->bindValue(':status', $status);
	$q->execute();
	$db->close();
	header("Location: admin.php");
	header("Refresh: 0");
	}

}

/*
############# Delete function ###############

Just remove the ticket from the db. 
id of the ticket to remove passed with id (GET)

*/
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


/*
############ logout function ##############
Affect 0 as the logged session var

*/
function logout() {
	$_SESSION['logged'] = 0;
	header('Location: index.php');
	header("Refresh: 0");
}

/* 
################## Purge function ############

Drop and re-create all the tables.
For maintenance purposes

*/
function purge() {
	$db = new dbmain();
	$db->exec("DROP TABLE tickets;");
	$db->exec("CREATE TABLE tickets (id INTEGER PRIMARY KEY, msg VARCHAR(500), nick VARCHAR(45), priority VARCHAR(10), status VARCHAR(10));");
	$db->close();
	header("Location: admin.php");
	header("Refresh: 0");
}

/*
########### getTicketsAdmin function ############

List all the tickets from the DB, with admins buttons 
(Lock, Resolve, Delete)
*/
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

	
				if($status == "default") {
					$alertColor = $priority;
				} else {
					$alertColor = $status;
				}
              echo "<div class='alert $alertColor'><span class='badge'>Ticket #$id</span><br>";
              echo "<b>$nick</b> : $msg </br> <a href='admin.php?f=status&op=closed&id=$id'><span class='glyphicon glyphicon-lock'></span></a><a href='admin.php?f=status&op=resolved&id=$id'><span class='glyphicon glyphicon-ok'></span></a>
              <a href='admin.php?f=delete&id=$id'><span class='glyphicon glyphicon-trash'></span></a></div><hr>";
            }
            
        		$db->close();
}



?>