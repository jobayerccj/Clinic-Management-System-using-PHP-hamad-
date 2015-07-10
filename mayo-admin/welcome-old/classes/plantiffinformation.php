<?php
class Plantiffinformation
{
	public function GetEmailId($choose_doctors,$case_type,$plantiff_status,$message_doctor,$message_plantiff,$user_id)
	{
		foreach($choose_doctors as $a)
			{
				$choose_doctors1 = mysql_query("SELECT * FROM `members` where `id` = '$a'") or die(mysql_error());
				$get_email      = mysql_fetch_array($choose_doctors1);
				$email_id       = $get_email['email_id'];
				$this->SendEmail($email_id,$message_doctor);
				$this->GetUserEmail($user_id,$email_plantiff);
			}
			$imp_doctor = implode(',',$choose_doctors);

		    $insert_doctor = mysql_query("UPDATE `plantiff_status_information` set `admin_approved`='1',`case_transfer_id`='$imp_doctor',
		`plantiff_status`='$plantiff_status',`case_type`='$case_type',`date_time`=now() where id='$_GET[id]'") or die(mysql_error());
	}

	
	private function SendEmail($emails_users,$message_doctor)
	{
		$to = $emails_users;
		$subject = 'Mayo Surgical';
		$message = '<html><body>';
		$message .= '<img src="http://mayosurgical.com/rao/images/logo.png" alt="Contact Email" />';
		$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
		$message .= "<tr><td><strong>Message:</strong> </td><td>".$message_doctor."</td></tr>";
		$message .= "</table>";
		$message .= "</body></html>";
		$headers = "From: fsfsf\r\n";
		$headers .= "CC: nordiff.com\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		$mail = mail($to,$subject,$message,$headers);
	}
		
	public function GetUserEmail($user_id,$message_plantiff)
	{
		
		$queryplantiffemail  = mysql_query("SELECT * from `members` where `id`='$user_id'") or die(mysql_error());
		$getplantiffemail    = mysql_fetch_array($queryplantiffemail);
		$email_plantiff = $getplantiffemail['email_id'];
		$this->SendEmailPlantiff($email_plantiff,$message_plantiff);
	}
	
	private function SendEmailPlantiff($email_plantiff,$message_plantiff)
	{
		$to = $email_plantiff ;
		$subject = 'Mayo Surgical';
		$message = '<html><body>';
		$message .= '<img src="http://mayosurgical.com/rao/images/logo.png" alt="Contact Email" />';
		$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
		$message .= "<tr><td><strong>Message:</strong> </td><td>".$message_plantiff."</td></tr>";
		$message .= "</table>";
		$message .= "</body></html>";
		$headers = "From: fsfsf\r\n";
		$headers .= "CC: nordiff.com\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		$mail = mail($to,$subject,$message,$headers);
	}
}
?>
