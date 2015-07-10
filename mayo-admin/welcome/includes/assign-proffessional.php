<div class="back_btn_area">
	<a href="index.php"><input name="" type="button" class="back_btn" value="<<Back"/></a>
</div>
<div class="back_btn_area">
	<a href="#"><input name="" type="button" class="back_btn" value="<?php echo $row['plantiff_name']; ?>"/></a>
</div>
<div class="attorney_client_info"><h1>Process Verified Clients</h1></div>
			<div class="dashbord_client dashboard_boder">
				<div class="client_box_bg">
					<form name="form1" method="post" action="">
						<div class="hire_left">
							<div class="dashboard_row">
								<label>Choose Department</label>
								<select name="desgntn" onchange="getUser(this.value)" required >
									<option value="">Select Department</option>
									<?php
										$sql = mysql_query("SELECT * FROM  `designation` WHERE id !=5 and id!=2 AND id !=7 AND id !=8") or die(mysql_error());
										while($data=mysql_fetch_object($sql))
										{
											echo "<option value='$data->id'>$data->designation</option>";
										}
									?>
								</select>
							</div>
							<div class="dashboard_row">
								<label>Employee Name</label>
								<div id="result">
									<select name="members" required >
										<option value="">...Select...</option>
									</select>
								</div>
								<div id="result2"></div>
								
							</div>
							<div class="dashboard_row">
								<input type="submit" name="hire_button" id="" value="Submit"/>
							</div>
						</div>
						<div class="hire_right">
							<div class="dashboard_row">
								<textarea name="hire_message" style="display:none;"></textarea>
							</div>
							
						</div>	 
					</form>
					<?php
						$user_id_req       = $_REQUEST['fid'];
						$fname         = $getdata->GetInfoPlantiffInformation("plantiff_name",$user_id_req);
						$contact_p_er  = $getdata->GetInfoPlantiffInformation("p_home_no",$user_id_req);
						//echo $lname       = $getdata->GetObjectById($user_id_req,"last_name");
						$c_email_id    = $getdata->GetInfoPlantiffInformation("client_email",$user_id_req);
						$case_type     = $getdata->GetInfoPlantiffInformation("case_type",$user_id_req);
						$case_name     = $getdata->getNameCase($case_type);
						$date_time       = date("Y-m-d H:i:s a");
						if(isset($_POST['hire_button']))
						{
							$desgntn      = $_REQUEST['desgntn'];
							$getname      = $getdata->GetDesgBydesId($desgntn);
							
							/*client info*/
						    
							$contact_cl    = $getdata->GetInfoPlantiffInformation("p_home_no",$user_id_req);
							/*end*/
							
							/*Hire information*/
							$hire_id       = $_REQUEST['user_details'];
							$h_f_name      = $getdata->GetObjectById($hire_id,"first_name");
							$l_f_name      = $getdata->GetObjectById($hire_id,"last_name");
							$fullnameofhire = $h_f_name." ".$l_f_name;
							$s_email_id    = $getdata->GetObjectById($hire_id,"email_id");
							//$s_email_id    = $getdata->GetObjectById($hire_id,"email_id");
							$contact_h     = $getdata->GetObjectById($hire_id,"email_id");
							/*End*/
							
							/*Emails*/
							$c_subject     = "Case Successfully Transferred";
							if($_POST['desgntn']=="3")
							{
								$s_subject = "Please schedule a Consultation Appointment(".$fname.")";
								$s_messaage     = "Please Schedule a Consultation Appointment for this client, when the appointment is scheduled please login to <a href='mayosurgical.com'>Mayosurgical.com</a> and record the appointment.";
							}
							elseif($_POST['desgntn']=="6")
							{
								$s_subject = "Mayo surgical has assigned you to underwrite the funding request for ".$fname;
								$s_messaage     = "Please login to your <a href='mayosurgical.com'>Mayosurgical.com</a> account to review all information on this client including Medical Records.";
							}
							else
							{
								$s_subject = "New Case Information (".$fname.")";
								$s_messaage     = "Please login to your <a href='mayosurgical.com'>Mayosurgical.com</a> account to review all information on this client including Medical Records.";
							}
							$s_message     = $_REQUEST['hire_message']; 
							/*ends*/
							
							$message_c     = "Client Details";
							
							//$extravalues_c = array("Name" =>ucwords($h_f_name),"Email Id" =>$c_email_id,"Contact No" =>$contact_cl,"Details:"=>$detailsGo);
							$note = "DO NOT REPLY TO THIS MESSAGE. THIS EMAIL IS NOT MONITORED.";
							$extravalues_s = array("Name" =>ucwords($fname),"Contact Number"=>$contact_p_er,"Email Id" =>$c_email_id,"Note"=>$note);
							$form_id_req   = $_REQUEST['fid'];
							
							/*Store Hire Information*/ 
							
							$checkProff = mysql_query("SELECT * FROM `hire_staff` WHERE `form_id`='$form_id_req' && `hire_id`='$hire_id' ") or die(mysql_error());
							if(mysql_num_rows($checkProff)>0)
							{
								echo "<div class='thank_message'>".$getname." ".ucwords($h_f_name)." ".ucwords($l_f_name)." is Already Assigned to ".ucwords($fname)." . Please select Other Professional.</div>";
							}
							else
							{						
								$temp_hire     = mysql_query("INSERT INTO `hire_staff` (`form_id`,`hire_id`,`user_id`,`message`,`date_time`)VALUES 
								('$form_id_req','$hire_id','$_REQUEST[uid]',' ','$date_time')") or die(mysql_error());
								
								//store temptable
								
								if($_POST['desgntn']=="1")
								{
									$temptable = mysql_query("UPDATE `temp_data` SET `anesthesiologist`='$fullnameofhire' WHERE `form_id`='$_REQUEST[fid]'") or die(mysql_error());
								}
								elseif($_POST['desgntn']=="3")
								{
									$temptable = mysql_query("UPDATE `temp_data` SET `doctor`='$fullnameofhire' WHERE `form_id`='$_REQUEST[fid]'") or die(mysql_error());
								}
								elseif($_POST['desgntn']=="4")
								{
									$temptable = mysql_query("UPDATE `temp_data` SET `medicalfacility`='$fullnameofhire' WHERE `form_id`='$_REQUEST[fid]'") or die(mysql_error());
								}
								elseif($_POST['desgntn']=="6")
								{
									$temptable = mysql_query("UPDATE `temp_data` SET `underwriter`='$fullnameofhire' WHERE `form_id`='$_REQUEST[fid]'") or die(mysql_error());
								}
								
								if($temp_hire)
								{
									//$sendmail_client = $getdata->SendEmail($c_email_id,$c_subject,$message_c,$extravalues_c);
									$sendmail_staff  = $getdata->SendEmail($s_email_id,$s_subject,$s_messaage,$extravalues_s);
									echo "<div class='thank_message'>".$getname." ".ucwords($h_f_name)." ".ucwords($l_f_name)." is Successfully Assigned to ".ucwords($fname)."</div>";
								}
							}
							/*Store Messsage*/    
							//$mess_insert   = mysql_query("INSERT INTO `message_sent` (`form_id`,`user_id`,`main_user_id`,`message`,`date_message`) VALUES ('$form_id_req','$user_id_req','$hire_id','$s_message ','$date_time')") or die(mysql_error());
							
							/*Delete user record from upload Documents*/
							//$delete_docs   = mysql_query("DELETE FROM `documents_messages` WHERE `form_id`='$_REQUEST[id]'") or die(mysql_error());
							//header("refresh:3;url=http://$sitepath/mayo-admin/welcome/cases/new-cases.php?id=$_REQUEST[id]&uid=$_REQUEST[uid]/#tabnav3");
							
							
						}
					?>
				</div>
</div>
			<div class="dashbord_client">
				<h1>Details List</h1>
				<div class="client_box_bg">
					<div class="dashboard_row_heading">
						<div class="dashboard_span_h1">Case ID</div>
						<div class="dashboard_span_h2">Choose Department</div>
						<div class="dashboard_span_h3">Employee Name</div>
						<div class="dashboard_span_h4">Email ID</div>
						<div class="dashboard_span_h6">Action</div>
					</div>
					 <script src="<?php echo $sitepath; ?>/js/jquery.js"></script>
					<script type="text/javascript">
						$(function()
						{
							$(".assign_prof").click(function()
							{
								var element = $(this);
								var del_id = element.attr("hid");
								var info = 'hid='+del_id;
								if(confirm("Sure you want to delete this update? There is no undo"))
								{
									$.ajax({
										type:"POST",
										url:"../includes/delete-c-staff.php",
										data:info,
										success:function()
										{
										}
									});
								$(this).parents(".client_row_content").animate({ backgroundColor: "#fbc7c7" }, "fast")
.animate({ opacity: "hide" }, "slow");
								}
								return false;
							});
						});
					</script>
					<?php
						$count=0;
						$query= "SELECT * FROM `hire_staff` WHERE `user_id`= '$_REQUEST[uid]' && `form_id`='$_REQUEST[fid]'";
						$temp_hired_inform = mysql_query("SELECT * FROM `hire_staff` WHERE `user_id`= '$_REQUEST[uid]' && `form_id`='$_REQUEST[fid]'") or die(mysql_error());
							while($data    = mysql_fetch_object($temp_hired_inform))
							{
								$count++;
								$hire_id = $data->hire_id;
								if($count>0)
								{
					?>
								<div class="client_row_content">
									<div class="attorney_client_info">
                                    <div class="dashboard_span_h1"><?php echo $data->form_id; ?></div>
									<div class="dashboard_span_h2">
										<?php 
											$department = $getdata->GetObjectById($hire_id,"designation"); 
											echo $depar = $getdata->GetDesgBydesId($department);
										?>
									</div>
									<div class="dashboard_span_h3">
										<?php 
											$hire_id = $data->hire_id; 
											$f_name  = $getdata->GetObjectById($hire_id,"first_name");
											$l_name  = $getdata->GetObjectById($hire_id,"last_name");
											echo ucwords($f_name)."&nbsp".ucwords($l_name);
										?>
									</div>
									<div class="dashboard_span_h4">
										<?php 
											echo $email_id  = $getdata->GetObjectById($hire_id,"email_id"); 
										?>
									</div>
									<?php
										$designation  = $getdata->GetObjectById($hire_id,"designation"); 
										if($designation==1||$designation==3||$designation==4||$designation==6)
										{
									?>
									<div class="dashboard_span_h6">
										<a class="assign_prof" id="deletestaff" href="#" hid=<?=$data->id?> alt="Delete Professionals">Delete</a>	
									</div>
										<?php } ?>
								</div></div>
						<?php 
							}
							else
							{
						?>
							<div class="client_row_content">
								<h1>No Team is selected for this Client.</h1>		
							</div>
						<?php
							}
						} 
						?>
				</div>
			</div>	
<?php
				if(isset($_POST['appt_sch']))
				{
					$doctor_id                = $_POST['doctor_id'];
					$caseType                 = $getdata->GetInfoPlantiffInformation("case_type",$_REQUEST['fid']);
					$pName                    = $getdata->GetInfoPlantiffInformation("plantiff_name",$_REQUEST['fid']);
					$caseName                 = $getdata->getNameCase($caseType);
					$frm_id                   = $_REQUEST['fid'];
					$us_id                    = $_REQUEST['uid'];
					$form_id                  = $_REQUEST['fid'];
					//$m_u_n                  = $_SESSION['username'];
					$appt_time                = $_POST['appt_time'];
					$location                 = $_POST['location'];
					$app_type                 = $_POST['app_type'];
					@$medical_clearance       = $_POST['medical_clearance'];
					@$medical_clearance_area  = $_POST['medical_clearance_area'];
					@$due_by_date             = $_POST['due_by_date'];
					@$travel_remarks          = $_POST['travel_remarks'];
					@$travel_remarks_area     = $_POST['travel_remarks_area'];
					@$other_remarks           = $_POST['other_remarks'];
					@$other_remarks_area      = $_POST['other_remarks_area'];
					$date_time                = date('d-m-Y h:i:s');
					
					list($ddateapp,$ttimeapp) = explode("/",$appt_time);
					$dateapporig              = $ddateapp;
					
					@list($duedatea,$duetimea)= explode("/",$due_by_date);
					@$duedateorginal          = $duedatea;
					
					$fields                   = array("form_id"=>$frm_id,
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
													"other_remarks"=>$travel_remarks,
													"other_remarks_area"=>$other_remarks_area,
													"date_time"=>$date_time);
											
					$insert                 = $getdata->Insert($fields,"appointment_doctor"); 
					$p_d_o_b                = $getdata->GetInfoPlantiffInformation("p_d_o_b",$_REQUEST['fid']);
					$bestcontact            = $getdata->GetInfoPlantiffInformation("p_home_no",$_REQUEST['fid']);
					$allHired               = $getdata->getHiredStaff($_REQUEST['fid']);
					$message_status          = "An Appointment was Scheduled for ".$pName." on ".$dateapporig;
					
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
					
					$messageSaved = "The Client Listed Cancelled their appointment which was scheduled on (".$appt_time.")";
					$message = mysql_query("INSERT INTO `message_sent` (`form_id`,`user_id`,`sent_by`,`main_user_id`,`message`,`date_message`) VALUES ('$_REQUEST[fid]','$_REQUEST[uid]','$doctor_id','$allHired','$message_status',now())") or die(mysql_error());
					
					/*Mail function used to send to all the professionals*/
					$getAllProffes 			= mysql_query("SELECT * FROM `hire_staff` WHERE `form_id`='$_REQUEST[fid]' AND `user_id`='$_REQUEST[uid]'") or die(mysql_error());
					$clientNamed = ucwords($getdata->GetInfoPlantiffInformation("plantiff_name",$_REQUEST['fid'])); 
					while($professionals    = mysql_fetch_object($getAllProffes))
					{
						$hire_id  			= $professionals->hire_id;
						$emailProffesionals = $getdata->GetObjectById($hire_id,"email_id");
						/*
							Get the details of the professionals
						*/
						
						$dfirst_name		= ucwords($getdata->GetObjectById($hire_id,"first_name"));
						$dlast_name 		= ucwords($getdata->GetObjectById($hire_id,"last_name"));
						$designations  = $getdata->GetObjectById($hire_id,"designation");
						$desgName      = $getdata->GetDesgBydesId($designations);
						/*
							Case id by using the table plantiff_case_ifno
						*/
						$case_id 			= $getdata->Getcidbyformid($form_id);
						
						/*
							get client information
						*/
						//die();
						
						$message    = "";
						$message   .= '<html><body>';
						$message   .= '<img src="https://'.$_SERVER['HTTP_HOST'].'/images/logo.png" alt="Appointment Scheduled" />';

						$message   .= '<table rules="all" cellpadding="0" cellspacing="5" border="0" style="font-size:17px;color:#000; border:1px solid #0665be; border-radius:5px;">';

						$message   .='<tr><td style="background: none repeat scroll 0 0 #3a9df8;border-top-left-radius: 5px;border-top-right-radius: 5px;color: #fff;font: 15px MemphisLTStd-Medium;padding: 15px 0;text-align: center;">';
						
						$message .='<h1>From Mayo to '.$getdata->GetObjectById($hire_id,"first_name").' – '.$getdata->GetAppById($app_type).'</h1></td></tr>';
						//$message .='<tr><td align="center"><h2 style="color:#f6801f;">'.$caseName.'</h2></td></tr>';
						
						$message .='<tr><td><h2>Dear '.$dfirst_name.'&nbsp;'.$dlast_name.'</h2></td></tr>';
											
						
						$message .='<tr><td align="center">Your Client Name ('.$clientNamed.') has been scheduled for';
						if($app_type==1)
						{
							$message .= 'an ';
						}
						else
						{
							$message .= 'a '; 
						}

						$message .= $getdata->GetAppById($app_type)." on Date: ".$dateapporig."at".$ttimeapp."</td></tr>";
						
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
						$message .='</table>';
						
						$to       = $emailProffesionals; 
						//$functions->GetObjectById($attManId,"email_id");
						$subject  ='From Mayo to – '.$getdata->GetAppById($app_type);
						
						
						$headers  = "From: admin <info@mayosurgical.com>"."\r\n";
					    $headers .= "MIME-Version: 1.0\r\n";
					    $headers .= "Content-type: text/html; charset=UTF-8";
					    $headers .= "X-Priority: 3\r\n";
					    $headers .= "X-Mailer: PHP". phpversion() ."\r\n"; 
						
						mail($to, $subject, $message, $headers);

					}
					if($insert == 1)
					{
						echo "<div class='thank_message'>Appointment has been Schedulled</div>";
					}
					else
					{
						echo "<div class='thank_message'>Some thing Went Wrong. Please Retry.</div>";
					}
					
				} 
			?>
<script>
	$(document).ready(function()
	{
		$("#make_appointment").click(function()
		{
			$("#appointment_admin").toggle('slow');
		});
		$('#appointments_list').click(function()
		{
			$('#appointments_show').toggle('slow');
		});
	});
</script>
<input type="button" class="back_btn" id="make_appointment" value="Schedule Appointment">

<?php
	$doctorList = mysql_query("SELECT a.hire_id,b.id from hire_staff as a, members as b where a.hire_id=b.id and b.designation=3 and a.form_id='$_REQUEST[fid]'") or die(mysql_error());
	if(mysql_num_rows($doctorList)>0)
	{
		$doctorDetails = mysql_fetch_object($doctorList);
?>
<div id="appointment_admin" style="display:none;">
	<div class="dashbord_client">
		<div class="client_full_info">
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
							<input type="text" name="location" value="<?php echo $add1  = $getdata->GetObjectById($doctorDetails->hire_id,"address"); ?>" id="" class="required" />
							<input type="hidden" name="doctor_id" value="<?php echo $doctorDetails->hire_id;?>">
						</div>
						
						<div class="client_schedule">
							<label>Schedule Type:-</label>
							<?php $getdata->GetAppointments(); ?>
						</div>
					</div>
					<div class="client_row">
						<h3> Appointment Requirement:- </h3>
					</div>
					<div class="client_row row_border">
						<label><input type="checkbox" name="medical_clearance" value="yes" id="med_c"/>Medical Clearance Remarks</label>
						<textarea id="medical_area" name="medical_clearance_area"></textarea>
						<span id="medical_error" class="error"></span>
						<label>Due  by Date</label>
						<div class="controls input-append date form_datetime" data-date="<?php echo date('Y-m-d'); ?>T05:25:07Z" data-date-format="mm-dd-yyyy / HH:ii p" data-link-field="dtp_input1">
							<input size="16" name="due_by_dates" type="hidden" value="" readonly />
							<input type="text" name="due_by_date" id="dtp_input2"  value=""  />
						<span class="add-on"><i class="icon-remove"></i></span>
						<span class="add-on"><i class="icon-th"></i></span>
					</div>
					<span id="duedate_error" class="error"></span>
				<br/>
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
	</div>			
</div>
<?php
	}
?>
<div id="appointments_list">
<div class="dashbord_client">
				<input type="button" class="back_btn" id="make_appointment" value="Appointment List">
				<div id="appointments_show" style="display:none;">
				<div class="client_box_bg">
					<div class="anesth_box_bg">
						<div class="anesth_row_heading">
							<div class="dr_new_client_d11">Client No.</div>
							<div class="dr_new_client_d21">Client Name</div>
							<div class="dr_new_client_d31">Date of Birth</div>
							<div class="dr_new_client_d41">Appointment Date</div>
							<div class="dr_new_client_d51">Due Date</div>
							<div class="dr_new_client_d61">Re-Schedule</div>
						</div>
				<?php
						@$doctor_id = $doctorDetails->hire_id;
						$tempApt = mysql_query("SELECT * FROM `appointment_doctor` WHERE `form_id`='$_REQUEST[fid]' order by `appt_id` desc") or die(mysql_error());
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
												$name = $getdata->GetInfoPlantiffInformation("plantiff_name",$data->form_id);
												echo ucwords($name);
											?>
										</div>
										<div class="dr_new_client_d31">
											<?php
												echo $d_o_b          = $getdata->GetInfoPlantiffInformation("p_d_o_b",$data->form_id);
												//echo $date_tiem = date('m-d-Y',strtotime($d_o_b));
											?>
										</div>
										<div class="dr_new_client_d41">
											<?php
												 $temp_date_t = $data->date_appt;
												 if($temp_date_t!=" ")
												 {
													list($k,$l)  = explode("/",$temp_date_t);
													echo $date_tiems   = $k;
													echo "-".$l;
												 }
											?>
										</div>
										<div class="dr_new_client_d51">
											<?php
												 $temp_date_td = $data->due_by_date;
												 if($temp_date_td!=" ")
												 {
													list($s,$t) = explode('/',$temp_date_td);
													echo $date_tiem   = $s;
													echo $t;
												 }
											?>
										</div>	
										<div class="dr_new_client_d61">
											<a href="/mayo-admin/welcome/re-schedule.php?fid=<?=$_REQUEST['fid']?>&id=<?=$data->appt_id?>&uid=<?=$_REQUEST['uid']?>" target="_blank">Re-Schedule</a>
										</div>											
																			
									</div>
									
								
				<?php
							}
						}
						else
						{
							echo "<h1 style='text-align:center;'>No Appointment is Scheduled for this Client.</h1>";
						}
				?>
				
						</div>
				</div>
			</div>	</div>	</div>		
