<?php
	$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
	require_once($path);
	include($config);
	$sql = mysql_query("DELETE FROM `billing_info` WHERE `billing_id` = '$_REQUEST[bid]'") or die(mysql_error());
?>