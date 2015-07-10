<?php
	ob_start();
	ini_set('display_errors',1);  
	error_reporting(E_ALL);
	$path = $_SERVER['DOCUMENT_ROOT']."/rao/path.php";
	include($path);
	include($config);
	$q=$_GET['q'];
	$sql = mysql_query("SELECT * FROM `members` WHERE `id`='$q'") or die(mysql_error());
	while($row=mysql_fetch_array($sql))
	{
		echo $row['first_name']."\n";
		echo $row['last_name']."\n";
	}

?>

