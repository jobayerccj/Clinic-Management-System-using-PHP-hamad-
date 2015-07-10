<?php
ini_set('display_errors',1);  
error_reporting(E_ALL);
$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
include($config);
include '../functions.php';
$functions  = $pathofmayo."/classes/functions.php";
include($functions);

$username = $_SESSION['username'];
//$functions = new AllFunctions();

include('../../allpanels/allpanels.php');
//class file calling from attorney panel
$functions = new AllPanels();
$doctor_id = $functions->GetObjectByUsername("id",$username);
if(loggedin())
{
	include('header.php');
?>
<link rel="stylesheet" href="admin-style.css" type="text/css">
<section class="row">
	<div class="container">
		<div class="form_section_content">
			<h1 class="add_user">Re-Schedule</h1>
			<?php
			if(isset($_POST['delete']))
					{
						$form_id                = $_REQUEST['fid'];
						$frm_id                 = $_REQUEST['fid'];
						$m_u_n                  = $_SESSION['username'];
						$appType                = $functions->getInfoAppointment("app_type",$_REQUEST['id']);
						$p_name                 = $functions->GetInfoPlantiffInformation("plantiff_name",$_REQUEST['fid']);
						$message_status         = $p_name." Appointment is Cancelled on ".date('m-d-Y');
						$status_update          = mysql_query("INSERT INTO `status_update` (`form_id`,`user_id`,`main_user_id`,`status_messages`,`date_status`) VALUES ('$_REQUEST[fid]','$_REQUEST[uid]','$doctor_id','$message_status',now())") or die(mysql_error());
						/*Mail function used to send to all the professionals*/
						$getAllProffes 			= mysql_query("SELECT * FROM `hire_staff` WHERE `form_id`='$_REQUEST[fid]'") or die(mysql_error());
						
						//Using app id get here the dateof appt
						$date_appt_d            = $functions->getInfoAppointment("date_appt",$_REQUEST['id']);
						list($dateorig,$timeorig)   = explode("/",$date_appt_d);
						while($professionals    = mysql_fetch_object($getAllProffes))
						{
							$hire_id  			= $professionals->hire_id;
							$emailProffesionals = $functions->GetObjectById($hire_id,"email_id");
							/*
								Get the details of the professionals
							*/
							
							$dfirst_name		= ucwords($functions->GetObjectById($hire_id,"first_name"));
							$dlast_name 		= ucwords($functions->GetObjectById($hire_id,"last_name"));
							$designation        = $functions->GetObjectById($hire_id,"designation");
							$desgName           = $functions->GetDesgBydesId($designation);
							/*
								Case id by using the table plantiff_case_ifno
							*/
							$case_id 			= $functions->Getcidbyformid($form_id);
							
							/*
								get client information
							*/
							$caseType  	= $functions->GetInfoPlantiffInformation("case_type",$_REQUEST['fid']);
							$caseName 	= $functions->getNameCase($caseType);
							$clientName = $functions->GetInfoPlantiffInformation("plantiff_name",$_REQUEST['fid']); 
							$p_d_o_b 	= $functions->GetInfoPlantiffInformation("p_d_o_b",$_REQUEST['fid']);
							$bestcontact= $functions->GetInfoPlantiffInformation("p_home_no",$_REQUEST['fid']);
							$p_d_o_bs   = $functions->GetInfoPlantiffInformation("p_d_o_b",$_REQUEST['fid']);
							$clientNamed= ucwords($functions->GetInfoPlantiffInformation("plantiff_name",$_REQUEST['fid']));
							
							$message    = "";
							$message   .= '<html><body>';
							$message   .= '<img src="https://'.$_SERVER['HTTP_HOST'].'/images/logo.png" alt="Appointment Cancelled" />';

							$message   .= '<table rules="all" cellpadding="0" cellspacing="5" border="0" style="font-size:17px;color:#000; border:1px solid #0665be; border-radius:5px;">';

							$message   .='<tr><td style="background: none repeat scroll 0 0 #3a9df8;border-top-left-radius: 5px;border-top-right-radius: 5px;color: #fff;font: 15px MemphisLTStd-Medium;padding: 15px 0;text-align: center;">';
							
							$message .='<h1>Appointment Cancelled Notice</h1></td></tr>';
							//$message .='<tr><td align="center"><h2 style="color:#f6801f;">'.$caseName.'</h2></td></tr>';
							
							$message .='<tr><td><h2>Dear '.$dfirst_name.'&nbsp;'.$dlast_name.'</h2></td></tr>';
							
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
							
							$message .='<tr><td width="100%" align="center">The Client Listed Cancelled their appointment which was scheduled on Date: '.$dateorig.'at'.$timeorig.'.Please contact the customer to reschedule</td></tr>';
							$message .='<tr><td>Please login into <a href="mayosurgical.com">Mayo Surgical</a> for further information.</td></tr>';
							$message .='<tr><td width="100%" align="center"> If you have any questions please call us at 1-866-411-2525.</td></tr>';
							$message .='<tr><td width="100%" align="center">Thank You,</td></tr>';
							$message .='<tr><td width="100%" align="center">Mayo Surgical, LLC</td></tr>';
							$message .='<tr><td>DO NOT REPLY TO THIS MESSAGE. THIS EMAIL IS NOT MONITORED.</td></tr>';
							$message .='</table>';
							
							
							$to       = $emailProffesionals; 
							//$functions->GetObjectById($attManId,"email_id");
							$subject  ='From Mayo to '.$desgName.'-'.$functions->GetAppById($appType);
							$headers  ="From: Mayo Surgical\r\n";
							$headers .="Reply-To: mayosurical.com\r\n";
							$headers .="MIME-Version: 1.0\r\n";
							$headers .="Content-Type: text/html; charset=UTF-8";
							
							mail($to, $subject, $message, $headers);
						}
						$allHired = $functions->getHiredStaff($_REQUEST['fid']);
						$messageSaved = "The Client Listed Cancelled their appointment which was scheduled on Date:".$dateorig."at".$timeorig.")";
						
						$message = mysql_query("INSERT INTO `message_sent` (`form_id`,`user_id`,`sent_by`,`main_user_id`,`message`,`date_message`) VALUES ('$_REQUEST[fid]','$_REQUEST[uid]','$doctor_id','$allHired','$messageSaved',now())") or die(mysql_error());
						$deleteAppt = mysql_query("DELETE FROM `appointment_doctor` WHERE `appt_id` = '$_REQUEST[id]' && `form_id` = '$_REQUEST[fid]'") or die(mysql_error());
						if($deleteAppt)
						{
							echo "<div class='thank_message'>Appointment is Cancelled.</div>";
							echo "<script>
							alert('Appointment is Cancelled');
								window.close();
							</script>";
						}
						else
						{
							echo "<div class='thank_message'>Something Going Wrong. Please Try Again  Later Thanks.</div>";
						}
					}
					
					if(isset($_POST['appt_sch']))
					{
						$form_id                = $_REQUEST['fid'];
						$frm_id                 = $_REQUEST['fid'];
						$m_u_n                  = $_SESSION['username'];
						$appt_time              = $_POST['appt_time'];
						list($w,$x)             = explode("/",$appt_time);
						$location               = $_POST['location'];
						$app_type               = $_POST['app_type'];
						@$medical_clearance      = $_POST['medical_clearance'];
						@$medical_clearance_area = $_POST['medical_clearance_area'];
						@$due_by_date            = $_POST['due_by_date'];
						@list($s,$u)             = explode("/",$due_by_date);
						@$travel_remarks        = $_POST['travel_remarks'];
						@$travel_remarks_area   = $_POST['travel_remarks_area'];
						@$other_remarks         = $_POST['other_remarks'];
						@$other_remarks_area    = $_POST['other_remarks_area'];
						$date_time              = date('d-m-y h:i:s');
						$pName    				= $functions->GetInfoPlantiffInformation("plantiff_name",$_REQUEST['fid']);
						$message_status         = "Appointment is Re-Scheduled on " .$w."-".$x." of Client Name ".$pName;
						$status_update          = mysql_query("INSERT INTO `status_update` (`form_id`,`user_id`,`main_user_id`,`status_messages`,`date_status`) VALUES ('$_REQUEST[fid]','$_REQUEST[uid]','$doctor_id','$message_status',now())") or die(mysql_error());
						/*Mail function used to send to all the professionals*/
						
						$p_d_o_b                = $functions->GetInfoPlantiffInformation("p_d_o_b",$_REQUEST['fid']);
						$bestcontact            = $functions->GetInfoPlantiffInformation("p_home_no",$_REQUEST['fid']);
					
						$getAllProffes 			= mysql_query("SELECT * FROM `hire_staff` WHERE `form_id`='$_REQUEST[fid]'") or die(mysql_error());
						$clientNamed = $functions->GetInfoPlantiffInformation("plantiff_name",$_REQUEST['fid']);
						while($professionals    = mysql_fetch_object($getAllProffes))
						{
							$hire_id  			= $professionals->hire_id;
							$emailProffesionals = $functions->GetObjectById($hire_id,"email_id");
							$designations  		= $functions->GetObjectById($hire_id,"designation");
							$desgName      		= $functions->GetDesgBydesId($designations);
							/*
								Get the details of the professionals
							*/
							
							$dfirst_name		= ucwords($functions->GetObjectById($hire_id,"first_name"));
							$dlast_name 		= ucwords($functions->GetObjectById($hire_id,"last_name"));
							
							/*
								Case id by using the table plantiff_case_ifno
							*/
							$case_id 			= $functions->Getcidbyformid($form_id);
							
							/*
								get client information
							*/
							$caseType 			= $functions->GetInfoPlantiffInformation("case_type",$_REQUEST['fid']);
							$caseName 			= $functions->getNameCase($caseType);
							$p_d_o_bs           = $functions->GetInfoPlantiffInformation("p_d_o_b",$_REQUEST['fid']);
							
							$message    = "";
							$message   .= '<html><body>';
							$message   .= '<img src="https://'.$_SERVER['HTTP_HOST'].'/images/logo.png" alt="Re-Scheduled" />';

							$message   .= '<table rules="all" cellpadding="0" cellspacing="5" border="0" style="font-size:17px;color:#000; border:1px solid #0665be; border-radius:5px;">';

							$message   .='<tr><td style="background: none repeat scroll 0 0 #3a9df8;border-top-left-radius: 5px;border-top-right-radius: 5px;color: #fff;font: 15px MemphisLTStd-Medium;padding: 15px 0;text-align: center;">';
							
							$message .='<h1>From Mayo to '.$functions->GetObjectById($hire_id,"first_name").'-'.$functions->GetAppById($app_type).'</h1></td></tr>';
							//$message .='<tr><td align="center"><h2 style="color:#f6801f;">'.$caseName.'</h2></td></tr>';
							
							$message .='<tr><td><h2>Dear '.$dfirst_name.'&nbsp;'.$dlast_name.'</h2></td></tr>';
							
							//$message .='<tr><td align="center">Your Client ('.ucwords($clientNamed).') has been Re-Scheduled for '.$functions->GetAppById($app_type).' on <'.$w.'-'.$x.'></td></tr>';
							
							$message .='<tr><td align="center">Your Client ('.ucwords($clientNamed).') has been Re-Scheduled for ';
							if($app_type==1)
							{
								$message .= 'an ';
							}
							else
							{
								$message .= 'a '; 
							}

							$message .= $functions->GetAppById($app_type)." on Date: ".$w."at".$x."</td></tr>";

							
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
													<td width="18%"><strong>Date of Birth:</strong></td>
													<td><strong>'.$p_d_o_bs.'</strong></td>
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
							$message .='</table></td></tr>';
							$message .='<tr><td>DO NOT REPLY TO THIS MESSAGE. THIS EMAIL IS NOT MONITORED.</td></tr>';
							
							$to       = $emailProffesionals; 
							//$functions->GetObjectById($attManId,"email_id");
							$subject  ='From Mayo to '.$desgName.'-'.$functions->GetAppById($app_type);
							$headers  ="From: Mayo Surgical\r\n";
							$headers .="Reply-To: mayosurical.com\r\n";
							$headers .="MIME-Version: 1.0\r\n";
							$headers .="Content-Type: text/html; charset=UTF-8";
							
							mail($to, $subject, $message, $headers);
						}
						$updateAppoint            = mysql_query("UPDATE `appointment_doctor` SET 
							`date_appt`           = '$appt_time',
							`location`            = '$location',
							`app_type`       	  = '$app_type',
							`m_c_r`          	  = '$medical_clearance',
							`due_by_date`    	  = '$due_by_date',
							`m_c_r_a`        	  = '$medical_clearance_area',
							`travel_remarks`	  = '$travel_remarks',
							`travel_remarks_area` = '$travel_remarks_area',
							`other_remarks`       = '$other_remarks',
							`other_remarks_area`  = '$other_remarks_area',
							`date_time`           = '$date_time'
							WHERE `appt_id`       = '$_REQUEST[id]'
							") or die(mysql_error());
						$message_status         = "Appointment is fixed on".$appt_time."to".$due_by_date;
						if($updateAppoint == 1)
						{
							echo "<div class='thank_message'>Appointment has been Re-Scheduled</div>";
							echo "<script>
							alert('Appointment is Re-Scheduled');
								window.close();
							</script>";
						}
						else
						{
							echo "<div class='thank_message'>Some thing Went Wrong. Please Retry.</div>";
						}
						
					}
					?>
			<div class="client_info_details">
							<h1>Re-Schedule / Cancel Appointment</h1>

							<div class="anesth_dashbord_client">
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
											//$name = $functions->GetInfoFrompi('plantiff_name',$_REQUEST['uid']);
											$name = $functions->GetInfoPlantiffInformation("plantiff_name",$_REQUEST['fid']);
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
									<label><?php echo $functions->GetInfoPlantiffInformation("p_email_address",$_REQUEST['fid']);  ?></label>
								</div>
							</div>
							<div class="personal_row">
								<div class="personal_row_left">
									<label>Date of Birth :-</label>
								</div>
								<div class="personal_row_right">
									<label>
										<?php 
											echo $dob = $functions->GetInfoPlantiffInformation("p_d_o_b",$_REQUEST['fid']);
											//echo ucwords($name); 
										?>
									</label>
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
											//echo $mob_no = $functions->GetInfoFrompi('p_mob_no',$_REQUEST['uid']);
											echo $mob_no = $functions->GetInfoPlantiffInformation("p_home_no",$_REQUEST['fid']);
											//echo ucwords($name);
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
											echo $functions->GetInfoPlantiffInformation("p_address",$_REQUEST['fid']);
											echo " , ";
											$state = $functions->GetInfoPlantiffInformation("p_state",$_REQUEST['fid']);
											//$state = $functions->GetInfoFrompi('p_state',$_REQUEST['uid']);
											echo $functions->GetStatebyStateCode($state);
											
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
											//echo $p_city = $functions->GetInfoFrompi('p_city',$_REQUEST['uid']);
											echo $p_city=$functions->GetInfoPlantiffInformation("p_city",$_REQUEST['fid']);
										?>
									</label>
								</div>
							</div>
						</div>
					</div>
					<?php 
						$tempAppt = mysql_query("SELECT * FROM `appointment_doctor` WHERE `form_id`='".$_REQUEST['fid']."' and `appt_id` = '$_REQUEST[id]'") or die(mysql_error());
						$appt = mysql_fetch_object($tempAppt);
						//echo $appt->date_appt;
						//{
						//	echo $vik;
						//}
					?>	
					<form name="schedule_appt" method="post" action="">
					<div class="client_row">
						<div class="client_left">
						<label>Appointment Date Time:-</label>
						
						 <div class="controls input-append date form_datetime" data-date="<?php echo date('Y-m-d'); ?>T05:25:07Z" data-date-format="mm-dd-yyyy / HH:ii p" data-link-field="dtp_input1">
							<input size="16" name="appt_time" type="text" value="<?php echo $appt->date_appt; ?>" readonly required />
							<span class="add-on"><i class="icon-remove"></i></span>
							<span class="add-on"><i class="icon-th"></i></span>
						</div>
						<input type="hidden" id="dtp_input1"  value="" required /><br/>
					</div>
						<div class="client_right">
							<label>Locations:-</label>
							<input type="text" name="location" value="<?php echo $appt->location; ?>" id="" required />
						</div>
						
						<div class="client_right">
							<label>Schedule Type:-</label>
							<select name="app_type" required>
							
								<?php
									
									$appti = mysql_query("SELECT * FROM `appt_type`") or die(mysql_error());
									while($tappti = mysql_fetch_object($appti))
									{
								?>
									<option value="<?php echo $tappti->id; ?>" <?php if($tappti->id == $appt->app_type){echo 'selected="Selected"';} ?>><?php echo $tappti->type; ?></option>
								<?php
									}
								?>
							</select>
						</div>
					</div>
					<div class="client_row">
						<h3>Appointment Requirement:-</h3>
					</div>
				
					<div class="client_row row_border">
					<div class="client_left">
						<label><input type="checkbox" name="medical_clearance" id="" value="<?php echo $appt->m_c_r; ?>" <?php if($appt->m_c_r == " yes"){ echo 'checked="checked"';}?> />Medical Clearance Remarks</label>
						<textarea name="medical_clearance_area" /><?php echo $appt->m_c_r_a; ?></textarea>
						<span id="medical_error" class="error"></span>
						<label>Due  by Date</label>
						<div class="controls input-append date form_datetime" data-date="<?php echo date('Y-m-d'); ?>T05:25:07Z" data-date-format="mm-dd-yyyy / HH:ii p" data-link-field="dtp_input1">
						<input size="16" name="due_by_date" type="text" value="<?php echo $appt->due_by_date; ?>" readonly required />
						<span class="add-on"><i class="icon-remove"></i></span>
						<span class="add-on"><i class="icon-th"></i></span>
					</div>
					<input type="hidden" id="dtp_input1"  value="" required /><br/>
					</div>
					</div>
					
					<div class="client_row row_border">
						<label><input type="checkbox" name="travel_remarks" value="<?php echo $appt->travel_remarks; ?>" <?php if($appt->travel_remarks==" yes"){echo 'checked="checked"';} ?>/>Travel Remarks</label>
						<textarea name="travel_remarks_area"><?php echo $appt->travel_remarks_area; ?></textarea>
					</div>
					<div class="client_row">
						<label><input type="checkbox" name="other_remarks" value="<?php echo $appt->other_remarks; ?>" id="" <?php if($appt->other_remarks==" yes"){echo 'checked="checked"';} ?> />Other Remarks</label>
						<textarea name="other_remarks_area"><?php echo $appt->other_remarks_area; ?></textarea>
					</div>
					<div class="client_row">
						<input type="submit" name="appt_sch" id="" onclick="return validation();" value="Re-Schedule"/>
						<input type="submit" name="delete" id="" onclick="" value="Cancel"/>
					</div>
				</form>
				</div
			</div>
			
			</div>
		</div>
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
        showMeridian: 1
    });
</script>
</div>
	</div>
</section>
<?php
include($get_footer);
}
else
{
header('Location:../login.php');
}
?>
<style>



/*..client_status_css..*/
.client_personal_info{float:left; width:100%; padding:10px 0px;}
.personal_info_left{width:35%; float:left; margin:auto; height:auto;}
.personal_info_right{width:60%; float:right; margin:auto; height:auto;}

.personal_row{border-bottom:1px solid #ccc; padding:15px 0px; width:100%; float:left;}
.personal_row_left{width:38%; float:left; margin:auto; height:auto;}
.personal_row_left label{font:normal 13px open_sansregular; color:#333333;}

.personal_row_right{width:58%; float:right; margin:auto; height:auto;}
.personal_row_right label{font:normal 13px open_sansregular; color:#f6821f;}
.personal_row select{width:100%; font:normal 15px open_sansregular; display:inline-block; height:35px;}

.client_full_info{float:left; width:100%; padding:10px 0px;}
.client_info_heading{display:inline-block; width:100%; height:auto; padding:15px 0px 0px 0px;}
.info_heading_left{float:left; width:30%; height:auto; padding:25px 0px;}
.info_heading_left h1{font:normal 25px open_sanslight; color:#000; padding:0px 0px 10px 0px;}

.info_heading_right{float:right; width:69%; height:auto; padding:25px 0px;}
.info_heading_right ul{margin:0; padding:0; float:right;}
.info_heading_right ul li{position:relative; float:left; list-style:none; margin:0px 10px 0px 0px;}
.info_heading_right ul li:last-child{margin:0px 0px 0px 0px;}
.info_heading_right ul li  a{text-decoration:none; color:#000; display:block; font:normal 13px open_sansregular; text-align:center;}

.link_1{display:block; height:60px; width:100px; border:1px solid #ccc;}
.nav_icon_1{background:url(images/nav_appointment.png) no-repeat center; width:100%; height:35px; display:block;}
.nav_icon_2{background:url(images/nav_surgery.png) no-repeat center; width:100%; height:35px; display:block;}
.nav_icon_3{background:url(images/nav_client_report.png) no-repeat center; width:100%; height:35px; display:block;}
.nav_icon_4{background:url(images/nav_bill.png) no-repeat center; width:100%; height:35px; display:block;}
.nav_icon_5{background:url(images/nav_status.png) no-repeat center; width:100%; height:35px; display:block;}

.client_info_details{float:left; width:100%; padding:0px 0px 10px 0px;}
.client_info_details h1{background:#1b86e3; color:#fff; font:normal 22px open_sansregular; padding:8px; margin:0px 0px 20px 0px;}

.row_border{border-bottom:1px dashed #ccc; padding:0px 0px 25px 0px;  margin:0px 0px 25px 0px;}

.client_status_bg{width:100%; float:left; margin:auto;}
.client_status_bg h1{background:#ccc; color:#000; font:normal 22px open_sansregular; padding:8px; margin:0px 0px 20px 0px;}
.client_row select{width:100%; font:normal 15px open_sansregular; display:inline-block; height:35px;}

/*..cleint_status..*/
.client_status_heading{background:#ccc; width:100%; float:left; margin:auto; padding:15px 0px; text-align:center; font:normal 16px open_sansregular;}
.client_status_info{border-bottom:1px solid #ccc; width:100%; float:left; margin:auto; padding:15px 0px; text-align:center; font:normal 13px open_sansregular;}
.status_span_1{width:20%; float:left; margin:auto; height:auto;}
.status_span_2{width:20%; float:left; margin:auto; height:auto;}
.status_span_3{width:40%; float:left; margin:auto; height:auto;}
.status_span_4{width:20%; float:left; margin:auto; height:auto;}

.approve_status{background:url(images/approve_status.png) center no-repeat; text-indent:-99999px; display:block;}
.pending_status{background:url(images/pending_status.png) center no-repeat;text-indent:-99999px; display:block;}
.backward_status{background:url(images/backward_status.png) center no-repeat; text-indent:-99999px; display:block;}
.hold_status{background:url(images/hold_status.png) center no-repeat; text-indent:-99999px; display:block;}
</style>
