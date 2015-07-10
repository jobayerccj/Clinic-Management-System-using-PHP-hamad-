<?php
ob_start();
ini_set('display_errors',1);  
error_reporting(E_ALL);
require_once('../../../includes/functions.php');
$path = $_SERVER['DOCUMENT_ROOT']."/rao/path.php";
require_once($path);
include($config);

?>
<form name="form1" method="post" action="">
	<input type="text" name="search">
	<input type="submit" name="vikas">
</form>
<?php
	if(isset($_POST['vikas']))
	{
		
		if($string="")
		{
			$sql = mysql_query("SELECT message_id FROM message_sent") or die(mysql_error());
			while($data = mysql_fetch_object($sql))
			{
				echo $data->message_id."<br/>";
			}
		}
		else
		{
		echo "Test";
		echo $test = "SELECT message_id FROM message_sent WHERE FIND_IN_SET('$string', main_user_id ) >0";
		$sql = mysql_query("SELECT message_id FROM message_sent WHERE FIND_IN_SET('$string', main_user_id ) >0") or die(mysql_error());
		while($data = mysql_fetch_object($sql))
		{
			echo $data->message_id."<br/>";
		}
		}
	}
?>