<?php
echo $path = $_SERVER['DOCUMENT_ROOT']."/rao/path.php";
echo require_once($path);
echo include($config);
$role = $_GET['desgntn'];
$tempgetusers = mysql_query("SELECT * from `members` where `designation`='$role'") or die(mysql_error());
?>
<select name="user_details">
		<option value=''>...Select...</option>
<?php
while($getusers = mysql_fetch_object($tempgetusers))
{
?>
	<option value='<?php echo $getusers->id; ?>'><?php echo $getusers->first_name; ?></option>
<?php
}
?>
</select>
