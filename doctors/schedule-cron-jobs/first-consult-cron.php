<?php
	ini_set('display_errors',1);  
	error_reporting(E_ALL);
	require_once('/var/www/config/mayo-config.php');
	//class file calling from attorney panel
	//require_once('/var/www/rao/mayo-config.php');
	require_once('/var/www/cron-functions/functions.php');
	//require_once('/var/www/rao/attorney/classes/meshed.php');
	$getdata = new CronFunctions();
	$date  = date('d-m-Y');
	$consultdatetime = date('m-d-Y',strtotime($date. '+3 days'));
	$query 		  = "SELECT * FROM appointment_doctor WHERE (STR_TO_DATE( date_appt,  '%m-%d-%Y' )) >  '$consultdatetime' && `appt_report`=0";	
	$getApptDate    = mysql_query("SELECT * FROM appointment_doctor WHERE (STR_TO_DATE( date_appt,  '%d-%d-%Y' )) >  '$consultdatetime' && `appt_report`=0") or die(mysql_error());
	while($rowss    = mysql_fetch_object($getApptDate))
	{
		$form_id    = $rowss->form_id;

		$user_id    = $rowss->user_id;

		$doctor_id  = $rowss->main_user_id;
		$app_type	= $rowss->app_type;
		$due_by_date= $rowss->due_by_date;
		$date_appt  = $rowss->date_appt;
		if(isset($due_by_date) && $due_by_date!=" ")
		{
			list($c,$d) = explode("/",$due_by_date);
		}
		if(isset($date_appt))
		{
			list($e,$f) = explode("/",$date_appt);
		}
		/*
			get all doctor email id and there names using the functions
		*/
		echo $emails= $getdata->GetObjectById($doctor_id,"email_id");
		/*
			Cient information
		*/
		$abcd     = $getdata->GetInfoPlantiffInformation("plantiff_name",$form_id); 
		echo $client_named= ucwords($abcd);
		$d_o_b      = $getdata->GetInfoPlantiffInformation("p_d_o_b",$form_id);
		$home_phone = $getdata->GetInfoPlantiffInformation("p_home_no",$form_id);
		$work_phone = $getdata->GetInfoPlantiffInformation("p_office_no",$form_id);
		$mob_no     = $getdata->GetInfoPlantiffInformation("p_mob_no",$form_id);
		$dfirst_name= ucwords($getdata->GetObjectById($doctor_id,"first_name"));
		$dlast_name = ucwords($getdata->GetObjectById($doctor_id,"last_name"));
		
		$case_type  = $getdata->Getcidbyformid($form_id);
		
		$message    ="";
		$message   .= '<html><body>';
		
		$message   .= '<table rules="all" cellpadding="0" cellspacing="5" border="0" style="font-size:17px;color:#000; border:1px solid #0665be; border-radius:5px;">';
		
		$message .= '<tr><td align="center"><img src="https://'.$_SERVER['HTTP_HOST'].'/images/logo.png" alt="From Mayo to Doctor – Upload Reports" /></td></tr>';
		
		$message   .= '<tr><td style="background: none repeat scroll 0 0 #3a9df8;border-top-left-radius: 5px;border-top-right-radius: 5px;color: #fff;font: 15px MemphisLTStd-Medium;padding: 15px 0;text-align: center;border-left:1px solid #0665be;border-right:1px solid #0665be;"><h1>From Mayo to '.$dfirst_name. ''.$dlast_name.' – Waiting on Operative Report</h1></td></tr>';
		$message   .= '<tr><td align="center"><h2 style="color:#f6801f;">'.$getdata->getNameCase($case_type).'</h2></td></tr>';
		$message   .= '<tr><td><h2> Dear Dr. '.$dfirst_name.' '.$dlast_name.'</h2></td></tr>';
		$message   .= '<tr><td align="center">Our records indicates that your office performed a '.$getdata->GetAppById($app_type).' On Date: '.$e.'at'.$f.'.</td></tr>';
		
		$message   .= '<tr><td><table cellpadding="0" cellspacing="2" border="0" width="60%" style="color:#000"><tr><td><strong>Client Name:</strong></td><td><strong>'.$client_named.'</strong></td></tr> <tr><td><strong>Home Phone:</strong></td><td><strong>'.$home_phone.'</strong></td></tr><tr><td><strong>Work Phone:</strong></td><td><strong>'.$work_phone.'</strong></td></tr><tr><td><strong>Cell Phone:</strong></td><td><strong>'.$mob_no.'</strong></td></tr></table></td></tr>';

		
		$message .= '<tr><td>We have not received the Operative Report.</td></tr>';

		$message .= '<tr><td>Please LOGIN to mayosurgical.com and UPLOAD the needed documents.</td></tr>';
		$message .= '<tr><td>You may also fax to 800-865-8691 if needed.</td></tr>';
		$message .='<tr><td>Thank You,</td></tr>';
		$message .='<tr><td>Mayo Surgical, LLC</td></tr>';
		$message .='<tr><td>DO NOT REPLY TO THIS MESSAGE. THIS EMAIL IS NOT MONITORED to automatically generated emails.</td></tr>';
		echo $message .='</table>';
		
		$subject  ="Please Upload the Operative Report";
		$headers  ="From: Mayo Surgical\r\n";
		$headers .="Reply-To: mayosurgical.com\r\n";
		$headers .="MIME-Version: 1.0\r\n";
		$headers .="Content-Type: text/html; charset=ISO-8859-1\r\n";
		
		if (mail($emails, $subject, $message, $headers)) 
		{
		   echo 'Your message has been sent.';
		} 
		else 
		{
		   echo 'There was a problem sending the email.';
		}
		
	}
?>
