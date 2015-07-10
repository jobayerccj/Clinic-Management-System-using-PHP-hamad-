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
								$f_name = $functions->GetObjectById($u_id,"first_name"); 
								$l_name = $functions->GetObjectById($u_id,"last_name"); 
								echo ucwords($f_name)."&nbsp;".ucwords($l_name);
							?>
						</label>
					</div>
				</div>
				<div class="personal_row">
					<div class="personal_row_left">
						<label>Email Address :-</label>
					</div>
					<div class="personal_row_right">
						<label><?php echo $functions->GetObjectById($u_id,"email_id"); ?></label>
					</div>
				</div>
				<div class="personal_row">
					<div class="personal_row_left">
						<label>Date of Birth :-</label>
					</div>
					<div class="personal_row_right">
						<label><?php echo $functions->GetD_O_B("p_d_o_b",$u_id); ?></label>
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
								$c_no = $functions->GetObjectById($u_id,"contact_number"); 
								if($c_no=="")
								{
									echo "In-Completed Profile";
								}
								else
								{
									echo $c_no;
								}
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
								$add  = $functions->GetObjectById($u_id,"address"); 
								if($add=="")
								{
									echo "In-Completed Profile";
								}
								else
								{
									echo $add;
								}
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
								$city = $functions->GetObjectById($u_id,"city");
								if($city=="")
								{
									echo "In-Completed Profile";
								}
								else
								{
									echo $city;
								} 
							?>
						</label>
					</div>
				</div>
			</div>
		</div>
		<div class="client_full_info">
			<div class="client_info_heading">
				<div class="info_heading_left">
					<h1>Client Case Information</h1>
				</div>
				<div class="info_heading_right">
					<ul>
						<li><a href="#">
							<span class="link_1">
								<span class="nav_icon_1"></span>
								Appointment
							</span></a>
						</li>
						<li><a href="#">
							<span class="link_1">
								<span class="nav_icon_2"></span>
								Surgery
							</span></a>
						</li>
						<li><a href="#">
							<span class="link_1">
								<span class="nav_icon_3"></span>
								Client Report
							</span></a>
						</li>
						<li><a href="#">
							<span class="link_1">
								<span class="nav_icon_4"></span>
								Bills
							</span></a>
						</li>
						<li><a href="#">
							<span class="link_1">
								<span class="nav_icon_5"></span>
								Status
							</span></a>
						</li>
					</ul>
				</div>
			</div>
			<div class="client_info_details">
				<h1>Appointment Schedule</h1>
				<form name="schedule_appt" method="post" action="">
					<div class="client_row">
						<div class="client_left">
					<label>Appointment Date Time:-</label>
					 <div class="controls input-append date form_datetime" data-date="1979-09-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
						<input size="16" name="appt_time" type="text" value="" readonly>
						<span class="add-on"><i class="icon-remove"></i></span>
						<span class="add-on"><i class="icon-th"></i></span>
					</div>
					<input type="hidden" id="dtp_input1"  value="" /><br/>
					</div>
						<div class="client_right">
							<label>Locations:-</label>
							<input type="text" name="location" value="<?php echo $add1  = $functions->GetObjectById($doctor_id,"address"); ?>" id=""/>
						</div>
						
						<div class="client_right">
							<label>Schedule Type:-</label>
							<?php $functions->GetAppointments(); ?>
						</div>
					</div>
					<div class="client_row">
						<h3>Appointment Requriment:-</h3>
					</div>
					<div class="client_row row_border">
						<label><input type="checkbox" name="medical_clearance" value="yes" id=""/>Medical Clearance Remarks</label>
						<textarea name="medical_clearance_area"></textarea>
						<label>Due  by Date</label>
						<div class="controls input-append date form_datetime" data-date="1979-09-16" data-date-format="dd MM yyyy - HH:ii p" 
						data-link-field="dtp_input1">
						<input size="16" name="due_by_date" type="text" value="" readonly>
						<span class="add-on"><i class="icon-remove"></i></span>
						<span class="add-on"><i class="icon-th"></i></span>
					</div>
					<input type="hidden" id="dtp_input1"  value="" /><br/>
					</div>
					<div class="client_row row_border">
						<label><input type="checkbox" name="travel_remarks" value="yes" id=""/>Travel Remarks</label>
						<textarea name="travel_remarks_area"></textarea>
					</div>
					<div class="client_row">
						<label><input type="checkbox" name="other_remarks" value="yes" id=""/>Other Remarks</label>
						<textarea name="other_remarks_area"></textarea>
					</div>
				<div class="client_row">
					<input type="submit" name="appt_sch" id="" value="Submit"/>
				</div>
				</form>
			<?php
				if(isset($_POST['appt_sch']))
				{
					$frm_id                 = $_REQUEST['fid'];
					$us_id                  = $_REQUEST['uid'];
					$m_u_n                  = $_SESSION['username'];
					$appt_time              = $_POST['appt_time'];
					$location               = $_POST['location'];
					$app_type               = $_POST['app_type'];
					$medical_clearance      = $_POST['medical_clearance'];
					$medical_clearance_area = $_POST['medical_clearance_area'];
					$due_by_date            = $_POST['due_by_date'];
					$travel_remarks         = $_POST['travel_remarks'];
					$travel_remarks_area    = $_POST['travel_remarks_area'];
					$other_remarks          = $_POST['other_remarks'];
					$other_remarks_area     = $_POST['other_remarks_area'];
					$fields                 = array("form_id"=>$frm_id,
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
											"other_remarks_area"=>$other_remarks_area);
											
					
					$insert = $functions->Insert($fields,"appointment_doctor"); 
					if($insert == 1)
					{
						echo "<div class='e_messages'>Appointment has been Schedulled</div>";
					}
					else
					{
						echo "<div class='e_messages'>Some thing Went Wrong. Please Retry.</div>";
					}
					
				}
			?>
			</div>
			
			
			
			
			
			
			<div class="client_status_bg">
				<h1>Client Status</h1>
				<form name="update_status" method="post" action="">
					<div class="client_row">
						<div class="client_right">
							<label>Status Short Note:-</label>
							<input type="text" name="status" id=""/>
						</div>
					</div>
					<div class="client_row">
						<input type="submit" name="up_status" id="" value="Submit"/>
					</div>
				</form>
				<?php
					if(isset($_POST['up_status']))
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
?>
<?php 
}
else
{
header('Location:../login.php');
} 
?>
