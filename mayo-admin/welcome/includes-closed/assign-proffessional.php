<div class="back_btn_area">
	<a href="index.php"><input name="" type="button" class="back_btn" value="<<Back"/></a>
</div>
<div class="back_btn_area">
	<a href="#"><input name="" type="button" class="back_btn" value="<?php echo $row['plantiff_name']; ?>"/></a>
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

<script>
	$(document).ready(function()
	{
		$('#appointments_list').click(function()
		{
			$('#appointments_show').toggle('slow');
		});
	});
</script>
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
						
						 <div class="controls input-append date form_datetime" data-date="<?php echo date('mm-dd-Y'); ?>T05:25:07Z" data-date-format="mm-dd-yyyy / HH:ii p" data-link-field="dtp_input1">
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
						<div class="controls input-append date form_datetime" data-date="<?php echo date('mm-dd-Y'); ?>T05:25:07Z" data-date-format="mm-dd-yyyy / HH:ii p" data-link-field="dtp_input1">
							
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
						$doctor_id = $doctorDetails->hire_id;
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
												$d_o_b          = $getdata->GetInfoPlantiffInformation("p_d_o_b",$data->form_id);
												echo $date_tiem = date('m-d-Y',strtotime($d_o_b));
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
									</div>
									
								
				<?php
							}
						}
				?>
				
						</div>
				</div>
			</div>	</div>	</div>		
