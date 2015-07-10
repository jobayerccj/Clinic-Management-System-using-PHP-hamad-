<?php 
ini_set('error_reporting', E_ALL);
ini_set('display_errors',1);  
$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
include('header.php');
require_once($config);
include('../classes/login-functions.php');
if(loggedin()) 
{
/*Class file to call the functions*/
?><script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<section class="row">
	<div class="container dashboard_bg">
		<div class="dr_upload_doc_slide">
			<div class="dr_message_side_bg">
			<div class="dr_message_side">
				<script>
						 $(document).ready(function() 
						 {
							 $(".view").load("latestmessages.php?attorneys_id=<?php echo $attorneys_id; ?>");
						   var refreshId = setInterval(function() {
							  $(".view").load('latestmessages.php?attorneys_id=<?php echo $attorneys_id; ?>');
						   }, 5000);
						   $.ajaxSetup({ cache: false });
						});
					</script>
					<div class="view"></div>
</div>					
			</div>
		</div>
		<div class="slide_right">
			<div class="anesth_bg">
			<div class="view_application">
		<?php

		//$tempcheck = mysql_query("SELECT `form_id` FROM `hire_staff` WHERE `hire_id`='$doctor_id' && `user_id`='$_REQUEST[uid]'") or die(mysql_error());

						$qry = "SELECT a . * , b . * FROM plantiff_information AS a,  `plantiff_case_type_info` AS b
					WHERE a.form_id = b.form_id && a.id = b.id && b.admin_approved =1 && b.attorney_id = '$attorneys_id' && a.id ='$_REQUEST[uid]' && b.id ='$_REQUEST[uid]' && admin_approved =1 && b.case_type ='$_REQUEST[cid]' && a.form_id='$_REQUEST[fid]' && b.form_id='$_REQUEST[fid]'
GROUP BY a.id";
					    $sql = mysql_query($qry) or die(mysql_error());
						$row = mysql_fetch_array($sql);
						$case_type = $row['case_type'];
						
					?>
				<div class="client_1">
					<div class="status_bar_bg">
						<div class="status_bar_left">
							<div class="back_btn_area">
<a href="index.php"><input name="" type="button" class="back_btn" value="<<Back"/></a>
</div>
						</div>
						<div class="status_bar_right">
							<a href="full-details.php?fid=<?=$row['form_id'] ?>&uid=<?php echo $_REQUEST['uid'];?>&cid=<?php echo $_REQUEST['cid']; ?>">Click here to view full Details</a>
						</div>
					</div>
					<div class="view_client_row">
						<h1 style="float:left;">Client Basic Information</h1>
					</div>
					<div class="view_client_row">
						<div class="client_left">
							<label>Plantiff Name</label>
							<label class="filled_label"><?php echo $row['plantiff_name']; ?></label>
						</div>
						<div class="client_right">
							<label>Date</label>
							<label class="filled_label"><?php list($date,$time) = explode(" ",$row['p_date']); echo $date; ?><?php //echo date('m-d-Y',strtotime($date))?></label>
						</div>
					</div>
					<div class="view_client_row">
						<div class="client_left">
							<label>Mobile No.</label>
							<label class="filled_label"><?php echo $row['p_mob_no']; ?></label>
						</div>
						<div class="client_right">
							<label>Home No.</label>
							<label class="filled_label"><?php echo $row['p_home_no']; ?></label>
						</div>
					</div>
					<div class="view_client_row">
						<div class="client_left">
							<label>Office No.</label>
							<label class="filled_label"><?php echo $row['p_office_no']; ?></label>
						</div>
						<div class="client_right">
							<label>Email Address</label>
							<label class="filled_label"><?php echo $row['p_email_address']; ?></label>
						</div>
					</div>
					<div class="view_client_row">
						<div class="client_left">
							<label>Date of Birth</label>
							<label class="filled_label"><?php echo $d= $row['p_d_o_b']; ?><?php //echo date('m-d-Y',strtotime($d));?></label>
						</div>
						<div class="client_right">
							<label>Driving License</label>
							<label class="filled_label"><?php echo $row['p_driving_licence']; ?></label>
						</div>
					</div>
					<div class="view_client_row">
						<label>Address</label>
						<label class="filled_label"><?php echo $row['p_address']; ?></label>
					</div>
					<div class="view_client_row">
						<div class="client_left">
							<label>State</label>
							<label class="filled_label">
								<?php 
									echo $g_state = $temp_profile->GetStatebyStateCode($row['p_state']); 
								?>
							</label>
						</div>
						<div class="client_right">
							<label>City</label>
							<label class="filled_label"><?php echo $row['p_city']; ?></label>
						</div>
					</div>
					<div class="view_client_row">
						<div class="client_left">
							<label>Zip Code</label>
							<label class="filled_label"><?php echo $row['p_zip_code']; ?></label>
						</div>
						<div class="client_right">
							<label>Preferred Choice of Doctor</label>
							<label class="filled_label"><?php echo $row['p_preferred_coice']; ?></label>
						</div>
					</div>
					
				</div><!--client_1_end-->
				
				
				<div class="dashbord_client">
				<h1>Pending Documents</h1>
				<div class="client_box_bg">
					<div class="client_row_heading">
						<div class="client_span_1">Client No.</div>
						<div class="client_span_2">Client Name</div>
						<div class="client_span_3">Email Address</div>
						<div class="client_span_4">State</div>
						<div class="client_span_5">Application Date</div>
						<div class="client_span_6">Action</div>
					</div>
					<?php
						$temp_temp_profile = mysql_query("SELECT * FROM `documents_messages` WHERE `main_user_id`='$attorneys_id' && `form_id`='$_REQUEST[fid]'") or die(mysql_error());
						if(mysql_num_rows($temp_temp_profile)>0)
						{
						while($f_temp_profile= mysql_fetch_object($temp_temp_profile))
						{
							$user_ids = $f_temp_profile->user_id;
					?>
						<div class="client_row_content">
							<div class="client_span_1"><?php echo $f_temp_profile->form_id; ?></div>
							<div class="client_span_2">
								<?php 
									echo $name = ucwords($temp_profile->GetInfoPlantiffInformation("plantiff_name",$_REQUEST['fid']));
									//echo $lname= $temp_profile->GetObjectById($user_ids,"last_name"); 
								?>
							</div>
							<div class="client_span_3"><?php echo $email_address = $temp_profile->GetInfoPlantiffInformation("client_email",$_REQUEST['fid']); ?></div>
							<div class="client_span_4">
								<?php 
									$temp_state = $temp_profile->GetInfoPlantiffInformation("p_state",$_REQUEST['fid']);
									echo $g_state = $temp_profile->GetStatebyStateCode($temp_state); 
								?>
								</div>
							<div class="client_span_5">
								<?php 
									$date = $f_temp_profile->date_document; 
									echo $dattime = date('m-d-Y',strtotime($date));
								?>
								</div>
							<div class="client_span_6">
								<a href="full-details.php?fid=<?=$row['form_id'] ?>&uid=<?php echo $_REQUEST['uid'];?>&cid=<?php echo $_REQUEST['cid']; ?>#upload">Upload</a>
							</div>
						</div>
					<?php
						}
					}
					else
					{
						echo "<h1>No Message Related to Documents.</h1>";
					}
					?>
				</div>
			</div>
			
			<div class="anesth_dashbord_client">
					<h1>Appointment</h1>
					<div class="anesth_box_bg">
						<div class="anesth_row_heading">
							<div class="anesth_span_1">Client No.</div>
							<div class="anesth_span_2">Doctor</div>
							<div class="anesth_span_3">Date of Birth</div>
							<div class="anesth_span_4">Appointment Date</div>
							<div class="anesth_span_5">Appointment Type</div>
						</div>
						<?php
							$query = mysql_query("SELECT * FROM `appointment_doctor` where `form_id`='$_REQUEST[fid]'") 
							or die(mysql_error());
							if(mysql_num_rows($query)>0)
							{
								while($getapp = mysql_fetch_object($query))
								{
									$uid  = $_REQUEST['uid'];
									$f_id = $_REQUEST['fid']; 
						?>
							<div class="anesth_row_content">
								<div class="anesth_span_1"><?php echo $form_id = $getapp->form_id?></div>
								<div class="anesth_span_2">
									<?php 
										$m_u_id = $getapp->main_user_id; 
										$fname = $temp_profile->GetObjectById($m_u_id,"first_name");
										$lname = $temp_profile->GetObjectById($m_u_id,"last_name");
										echo ucwords($fname);
										echo ucwords($lname);
									?>
								</div>
								<div class="anesth_span_3">
									<?php 
										 echo $date_o_b = $temp_profile->GetInfoPlantiffInformation("p_d_o_b",$form_id);
									?>
								</div>
								<div class="anesth_span_4">
									<?php 
										$appt = $getapp->date_appt;										
										list($a,$b) = explode("/",$appt);
										echo $a;
									?>
								</div>
								<div class="anesth_span_4">
									<?php 
										$appt = $getapp->app_type; 
										echo $temp_profile->GetAppById($appt);
									?>
								</div>
							</div>
						<?php
							}
						}
						else{
							echo "<h1>There are no Appointments scheduled at this time.</h1>";
						}
						?>
					</div>
				</div>
				<?php
					$temp_profile->statusShow();
					$temp_profile->popUp();
				?>
				<div class="anesth_dashbord_client">
					<h1>Uploaded Client Documents</h1>
					<div class="anesth_box_bg">
						<div class="anesth_row_heading">
							<div class="anesth_span_1">Client No</div>
							<div class="anesth_span_2">Document Type</div>
							<div class="anesth_span_3">Document Description</div>
							<div class="anesth_span_4">Uploaded Date</div>
							<div class="anesth_span_5">View</div>
						</div>
						<?php
							$temp_uploads   = mysql_query("select a.id,b.* from members as a,upload_documents as b where a.id=b.attorney_id and a.designation!=6 and a.designation!=3 and `user_id` = '$_REQUEST[uid]' && `form_id` = '$_REQUEST[fid]' && `related_to` !=  'Estimate of Doctor and Facilities Charges'") or die(mysql_error());
							while($uploads  = mysql_fetch_object($temp_uploads))
							{
						?>
							<div class="anesth_row_content">
								<div class="anesth_span_1"><?=$uploads->form_id;?></div>
								<div class="anesth_span_2"><?=$uploads->related_to;?></div>
								<div class="anesth_span_3"><?=$uploads->name_of_document;?></div>
								<div class="anesth_span_4"><?php echo date('m-d-Y',strtotime($uploads->upload_date));?></div>
								
								<div class="anesth_span_4"><a href="download.php?filename=<?=$uploads->upload_document_path;?>&fid=<?php echo $uploads->form_id; ?>">Download</a>
							
							</div>
						<?php
							}
						?>
					</div>
				</div>
				<div class="add_dr_message">
					<a href="upload-documents.php?fid=<?php echo $_REQUEST['fid']; ?>&uid=<?php echo $_REQUEST['uid']; ?>&cid=<?php $fo_id = $_REQUEST['fid']; echo $temp_profile->GetCaseTypeByFormID("case_type",$fo_id);  ?>" class="dr_add_message">Upload Additional Documents</a>
				</div>
							</div>
						</div>
					</div>
				</div>
		</div>
	</div>
</section>
<?php
require($get_footer);
}
else
{
	
header('Location:../../login.php');
	
}
?>
