<?php 
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
$formid = $_REQUEST['fid'];
$userid = $_REQUEST['uid'];
?><script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<section class="row">
	<div class="container dashboard_bg">
		<div class="dr_upload_doc_slide">
      <div class="dr_message_side_bg">
        <div id="show_data">
			<div class="dr_message_side">
			  <script>
						 $(document).ready(function() 
						 {
							 $(".view").load("latestmessages.php?doctor_id=<?php echo $doctor_id; ?>");
						   var refreshId = setInterval(function() {
							  $(".view").load('latestmessages.php?doctor_id=<?php echo $doctor_id; ?>');
						   }, 5000);
						   $.ajaxSetup({ cache: false });
						});
					</script>
					<div class="view"></div>
			</div>
        </div>
      </div>
    </div>
		<div class="slide_right">
			<div class="anesth_bg">
			<div class="view_application">
			<?php

				$tempcheck = mysql_query("SELECT `form_id` FROM `hire_staff` WHERE `hire_id`='$doctor_id' && `user_id`='$_REQUEST[uid]'") or die(mysql_error());

				$qry = "SELECT a . * , b . * , c.id AS hi_id
				FROM plantiff_information AS a, plantiff_case_type_info AS b, hire_staff AS c
				WHERE a.id = b.id && a.form_id=b.form_id && a.form_id='$_REQUEST[fid]' && b.form_id='$_REQUEST[fid]' && a.id='$_REQUEST[uid]' && b.id='$_REQUEST[uid]'
				&& c.user_id='$_REQUEST[uid]'";
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
							<!--<a href="<?php //echo $sitepath;?>/anesthesiologist/index.php?fid=<?php//=$_REQUEST['fid'] ?>&uid=<?php// echo $_REQUEST['uid'];?>">Click here to view full Details</a>-->
							<a href="<?php echo $sitepath;?>/anesthesiologist/messages.php?fid=<?=$_REQUEST['fid'] ?>&uid=<?php echo $_REQUEST['uid'];?>"><input name="" type="button" class="back_btn" value="Message"/></a>
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
							<label class="filled_label"><?php $getd=$row['p_date']; ?> <?php  list($a,$b)=explode(" ",$getd); echo $a;?></label>
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
							<label class="filled_label"><?php echo $row['client_email']; ?></label>
						</div>
					</div>
					<div class="view_client_row">
						<div class="client_left">
							<label>Date of Birth</label>
							<label class="filled_label"><?php echo $d= $row['p_d_o_b']; ?> <?php  //echo date('m-d-Y',strtotime($d));?></label>
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
								$p_state = $row['p_state']; 
								if($p_state!="")
								{
									echo $state1 = $functions->GetStatebyStateCode($p_state);
								}
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
				<?php 
					$functions->statusShow();
					echo $functions->popUp();
				?>				
			<div class="anesth_dashbord_client">
					<h1>Appointments</h1>
					<div class="anesth_box_bg">
						<div class="anesth_row_heading">
							<div class="anesth_span_1">Client No</div>
							<div class="anesth_span_2">Doctor</div>
							<div class="anesth_span_3">Consultation Date</div>
							<div class="anesth_span_4">Consultation Type</div>
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
									<div class="c_d"><p>Consultation Date:</p><?php 
										$dateapp=$getapp->date_appt;
										list($a,$b)=explode("/",$dateapp);
										echo date('m-d-Y',strtotime($a));?></div>
									<div class="c_d"><p>Due Date:</p><?=$getapp->due_by_date;?></div>
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
				<!--<div class="anesth_dashbord_client">
					<h1>Appointments</h1>
					<div class="anesth_box_bg">
						<div class="anesth_row_heading">
							<div class="anesth_span_1">Application Date</div>
							<div class="anesth_span_2">Appointment Type</div>
							<div class="anesth_span_3">Appointment Status</div>
							<div class="anesth_span_4">More Consultation</div>
							<div class="anesth_span_5">Add Billing</div>
						</div>
						<?php
							/*$query = mysql_query("SELECT * FROM `appointment_doctor` where `form_id`='$_REQUEST[fid]' && `user_id`='$_REQUEST[uid]'") 
							or die(mysql_error());
							while($getapp = mysql_fetch_object($query))
							{
								$uid  = $_REQUEST['uid'];
								$f_id = $_REQUEST['fid']; */
						?>
							<div class="anesth_row_content">
								<div class="anesth_span_1">
									<?php 
										//$appt = $functions->GetObjectFromPCTI("date_time",$f_id);
										//echo $appt;
									?>
								</div>
								<div class="anesth_span_2">
									<?php 
										//$appt = $getapp->app_type; 
										//echo $functions->GetAppById($appt);
									?>
								</div>
								<div class="anesth_span_3">
									<?php
										//if($getapp->appt_status == "")
										//{
									?>
										<a href="appointment-status.php?app_id=<?php //echo $getapp->appt_id; ?>">Appointment Status</a>
									<?php
										//}
										//else
										//{
											//echo $getapp->appt_status;
										//} 
									?>
								</div>
								<div class="anesth_span_4">
									<a href="more-consultation.php">More Consultation</a>
								</div>
								<div class="anesth_span_4">
									<a href="add-billing.php?uid=<?php //echo $getapp->user_id ?>&fid=<?php //echo $getapp->form_id; ?>" class="add_billing">Add Billing</a>
								</div>
							</div>
						<?php
						// }
						?>
					</div>
				</div>-->
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
								<div class="anesth_span_4"><?php $d=$uploads->upload_date;?> <?php echo $d=date('m-d-Y',strtotime($d));?></div>
								<div class="anesth_span_4"><a href="download.php?filename=<?=$uploads->upload_document_path;?>&fid=<?php echo $uploads->form_id; ?>">Download</a></div>
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
