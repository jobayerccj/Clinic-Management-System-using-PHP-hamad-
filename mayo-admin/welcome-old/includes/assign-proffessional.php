<div class="back_btn_area">
	<a href="index.php"><input name="" type="button" class="back_btn" value="<<Back"/></a>
</div>
<div class="back_btn_area">
	<a href="#"><input name="" type="button" class="back_btn" value="<?php echo $row['plantiff_name']; ?>"/></a>
</div>
<h2>Assign Professionals</h2>
<div class="attorney_client_info"><h1>Process Verified Clients</h1></div>
			<div class="dashbord_client dashboard_boder">
				<div class="client_box_bg">
					<form name="form1" method="post" action="">
						<div class="hire_left">
							<div class="dashboard_row">
								<label>Choose Department</label>
								<select name="desgntn" onchange="getUser(this.value)">
									<option>Select Department</option>
									<?php
										$sql = mysql_query("SELECT * FROM `designation` LIMIT 0,7") or die(mysql_error());
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
									<select name="members" >
										<option value="">...Select...</option>
									</select>
								</div>
								<div id="result2"></div>
								
							</div>
						</div>
						<div class="hire_right">
							<div class="dashboard_row">
								<label>Email Message</label>
								<textarea name="hire_message"></textarea>
							</div>
							<div class="dashboard_row">
								<input type="submit" name="hire_button" id="" value="Submit"/>
							</div>
						</div>	 
					</form>
					<?php
						$user_id_req       = $_REQUEST['fid'];
						$fname         = $getdata->GetInfoPlantiffInformation("plantiff_name",$user_id_req);
						$contact_p_er  = $getdata->GetInfoPlantiffInformation("p_mob_no",$user_id_req);
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
						    
							$contact_cl    = $getdata->GetInfoPlantiffInformation("client_email",$user_id_req);
							/*end*/
							
							/*Hire information*/
							$hire_id       = $_REQUEST['user_details'];
							$h_f_name      = $getdata->GetObjectById($hire_id,"first_name");
							$l_f_name      = $getdata->GetObjectById($hire_id,"last_name");
							$fullnames     = $h_f_name.$l_f_name;
							$s_email_id    = $getdata->GetObjectById($hire_id,"email_id");
							//$s_email_id    = $getdata->GetObjectById($hire_id,"email_id");
							$contact_h     = $getdata->GetObjectById($hire_id,"email_id");
							/*End*/
							
							/*Emails*/
							$c_subject     = "Case Successfully Transferred";
							if($_POST['desgntn']=="3")
							{
								$s_subject = "Please schedule a Consultation Appointment(".$case_name.")";
							}
							else
							{
								$s_subject = "New Case Information (".$case_name.")";
							}
							$s_message     = $_REQUEST['hire_message']; 
							/*ends*/
							
							$message_c     = "Client Details";
							$extravalues_c = array("Name" =>ucwords($h_f_name),"Email Id" =>$c_email_id,"Contact No" =>$contact_cl);
							$extravalues_s = array("Name" =>ucwords($fname),"Contact Number"=>$contact_p_er,"Email Id" =>$c_email_id);
							$form_id_req   = $_REQUEST['fid'];
							
							/*Store Hire Information*/ 
							
							$temp_hire     = mysql_query("INSERT INTO `hire_staff` (`form_id`,`hire_id`,`user_id`,`message`,`date_time`)VALUES 
							('$form_id_req','$hire_id','$user_id_req','$s_message','$date_time')") or die(mysql_error());
							      
							//$strDesigna  = str_replace(' ','',$getname );
							//$lowerDesigna= strtolower($strDesigna);
							//$tempTable = mysql_query("UPDATE `temp_data` set '$lowerDesigna'='$fullnames' WHERE `form_id`=$_REQUEST[fid]") or die(mysql_error());
							
							/*Store Messsage*/    
							//$mess_insert   = mysql_query("INSERT INTO `message_sent` (`form_id`,`user_id`,`main_user_id`,`message`,`date_message`) VALUES ('$form_id_req','$user_id_req','$hire_id','$s_message ','$date_time')") or die(mysql_error());
							
							/*Delete user record from upload Documents*/
							//$delete_docs   = mysql_query("DELETE FROM `documents_messages` WHERE `form_id`='$_REQUEST[id]'") or die(mysql_error());
							//header("refresh:3;url=http://$sitepath/mayo-admin/welcome/cases/new-cases.php?id=$_REQUEST[id]&uid=$_REQUEST[uid]/#tabnav3");
							
							if($temp_hire)
							{
								//$sendmail_client = $getdata->SendEmail($c_email_id,$c_subject,$message_c,$extravalues_c);
								$sendmail_staff  = $getdata->SendEmail($s_email_id,$s_subject,$s_message,$extravalues_s);
								echo "<div class='thank_message'>".$getname." ".ucwords($h_f_name)." ".ucwords($l_f_name)." is Successfully Assigned to ".ucwords($fname)."</div>";
							}
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
						<div class="dashboard_span_h5">Email Message</div>
						<div class="dashboard_span_h6">Action</div>
					</div>
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
									<div class="dashboard_span_h5">
										<?php
											echo $data->message; 
										?>
									</div>
									<div class="dashboard_span_h6">
									<?php 
										$proffDesingation = $getdata->GetObjectById($hire_id,"designation");
										if($proffDesingation==3 || $proffDesingation==4 || $proffDesingation==6 || $proffDesingation==1)
										{
									?>
										<a class="assign_prof" id="deletestaff" href="#" hid=<?=$data->id?> alt="Delete Professionals">Delete</a>	
									<?php
										}
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
<div class="dashbord_client">
				<h1>Appointments</h1>
				<div class="client_box_bg">
					<div class="dashboard_row_heading">
						<div class="dashboard_span_h1">Client No</div>
						<div class="dashboard_span_h2">Client Name</div>
						<div class="dashboard_span_h3">Date of Birth</div>
						<div class="dashboard_span_h4">Appointment Date</div>
						<div class="dashboard_span_h5">Appointment Type</div>
						<div class="dashboard_span_h6">Status</div>
					</div>
					<?php
						$tempApt = mysql_query("SELECT * FROM `appointment_doctor` WHERE `form_id`='$_REQUEST[fid]' && `user_id`='$_REQUEST[uid]'") or die(mysql_error());
						if(mysql_num_rows($tempApt)>0)
						{
							while($data = mysql_fetch_object($tempApt))
							{
					?>
								<div class="client_row_content">
									<div class="attorney_client_info">
                                    <div class="dashboard_span_h1"><?php 
												echo $form_di = $_REQUEST['fid']; 
											?></div>
									<div class="dashboard_span_h2">
										<?php
												$user_id = $_REQUEST['uid'];
												$name = $getdata->GetInfoPlantiffInformation('plantiff_name',$form_di);
												echo ucwords($name);
											?>
									</div>
									<div class="dashboard_span_h3">
										<?php
												$d_o_b          = $getdata->GetD_O_B("p_d_o_b",$user_id);
												echo $date_tiem = date('Y-M-d',strtotime($d_o_b));
											?>
									</div>
									<div class="dashboard_span_h4">
										<?php
												echo $temp_date_t = $data->date_appt;
											 //echo $date_tiem   = date('Y-m-d',strtotime($temp_date_t));
										?>
									</div>
									<div class="dashboard_span_h5">
										<?php
											$app_status = $data->app_type; 
											echo $getdata->GetAppById($app_status)
											
										?>
									</div>
									<div class="dashboard_span_h6">
										<?php
											$temp_date_t = $data->appt_report;
											 //echo $date_tiem   = date('Y-m-d',strtotime($temp_date_t));
											 if($temp_date_t==1)
											 {
												echo "Report Uploaded";
											 }
											 else
											 {
												echo "Report Pending";
											 }
										?>
									</div>
								</div></div>
						<?php 
							}
						}
						else
						{
						?>
							<div class="client_row_content">
								<h1>No Appointment is Scheduled for Now.</h1>		
							</div>
						<?php
						} 
						?>
				</div>
			</div>				