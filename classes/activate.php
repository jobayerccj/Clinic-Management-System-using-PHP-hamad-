<?php

	require($config);

	include('header.php');

	$path = $_SERVER['DOCUMENT_ROOT']."/rao/path.php";

	require_once($path);

	$activation = $_GET['activation_code'];

	$email_id = $_GET['email_id'];
	
	$data = mysql_query("SELECT `id` FROM `members` where `email_id`='$email_id' && `activation_code`='$activation'") or die(mysql_error());
	
	if($data)
	{
		
		$sql = mysql_query("UPDATE `members` set `activation_code`='1' where `email_id`='$email_id'");
		
		echo "Your Account is Activated";
		
	}
	else
	{
		
		echo "Token Expired";
		
	}
	

?>
