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
$high = $db->querySingle("SELECT COUNT(*) as count1 FROM tickets WHERE (priority='High');");
$medium = $db->querySingle("SELECT COUNT(*) as count2 FROM tickets WHERE (priority='Medium');");
$low = $db->querySingle("SELECT COUNT(*) as count3 FROM tickets WHERE (priority='Low');");
$resolved = $db->querySingle("SELECT COUNT(*) as count4 FROM tickets WHERE (priority='resolved');");
$locked = $db->querySingle("SELECT COUNT(*) as count5 FROM tickets WHERE (priority='closed');");
?>
<html>
	<header class='indicT'>
		<link rel="stylesheet" media="screen" type="text/css" href="css/bootstrap.css">
		<MEAT charset='UTF-8'>
		<h1> YAHD 0.21 </h1>
		<h4> Yet Another Help Desk </h4>
    <span class="label label-primary"><?php echo $count; ?> total ticket(s)</span>
    <span class="label high indicT"><?php echo $high; ?> high priority ticket(s)</span>
    <span class="label medium indicT"><?php echo $medium; ?> medium priority ticket(s)</span>
    <span class="label low indicT"><?php echo $low; ?> low priority ticket(s)</span>
    <span class="label resolved indicT"><?php echo $resolved; ?> resolved ticket(s)</span>
    <span class="label closed indicT"><?php echo $locked; ?> locked ticket(s)</span>
		<hr>
	</header>
	<body>
		<form class="form-horizontal yahd" role="form" method="post" action="send.php">
  <div class="form-group">
    <label for="nick" class="col-sm-2 control-label">Nickname</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="nick" name="nick" placeholder="Your nickname">
    </div>
  </div>
  </div>
  <div class="form-group">
  		<label for "priority" class="col-sm-2 control-label">Priority</label>
  		<div class="col-sm-10">
  		<select class="form-control" id="priority" name="priority">
  			<option>High</option>
  			<option>Medium</option>
  			<option>Low</option>
  		</select>
  	</div>
  </div>
  	  <div class="form-group">
    <label for="msg" class="col-sm-2 control-label">Issue ?</label>
    <div class="col-sm-10">
      <textarea class="form-control" rows="3" id="msg" name="msg"></textarea>
    </div>
  </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
  </div>
</form>
		<?php 
            for($j = 1; $j < $count+1; ++$j)
            {
              $query = "SELECT DISTINCT * FROM tickets WHERE (id='$j');";
              $result = $db->query($query)->fetchArray();
              if (!$result) {

              } else {
              extract($result, EXTR_OVERWRITE, "wddx");
              echo "<div class='alert $priority'><span class='badge'># $id</span><br>";
              echo "<b>$nick</b> : $msg </br> <a href='lock.php?id=$id'><span class='glyphicon glyphicon-lock'></span></a><a href='unlock.php?id=$id'><span class='glyphicon glyphicon-ok'></span></a></div><hr>";
            }
            }
        $db->close();
		?>
	</body>	