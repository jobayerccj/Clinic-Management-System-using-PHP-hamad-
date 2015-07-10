<?php 
ini_set('display_errors',1);  
error_reporting(E_ALL);
$path = $_SERVER['DOCUMENT_ROOT']."/rao/path.php";
require_once($path);
include('header.php');
require_once($config);
include('../classes/login-functions.php');

if(loggedin()) 
{
/*Class file to call the functions*/
$formid = $_REQUEST['fid'];
$userid = $_REQUEST['uid'];
?>
<section class="row">
	<div class="container dashboard_bg">
		<?php include('messages.php'); ?>
		<div class="slide_right">
			<div class="anesth_bg">
			<div class="view_application">
					<?php

		$tempcheck = mysql_query("SELECT `form_id` FROM `hire_staff` WHERE `hire_id`='$doctor_id' && `user_id`='$_REQUEST[uid]'") or die(mysql_error());

						$qry = "SELECT a . * , b . * , c.id AS hi_id
FROM plantiff_information AS a, plantiff_case_type_info AS b, hire_staff AS c
WHERE a.id = b.id && a.form_id = b.form_id && a.id = c.user_id && a.id = c.user_id && b.id = c.user_id
AND b.case_type =1 && hire_id ='$doctor_id' && a.form_id='$_REQUEST[fid]' && b.form_id='$_REQUEST[fid]' && a.id='$_REQUEST[uid]' && b.id='$_REQUEST[uid]'
&& c.user_id='$_REQUEST[uid]'";
						$sql = mysql_query($qry) or die(mysql_error());
						$row = mysql_fetch_array($sql);
						$case_type = $row['case_type'];
						
					?>
				<div class="client_1">
					<h2><a href="index.php">Back</a></h2>
					<div class="view_client_row">
						<h1 style="float:left;">Client Basic Information</h1><h1 style="float:right;">
							<a href="index.php?fid=<?=$row['form_id'] ?>&uid=<?php echo $_REQUEST['uid'];?>">Click here to view full Details</a></h1>
					</div>
					<div class="view_client_row">
						<div class="client_left">
							<label>Plantiff Name</label>
							<label class="filled_label"><?php echo $row['plantiff_name']; ?></label>
						</div>
						<div class="client_right">
							<label>Date</label>
							<label class="filled_label"><?php echo $row['p_date']; ?></label>
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
							<label class="filled_label"><?php echo $row['p_d_o_b']; ?></label>
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
							<label class="filled_label"><?php echo $row['p_state']; ?></label>
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
					<div class="view_client_row">
						<label>Auto Insurance Carrier (Auto collision only)</label>
						<label class="filled_label">1<?php echo $row['auto_insurance']; ?></label>
					</div>
				</div><!--client_1_end-->
				<div class="anesth_dashbord_client">
					<h1>Current Status</h1>
					<div class="anesth_box_bg">
						<div class="anesth_row_heading">
							<div class="anesth_span_1">Client No.</div>
							<div class="anesth_span_2">Client Name</div>
							<div class="anesth_span_3">Date of Birth</div>
							<div class="anesth_span_4">Date</div>
							<div class="anesth_span_5">Status</div>
						</div>
						<?php
							$temp_status = mysql_query("SELECT * 
FROM  `status_update` 
WHERE id = ( 
SELECT MAX( id ) 
FROM  `status_update` ) && `form_id`='$_REQUEST[fid]' && `user_id`='$_REQUEST[uid]'") or die(mysql_error());
							while($status = mysql_fetch_object($temp_status))
							{
						?>
							<div class="anesth_row_content">
								<div class="anesth_span_1"><?=$status->form_id?></div>
								<div class="anesth_span_2">
									<?php 
										$s_u_id = $status->user_id;
										echo $fname  = $functions->GetObjectById($s_u_id,"first_name");
										echo $lname  = $functions->GetObjectById($s_u_id,"last_name");
									?>
								</div>
								<div class="anesth_span_3"><?=$functions->GetD_O_B("p_d_o_b",$s_u_id);?></div>
								<div class="anesth_span_4"><?=$status->date_status?></div>
								<div class="anesth_span_4"><?=$status->status_messages?></div>
							</div>
						<?php
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
							<div class="anesth_span_4">Application Date</div>
							<div class="anesth_span_5">Appointment Type</div>
						</div>
						<?php
							$query = mysql_query("SELECT * FROM `appointment_doctor` where `form_id`='$_REQUEST[fid]' && `user_id`='$_REQUEST[uid]'") 
							or die(mysql_error());
							while($getapp = mysql_fetch_object($query))
							{
								$uid  = $_REQUEST['uid'];
								$f_id = $_REQUEST['fid']; 
						?>
							<div class="anesth_row_content">
								<div class="anesth_span_1"><?=$getapp->form_id?></div>
								<div class="anesth_span_2">
									<?php 
										$m_u_id = $getapp->main_user_id; 
										$fname = $functions->GetObjectById($m_u_id,"first_name");
										$lname = $functions->GetObjectById($m_u_id,"last_name");
										echo ucwords($fname);
										echo ucwords($lname);
									?>
								</div>
								<div class="anesth_span_3">
									<?php 
										echo $var = $functions->GetD_O_B("p_d_o_b",$uid); 
									?>
								</div>
								<div class="anesth_span_4">
									<?php 
										$appt = $functions->GetObjectFromPCTI("date_time",$f_id);
										echo $appt;
									?>
								</div>
								<div class="anesth_span_4">
									<?php 
										$appt = $getapp->app_type; 
										echo $functions->GetAppById($appt);
									?>
								</div>
							</div>
						<?php
						 }
						?>
					</div>
				</div>
				<div class="anesth_dashbord_client">
					<h1>Uploaded Client Doocuments</h1>
					<div class="anesth_box_bg">
						<div class="anesth_row_heading">
							<div class="anesth_span_1">Client No</div>
							<div class="anesth_span_2">Document Type</div>
							<div class="anesth_span_3">Document Description</div>
							<div class="anesth_span_4">Uploaded Date</div>
							<div class="anesth_span_5">View</div>
						</div>
						<?php
							$temp_uploads   = mysql_query("SELECT * FROM `upload_documents` where `user_id` = '$_REQUEST[uid]' && `form_id` = '$_REQUEST[fid]'") or die(mysql_error());
							while($uploads  = mysql_fetch_object($temp_uploads))
							{
						?>
							<div class="anesth_row_content">
								<div class="anesth_span_1"><?=$uploads->form_id;?></div>
								<div class="anesth_span_2"><?=$uploads->related_to;?></div>
								<div class="anesth_span_3"><?=$uploads->name_of_document;?></div>
								<div class="anesth_span_4"><?=$uploads->upload_date;?></div>
								<div class="anesth_span_4"><a target="_blank" href="<?php echo $sitepath;?>/uploads/<?=$uploads->upload_document_path;?>">Download</a></div>
							</div>
						<?php
							}
						?>
					</div>
				</div>
				<div class="add_dr_message">
					<a href="upload-documents.php?fid=<?php echo $_REQUEST['fid']; ?>&uid=<?php echo $_REQUEST['uid']; ?>&cid=<?php $fo_id = $_REQUEST['fid']; echo $functions->GetCaseTypeByFormID("case_type",$fo_id);  ?>" class="dr_add_message">Upload Additional Documents</a>
				</div>
		</div>
	</div>
</section>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo $sitepath; ?>/popup/featherlight.min.css" title="Featherlight Styles" />
<script src="<?php echo $sitepath; ?>/popup/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="<?php echo $sitepath; ?>/popup/style.css">
<?php
require($get_footer);
}
else
{
	
header('Location:../../login.php');
	
}
?>
