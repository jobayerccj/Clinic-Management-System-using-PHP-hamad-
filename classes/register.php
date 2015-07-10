<?php

class Register
{
	public function UserRegister($uname,$mdpass,$fname,$lname,$state,$city,$address,$contact_no,$designation,$zip_code,$organisation,$uemail,$user_type,$user_ip)
	{
		
		$check_user = mysql_query("SELECT `id` FROM `members` where `user_name`='$uname' || `email_id`='$uemail'") or die(mysql_error());
		
		if(mysql_num_rows($check_user)>=1)
		{
			
			return false;

		}
		else
		{
			
			$user_insert = mysql_query("INSERT INTO `members` (
`user_name`,`password`,`first_name`,`last_name`,`state`,`city`,`address`,`contact_number`,`designation`,`organisation`,`email_id`,`zip_code`,`user_type`,`user_ip`,`date_time`)
 VALUES (
 '$uname','$mdpass','$fname','$lname','$state','$city','$address','$contact_no','$designation','$organisation','$uemail','$zip_code','$user_type','$user_ip',now())") or die(mysql_error());
				
			return true;
		
		}
		
		
		
	}
	
}
?>
