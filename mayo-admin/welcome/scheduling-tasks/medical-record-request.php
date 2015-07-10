<?php
	ini_set('display_errors',1);  
	error_reporting(E_ALL);
	require_once('/var/www/config/mayo-config.php');
	//class file calling from attorney panel
	//require_once('/var/www/rao/mayo-config.php');
	require_once('/var/www/cron-functions/functions.php');
	//require_once('/var/www/rao/attorney/classes/meshed.php');
	$getdata = new CronFunctions();

	$document_messages = mysql_query("SELECT members.id AS rd_id, hire_staff.hire_id AS hd_id, hire_staff.form_id AS hf_id, plantiff_case_type_info.id AS pid, plantiff_case_type_info.form_id AS fid
	FROM hire_staff, members, plantiff_case_type_info
	WHERE hire_staff.id NOT 
	IN (
		SELECT DISTINCT form_id
		FROM appointment_doctor
	)
	AND members.id = hire_staff.hire_id && members.designation =3
	AND plantiff_case_type_info.form_id = hire_staff.form_id
	AND plantiff_case_type_info.case_type = 6") or die(mysql_error());
	while($docs = mysql_fetch_object($document_messages))
	{
		$attManId    = $docs->rd_id;
		$form_id     = $docs->fid;
		$a           = $getdata->GetInfoPlantiffInformation("plantiff_name",$form_id); 
		$b           = ucwords($a);
		$d_o_b       = $getdata->GetInfoPlantiffInformation("p_d_o_b",$form_id);
		$home_phone  = $getdata->GetInfoPlantiffInformation("p_home_no",$form_id);
		$work_phone  = $getdata->GetInfoPlantiffInformation("p_office_no",$form_id);
		$mob_no      = $getdata->GetInfoPlantiffInformation("p_mob_no",$form_id);
		$dfirst_name = ucwords($getdata->GetObjectById($attManId,"first_name"));
		$dlast_name  = ucwords($getdata->GetObjectById($attManId,"last_name"));
		$emails      = $getdata->GetObjectById($attManId,"email_id");
		$message     = "";
		$message    .= '<html><body>';
		$message    .= '<img src="/images/logo.png" alt="From Mayo to Doctor – New Referral" />';
		//$message  .= '<img src="/rao/images/logo.png" alt="From Mayo to Doctor – New Referral" />';

		$message    .= '<table rules="all" cellpadding="0" cellspacing="5" border="0" style="font-size:17px;color:#000; border:1px solid #0665be; border-radius:5px;">';

		$message    .= '<tr><td style="background: none repeat scroll 0 0 #3a9df8;border-top-left-radius: 5px;border-top-right-radius: 5px;color: #fff;font: 15px MemphisLTStd-Medium;padding: 15px 0;text-align: center;">';
		
		$message    .= '<h1>From Mayo to '.$getdata->GetObjectById($attManId,"first_name").' – New Referral</h1></td></tr>';
		$message    .= '<tr><td align="center"><h2 style="color:#f6801f;">Medical Record Request</h2></td></tr>';
		$message    .= '<tr><td><h2>Dear Dr. '.$dfirst_name.' &nbsp; '.$dlast_name.'</h2></td></tr>';
		$message    .= '<tr><td align="center">Mayo Surgical would like to refer a client for Consultation.  Here is the client information:</td></tr>';
		
		$message    .= '<tr><td><table cellpadding="0" cellspacing="2" border="0" width="60%" style="color:#000"><tr><td><strong>Client Name:</strong></td><td><strong>'.$b.'</strong></td></tr><tr><td><strong>Home Phone:</strong></td><td><strong>'.$home_phone.'</strong></td></tr><tr><td><strong>Work Phone:</strong></td><td><strong>'.$work_phone.'</strong></td></tr><tr><td><strong>Cell Phone:</strong></td><td><strong>'.$mob_no.'</strong></td></tr></table></td></tr>';
		$message    .= '<tr><td>1. Please Login and review the medical records available at mayosurgical.com</td></tr>';
		$message    .= '<tr><td>2. Please Login and enter the appointment date once set, by clicking on the appointment tab in the main menu.</td></tr>';
		
		$message    .= '<tr><td>3. Please UPLOAD or fax the following information once completed:</td></tr>';
		$message    .='<tr><td><ul style="text-align:left; list-style-type:none;"><li><img src="/images/arrw.png" alt=""> Letter of Medical Necessity</li><li><img src="/images/arrw.png" alt=""> Surgery recommendation</li><li><img src="/images/arrw.png" alt=""> Consult Notes</li>
		 </ul></td></tr>';
		 
		$message   .= '</table>';
		$to         = $emails; 
		//$getdata->GetObjectById($attManId,"email_id");
		$subject    = "From Mayo to – New Referral";
		$headers    = "From: Mayo Surgical\r\n";
		$headers   .= "Reply-To: mayosurical.com\r\n";
		$headers   .= "MIME-Version: 1.0\r\n";
		$headers   .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		
		if (mail($to, $subject, $message, $headers)) 
		{
		   echo 'Your message has been sent.';
		} 
		else 
		{
		   echo 'There was a problem sending the email.';
		}
	}
?>