<?php
	ini_set('display_errors',1);  
	error_reporting(E_ALL);
	require_once('/var/www/config/mayo-config.php');
	//class file calling from attorney panel
	//require_once('/var/www/mayo-config.php');
	require_once('/var/www/cron-functions/functions.php');
	//require_once('/var/www/attorney/classes/meshed.php');
	$getdata = new CronFunctions();
	echo$date  = date('Y-m-d');

	echo $billingdate = date('Y-m-d',strtotime($date. '+1 days'));

	echo "SELECT a.*,b.* from plantiff_information as a,`u_fwd_final_billing` as b WHERE STR_TO_DATE( fwd_date,  '%Y-%m-%d' ) >'2015-03-22' and b.flag_accept=0 and a.form_id=b.fid GROUP BY b.fid";
	
	$document_messages = mysql_query("SELECT a.*,b.* from plantiff_information as a,`u_fwd_final_billing` as b WHERE STR_TO_DATE( fwd_date,  '%Y-%m-%d' ) >'2015-03-22' and b.flag_accept=0 and a.form_id=b.fid GROUP BY b.fid") or die(mysql_error());
	while($docs = mysql_fetch_object($document_messages))
	{
		echo $attManId   = $docs->underwriter_id;
		$form_id    = $docs->fid;
		$a          = $getdata->GetInfoPlantiffInformation("plantiff_name",$form_id); 
		$b          = ucwords($a);
		$d_o_b      = $getdata->GetInfoPlantiffInformation("p_d_o_b",$form_id);
		$home_phone = $getdata->GetInfoPlantiffInformation("p_home_no",$form_id);
		$work_phone = $getdata->GetInfoPlantiffInformation("p_office_no",$form_id);
		$mob_no     = $getdata->GetInfoPlantiffInformation("p_mob_no",$form_id);
		$dfirst_name= ucwords($getdata->GetObjectById($attManId,"first_name"));
		$dlast_name = ucwords($getdata->GetObjectById($attManId,"last_name"));
		echo $emails     = $getdata->GetObjectById($attManId,"email_id");
		$message="";
		$message .= '<html><body>';
		$message .= '<img src="/images/logo.png" alt="From Mayo to Underwriter – Payment Not Received" />';

		$message .='<table rules="all" cellpadding="0" cellspacing="5" border="0" style="font-size:17px;color:#000; border:1px solid #0665be; border-radius:5px;">';

		$message .='<tr><td style="background: none repeat scroll 0 0 #3a9df8;border-top-left-radius: 5px;border-top-right-radius: 5px;color: #fff;font: 15px MemphisLTStd-Medium;padding: 15px 0;text-align: center;">';
		
		$message .='<h1>From Mayo to '.$dfirst_name.' '.$dlast_name.' – Payment not Received</h1></td></tr>';
		$message .='<tr><td><h2>Dear '.$dfirst_name.' '.$dlast_name.'</h2></td></tr>';
		$message .='<tr><td align="center">Mayo Surgical LLC and affiliates have not received payment for services provided for '.$b.'.</td></tr>';
		
		$message .='<tr><td><table cellpadding="0" cellspacing="2" border="0" width="60%" style="color:#000; font-size:15px;"><tr><td><h3>Client Name:</h3></td><td><h3>'.$b.'</h3></td></tr> <tr><td><h3>Home Phone:</h3></td><td><h3>'.$home_phone.'</h3></td></tr><tr><td><h3>Work Phone:</h3></td><td><h3>'.$work_phone.'</h3></td></tr><tr><td><h3>Cell Phone:</h3></td><td><h3>'.$mob_no.'</h3></td></tr></table></td></tr>';
		$message .='<tr><td>Please send payment immediately.</td></tr>';
		$message .='<tr><td>Thank you,</td></tr>';	
		$message .='<tr><td>Mayo Surgical LLC and affiliates</td></tr>';
		$message .='<tr><td>Please login into <a href="https://mayosurgical.com">Mayo Surgical</a> for further information.</td></tr>';	
		$message .='<tr><td>DO NOT REPLY TO THIS MESSAGE. THIS EMAIL IS NOT MONITORED.</td></tr>';		
		echo $message .='</table>';
		$to       = $emails; 
		//$getdata->GetObjectById($attManId,"email_id");
		$subject  ="Payment Not Received";
		$headers  ="From: Mayo Surgical\r\n";
		$headers .="Reply-To: mayosurical.com\r\n";
		$headers .="MIME-Version: 1.0\r\n";
		$headers .="Content-Type: text/html; charset=ISO-8859-1\r\n";
		
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