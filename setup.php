<html>
<header>
		<link rel="stylesheet" media="screen" type="text/css" href="css/bootstrap.css">
</header>
<h1> YAHD - auto setup </h1>
<hr/>
<p> This is the auto setup page. By visiting this page, I created the required tickets.db file.
	You can delete this page once the file has been generated
</p>
<?php 
class dbmain extends SQLite3
{
	function __construct()
	{
		$this->open('tickets.db');
	}
}
$db = new dbmain();
$db->exec("CREATE TABLE tickets (id INTEGER PRIMARY KEY, msg VARCHAR(500), nick VARCHAR(45), priority VARCHAR(10), status VARCHAR(10));");
$db->close();
?>
</html>