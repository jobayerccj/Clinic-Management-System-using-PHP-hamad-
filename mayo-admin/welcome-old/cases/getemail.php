<?php
	ob_start();
	ini_set('display_errors',1);  
	error_reporting(E_ALL);
	$path = $_SERVER['DOCUMENT_ROOT']."/rao/path.php";
	include($path);
	include($config);
	$my_data=$_GET['q'];
	$sql = mysql_query("SELECT `email_id` FROM `members` WHERE `email_id` LIKE '%$my_data%' and `designation`='3'") or die(mysql_error());
	while($row=mysql_fetch_array($sql))
	{
		echo $row['email_id']."\n";
	}

?>
