<?php 
ob_start();
ini_set('display_errors',1);  
error_reporting(E_ALL);
$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
include('header.php');
require_once($config);
include('../classes/login-functions.php');
if(loggedin()) 
{
/*Class file to call the functions*/
$u_id      = $_REQUEST['uid'];
$form_id   = $_REQUEST['fid'];
?>
<section class="row">
	<div class="container doctor_innerpanel">
		<div class="client_personal_info">
			<div class="personal_info_left">
				<div class="personal_row">
					<?php 
						/* get info by id */
						
					?>
					<div class="personal_row_left">
						<label>Client Name :-</label>
					</div>
					<div class="personal_row_right">
						<label>
							<?php 
								//$f_name = $functions->GetObjectById($u_id,"first_name"); 
								//$l_name = $functions->GetObjectById($u_id,"last_name"); 
								//echo ucwords($f_name)."&nbsp;".ucwords($l_name);
								//$functions->GetInfoFrompi($var1,$var2)
								$name = $functions->GetInfoPlantiffInformation('plantiff_name',$_REQUEST['fid']);
								echo ucwords($name);
							?>
						</label>
					</div>
				</div>
				<div class="personal_row">
					<div class="personal_row_left">
						<label>Email Address :-</label>
					</div>
					<div class="personal_row_right">
						<label><?php echo $functions->GetInfoPlantiffInformation("client_email",$_REQUEST['fid']); ?></label>
					</div>
				</div>
				<div class="personal_row">
					<div class="personal_row_left">
						<label>Date of Birth :-</label>
					</div>
					<div class="personal_row_right">
						<label><?php echo $functions->GetInfoPlantiffInformation("p_d_o_b",$_REQUEST['fid']); ?></label>
					</div>
				</div>
			</div>
			<div class="personal_info_right">
				<div class="personal_row">
					<div class="personal_row_left">
						<label>Contact No. :-</label>
					</div>
					<div class="personal_row_right">
						<label>
							<?php  
								echo $c_no = $functions->GetInfoPlantiffInformation("p_home_no",$_REQUEST['fid']); 
							?>
						</label>
					</div>
				</div>
				<div class="personal_row">
					<div class="personal_row_left">
						<label>Address :-</label>
					</div>
					<div class="personal_row_right">
						<label>
							<?php 
								echo $add  = $functions->GetInfoPlantiffInformation("p_address",$_REQUEST['fid']); 
							?>
							</label>
					</div>
				</div>
				<div class="personal_row">
					<div class="personal_row_left">
						<label>City :-</label>
					</div>
					<div class="personal_row_right">
						<label>
							<?php 
								echo $add  = $functions->GetInfoPlantiffInformation("p_city",$_REQUEST['fid']);
							?>
						</label>
					</div>
				</div>
			</div>
			<?php
				if(isset($_POST['appt_sch']))
				{
					$caseType                = $functions->GetInfoPlantiffInformation("case_type",$_REQUEST['fid']);
					$pName                   = $functions->GetInfoPlantiffInformation("plantiff_name",$_REQUEST['fid']);
					$caseName                = $functions->getNameCase($caseType);
					$frm_id                  = $_REQUEST['fid'];
					$us_id                   = $_REQUEST['uid'];
					$m_u_n                   = $_SESSION['username'];
					$appt_time               = $_POST['appt_time'];
					$location                = $_POST['location'];
					$app_type                = $_POST['app_type'];
					@$medical_clearance      = $_POST['medical_clearance'];
					@$medical_clearance_area = $_POST['medical_clearance_area'];
					@$due_by_date            = $_POST['due_by_dates'];
					@$travel_remarks         = $_POST['travel_remarks'];
					@$travel_remarks_area    = $_POST['travel_remarks_area'];
					@$other_remarks          = $_POST['other_remarks'];
					@$other_remarks_area     = $_POST['other_remarks_area'];
					$date_time               = date('d-m-Y h:i:s');
					
					list($ddateapp,$ttimeapp)= explode("/",$appt_time);
					
					$dateapporig             = $ddateapp;
					
					if(isset($due_by_date) && $due_by_date!="" )
					{
						@list($duedatea,$duetimea)= explode("/",$due_by_date);
						@$duedateorginal          = $duedatea;
					}
					
					$fields                  = array("form_id"=>$frm_id,
													"user_id"=>$us_id,
													"main_user_id"=>$doctor_id,
													"date_appt"=>$appt_time,
													"location"=>$location,
													"app_type"=>$app_type,
													"m_c_r"=>$medical_clearance,
													"m_c_r_a"=>$medical_clearance_area,
													"due_by_date"=>$due_by_date,
													"travel_remarks"=>$travel_remarks,
													"travel_remarks_area"=>$travel_remarks_area,
													"other_remarks"=>$other_remarks,
													"other_remarks_area"=>$other_remarks_area,
													"date_time"=>$date_time);
											
					$insert                  = $functions->Insert($fields,"appointment_doctor"); 
					$p_d_o_b                 = $functions->GetInfoPlantiffInformation("p_d_o_b",$_REQUEST['fid']);
					$bestcontact             = $functions->GetInfoPlantiffInformation("p_home_no",$_REQUEST['fid']);
					$allHired                = $functions->getHiredStaff($_REQUEST['fid']);
					
					$message_status          = "An Appointment was Scheduled for ".$pName." on ".$dateapporig."-".$ttimeapp;
					
					
					
					//Check to see that fields are filled or not.
					if(isset($medical_clearance))
					{	
						$message_status     .= ". A Medical Clearance Remark was added:(".$medical_clearance_area.") which must be completed before ".$duedateorginal."-".$duetimea;
					}
					if(isset($travel_remarks))
					{
						$message_status     .= ". A Travel Remark was added:(".$travel_remarks_area.")";
					}
					if(isset($other_remarks))
					{
						$message_status     .= ". A Other Remark was added:(".$other_remarks_area.")";
					}
					
					//end.

					$messageSaved = "The Client Listed Cancelled their appointment which was scheduled on (".$appt_time.")";
					$message = mysql_query("INSERT INTO `message_sent` (`form_id`,`user_id`,`sent_by`,`main_user_id`,`message`,`date_message`) VALUES ('$_REQUEST[fid]','$_REQUEST[uid]','$doctor_id','$allHired','$message_status',now())") or die(mysql_error());
					
					/*Mail function used to send to all the professionals*/
					$getAllProffes 			= mysql_query("SELECT * FROM `hire_staff` WHERE `form_id`='$_REQUEST[fid]' AND `user_id`='$_REQUEST[uid]'") or die(mysql_error());
					$clientNamed = ucwords($functions->GetInfoPlantiffInformation("plantiff_name",$_REQUEST['fid'])); 
					while($professionals    = mysql_fetch_object($getAllProffes))
					{
						$hire_id  			= $professionals->hire_id;
						$emailProffesionals = $functions->GetObjectById($hire_id,"email_id");
						/*
							Get the details of the professionals
						*/
						
						$dfirst_name		= ucwords($functions->GetObjectById($hire_id,"first_name"));
						$dlast_name 		= ucwords($functions->GetObjectById($hire_id,"last_name"));
						$p_d_o_bs           = $functions->GetInfoPlantiffInformation("p_d_o_b",$_REQUEST['fid']);
						$designations  		= $functions->GetObjectById($hire_id,"designation");
						$desgName      		= $functions->GetDesgBydesId($designations);
						/*
							Case id by using the table plantiff_case_ifno
						*/
						$case_id 			= $functions->Getcidbyformid($form_id);
						
						$docfirst_name      = $functions->GetObjectById($hire_id,"first_name");
						$doclast_name       = $functions->GetObjectById($hire_id,"last_name");
						
						/*
							get client information
						*/
						//die();
						
						$message    = "";
						$message   .= '<html><body>';
						$message   .= '<img src="https://'.$_SERVER['HTTP_HOST'].'/images/logo.png" alt="Appointment Scheduled" />';

						$message   .= '<table rules="all" cellpadding="0" cellspacing="5" border="0" style="font-size:17px;color:#000; border:1px solid #0665be; border-radius:5px;">';

						$message   .='<tr><td style="background: none repeat scroll 0 0 #3a9df8;border-top-left-radius: 5px;border-top-right-radius: 5px;color: #fff;font: 15px MemphisLTStd-Medium;padding: 15px 0;text-align: center;">';
						
						$message .='<h1>From Mayo to '.$docfirst_name.'&nbsp;'.$doclast_name.' – '.$functions->GetAppById($app_type).'</h1></td></tr>';
						//$message .='<tr><td align="center"><h2 style="color:#f6801f;">'.$caseName.'</h2></td></tr>';
						
						$message .='<tr><td><h2>Dear '.$dfirst_name.'&nbsp;'.$dlast_name.'</h2></td></tr>';
						
						$message .='<tr><td align="center">Your Client '.$clientNamed.' has been scheduled for a '.$functions->GetAppById($app_type)." on ";
						$message .="Date: ";
						$message .= $dateapporig;
						$message .="at";
						$message .= $ttimeapp;
						$message .='<tr>
										<td>
											<table width="100%">
												<tr>
													<td width="18%"><strong>Client Name:</strong></td>
													<td width="82%"><strong>'.$clientNamed.'</strong></td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td>
											<table width="100%">
												<tr>
													<td width="18%"><strong>Contact No:</strong></td>
													<td><strong>'.$bestcontact.'</strong></td>
												</tr>
											</table>
										</td>
									</tr>'; 
						$message .='<tr><td>Please login into <a href="mayosurgical.com">Mayo Surgical</a> for further information.</td></tr>';
						$message .='<tr><td> If you have any questions please call us at 1-866-411-2525.</td></tr>';
						$message .='<tr><td>Thank You,</td></tr>';
						$message .='<tr><td>Mayo Surgical, LLC</td></tr>';
						$message .='<tr><td>DO NOT REPLY TO THIS MESSAGE. THIS EMAIL IS NOT MONITORED.</td></tr>';
						$message .='</table>';
						
						$to       = $emailProffesionals; 
						//$functions->GetObjectById($attManId,"email_id");
						$subject  ='From Mayo to – '.$functions->GetAppById($app_type);
						$headers  ="From: Mayo Surgical\r\n";
						$headers .="Reply-To: mayosurical.com\r\n";
						$headers .="MIME-Version: 1.0\r\n";
						$headers .="Content-Type: text/html; charset=UTF-8";
						
						mail($to, $subject, $message, $headers);

					}
					if($insert == 1)
					{
						echo "<div class='thank_message'>Appointment has been Scheduled</div>";
						//header("refresh:3;url=/doctors/appointment-status.php?fid=$_REQUEST[fid]&uid=$_REQUEST[uid]");
					}
					else
					{
						echo "<div class='thank_message'>Some thing Went Wrong. Please Retry.</div>";
					}
					
				} 
			?>
		</div>
		<div class="info_heading_left"><h1>Client Appointments</h1></div>
		<div class="anesth_box_bg">
			<div class="anesth_row_heading">
				<div class="dr_new_client_d1">Client No.</div>
				<div class="dr_new_client_d2">Client Name</div>
				<div class="dr_new_client_d3">Date of Birth</div>
				<div class="dr_new_client_d4">Appointment Date</div>
				<div class="dr_new_client_d5">Appointment History</div>
				<div class="dr_new_client_d6">Client Information</div>
				<div class="dr_new_client_d7">Upload Report</div>
			</div>
	<?php
		$tempApt = mysql_query("SELECT * FROM `appointment_doctor` WHERE `form_id`='$_REQUEST[fid]' && `user_id`='$_REQUEST[uid]'") or die(mysql_error());
		if(mysql_num_rows($tempApt)>0)
		{
			while($data = mysql_fetch_object($tempApt))
			{
	?>
				
				<div class="anesth_row_content">
				
					<div class="dr_new_client_d1">
						<?php 
							echo $form_id = $_REQUEST['fid']; 
						?>
					</div>
					<div class="dr_new_client_d2">
						<?php
							$user_id = $_REQUEST['uid'];
							$name = $functions->GetInfoPlantiffInformation('plantiff_name',$form_id);
							echo ucwords($name);
						?>
					</div>
					<div class="dr_new_client_d3">
						<?php
							echo $d_o_b          = $functions->GetInfoPlantiffInformation("p_d_o_b",$form_id);
						?>
					</div>
					<div class="dr_new_client_d4">
						<?php
						 $temp_date_t = $data->date_appt;
						 list($dates,$time) = explode("/",$temp_date_t);
						 
						 echo $date_tiem   = $dates;
						?>
					</div>
					<div class="dr_new_client_d5">
						<a href="appointment-status.php?fid=<?php echo $_REQUEST['fid'];?>&uid=<?=$user_id ?>&id=<?=$data->appt_id?>&action=status" class="dr_appointment">Appointment</a>
					</div>		
					<div class="dr_new_client_d6">
						<a href="check-status.php?fid=<?php echo $_REQUEST['fid'];?>&uid=<?=$user_id ?>" class="dr_check_status">Appointment</a>
					</div>	
					<div class="dr_new_client_d7">
						<a href="schedulling-report.php?fid=<?php echo $_REQUEST['fid'];?>&uid=<?=$user_id ?>&appid=<?=$data->appt_id?>" class="dr_check_status">Appointment</a>
					</div>											
				</div>
				
<?php
			}
		}
			else 
			{
				echo '<div class="anesth_row_content">No Appointment Scheduled.</div>';
	}
?>
				</div>
		<div class="client_full_info">
			<div class="client_info_heading">
				<div class="info_heading_left">
					<h1>Client Case Information</h1>
				</div>
			</div>
<!-- function validation()
	{
		var med = document.getElementById("med_c").checked;
		var medtext = document.getElementById("medical_area").value;
		
		//check travel remarks
		
		var travel = document.getElementById("travel_remarkss").checked;
		var travelArea = document.getElementById("travel_remarks_area").value;
		
		//check other remarks
		
		var other = document.getElementById("other_remarks").checked;
		var other_remarks = document.getElementById("other_remarks_area").value;
		
		//alert(medtext);
		if(med == true)
		{
			
			if(medtext=="" || medtext == null )
			{
				//alert("error2");
				document.getElementById('medical_error').innerHTML="Please Enter the Medical Remarks";
				return false;
			}
		}	
		else
		{
				//alert("fine");
			document.getElementById('medical_error').innerHTML="";
			return true;
		}

		//validation for travel
		
		if(travel == true)
		{
			alert("hello");
			if(travelArea=="" || travelArea == null )
			{
				//alert("error2");
				document.getElementById('travel_error').innerHTML="Please Enter the Travel Remarks";
				return false;
			}
		}
		else
		{
			//alert("fine");
			document.getElementById('travel_error').innerHTML="";
			return true;
		}
		
		if(other == true)
		{
			
			if(other=="" || other == null )
			{
				//alert("error2");
				document.getElementById('other_error').innerHTML="Please Enter the Travel Remarks";
				return false;
			}
		}
		else
		{
			//alert("fine");
			document.getElementById('other_error').innerHTML="";
			return true;
		}
	}-->
	<script type="text/javascript">
	
	function validationt()
	{

		var med_c   = document.getElementById("med_c").checked;
		var other_remarks = document.getElementById("other_remarrks").checked;
		var other_remarks_area = document.getElementById("other_remarrks_area").value;
		var travelr = document.getElementById("travel_remarkss").checked;
		var medtext = document.getElementById("medical_area").value;
		var duedate = document.getElementById("dtp_input2").value;
		var travel_remarkss_area = document.getElementById("travel_remarks_area").value;
		if((med_c==true) && (medtext == ""))
		{
			document.getElementById('medical_error').innerHTML = "Please Enter the Medical Remarks";
			
			return false;
		}
		else if((med_c==true) && (duedate==""))
		{
			document.getElementById('duedate_error').innerHTML = "Please Enter the Date";
			return false; 
		}
		else if((travelr==true) && (travel_remarkss_area==""))
		{
			document.getElementById('travel_error').innerHTML="Please Enter the Travel Remarks";
			return false;
		}
		else if((other_remarks==true) && (other_remarks_area==""))
		{
			document.getElementById("other_error").innerHTML="Please Enter the Other Remarks";
			return false;
		}
		
		else{
			document.getElementById('medical_error').innerHTML = "";
			document.getElementById('duedate_error').innerHTML = "";
			document.getElementById('travel_error').innerHTML  = "";
			document.getElementById('other_error').innerHTML  = "";
			return true;
		}
			
	}
	</script>
			<div class="client_info_details">
				<h1>Appointment Schedule</h1>
				
				<form name="schedule_appt" id="schedule_appt" method="post" action="">
					<div class="client_row">
					<div class="client_left">
						<label>Appointment Date Time:-</label>
						
						 <div class="controls input-append date form_datetime" data-date="<?php echo date('Y-m-d'); ?>T05:25:07Z" data-date-format="mm-dd-yyyy / HH:ii p" data-link-field="dtp_input1">
							<input size="16" name="appt_time" type="hidden" value="" readonly required="required" />
							<input type="text" name="appt_times" id="dtp_input1"  value="" required="required" />
							<span class="add-on"><i class="icon-remove"></i></span>
							<span class="add-on"><i class="icon-th"></i></span>
						</div>
<br/>
					</div>
						<div class="client_right">
							<label>Locations:-</label>
							<input type="text" name="location" value="<?php echo $add1  = $functions->GetObjectById($doctor_id,"address"); ?>" id="" required />
						</div>
						
						<div class="client_right">
							<label>Schedule Type:-</label>
							<?php $functions->GetAppointments(); ?>
						</div>
					</div>
					<div class="client_row">
						<h3> Appointment Requirement:- </h3>
					</div>
					<div class="client_row row_border">
						<label>
							<input type="checkbox" id="med_c" name="medical_clearance" onclick="" value="yes" />Medical Clearance Remarks</label>
							<textarea id="medical_area" name="medical_clearance_area"></textarea>
						<span id="medical_error" class="error"></span>
						<label>Due  by Date</label>
						<div class="controls input-append date form_datetime" value=" " data-date="<?php echo date('Y-m-d'); ?>T05:25:07Z" data-date-format="mm-dd-yyyy / HH:ii p" data-link-field="dtp_input2">
						<input size="16" name="due_by_dates" id="duebydate" type="hidden" value="" readonly />
						<input type="text" name="due_by_date" id="dtp_input2"  value="" />
						<span class="add-on"><i class="icon-remove"></i></span>
						<span class="add-on"><i class="icon-th"></i></span>
						
					</div><span id="duedate_error" class="error"></span><br/>
					</div>
					<div class="client_row row_border">
						<label><input type="checkbox" name="travel_remarks" value="yes" id="travel_remarkss" />Travel Remarks</label>
						<textarea name="travel_remarks_area" id="travel_remarks_area"></textarea>
						<span id="travel_error" class="error"></span>
					</div>
					<div class="client_row">
						<label><input type="checkbox" name="other_remarks" value="yes" id="other_remarrks" />Other Remarks</label>
						<textarea name="other_remarks_area" id="other_remarrks_area"></textarea>
						<span id="other_error" class="error"></span>
					</div>
				<div class="client_row">
					<input type="submit" name="appt_sch" id="" onclick="return validationt();" value="Submit"/>
				</div>
				</form>
			
			</div>			
		<!--<div class="client_status_bg">
			<h1>Client Status</h1>
			<form name="update_status" method="post" action="">
				<div class="client_row">
					<label>Status Short Note:-</label>
					<textarea name="status"></textarea>
				</div>
				<div class="client_row">
					<input type="submit" name="up_status" id="" value="Submit"/>
				</div>
			</form>
			<?php
				/*if(isset($_POST['up_status']))
				{
					
					$form_id         = $_REQUEST['fid'];
					$user_id         = $_REQUEST['uid'];
					$status_messages = $_POST['status'];
					$date_time       = date('Y-m-d H:i:s');
					$fields   		 = array('form_id'=>$form_id,'user_id'=>$user_id,'main_user_id'=>$doctor_id,'status_messages'=>$status_messages,
					'date_status'=>$date_time);
					$table_name      = "status_update";
					$temp_upd   = $functions->Insert($fields,$table_name);
					$u_email    = $functions->GetObjectById($user_id,"email_id");
					$subject         = "Status Update From Doctor.Your Schedule has been Cosnsulted";
					$message         = "Your Schedule has been Cosnsulted";
					$extravalues     = array("First Name"=>$d_f_name,"Last Name"=>$d_l_name,"Contact Number"=>$contactn);
					$email           = $functions->SendEmail($u_email,$subject,$message,$extravalues);
					if($temp_upd = 1)
					{
						echo "<div class='e_messages'>Status has been Sucessfully Updated";
					}
				}*/
			?>
		</div>
	</div>-->
</div>
</section>
<script type="text/javascript" src="<?php echo $sitepath; ?>/timepicker/sample in bootstrap v2/jquery/jquery-1.8.3.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo $sitepath; ?>/timepicker/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<link href="<?php echo $sitepath; ?>/timepicker/sample in bootstrap v2/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="<?php echo $sitepath; ?>/timepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

<script type="text/javascript">
    $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1,
		locale: 'ru'
    });
</script>
<?php
require($get_footer);
?>
<?php 
}
else
{
header('Location:../login.php');
} 
?>
