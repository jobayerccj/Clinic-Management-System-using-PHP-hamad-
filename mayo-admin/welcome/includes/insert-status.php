<?php
	ini_set('display_errors',1);  
	error_reporting(E_ALL);
	
	if(!isset($_SESSION))
	{
		session_start();
	}
	
	$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
	require_once($path);
	
	include($config);
	
	$functions  = $pathofmayo."/classes/functions.php";
	include($functions);
	
	$meshedfile = $pathofmayo."/attorney/classes/meshed.php";
	require_once($meshedfile);
	
	$getdata    = new Meshed();
	
	$admin      = $_SESSION['username'];
	$admin_id   = $getdata->GetDetailsByUsername($admin,"id");
	
	$status    = $_REQUEST['status'];
	$form_s_id = $_REQUEST['fid'];
	$use_id    = $_REQUEST['uid'];
	$statusArea= $_REQUEST['statusComment'];
	$query     = mysql_query("INSERT INTO `status_update` (`form_id`,`user_id`,`main_user_id`,`status_messages`,`status_notes`,`date_status`) 
	VALUES ('$form_s_id','$use_id','$admin_id','$status','$statusArea',now())") or die(mysql_error());
	
	$hiresId = $getdata->getHiredStaff($form_s_id);
		/*
			Get information from the hire staff to send the status update emails to all of them
		*/
	// Insert Status in the latest Messages
	$clientName = $getdata->GetInfoPlantiffInformation("plantiff_name",$form_s_id);
	$messageSent = $clientName ." has changed Status to ".$status;
	
	$notification = mysql_query("INSERT INTO `notifications` (`user_id`,`form_id`,`main_id`,`message`) VALUES ('$use_id','$form_s_id','$admin_id','$messageSent')") or die(mysql_error());
	
	$insertStatus = mysql_query("INSERT INTO `message_sent` (`form_id`,`user_id`,`sent_by`,`main_user_id`,`message`,`date_message`) VALUES ('$form_s_id','$use_id','$admin_id','$hiresId','$messageSent',now())") or die(mysql_error());
	if($query)
	{
		echo "<div class='thank_message'>Status is Successfully Updated</div>";
	}
	else
	{
		echo "<div class='thank_message'>There is some problem</div>";
	}
?>
	<div class="update_status_botom">
		<div class="update_status_row_heading">
			<div class="update_status_span_1">Date</div>
			<div class="update_status_span_2">Update By</div>
			<div class="update_status_span_3">Status</div>
		</div>
			<?php
				$count=0;
				$temp_getstatus = mysql_query("SELECT * FROM `status_update` where `form_id`='$_REQUEST[fid]' order by id desc") or die(mysql_error());
				if(mysql_num_rows($temp_getstatus)>0)
				{
					while($getstatus= mysql_fetch_object($temp_getstatus))
					{
				?>
						<div class="update_status_row">
							<div class="update_status_span_1">
								<?php 
									$tempdate = $getstatus->date_status;
									echo $date_time = date("Y-M-d",strtotime($tempdate))."<br/>"; 
									echo $datetime = date("H:m:s a",strtotime($tempdate));
								?>
							</div>
							<div class="update_status_span_2">
								<?php 
									$a_id = $getstatus->main_user_id;
									$fname = $getdata->GetObjectById($a_id,"first_name");
									$lname = $getdata->GetObjectById($a_id,"last_name");
									echo ucwords($fname)."&nbsp;";
									echo ucwords($lname);
									//echo $temdes= $getinformation->GetObjectById($a_id,"designation");									
								?>
							</div>
							<div class="update_status_span_3"><?php echo $getstatus->status_messages; ?></div>
						</div>
				<?php	
					}
			 }
				else
				{
			?>
					<div class="update_status_row">
						No Status Update Till now.
					</div>
			<?php
				}
			?>
	</div>