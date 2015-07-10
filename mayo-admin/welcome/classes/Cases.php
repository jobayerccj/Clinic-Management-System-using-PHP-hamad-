<?php 
Class Cases
{
	public $user_id;
	public $attorney_id;
	public $form_id;
	public $doctor_id;
	public $messagetodoctor;
	public $messagetoclient;
	
	function AcceptCase($form_id)
	{
		$accept = mysql_query("UPDATE `plantiff_case_type_info` SET `admin_approved`='1' WHERE `form_id` = '$form_id' ") or die(mysql_error());
		if($accept)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function RejectCase($form_id)
	{
		$reject = mysql_query(" UPDATE `plantiff_case_type_info` SET `admin_approved`='2' WHERE `form_id` = '$form_id' ") or die(mysql_error());
		if($reject)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function mail()
	{
		
	}
	
	public function HireDoctor()
	{
		
		$sendmess = mysql_query("INSERT INTO `hire_doctors` (`form_id`,`attorney_id`,`user_id`,`doctor_id`,`message_to_doctor`,`message _to_client`) 
		VALUES ('".$this->form_id."','".$this->attorney_id."','".$this->user_id."','".$this->doctor_id."','".$this->messagetodoctor."',
		'".$this->messagetoclient."')") or die(mysql_error());
		
		$update = mysql_query("UPDATE `plantiff_case_type_info` set `hired`='hired' where `form_id`='".$this->form_id."'") or die(mysql_error());
		if($sendmess)
		{
			return true;
		}
		else
		{
			return false;
		}
		
	}
	
	/*function EmailUsers($messagetoclient)
	{
		$subject = "Mayo Surgical";
		$message = "<html><body>";
		$message.="<img src='http://mayosurgical.com/images/logo.png' alt='Username/Password'>";
		$message.="</body></html>";
		$message.='<table rules="all" style="border-color: #666;" cellpadding="10">';
		$message.="<tr style='background: #eee;'><td>Hi ".$this->plantiff_name." <br/>Your Login Information</td></tr>";
		$message.="<tr style='background: #eee;'><td colspan='2'>Automatically Created Username and Password</td></tr>";
		$message.="<tr style='background: #eee;'><td><strong>Username:</strong> </td><td>".$this->u_name.$uname."</td></tr>";
		$message.="<tr style='background: #eee;'><td><strong>Password:</strong> </td><td>".$password."</td></tr>";
		$message.="</table>";
		$headers = "From: Mayo Surgical\r\n";
		$headers.= "CC: nordiff.com\r\n";
		$headers.= "MIME-Version: 1.0\r\n";
		$headers.= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		$mail    = mail($this->email_address,$subject,$message,$headers);
		if($mail)
		{
		 return true;
		}
		else
		{
		 return false;
		}	  
	}*/
	
	function getdesignation(){
		$dsg_d = mysql_query("SELECT * FROM `designation` where `id`!=5 && `id`!=2 && `id`!=7") or die(mysql_error());
		while($desg = mysql_fetch_object($dsg_d))
		{
	?>
			<option value="<?php echo $desg->id; ?>"><?php echo $desg->designation; ?></option>
	<?php
		} 
	}
	
	function getmembers(){
		$mem_d = mysql_query("SELECT * FROM `members`") or die(mysql_error());
		while($mem = mysql_fetch_object($mem_d))
		{
	?>
			<option value="<?php echo $mem->id; ?>"><?php echo $mem->first_name; ?></option>
	<?php
		} 
	}

}
?>
