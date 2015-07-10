<?php
	$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
	require_once($path);
	include($config);
	$sql = mysql_query("DELETE FROM `hire_staff` WHERE `id` = '$_REQUEST[hid]'") or die(mysql_error());
?>