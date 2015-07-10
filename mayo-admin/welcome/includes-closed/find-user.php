<?php
$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
include($config);
$role = $_GET['desgntn'];
$tempgetusers = mysql_query("SELECT * from `members` where `designation`='$role'") or die(mysql_error());
?>
<select name="user_details" onChange="getInfo(this.value)">
		<option value=''>...Select...</option>
<?php
while($getusers = mysql_fetch_object($tempgetusers))
{
?>
	<option value='<?php echo $getusers->id; ?>'><?php echo ucwords($getusers->first_name)."&nbsp;".ucwords($getusers->last_name); ?></option>
<?php
}
?>
</select>
