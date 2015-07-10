<?php 
$path = $_SERVER['DOCUMENT_ROOT']."/rao/path.php";
require_once($path);
include('header.php');
require_once($config);
include('../classes/login-functions.php');
if(loggedin()) 
{
/*Class file to call the functions*/
?>
<section class="row">
	<div class="container dashboard_bg">
		<div class="dr_upload_doc_slide">
			<div class="dr_message_side_bg">
				<h1>Latest Message</h1>
				<div class="dr_message_side">
					<?php
						$temp_message = mysql_query("SELECT * FROM `message_sent` where `main_user_id`='$doctor_id'") or die(mysql_error());
						while($message= mysql_fetch_object($temp_message))
						{
					?>
						
						<div class="dr_message_side_row">
							<div class="dr_message_side_left">
								<label><?php echo $message->date_message; ?></label>
							</div>
							<div class="dr_message_side_right">
								<label><?php echo $message->message; ?></label>
							</div>
						</div>
					<?php
						}
					?>
				</div>		
			</div>
		</div>
		<div class="slide_right">
			<div class="anesth_bg">
				<?php 
					if(isset($_REQUEST['fid']) && ($_REQUEST['uid']))
					{
				?>
			<div class="view_application">
					<?php

		$tempcheck = mysql_query("SELECT `form_id` FROM `hire_staff` WHERE `hire_id`='$doctor_id' && `user_id`='$_REQUEST[uid]'") or die(mysql_error());
		if(mysql_num_rows($tempcheck)>=1)
		{
						$qry = "SELECT a . * , b . * , c.id AS hi_id
FROM plantiff_information AS a, plantiff_case_type_info AS b, hire_staff AS c
WHERE a.id = b.id && a.form_id = b.form_id && a.id = c.user_id && a.id = c.user_id && b.id = c.user_id
AND b.case_type =1 && hire_id ='$doctor_id' && a.form_id='$_REQUEST[fid]' && b.form_id='$_REQUEST[fid]' && a.id='$_REQUEST[uid]' && b.id='$_REQUEST[uid]'
&& c.user_id='$_REQUEST[uid]'";
						$sql = mysql_query($qry) or die(mysql_error());
						$row = mysql_fetch_array($sql);
						$case_type = $row['case_type'];
						if($case_type =='1' || '3' || '5')
						{
					?>
				<div class="client_1">
					<h2><a href="index.php">Back</a></h2>
					<div class="view_client_row">
						<h1>Plantiff Information</h1>
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
					<div class="view_client_row">
						<div class="client_left">
							<div class="form_field_left">
								<label>UM / UIM</label>
							</div>
							<div class="form_field_right">
								<label class="filled_label">
								<?php
									if($row['um_uim'] == "yes")
									{
										echo '<input type="radio" value="'.$row['um_uim'].'" name="um_uim1" checked> Yes';
									?>
										
									<?php
									}
									else if($row['um_uim']== "no")
									{
										echo '<input type="radio" value="'.$row['um_uim'].'" name="um_uim1" checked> No';
									}
									else
									{
										echo '<input type="radio" value="'.$row['um_uim'].'" name="um_uim1" checked> N/A';
									}
								?>
								</label>
							</div>	
						</div>
					</div>
					<div class="view_client_row">
						<div class="client_left">
							<div class="form_field_left">
								<label>Client ever claim bankruptcy ?</label>
							</div>
							<div class="form_field_right">
								<label class="filled_label">
									<?php
									if($row['client_bankrupty'] == "yes")
									{
										echo '<input type="radio" value="'.$row['client_bankrupty'].'" name="client_bank" checked> Yes';
									}
									else if($row['client_bankrupty']== "no")
									{
										echo '<input type="radio" value="'.$row['client_bankrupty'].'" name="client_bank" checked> No';
									}
									else
									{
										echo '<input type="radio" value="'.$row['client_bankrupty'].'" name="client_bank" checked> N/A';
									}	
								?>
								</label>
							</div>
						</div>
					</div>
				</div><!--client_1_end-->
				<div class="client_2">
					<h1>Plantiff’s Attorney’s Information</h1>
					<div class="view_client_row">
						<label>Firm</label>
						<label class="filled_label"><?php echo $row['att_firm']; ?></label>
					</div>
					<div class="view_client_row">
						<label>Address</label>
						<label class="filled_label"><?php echo $row['att_address']; ?></label>
					</div>
					<div class="view_client_row">
						<div class="client_left">
							<label>Phone</label>
							<label class="filled_label"><?php echo $row['att_phone']; ?></label>
						</div>
						<div class="client_right">
							<label>Fax</label>
							<label class="filled_label"><?php echo $row['att_fax']; ?></label>
						</div>
					</div>
					<div class="view_client_row">
						<div class="client_left">
							<label>Firm Contact Person</label>
							<label class="filled_label"><?php echo $row['att_contact_person']; ?></label>
						</div>
						<div class="client_right">
							<label>Position</label>
							<label class="filled_label"><?php echo $row['att_position']; ?></label>
						</div>
					</div>
					<div class="view_client_row">
						<div class="client_left">
							<label>Contact E-mail</label>
							<label class="filled_label"><?php echo $row['att_email']; ?></label>
						</div>
					</div>
				</div><!--client_2_end-->
				<div class="client_2">
					<h1>Defendant Infomation Insurance ( information is neededwhether or not in suit)</h1>
					<div class="view_client_row">
						<label>Defendant Name</label>
						<label class="filled_label"><?php echo $row['defendant_name']; ?></label>
					</div>
					<div class="view_client_row">
						<label>Insurance Company</label>
						<label class="filled_label"><?php echo $row['insurance_company']; ?></label>
					</div>
					<div class="view_client_row">
						<div class="client_left">
							<label>Claim No</label>
							<label class="filled_label"><?php echo $row['claim_no']; ?></label>
						</div>
						<div class="client_right">
							<label>Limits</label>
							<label class="filled_label"><?php echo $row['d_limits']; ?></label>
						</div>
					</div>
				</div><!--client_2_end-->
				<div class="client_2">
					<h1>Incident Information</h1>
					<div class="view_client_row">
						<label>Date of Injury</label>
						<label class="filled_label"><?php echo $row['date_injury']; ?></label>
					</div>
					<div class="view_client_row">
						<label>Location of Event</label>
						<label class="filled_label"><?php echo $row['location_of_event']; ?></label>
					</div>
					<div class="view_client_row">
						<div class="client_left">
							<label>Description of the Event</label>
							<label class="filled_label"><?php echo $row['description_of_event']; ?></label>
						</div>
						<div class="client_right">
							<label>Description of the Injury</label>
							<label class="filled_label"><?php echo $row['description_of_injury']; ?></label>
						</div>
					</div>
				</div><!--client_2_end-->
				<div class="client_3">
					<h1>Please also provide the following, if Available</h1>
					<div class="view_client_row">
						<div class="form_field_left">
							<label>Police / Accident Report</label>
						</div>
						<div class="form_field_right">
							<label class="filled_label">
								<?php
									if($row['police_report'] == "yes")
									{
										echo '<input type="radio" value="'.$row['police_report'].'" name="police_rep" checked> Yes';
									}
									else
									{
										echo '<input type="radio" value="'.$row['police_report'].'" name="police_rep" checked> No';
									}
								?>
							</label>
						</div>
					</div>
					<div class="view_client_row">
						<div class="form_field_left">
							<label>Medical Record</label>
						</div>
						<div class="form_field_right">
							<label class="filled_label">
								<?php
									if($row['others_injured_too'] == "yes")
									{
										echo '<input type="radio" value="'.$row['others_injured_too'].'" name="um_uim" checked> Yes';
									}
									else
									{
										echo '<input type="radio" value="'.$row['others_injured_too'].'" name="um_uim" checked> No';
									}
								?>	
								</label>
						</div>
					</div>
					<div class="view_client_row">
						<div class="form_field_left">
							<label>Medical Bill</label>
						</div>
						<div class="form_field_right">
							<label class="filled_label">
							<?php
									if($row['witness'] == "yes")
									{
										echo '<input type="radio" value="'.$row['witness'].'" name="witnes" checked> Yes';
									}
									else
									{
										echo '<input type="radio" value="'.$row['witness'].'" name="witnes" checked> No';
									}
								?>
							</label>
						</div>
					</div>
					</div>
				<?php
					}
					else
					{
				?>
		<div class="client_1">
					<div class="view_client_row">
						<h1>Plantiff Information</h1>
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
					<div class="view_client_row">
						<div class="client_left">
							<div class="form_field_left">
								<label>UM / UIM</label>
							</div>
							<div class="form_field_right">
								<label class="filled_label">
								<?php
									if($row['um_uim'] == "yes")
									{
										echo '<input type="radio" value="'.$row['um_uim'].'" name="um_uim1" checked> Yes';
									?>
										
									<?php
									}
									else if($row['um_uim']== "no")
									{
										echo '<input type="radio" value="'.$row['um_uim'].'" name="um_uim1" checked> No';
									}
									else
									{
										echo '<input type="radio" value="'.$row['um_uim'].'" name="um_uim1" checked> N/A';
									}
								?>
								</label>
							</div>	
						</div>
					</div>
					<div class="view_client_row">
						<div class="client_left">
							<div class="form_field_left">
								<label>Client ever claim bankruptcy ?</label>
							</div>
							<div class="form_field_right">
								<label class="filled_label">
									<?php
									if($row['client_bankrupty'] == "yes")
									{
										echo '<input type="radio" value="'.$row['client_bankrupty'].'" name="client_bank" checked> Yes';
									}
									else if($row['client_bankrupty']== "no")
									{
										echo '<input type="radio" value="'.$row['client_bankrupty'].'" name="client_bank" checked> No';
									}
									else
									{
										echo '<input type="radio" value="'.$row['client_bankrupty'].'" name="client_bank" checked> N/A';
									}	
								?>
								</label>
							</div>
						</div>
					</div>
				</div><!--client_1_end-->
				<div class="client_2">
					<h1>Plantiff’s Attorney’s Information</h1>
					<div class="view_client_row">
						<label>Firm</label>
						<label class="filled_label"><?php echo $row['att_firm']; ?></label>
					</div>
					<div class="view_client_row">
						<label>Address</label>
						<label class="filled_label"><?php echo $row['att_address']; ?></label>
					</div>
					<div class="view_client_row">
						<div class="client_left">
							<label>Phone</label>
							<label class="filled_label"><?php echo $row['att_phone']; ?></label>
						</div>
						<div class="client_right">
							<label>Fax</label>
							<label class="filled_label"><?php echo $row['att_fax']; ?></label>
						</div>
					</div>
					<div class="view_client_row">
						<div class="client_left">
							<label>Firm Contact Person</label>
							<label class="filled_label"><?php echo $row['att_contact_person']; ?></label>
						</div>
						<div class="client_right">
							<label>Position</label>
							<label class="filled_label"><?php echo $row['att_position']; ?></label>
						</div>
					</div>
					<div class="view_client_row">
						<div class="client_left">
							<label>Contact E-mail</label>
							<label class="filled_label"><?php echo $row['att_email']; ?></label>
						</div>
					</div>
				</div><!--client_2_end-->
					<div class="client_3">
					<h1>Please also provide the following, if Available</h1>
					<div class="view_client_row">
						<div class="form_field_left">
							<label>Police / Accident Report</label>
						</div>
						<div class="form_field_right">
							<label class="filled_label">
								<?php
									if($row['police_report'] == "yes")
									{
										echo '<input type="radio" value="'.$row['police_report'].'" name="police_rep" checked> Yes';
									}
									else
									{
										echo '<input type="radio" value="'.$row['police_report'].'" name="police_rep" checked> No';
									}
								?>
							</label>
						</div>
					</div>
					<div class="view_client_row">
						<div class="form_field_left">
							<label>Medical Record</label>
						</div>
						<div class="form_field_right">
							<label class="filled_label">
								<?php
									if($row['others_injured_too'] == "yes")
									{
										echo '<input type="radio" value="'.$row['others_injured_too'].'" name="um_uim" checked> Yes';
									}
									else
									{
										echo '<input type="radio" value="'.$row['others_injured_too'].'" name="um_uim" checked> No';
									}
								?>	
								</label>
						</div>
					</div>
					<div class="view_client_row">
						<div class="form_field_left">
							<label>Medical Bill</label>
						</div>
						<div class="form_field_right">
							<label class="filled_label">
							<?php
									if($row['witness'] == "yes")
									{
										echo '<input type="radio" value="'.$row['witness'].'" name="witnes" checked> Yes';
									}
									else
									{
										echo '<input type="radio" value="'.$row['witness'].'" name="witnes" checked> No';
									}
								?>
							</label>
						</div>
					</div>
					</div>
		<?php
			}
		}
		else
		{
				echo "<div class='e_message'>Unexpected Error. No Data. Please Go <a href='index.php'>Back</a></div>";
		}
		}
		else
		{
		?>
				<h1>Search Clients</h1>
				<div class="dr_upload_side_row">
					<div class="tabber" id="tab1">
						<div class="tabbertab">
							<h2><a name="tab1">Ortho Case</a></h2>
							<div class="anesth_search">
								<form>
									<input type="text" name="" id="" placeholder="First Name"/>
									<input type="text" name="" id="" placeholder="Last Name"/>
									<input type="text" name="" id="" placeholder="Date of Birth"/>
									<input type="Submit" name="" id="" value="Search"/>
								</form>
								<div class="anesth_dashbord_client">
					<h1>New Client Application</h1>
					<div class="anesth_box_bg">
						<div class="anesth_row_heading">
							<div class="anesth_span_1">Client No.</div>
							<div class="anesth_span_2">Client Name</div>
							<div class="anesth_span_3">Date of Birth</div>
							<div class="anesth_span_4">Application Date</div>
							<div class="anesth_span_5">Action</div>
						</div>
						<?php
							$count = 0;
							$temp_query = mysql_query("SELECT a.id as hireid,a.form_id as formsid,a.hire_id as doc_id,a.user_id as use_id,
							a.date_time as h_date , b . * 
														FROM hire_staff AS a, plantiff_case_type_info AS b
														WHERE a.form_id = b.form_id
														AND a.user_id = b.id
														AND hire_id ='$doctor_id'
														AND b.case_type =1 order by `form_id` desc") or die(mysql_error());
							while($hires = mysql_fetch_object($temp_query))
							{
								$count++;
								
								$hires->formsid;
								$hires->use_id;
						?>
							<div class="anesth_row_content">
								<?php 
									if($count>0)
									{
								?>
								<div class="anesth_span_1">
									<?php 
										echo $hires->formsid; 
									?>
								</div>
								<div class="anesth_span_2">
									<?php
										$user_id = $hires->use_id;
										echo $functions->GetObjectById($user_id,"first_name")."&nbsp;";
										echo $functions->GetObjectById($user_id,"last_name");
									?>
								</div>
								<div class="anesth_span_3">
									<?php
									 $temp_date_t = $hires->h_date;
									 echo $date_tiem   = date('Y-m-d',strtotime($temp_date_t));
									?>
								</div>
								<div class="anesth_span_4">
									<?php
										$d_o_b          = $functions->GetD_O_B("p_d_o_b",$user_id);
										echo $date_tiem = date('Y-M-d',strtotime($d_o_b));
									?>
								</div>
								<div class="anesth_span_5">
										<a href="index.php?fid=<?=$hires->formsid; ?>&uid=<?=$hires->use_id;?>" class="dr_view">View</a>
										<a href="check-status.php?fid=<?=$hires->formsid; ?>&uid=<?=$hires->use_id;?>" class="dr_check_status">Check Status</a>
								</div>
								<?php
									}
									else
									{
										echo '<h2>There is not record.</h2>';
									}
								?>
							</div>
					<?php
							}
					 ?>
					</div>
				</div>
				<div class="anesth_dashbord_client">
					<h1>Today Appointment</h1>
					<div class="anesth_box_bg">
						<div class="anesth_row_heading">
							<div class="anesth_span_1">Client No.</div>
							<div class="anesth_span_2">Client Name</div>
							<div class="anesth_span_3">Date of Birth</div>
							<div class="anesth_span_4">Application Date</div>
							<div class="anesth_span_5">Action</div>
						</div>
						<div class="anesth_row_content">
							<div class="anesth_span_1">1024568</div>
							<div class="anesth_span_2">Mayo Surgical</div>
							<div class="anesth_span_3">02-01-1988</div>
							<div class="anesth_span_4">02-01-1988</div>
							<div class="anesth_span_5">
								<button class="view_button">view</button>
							</div>
						</div>
						<div class="anesth_row_content">
							<div class="anesth_span_1">1024568</div>
							<div class="anesth_span_2">Mayo Surgical</div>
							<div class="anesth_span_3">02-01-1988</div>
							<div class="anesth_span_4">02-01-1988</div>
							<div class="anesth_span_5">
								<button class="view_button">view</button>
							</div>
						</div>
						<div class="anesth_row_content">
							<div class="anesth_span_1">1024568</div>
							<div class="anesth_span_2">Mayo Surgical</div>
							<div class="anesth_span_3">02-01-1988</div>
							<div class="anesth_span_4">02-01-1988</div>
							<div class="anesth_span_5">
								<button class="view_button">view</button>
							</div>
						</div>
						<div class="anesth_row_content">
							<div class="anesth_span_1">1024568</div>
							<div class="anesth_span_2">Mayo Surgical</div>
							<div class="anesth_span_3">02-01-1988</div>
							<div class="anesth_span_4">02-01-1988</div>
							<div class="anesth_span_5">
								<button class="view_button">view</button>
							</div>
						</div>
						<div class="anesth_row_content">
							<div class="anesth_span_1">1024568</div>
							<div class="anesth_span_2">Mayo Surgical</div>
							<div class="anesth_span_3">02-01-1988</div>
							<div class="anesth_span_4">02-01-1988</div>
							<div class="anesth_span_5">
								<button class="view_button">view</button>
							</div>
						</div>
						<div class="anesth_row_content">
							<div class="anesth_span_1">1024568</div>
							<div class="anesth_span_2">Mayo Surgical</div>
							<div class="anesth_span_3">02-01-1988</div>
							<div class="anesth_span_4">02-01-1988</div>
							<div class="anesth_span_5">
								<button class="view_button">view</button>
							</div>
						</div>
					</div>
				</div>
							</div>
						</div>
						<div class="tabbertab">
							<h2>Mesh Case</h2>
							<div class="anesth_search">
								<form>
									<input type="text" name="" id="" placeholder="First Name"/>
									<input type="text" name="" id="" placeholder="Last Name"/>
									<input type="text" name="" id="" placeholder="Date of Birth"/>
									<input type="Submit" name="" id="" value="Search"/>
								</form>
								<div class="anesth_dashbord_client">
					<h1>New Client Application</h1>
					<div class="anesth_box_bg">
						<div class="anesth_row_heading">
							<div class="anesth_span_1">Client No.</div>
							<div class="anesth_span_2">Client Name</div>
							<div class="anesth_span_3">Date of Birth</div>
							<div class="anesth_span_4">Application Date</div>
							<div class="anesth_span_5">Action</div>
						</div>
						<?php
							$count = 0;
							$temp_query = mysql_query("SELECT a.id as hireid,a.form_id as formsid,a.hire_id as doc_id,a.user_id as use_id,
							a.date_time as h_date , b . * 
														FROM hire_staff AS a, plantiff_case_type_info AS b
														WHERE a.form_id = b.form_id
														AND a.user_id = b.id
														AND hire_id ='$doctor_id'
														AND b.case_type =2 order by `form_id` desc") or die(mysql_error());
							while($hires = mysql_fetch_object($temp_query))
							{
								$count++;
								
								$hires->formsid;
								$hires->use_id;
						?>
							<div class="anesth_row_content">
								<?php 
									if($count>0)
									{
								?>
								<div class="anesth_span_1">
									<?php 
										echo $hires->formsid; 
									?>
								</div>
								<div class="anesth_span_2">
									<?php
										$user_id = $hires->use_id;
										echo $functions->GetObjectById($user_id,"first_name")."&nbsp;";
										echo $functions->GetObjectById($user_id,"last_name");
									?>
								</div>
								<div class="anesth_span_3">
									<?php
									 $temp_date_t = $hires->h_date;
									 echo $date_tiem   = date('Y-m-d',strtotime($temp_date_t));
									?>
								</div>
								<div class="anesth_span_4">
									<?php
										$d_o_b          = $functions->GetD_O_B("p_d_o_b",$user_id);
										echo $date_tiem = date('Y-M-d',strtotime($d_o_b));
									?>
								</div>
								<div class="anesth_span_5">
										<a href="index.php?fid=<?=$hires->formsid; ?>&uid=<?=$hires->use_id;?>">View</a>
								</div>
								<?php
									}
									else
									{
										echo '<h2>There is not record.</h2>';
									}
								?>
							</div>
					<?php
							}
					 ?>
					</div>
				</div>
				<div class="anesth_dashbord_client">
					<h1>Today Appointment</h1>
					<div class="anesth_box_bg">
						<div class="anesth_row_heading">
							<div class="anesth_span_1">Client No.</div>
							<div class="anesth_span_2">Client Name</div>
							<div class="anesth_span_3">Date of Birth</div>
							<div class="anesth_span_4">Application Date</div>
							<div class="anesth_span_5">Action</div>
						</div>
						<div class="anesth_row_content">
							<div class="anesth_span_1">1024568</div>
							<div class="anesth_span_2">Mayo Surgical</div>
							<div class="anesth_span_3">02-01-1988</div>
							<div class="anesth_span_4">02-01-1988</div>
							<div class="anesth_span_5">
									<a href="check-status.php?fid=<?=$hires->formsid; ?>&uid=<?=$hires->use_id;?>" class="dr_check_status">Check Status</a>
								</div>
						</div>
						<div class="anesth_row_content">
							<div class="anesth_span_1">1024568</div>
							<div class="anesth_span_2">Mayo Surgical</div>
							<div class="anesth_span_3">02-01-1988</div>
							<div class="anesth_span_4">02-01-1988</div>
							<div class="anesth_span_5">
									<a href="check-status.php?fid=<?=$hires->formsid; ?>&uid=<?=$hires->use_id;?>" class="dr_check_status">Check Status</a>
								</div>
						</div>
						<div class="anesth_row_content">
							<div class="anesth_span_1">1024568</div>
							<div class="anesth_span_2">Mayo Surgical</div>
							<div class="anesth_span_3">02-01-1988</div>
							<div class="anesth_span_4">02-01-1988</div>
							<div class="anesth_span_5">
									<a href="check-status.php?fid=<?=$hires->formsid; ?>&uid=<?=$hires->use_id;?>" class="dr_check_status">Check Status</a>
								</div>
						</div>
						<div class="anesth_row_content">
							<div class="anesth_span_1">1024568</div>
							<div class="anesth_span_2">Mayo Surgical</div>
							<div class="anesth_span_3">02-01-1988</div>
							<div class="anesth_span_4">02-01-1988</div>
							<div class="anesth_span_5">
									<a href="check-status.php?fid=<?=$hires->formsid; ?>&uid=<?=$hires->use_id;?>" class="dr_check_status">Check Status</a>
								</div>
						</div>
						<div class="anesth_row_content">
							<div class="anesth_span_1">1024568</div>
							<div class="anesth_span_2">Mayo Surgical</div>
							<div class="anesth_span_3">02-01-1988</div>
							<div class="anesth_span_4">02-01-1988</div>
							<div class="anesth_span_5">
									<a href="check-status.php?fid=<?=$hires->formsid; ?>&uid=<?=$hires->use_id;?>" class="dr_check_status">Check Status</a>
								</div>
						</div>
						<div class="anesth_row_content">
							<div class="anesth_span_1">1024568</div>
							<div class="anesth_span_2">Mayo Surgical</div>
							<div class="anesth_span_3">02-01-1988</div>
							<div class="anesth_span_4">02-01-1988</div>
							<div class="anesth_span_5">
									<a href="check-status.php?fid=<?=$hires->formsid; ?>&uid=<?=$hires->use_id;?>" class="dr_check_status">Check Status</a>
								</div>
						</div>
					</div>
				</div>
							</div>
						</div>
						<div class="tabbertab">
							<h2>Pain Management Case</h2>
							<div class="anesth_search">
								<form>
									<input type="text" name="" id="" placeholder="First Name"/>
									<input type="text" name="" id="" placeholder="Last Name"/>
									<input type="text" name="" id="" placeholder="Date of Birth"/>
									<input type="Submit" name="" id="" value="Search"/>
								</form>
							<div class="anesth_dashbord_client">
					<h1>New Client Application</h1>
					<div class="anesth_box_bg">
						<div class="anesth_row_heading">
							<div class="anesth_span_1">Client No.</div>
							<div class="anesth_span_2">Client Name</div>
							<div class="anesth_span_3">Date of Birth</div>
							<div class="anesth_span_4">Application Date</div>
							<div class="anesth_span_5">Action</div>
						</div>
						<?php
							$count = 0;
							$temp_query = mysql_query("SELECT a.id as hireid,a.form_id as formsid,a.hire_id as doc_id,a.user_id as use_id,
							a.date_time as h_date , b . * 
														FROM hire_staff AS a, plantiff_case_type_info AS b
														WHERE a.form_id = b.form_id
														AND a.user_id = b.id
														AND hire_id ='$doctor_id'
														AND b.case_type = 3 order by `form_id` desc") or die(mysql_error());
							while($hires = mysql_fetch_object($temp_query))
							{
								$count++;
								
								$hires->formsid;
								$hires->use_id;
						?>
							<div class="anesth_row_content">
								<?php 
									if($count>0)
									{
								?>
								<div class="anesth_span_1">
									<?php 
										echo $hires->formsid; 
									?>
								</div>
								<div class="anesth_span_2">
									<?php
										$user_id = $hires->use_id;
										echo $functions->GetObjectById($user_id,"first_name")."&nbsp;";
										echo $functions->GetObjectById($user_id,"last_name");
									?>
								</div>
								<div class="anesth_span_3">
									<?php
									 $temp_date_t = $hires->h_date;
									 echo $date_tiem   = date('Y-m-d',strtotime($temp_date_t));
									?>
								</div>
								<div class="anesth_span_4">
									<?php
										$d_o_b          = $functions->GetD_O_B("p_d_o_b",$user_id);
										echo $date_tiem = date('Y-M-d',strtotime($d_o_b));
									?>
								</div>
								<div class="anesth_span_5">
										<a href="index.php?fid=<?=$hires->formsid; ?>&uid=<?=$hires->use_id;?>">View</a>
								</div>
								<?php
									}
									else
									{
										echo '<h2>There is not record.</h2>';
									}
								?>
							</div>
					<?php
							}
					 ?>
					</div>
				</div>
				<div class="anesth_dashbord_client">
					<h1>Today Appointment</h1>
					<div class="anesth_box_bg">
						<div class="anesth_row_heading">
							<div class="anesth_span_1">Client No.</div>
							<div class="anesth_span_2">Client Name</div>
							<div class="anesth_span_3">Date of Birth</div>
							<div class="anesth_span_4">Application Date</div>
							<div class="anesth_span_5">Action</div>
						</div>
						<div class="anesth_row_content">
							<div class="anesth_span_1">1024568</div>
							<div class="anesth_span_2">Mayo Surgical</div>
							<div class="anesth_span_3">02-01-1988</div>
							<div class="anesth_span_4">02-01-1988</div>
							<div class="anesth_span_5">
									<a href="check-status.php?fid=<?=$hires->formsid; ?>&uid=<?=$hires->use_id;?>" class="dr_check_status">Check Status</a>
								</div>
						</div>
						
						<div class="anesth_row_content">
							<div class="anesth_span_1">1024568</div>
							<div class="anesth_span_2">Mayo Surgical</div>
							<div class="anesth_span_3">02-01-1988</div>
							<div class="anesth_span_4">02-01-1988</div>
							<div class="anesth_span_5">
									<a href="check-status.php?fid=<?=$hires->formsid; ?>&uid=<?=$hires->use_id;?>" class="dr_check_status">Check Status</a>
								</div>
						</div>
						<div class="anesth_row_content">
							<div class="anesth_span_1">1024568</div>
							<div class="anesth_span_2">Mayo Surgical</div>
							<div class="anesth_span_3">02-01-1988</div>
							<div class="anesth_span_4">02-01-1988</div>
							<div class="anesth_span_5">
									<a href="check-status.php?fid=<?=$hires->formsid; ?>&uid=<?=$hires->use_id;?>" class="dr_check_status">Check Status</a>
								</div>
						</div>
						<div class="anesth_row_content">
							<div class="anesth_span_1">1024568</div>
							<div class="anesth_span_2">Mayo Surgical</div>
							<div class="anesth_span_3">02-01-1988</div>
							<div class="anesth_span_4">02-01-1988</div>
							<div class="anesth_span_5">
									<a href="check-status.php?fid=<?=$hires->formsid; ?>&uid=<?=$hires->use_id;?>" class="dr_check_status">Check Status</a>
								</div>
						</div>
						
					</div>
				</div>
							</div>
						</div>
						<div class="tabbertab">
							<h2>General Surgery Case</h2>
							<div class="anesth_search">
								<form>
									<input type="text" name="" id="" placeholder="First Name"/>
									<input type="text" name="" id="" placeholder="Last Name"/>
									<input type="text" name="" id="" placeholder="Date of Birth"/>
									<input type="Submit" name="" id="" value="Search"/>
								</form>
								<div class="anesth_dashbord_client">
					<h1>New Client Application</h1>
					<div class="anesth_box_bg">
						<div class="anesth_row_heading">
							<div class="anesth_span_1">Client No.</div>
							<div class="anesth_span_2">Client Name</div>
							<div class="anesth_span_3">Date of Birth</div>
							<div class="anesth_span_4">Application Date</div>
							<div class="anesth_span_5">Action</div>
						</div>
						<?php
							$count = 0;
							$temp_query = mysql_query("SELECT a.id as hireid,a.form_id as formsid,a.hire_id as doc_id,a.user_id as use_id,
							a.date_time as h_date , b . * 
														FROM hire_staff AS a, plantiff_case_type_info AS b
														WHERE a.form_id = b.form_id
														AND a.user_id = b.id
														AND hire_id ='$doctor_id'
														AND b.case_type = 4 order by `form_id` desc") or die(mysql_error());
							while($hires = mysql_fetch_object($temp_query))
							{
								$count++;
								
								$hires->formsid;
								$hires->use_id;
						?>
							<div class="anesth_row_content">
								<?php 
									if($count>0)
									{
								?>
								<div class="anesth_span_1">
									<?php 
										echo $hires->formsid; 
									?>
								</div>
								<div class="anesth_span_2">
									<?php
										$user_id = $hires->use_id;
										echo $functions->GetObjectById($user_id,"first_name")."&nbsp;";
										echo $functions->GetObjectById($user_id,"last_name");
									?>
								</div>
								<div class="anesth_span_3">
									<?php
									 $temp_date_t = $hires->h_date;
									 echo $date_tiem   = date('Y-m-d',strtotime($temp_date_t));
									?>
								</div>
								<div class="anesth_span_4">
									<?php
										$d_o_b          = $functions->GetD_O_B("p_d_o_b",$user_id);
										echo $date_tiem = date('Y-M-d',strtotime($d_o_b));
									?>
								</div>
								<div class="anesth_span_5">
										<a href="index.php?fid=<?=$hires->formsid; ?>&uid=<?=$hires->use_id;?>">View</a>
								</div>
								<?php
									}
									else
									{
										echo '<h2>There is not record.</h2>';
									}
								?>
							</div>
					<?php
							}
					 ?>
					</div>
				</div>
				<div class="anesth_dashbord_client">
					<h1>Today Appointment</h1>
					<div class="anesth_box_bg">
						<div class="anesth_row_heading">
							<div class="anesth_span_1">Client No.</div>
							<div class="anesth_span_2">Client Name</div>
							<div class="anesth_span_3">Date of Birth</div>
							<div class="anesth_span_4">Application Date</div>
							<div class="anesth_span_5">Action</div>
						</div>
						<div class="anesth_row_content">
							<div class="anesth_span_1">1024568</div>
							<div class="anesth_span_2">Mayo Surgical</div>
							<div class="anesth_span_3">02-01-1988</div>
							<div class="anesth_span_4">02-01-1988</div>
							<div class="anesth_span_5">
									<a href="check-status.php?fid=<?=$hires->formsid; ?>&uid=<?=$hires->use_id;?>" class="dr_check_status">Check Status</a>
								</div>
						</div>
						
						<div class="anesth_row_content">
							<div class="anesth_span_1">1024568</div>
							<div class="anesth_span_2">Mayo Surgical</div>
							<div class="anesth_span_3">02-01-1988</div>
							<div class="anesth_span_4">02-01-1988</div>
							<div class="anesth_span_5">
									<a href="check-status.php?fid=<?=$hires->formsid; ?>&uid=<?=$hires->use_id;?>" class="dr_check_status">Check Status</a>
								</div>
						</div>
						<div class="anesth_row_content">
							<div class="anesth_span_1">1024568</div>
							<div class="anesth_span_2">Mayo Surgical</div>
							<div class="anesth_span_3">02-01-1988</div>
							<div class="anesth_span_4">02-01-1988</div>
							<div class="anesth_span_5">
									<a href="check-status.php?fid=<?=$hires->formsid; ?>&uid=<?=$hires->use_id;?>" class="dr_check_status">Check Status</a>
								</div>
						</div>
						
					</div>
				</div>
							</div>
						</div>
						<div class="tabbertab">
							<h2>Spine/Neuro Case</h2>
							<div class="anesth_search">
								<form>
									<input type="text" name="" id="" placeholder="First Name"/>
									<input type="text" name="" id="" placeholder="Last Name"/>
									<input type="text" name="" id="" placeholder="Date of Birth"/>
									<input type="Submit" name="" id="" value="Search"/>
								</form>
							<div class="anesth_dashbord_client">
					<h1>New Client Application</h1>
					<div class="anesth_box_bg">
						<div class="anesth_row_heading">
							<div class="anesth_span_1">Client No.</div>
							<div class="anesth_span_2">Client Name</div>
							<div class="anesth_span_3">Date of Birth</div>
							<div class="anesth_span_4">Application Date</div>
							<div class="anesth_span_5">Action</div>
						</div>
						<?php
							$count1 = 0;
							$temp_query = mysql_query("SELECT a.id as hireid,a.form_id as formsid,a.hire_id as doc_id,a.user_id as use_id,
							a.date_time as h_date , b . * 
														FROM hire_staff AS a, plantiff_case_type_info AS b
														WHERE a.form_id = b.form_id
														AND a.user_id = b.id
														AND hire_id ='$doctor_id'
														AND b.case_type =5 order by `form_id` desc") or die(mysql_error());
							while($hires = mysql_fetch_object($temp_query))
							{
								
								$hires->formsid;
								$hires->use_id;
						?>
							<div class="anesth_row_content">
										<div class="anesth_span_1">
									<?php 
										echo $hires->formsid; 
									?>
								</div>
								<div class="anesth_span_2">
									<?php
										$user_id = $hires->use_id;
										echo $functions->GetObjectById($user_id,"first_name")."&nbsp;";
										echo $functions->GetObjectById($user_id,"last_name");
									?>
								</div>
								<div class="anesth_span_3">
									<?php
									 $temp_date_t = $hires->h_date;
									 echo $date_tiem   = date('Y-m-d',strtotime($temp_date_t));
									?>
								</div>
								<div class="anesth_span_4">
									<?php
										$d_o_b          = $functions->GetD_O_B("p_d_o_b",$user_id);
										echo $date_tiem = date('Y-M-d',strtotime($d_o_b));
									?>
								</div>
								<div class="anesth_span_5">
										<a href="index.php?fid=<?=$hires->formsid; ?>&uid=<?=$hires->use_id;?>">View</a>
								</div>
							</div>
					<?php
							
							}
					 ?>
					</div>
				</div>
				<div class="anesth_dashbord_client">
					<h1>Today Appointment</h1>
					<div class="anesth_box_bg">
						
						<div class="anesth_row_content">
							<div class="anesth_span_1">1024568</div>
							<div class="anesth_span_2">Mayo Surgical</div>
							<div class="anesth_span_3">02-01-1988</div>
							<div class="anesth_span_4">02-01-1988</div>
							<div class="anesth_span_5">
									<a href="check-status.php?fid=<?=$hires->formsid; ?>&uid=<?=$hires->use_id;?>" class="dr_check_status">Check Status</a>
								</div>
						</div>
						<div class="anesth_row_content">
							<div class="anesth_span_1">1024568</div>
							<div class="anesth_span_2">Mayo Surgical</div>
							<div class="anesth_span_3">02-01-1988</div>
							<div class="anesth_span_4">02-01-1988</div>
							<div class="anesth_span_5">
									<a href="check-status.php?fid=<?=$hires->formsid; ?>&uid=<?=$hires->use_id;?>" class="dr_check_status">Check Status</a>
								</div>
						</div>
						<div class="anesth_row_content">
							<div class="anesth_span_1">1024568</div>
							<div class="anesth_span_2">Mayo Surgical</div>
							<div class="anesth_span_3">02-01-1988</div>
							<div class="anesth_span_4">02-01-1988</div>
							<div class="anesth_span_5">
									<a href="check-status.php?fid=<?=$hires->formsid; ?>&uid=<?=$hires->use_id;?>" class="dr_check_status">Check Status</a>
								</div>
						</div>
						<div class="anesth_row_content">
							<div class="anesth_span_1">1024568</div>
							<div class="anesth_span_2">Mayo Surgical</div>
							<div class="anesth_span_3">02-01-1988</div>
							<div class="anesth_span_4">02-01-1988</div>
							<div class="anesth_span_5">
									<a href="check-status.php?fid=<?=$hires->formsid; ?>&uid=<?=$hires->use_id;?>" class="dr_check_status">Check Status</a>
								</div>
						</div>
					</div>
				</div>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
		</div>
	</div>
</section>
<script type="text/javascript">
	document.write('<style type="text/css">.tabber{display:none;}<\/style>');
	var tabberOptions = {
		'manualStartup':true,
		'onLoad':function(argsObj) {
		/* Display an alert only after tab2 */
			if (argsObj.tabber.id == 'tab2') {
				alert('Finished loading tab2!');
			}
		},
		'onClick':function(argsObj) {
			var t = argsObj.tabber; /* Tabber object */
			var id = t.id; /* ID of the main tabber DIV */
			var i = argsObj.index; /* Which tab was clicked (0 is the first tab) */
			var e = argsObj.event; /* Event object */
			if (id == 'tab2') {
				return confirm('Swtich to '+t.tabs[i].headingText+'?\nEvent type: '+e.type);
			}
		},
		'addLinkId':true
	};
</script>
<script type="text/javascript" src="<?php echo $sitepath; ?>/tabs/tabber.js"></script>
<script type="text/javascript" src="<?php echo $sitepath; ?>/tabs/example.css"></script>
<script type="text/javascript">
	tabberAutomatic(tabberOptions);
</script>
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
