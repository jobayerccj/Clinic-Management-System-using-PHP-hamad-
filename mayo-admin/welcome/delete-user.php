<?php
echo $path = $_SERVER['DOCUMENT_ROOT']."/path.php";
echo require_once($path);
echo include($config);
echo $user_id = $_POST['id'];
$query = mysql_query("DELETE FROM `members` where `id` = '$user_id'");
echo "DELETED";
?>
