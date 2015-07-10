<?php
	ini_set('display_errors',1);  
	error_reporting(E_ALL);
	require_once('/var/www/config/mayo-config.php');
	//class file calling from attorney panel
	//require_once('/var/www/rao/mayo-config.php');
	require_once('/var/www/cron-functions/functions.php');
	//require_once('/var/www/rao/attorney/classes/meshed.php');
	$date = date('Y-m-d h:i:s');
	//$date = "2015-04-12 20:32:57";
	$currentDate = strtotime($date);
	echo "<br/>";
	$futureDate = $currentDate-(60*1);
	echo $formatDate = date("Y-m-d H:i:s", $futureDate);
	$getdata = new CronFunctions();
	$sql = mysql_query("SELECT a.*,b.* FROM plantiff_information as a, plantiff_case_type_info as b where a.form_id=b.form_id and b.date_time > '$formatDate' ") or die(mysql_error());
	
	if(mysql_num_rows($sql)>0)
	{
		while($row=mysql_fetch_object($sql))
		{
			echo $plantiff_name = $row->plantiff_name;
			echo $form_id = $row->form_id;

			$user_id = $row->id;
			$att_id  = $row->attorney_id;
			$designationid = $getdata->GetObjectById($user_id,'designation');
			$desgname = $getdata->getRoleByRoleId($designationid);
			
			$check = mysql_query("SELECT * FROM `message_sent` WHERE `form_id`='$form_id'") or die(mysql_error());
			if(mysql_num_rows($check)<1)
			{
				$messageSaved = $desgname." has submitted a new Application.  The New Client name is ".$plantiff_name.".";
				$message = mysql_query("INSERT INTO `message_sent` (`form_id`,`user_id`,`sent_by`,`main_user_id`,`message`,`date_message`) VALUES ('$form_id','$user_id','$att_id','$att_id','$messageSaved',now())") or die(mysql_error());
			}
		}	
	}
?>
