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
			<div class="anesth_dashbord_client">
				<?php 
					if(isset($_REQUEST['fid']) && isset($_REQUEST['uid']) && isset($_REQUEST['action']) && $_REQUEST['action']=="status")
					{
						ini_set('display_errors',1);  
						error_reporting(E_ALL);
				?>
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
									<label>
										<?php 
											echo $dob = $functions->GetInfoPlantiffInformation('p_d_o_b',$_REQUEST['fid']);
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
											echo $mob_no = $functions->GetInfoPlantiffInformation('p_home_no',$_REQUEST['fid']);
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
											echo $functions->GetInfoPlantiffInformation('p_address',$_REQUEST['fid']);
											echo " , ";
											$state = $functions->GetInfoPlantiffInformation('p_state',$_REQUEST['fid']);
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
										<?php echo $p_city = $functions->GetInfoPlantiffInformation('p_city',$_REQUEST['fid']); ?>
									</label>
								</div>
							</div>
						</div>
					</div>
					<?php 
						$tempAppt = mysql_query("SELECT * FROM `appointment_doctor` WHERE `form_id`='".$_REQUEST['fid']."' && `user_id`='".$_REQUEST['uid']."' && `appt_id`=$_REQUEST[id]") or die(mysql_error());
						$appt = mysql_fetch_object($tempAppt);
						//foreach($appt as $vik)
						//{
						//	echo $vik;
						//}
					?>	
					<form name="schedule_appt" method="post" action="">
					<div class="client_row">
						<div class="client_left">
					<label>Appointment Date Time:-</label>
					
					 <div>
						<input size="16" name="appt_time" type="text" value="<?php echo $appt->date_appt; ?>" readonly required />

					</div>
					<input type="hidden" id="dtp_input1"  value="" required /><br/>
					</div>
						<div class="client_right">
							<label>Locations:-</label>
							<input type="text" name="location" value="<?php echo $appt->location; ?>" id="" required />
						</div>
						
						<div class="client_right">
							<label>Schedule Type:-</label>
							<?php 
								$appti = $appt->app_type;
								echo $functions->GetAppById($appti);
							?>
							
						</div>
					</div>
					<div class="client_row">
						<h3>Appointment Requirement:-</h3>
					</div>
					<div class="client_row row_border">
						<label><input type="checkbox" name="medical_clearance" id="" value="<?php echo $appt->m_c_r; ?>" <?php if($appt->m_c_r == "yes"){ echo 'checked="checked"';}?> />Medical Clearance Remarks</label>
						<textarea name="medical_clearance_area" required /><?php echo $appt->m_c_r_a; ?></textarea>
						<label>Due  by Date</label>
						<div class="controls input-append date form_datetime">
							<?php echo $appt->due_by_date; ?>
						</div>
					<input type="hidden" id="dtp_input1"  value="" required /><br/>
					</div>
					<div class="client_row row_border">
						<label><input type="checkbox" value="<?php echo $appt->travel_remarks; ?>" <?php if($appt->travel_remarks==" yes"){echo 'checked="checked"';} ?>/>Travel Remarks</label>
						<textarea name="travel_remarks_area"><?php echo $appt->travel_remarks_area; ?></textarea>
					</div>
					<div class="client_row">
						<label><input type="checkbox" name="other_remarks" value="<?php echo $appt->other_remarks; ?>" id="" <?php if($appt->other_remarks=="yes"){ echo 'checked="checked"'; } ?> />Other Remarks</label>
						<textarea name="other_remarks_area"><?php echo $appt->other_remarks_area; ?></textarea>
					</div>
				</form>

				</div>
						
				<?php
					}
					else
					{
				?>
						<h1>Client Appointments</h1>
								<div class="anesth_box_bg">
									<div class="anesth_row_heading">
										<div class="dr_new_client_d1">Client No.</div>
										<div class="dr_new_client_d2">Client Name</div>
										<div class="dr_new_client_d3">Date of Birth</div>
										<div class="dr_new_client_d4">Appointment Date</div>
										<div class="dr_new_client_d5">Appointment History</div>
										<div class="dr_new_client_d6">Appointment Information</div>
										<div class="dr_new_client_d7">Reports</div>
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
												echo $data->form_id;//$_REQUEST['fid']; 
											?>
										</div>
										<div class="dr_new_client_d2">
											<?php
												//$user_id = $_REQUEST['fid'];
												$name = $functions->GetInfoPlantiffInformation('plantiff_name',$_REQUEST['fid']);
												echo ucwords($name);
											?>
										</div>
										<div class="dr_new_client_d3">
											<?php
												$d_o_b          = $functions->GetInfoPlantiffInformation('p_d_o_b',$_REQUEST['fid']);
												echo $date_tiem = date('d-m-Y',strtotime($d_o_b));
											?>
										</div>
										<div class="dr_new_client_d4">
											<?php
												echo $temp_date_t = $data->date_appt;
											 //echo $date_tiem   = date('Y-m-d',strtotime($temp_date_t));
											?>
										</div>
										<div class="dr_new_client_d5">
											<a href="appointment-status.php?fid=<?php echo $data->form_id;?>&uid=<?=$data->user_id ?>&id=<?=$data->appt_id?>&action=status" class="dr_appointment">Appointment</a>
										</div>		
										<div class="dr_new_client_d6">
											<a href="check-status.php?fid=<?php echo $data->form_id;?>&uid=<?=$data->user_id ?>" class="dr_check_status">Appointment</a>
										</div>	
										<div class="dr_new_client_d7">
											<a href="schedulling-report.php?fid=<?php echo $data->form_id; ?>&uid=<?=$data->user_id ?>&id=<?=$data->appt_id?>" class="dr_check_status">Appointment</a>
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
<?php
require($get_footer);
}
else
{
header('Location:../login.php');
} 
?>
