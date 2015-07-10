<?php
	require_once('/var/www/config/mayo-config.php');
	class CronFunctions
	{
			public function GetInfoPlantiffInformation($var1,$var2)
			{
				$query = mysql_query("SELECT $var1 FROM `plantiff_information` WHERE `form_id`='$var2'") or die(msyql_error());
				$getcase = mysql_fetch_object($query);
				return $getcase->$var1;
			}
			
			public function GetObjectById($id,$var)
			{
				
				$tempobjbyid = mysql_query("SELECT $var from `members` where id='$id'") or die(mysql_error());
				$objbyid     = mysql_fetch_object($tempobjbyid);
				return $objbyid->$var;
				
			}
			
			function getRoleByRoleId($var)
			{
				$sql = mysql_query("SELECT `designation` FROM `designation` WHERE `id`='$var'") or die(mysql_error());
				$app = mysql_fetch_object($sql);
				return $app->designation;
			}
			
			public function GetAppById($var)
			{
				$sql = mysql_query("SELECT * FROM `appt_type` WHERE `id`='$var'") or die(mysql_error());
				$app = mysql_fetch_object($sql);
				return $app->type;
			}
		
			public function Getcidbyformid($form_id)
			{
				$tempinfo = mysql_query("SELECT case_type FROM `plantiff_case_type_info` where `form_id`='$form_id'") or die(mysql_error());
				$userinfo = mysql_fetch_object($tempinfo);
				return $userinfo->case_type;
			}
			
			function getNameCase($var)
			{
				$sql = mysql_query("SELECT `name_of_case` FROM `type_of_cases` WHERE `case_id`='$var'") or die(mysql_error());
				$app = mysql_fetch_object($sql);
				return $app->name_of_case;
			}
	}
?>