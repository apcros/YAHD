<?php
class dbmain extends SQLite3
{
	function __construct()
	{
		$this->open('tickets.db');
	}
}


function send() {
	$db = new dbmain();

$q = $db->prepare('INSERT INTO tickets (msg, nick, priority, status) VALUES (:msg, :nick, :pri, :status);');
$msg = utf8_encode($_POST['msg']);
$nick = utf8_encode($_POST['nick']);

$q->bindValue(':msg', $msg);
$q->bindValue(':nick', $nick);
$q->bindValue(':pri', $_POST['priority']);
$q->bindValue(':status', 'default');
$q->execute();
$db->close();

}


function generateUTID() {
	$string = "";
	for ($i=1; $i < 9; $i++) { 
		$string = $string . (rand(1,9));
		
	}
	return $string;
}

function returnStats(){
$db = new dbmain();
$count = $db->querySingle('SELECT COUNT(*) as count FROM tickets;');
$high = $db->querySingle("SELECT COUNT(*) as count1 FROM tickets WHERE (priority='High');");
$medium = $db->querySingle("SELECT COUNT(*) as count2 FROM tickets WHERE (priority='Medium');");
$low = $db->querySingle("SELECT COUNT(*) as count3 FROM tickets WHERE (priority='Low');");
$resolved = $db->querySingle("SELECT COUNT(*) as count4 FROM tickets WHERE (status='resolved');");
$locked = $db->querySingle("SELECT COUNT(*) as count5 FROM tickets WHERE (status='closed');");

$result  = "
<span class='label label-primary'>$count total ticket(s)</span>
    <span class='label high indicT'>$high high priority ticket(s)</span>
    <span class='label medium indicT'>$medium medium priority ticket(s)</span>
    <span class='label low indicT'>$low low priority ticket(s)</span>
    <span class='label resolved indicT'>$resolved resolved ticket(s)</span>
    <span class='label closed indicT'>$locked locked ticket(s)</span>";
 return $result;
}

function getAlertColor($priority, $status) {
	
	if($status == "default") {
		return $priority;
	} else {
		return $status;
	}
}

function getTickets() {

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
              echo "<b>$nick</b> : $msg </br> </div><hr>";
            }
            
        		$db->close();
}

?>