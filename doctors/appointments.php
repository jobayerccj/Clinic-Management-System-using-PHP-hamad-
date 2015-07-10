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

?>

<section class="row">
	<div class="container doctor_innerpanel">
		<div class="client_personal_info">
			<div class="anesth_dashbord_client">
			<?php
				/*************************Appointment Updates starts from here **************************/
					if(isset($_REQUEST['fid']) && isset($_REQUEST['id']) && $_REQUEST['action']=="delete")
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
							
							$message .='<tr><td width="100%" align="center">The Client Listed Cancelled their appointment which was scheduled on Date: '.$dateorig.'at'.$timeorig.')  Please contact the customer to reschedule</td></tr>';
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
						$messageSaved = "The Client Listed Cancelled their appointment which was scheduled on (".$dateorig."-".$timeorig.")";
						
						$message = mysql_query("INSERT INTO `message_sent` (`form_id`,`user_id`,`sent_by`,`main_user_id`,`message`,`date_message`) VALUES ('$_REQUEST[fid]','$_REQUEST[uid]','$doctor_id','$allHired','$messageSaved',now())") or die(mysql_error());
						$deleteAppt = mysql_query("DELETE FROM `appointment_doctor` WHERE `appt_id` = '$_REQUEST[id]' && `form_id` = '$_REQUEST[fid]'") or die(mysql_error());
						if($deleteAppt)
						{
							echo "<div class='thank_message'>Appointment is Cancelled.</div>";
							header("refresh:2;url=appointments.php");
						}
						else
						{
							echo "<div class='thank_message'>Something Going Wrong. Please Try Again  Later Thanks.</div>";
						}
					}
				?>
				<?php
					if(isset($_POST['appt_sch']))
					{
						$form_id                = $_REQUEST['fid'];
						$frm_id                 = $_REQUEST['fid'];
						$m_u_n                  = $_SESSION['username'];
						$appt_time              = $_POST['appt_time'];
						list($w,$x)             = explode("/",$appt_time);
						$location               = $_POST['location'];
						$app_type               = $_POST['app_type'];
						@$medical_clearance     = $_POST['medical_clearance'];
						@$medical_clearance_area= $_POST['medical_clearance_area'];
						@$due_by_date           = $_POST['due_by_date'];
						@list($s,$u)            = explode("/",$due_by_date);
						@$travel_remarks        = $_POST['travel_remarks'];
						@$travel_remarks_area   = $_POST['travel_remarks_area'];
						@$other_remarks         = $_POST['other_remarks'];
						@$other_remarks_area    = $_POST['other_remarks_area'];
						$date_time              = date('d-m-y h:i:s');
						$allHired               = $functions->getHiredStaff($_REQUEST['fid']);
						$pName    			    = $functions->GetInfoPlantiffInformation("plantiff_name",$_REQUEST['fid']);
						$message_status         = "Appointment is Re-Scheduled on " .$w."-".$x." of Client Name ".$pName;
						
						
						
					
						
						$message = mysql_query("INSERT INTO `message_sent` (`form_id`,`user_id`,`sent_by`,`main_user_id`,`message`,`date_message`) VALUES ('$_REQUEST[fid]','$_REQUEST[uid]','$doctor_id','$allHired','$message_status',now())") or die(mysql_error());
						
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
							
							$message .='<tr><td align="center">Your Client ('.ucwords($clientNamed).') has been Re-Scheduled for ';
							if($app_type==1)
							{
								$message .= 'an ';
							}
							else
							{
								$message .= 'a '; 
							}

							$message .= $functions->GetAppById($app_type);
							$message .= " on ";
							$message .= "Date: ".$w;
							$message .= "at:".$x;
							$message .= "</td></tr>";

							
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
						$message_status         = "Appointment is fixed on ".$appt_time;
						
						if($updateAppoint == 1)
						{
							echo "<div class='thank_message'>Appointment has been Re-Schedulled</div>";
							//header("refresh:3;url=appointments.php");
						}
						else
						{
							echo "<div class='thank_message'>Some thing Went Wrong. Please Retry.</div>";
						}
						
					}
					if(isset($_REQUEST['fid']) && isset($_REQUEST['action']) && $_REQUEST['action']=="update")
					{
						ini_set('display_errors',1);  
						error_reporting(E_ALL);
				?>
					<div class="client_personal_info">
					<div class="back_btn_area">
						<a href="appointments.php"><input name="" type="button" class="back_btn" value="<<Back"/></a>
					</div> 
<div class="anesth_bg">					
					<h1>Update Appointment</h1> </div>
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
						
						 <div class="controls input-append date form_datetime" data-date="<?php echo date('mm-dd-Y'); ?>T05:25:07Z" data-date-format="mm-dd-yyyy / HH:ii p" data-link-field="dtp_input1">
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
						<label><input type="checkbox" name="medical_clearance" id="" value="<?php echo $appt->m_c_r; ?>" <?php if($appt->m_c_r == " yes"){ echo 'checked="checked"';}?> />Medical Clearance Remarks</label>
						<textarea name="medical_clearance_area" /><?php echo $appt->m_c_r_a; ?></textarea>
						<span id="medical_error" class="error"></span>
						<label>Due  by Date</label>
						<div class="controls input-append date form_datetime" data-date="<?php echo date('mm-dd-Y'); ?>T05:25:07Z" data-date-format="mm-dd-yyyy / HH:ii p" data-link-field="dtp_input1">
						<input size="16" name="due_by_date" type="text" value="<?php echo $appt->due_by_date; ?>" readonly required />
						<span class="add-on"><i class="icon-remove"></i></span>
						<span class="add-on"><i class="icon-th"></i></span>
					</div>
					<input type="hidden" id="dtp_input1"  value="" required /><br/>
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
						<input type="submit" name="appt_sch" id="" onclick="return validation();" value="Submit"/>
					</div>
				</form>
				</div>
				<?php
					}
					else
					{
				?>
						<div class="back_btn_area">
							<a href="index.php"><input name="" type="button" class="back_btn" value="<<Back"/></a>
						</div> 
						<div class="anesth_bg">
							<h1>Client Appointments</h1>
							</div>
					
							<div class="anesth_box_bg">
								<div class="anesth_row_heading">
									<div class="dr_new_client_d11">Client No.</div>
									<div class="dr_new_client_d21">Client Name</div>
									<div class="dr_new_client_d31">Date of Birth</div>
									<div class="dr_new_client_d41">Appointment Date</div>
									<div class="dr_new_client_d51">Due Date</div>
									<div class="dr_new_client_d61">Re-Schedule</div>	
									<div class="dr_new_client_d71">Cancel Appointment</div>
									<div class="dr_new_client_d81">Upload Report/Status</div>
									<div class="dr_new_client_d91">View Application</div>
								</div>
				<?php
						$tempApt = mysql_query("SELECT a.*,b.* FROM `appointment_doctor` as a,`plantiff_case_type_info` as b WHERE `main_user_id`='$doctor_id' AND `appt_report`=0 and a.form_id=b.form_id and b.case_closed=0 order by a.appt_id desc") or die(mysql_error());
						if(mysql_num_rows($tempApt)>0)
						{
							while($data = mysql_fetch_object($tempApt))
							{
				?>
								
									<div class="anesth_row_content">
									
										<div class="dr_new_client_d11">
											<?php 
												echo $data->form_id; 
											?>
										</div>
										<div class="dr_new_client_d21">
											<?php
												//$user_id = $_REQUEST['uid'];
												$name = $functions->GetInfoPlantiffInformation("plantiff_name",$data->form_id);
												echo ucwords($name);
											?>
										</div>
										<div class="dr_new_client_d31">
											<?php
												$d_o_b          = $functions->GetInfoPlantiffInformation("p_d_o_b",$data->form_id);
												echo $date_tiem = $d_o_b;
											?>
										</div>
										<div class="dr_new_client_d41">
											<?php
												 $temp_date_t = $data->date_appt;
												 list($n,$p)  = explode("/",$temp_date_t);
												 echo $date_tiem   = $n;
												 echo "-".$p;
											?>
										</div>
										<div class="dr_new_client_d51">
											<?php
												 echo $temp_date_t = $data->due_by_date;
												 if($temp_date_t!=" ")
												 {
													list($k,$l)  = explode("/",$temp_date_t);
													echo $date_tiem   = $k;
													echo "-".$l;
												 }
											?>
										</div>		
										<div class="dr_new_client_d61">
											<a class="dr_appointment" href="appointments.php?fid=<?=$data->form_id?>&uid=<?=$data->user_id?>&id=<?php echo $data->appt_id?>&action=update" class="messages" title="Re-Schedule">Re-Schedule</a>
										</div>	
										<div class="dr_new_client_d71">
											<a href="appointments.php?fid=<?=$data->form_id?>&uid=<?=$data->user_id?>&id=<?php echo $data->appt_id?>&action=delete" class="del_appointment" title="Cancel Appointment">Cancel Appointment</a>
										</div>	
										<div class="dr_new_client_d81">
											<a href="schedulling-report.php?fid=<?=$data->form_id?>&uid=<?=$data->user_id?>&id=<?php echo $data->appt_id?>&action=upload" class="up_appointment" title="Upload Report">Upload</a>
										</div>	
										<div class="dr_new_client_d91">
											<a href="check-status.php?fid=<?=$data->form_id?>&uid=<?=$data->user_id?>&appid=<?=$data->appt_id?>" class="dr_check_status" title="View Application">Appointment</a>
										</div>										
									</div>
								
				<?php
							}
						}
					}
				?>
				
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
<?php
require($get_footer);
}
else
{
header('Location:../login.php');
} 
?>
