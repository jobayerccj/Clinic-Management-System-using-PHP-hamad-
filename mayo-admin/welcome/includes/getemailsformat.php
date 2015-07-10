<?php
$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
include($config);
$role = $_GET['email_format'];
$tempgetusers = mysql_query("SELECT * from `email_formats` where `id`='$role'") or die(mysql_error());
$data = mysql_fetch_object($tempgetusers);
?>
<textarea name="document_message"><?php echo $data->email_format; ?></textarea>