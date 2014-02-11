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
?>
<html>
	<header>
		<link rel="stylesheet" media="screen" type="text/css" href="css/bootstrap.css">
		<MEAT charset='UTF-8'>
		<h1> YAHD 0.20 </h1>
		<h4> Yet Another Help Desk </h4>
    <span class="label label-primary">There is <?php echo $count; ?> tickets</span>
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
  			<option>Ridiculous</option>
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
              extract($result, EXTR_OVERWRITE, "wddx");
              echo "<span class='badge'># $id</span>";
              echo "<div class='alert $priority'> <b>$nick</b> : $msg </br> </div>";
            }
        $db->close();
		?>
	</body>	