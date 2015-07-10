<?php
$path = $_SERVER['DOCUMENT_ROOT']."/rao/path.php";
require_once($path);
include($config);
$user_id = $_GET['eid'];
$query = mysql_query("DELETE FROM `email_formats` where `id` = '$user_id'");
if($query)
{
	header("refresh:1;url=insert-email.php");
}
?>
