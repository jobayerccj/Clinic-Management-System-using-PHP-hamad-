<?php
	$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
	require_once($path);
	include($config);
	$sql = mysql_query("DELETE FROM `bill_forward_underwriter` WHERE `b_f_id` = '$_REQUEST[dfbid]'") or die(mysql_error());
?>