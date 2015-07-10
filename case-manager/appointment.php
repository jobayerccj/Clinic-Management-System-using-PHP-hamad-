<?php
	class Appointment extends Allfunctions
	{
		
		public function getAppointment($var,$doctor_id)
		{
?>
		<div class="anesth_dashbord_client">
			<h1>Todays Appointments</h1>
			<div class="anesth_box_bg">
				<div class="anesth_row_heading">
					<div class="anesth_span_1">Client No.</div>
					<div class="anesth_span_2">Client Name</div>
					<div class="anesth_span_3">Date of Birth</div>
					<div class="anesth_span_4">Application Date</div>
					<div class="anesth_span_5">Action</div>
				</div>
			<?php
				$date_time = date('d-m-Y');
				$quefry = "SELECT a.case_id,b.* from plantiff_case_type_info as a,appointment_doctor as b where a.form_id = b.form_id && a.id=b.user_id && b.date_appt LIKE '%$date_time%' && a.case_closed=0 && a.case_type='$var'";
				$appoint_temp = mysql_query("SELECT a.case_id,b.* from plantiff_case_type_info as a,appointment_doctor as b where a.form_id = b.form_id && a.id=b.user_id && b.date_appt LIKE '%$date_time%' && a.case_closed=0 && a.case_type='$var'") or die(mysql_error());
				
				if(mysql_num_rows($appoint_temp)>0)
				{
					while($appt = mysql_fetch_object($appoint_temp))
					{
			?>
					<div class="anesth_row_content">
						<div class="anesth_span_1"><?=$appt->form_id?></div>
						<div class="anesth_span_2">
						<?php 
							$user_id = $appt->user_id; 
							$name = $this->GetInfoFrompi('plantiff_name',$user_id);
							echo ucwords($name);
						?>
						</div>
						<div class="anesth_span_3"><?=$this->GetInfoFrompi('p_d_o_b',$user_id);?></div>
						<div class="anesth_span_4"><?php echo $appt->date_appt;?></div>
						<div class="anesth_span_5">
							<a href="/underwriter/index.php?fid=<?php echo $appt->form_id; ?>&uid=<?php echo $appt->user_id; ?>" class="dr_check_status">view</a>
						</div>
					</div>				
			<?php
					}
				}
				else
				{
					echo "<h1 style='text-align:center'>There is no Appointment Today.</h2>";
				}
			?>
			</div>
		</div>
<?php
		}
		public function getClientRecords($var,$attorneys_id)
		{
?>
		
			<div class="anesth_dashbord_client">
				<h1>New Client Application</h1>
				<div class="anesth_box_bg">
					<div class="anesth_row_heading">
						<div class="client_row_heading">

						<div class="client_att_1">Client No.</div>

						<div class="client_att_2">Client Name</div>

						<div class="client_att_3">Email Address</div>

						<div class="client_att_4">State</div>

						<div class="client_att_5">Application Date</div>

						<div class="client_att_6">Messages</div>

						<div class="client_att_7">Action</div>

						</div>
						
					</div>
					<?php
					
						$tempgetinfo = mysql_query("SELECT a . * , b . * FROM plantiff_information AS a,  `plantiff_case_type_info` AS b
					WHERE a.form_id = b.form_id && a.id = b.id && b.case_type = '$var' && b.admin_approved =1 && b.attorney_id = '$attorneys_id' order by a.form_id desc") or die(mysql_error());
						if(mysql_num_rows($tempgetinfo)>0)
						{
						while($getinfo=mysql_fetch_object($tempgetinfo))
						{
							
							$client_id = $getinfo->id;
					?>
					<div class="client_row_content">

							<input type="hidden" name="form_di" value="<?php echo $getinfo->form_id; ?>">

							<div class="client_att_1"><?php echo $getinfo->form_id; ?></div>

							<div class="client_att_2">

								<?php 

									$firstname = $this->GetObjectById($client_id,"first_name");

									$lastname  = $this->GetobjectById($client_id,"last_name");

									echo ucwords($firstname)."&nbsp;".ucwords($lastname); 

								?>

							</div>

							<div class="client_att_3">

								<?php 

									echo $email_id = $this->GetObjectById($client_id,"email_id"); 

								?>

							</div>

							<div class="client_att_4">

								<?php 

									$state  = $getinfo->p_state;

									echo $this->GetStatebyStateCode($state);

								?>

								</div>

							<div class="client_att_5">

								<?php 

									echo date('Y-m-d',strtotime($getinfo->p_date)); 

								?>

							</div>

							

							

							

							<div class="client_att_6">

								<a href="messages.php?fid=<?php echo $getinfo->form_id; ?>&uid=<?php echo $getinfo->id; ?>&cid=<?php echo $getinfo->case_type; ?>">

									<span class="pending_status1">Messages</span>

								</a>

							</div>

				

								

							<div class="client_att_7">

								<a class="dr_check_status" href="check-status.php?fid=<?php echo $getinfo->form_id; ?>&uid=<?php echo $getinfo->id; ?>&cid=<?php echo $getinfo->case_type; ?>&action=upload">

									View Application

								</a>

							</div>

							

						</div>	
					<?php
							}
						}
						else
						{
							echo "<h1 style='text-align:center;'>There is no Record</h1>";
						}
					?>
				</div>
			</div>
		</div>			
<?php
	}
	/* meshed case for case_id=2,4*/
	function meshedView($row)
	{
?>
<div class="back_btn_area">
<a href="index.php"><input name="" type="button" class="back_btn" value="<<Back"/></a>
</div>
<div class="attorney_client_info">
  <h1>Client Information</h1>
<div class="view_client_row">
  <div class="client_left">
    <label>Client Name</label>
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
  <div class="client_right"><label>Address</label>
  <label class="filled_label"><?php echo $row['p_address']; ?></label>
</div>
</div>
<div class="view_client_row">
  <div class="client_left">
    <label>State</label>
    <label class="filled_label">
    <?php 
		$m_state = $row['p_state']; 
		echo $state1 = $this->GetStatebyStateCode($m_state)
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
  <div class="view_client_row">
    <h1>Attorney / Case Manager Information</h1>
    <div class="view_client_row">
      <div class="client_left">
      <label>Firm</label>
      <label class="filled_label"><?php echo $row['att_firm']; ?></label>
      </div>
    </div>
    <div class="view_client_row">
     <div class="client_left">
      <label>Address</label>
      <label class="filled_label"><?php echo $row['att_address']; ?></label>
      </div>
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
      <div class="client_left">
        <label>Contact E-mail</label>
        <label class="filled_label"><?php echo $row['att_email']; ?></label>
    </div>
  </div>
</div>
<!--attorney_client_info_end-->
<div class="attorney_client_info">
  <h1>Please also provide the following, if Available</h1>
  <div class="view_client_row">
    <div class="form_field_left">
      <label>Signed Medical Records Release Form</label>
    </div>
    <div class="form_field_right">
      <label class="checkbox_label">
	  <?php
		$signed_medical_records = $row['signed_medical_records'];
		if($_SESSION['designation']=='8' ||$_SESSION['designation']=='7' || $_SESSION['designation']=='2')
		{
	  ?>
        <input type="radio" name="signed_medical" onchange="window.open('<?php echo $path; ?>/upload-docs.php?fid=<?php echo $_REQUEST['fid']; ?>&uid=<?php echo $_REQUEST['uid']; ?>&mid=<?php echo $this->GetDetailsByUsername($_SESSION['username'],"id");?>&cid=2&name=sm')" value="<?=$signed_medical_records?>" <?php if(isset($signed_medical_records) && $signed_medical_records=="download"){ echo "checked"; } ?> />
        Download
	<?php
		}
		else
		{
	?>
		<input type="radio" name="signed_medical" value="<?=$signed_medical_records?>" <?php if(isset($signed_medical_records) && $signed_medical_records=="download"){ echo "checked"; } ?> />
        Download
	<?php
		}
	?>
		</label>
      <label class="checkbox_label">
        <input type="radio" name="signed_medical" value="<?=$signed_medical_records?>" <?php if(isset($signed_medical_records) && $signed_medical_records=="n/a"){ echo "checked"; } ?> id=""/>
        N/A </label>
      <label class="checkbox_label">
        <input type="radio" name="signed_medical" value="<?=$signed_medical_records?>" <?php if(isset($signed_medical_records) && $signed_medical_records=="will fax"){ echo "checked"; } ?> id=""/>
        Will Fax </label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="form_field_left">
      <label>Product Label</label>
    </div>
    <div class="form_field_right">
      <label class="checkbox_label">
	  <?php 
		$product_label = $row['product_label'];
		if($_SESSION['designation']=='8' ||$_SESSION['designation']=='7' || $_SESSION['designation']=='2')
		{
	  ?>
        <input type="radio" name="police_report" onchange="window.open('<?php echo $path; ?>/upload-docs.php?fid=<?php echo $_REQUEST['fid']; ?>&uid=<?php echo $_REQUEST['uid']; ?>&mid=<?php echo $this->GetDetailsByUsername($_SESSION['username'],"id");?>&cid=2&name=pl')" value="<?=$product_label?>" id="" <?php if(isset($product_label) && $product_label=="download"){ echo "checked"; } ?> />
        Download </label>
	<?php	
		}
		else
		{
	?>
		<input type="radio" name="police_report" value="<?=$product_label?>" id="" <?php if(isset($product_label) && $product_label=="download"){ echo "checked"; } ?> />
        Download </label>
	<?php
		}
	?>
      <label class="checkbox_label">
        <input type="radio" name="police_report" value="<?=$product_label?>" id=""<?php if(isset($product_label) && $product_label=="n/a"){ echo "checked"; } ?> />
        N/A </label>
      <label class="checkbox_label">
        <input type="radio" name="police_report" value="<?=$product_label?>" id="" <?php if(isset($product_label) && $product_label=="will fax"){ echo "checked"; } ?> />
        Will Fax </label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="form_field_left">
      <label>Medical Bill</label>
    </div>

    <div class="form_field_right">
      <label class="checkbox_label">
	  <?php 
		$medical_bi = $row['medial_bill']; 
		if($_SESSION['designation']=='8' ||$_SESSION['designation']=='7' || $_SESSION['designation']=='2')
		{
	?>
        <input type="radio" name="medical_bill" onchange="window.open('<?php echo $path; ?>/upload-docs.php?fid=<?php echo $_REQUEST['fid']; ?>&uid=<?php echo $_REQUEST['uid']; ?>&mid=<?php echo $this->GetDetailsByUsername($_SESSION['username'],"id");?>&cid=2&name=ml')" value="<?=$polic_acc_rep?>" id="" <?php if(isset($medical_bi) && $medical_bi=="download"){ echo "checked"; } ?> />
	<?php
		}
		else
		{
	?>
		 <input type="radio" name="medical_bill" value="<?=$polic_acc_rep?>" id="" <?php if(isset($medical_bi) && $medical_bi=="download"){ echo "checked"; } ?> />
	<?php
		}
	?>
        Download </label>
      <label class="checkbox_label">
        <input type="radio" name="medical_bill" value="<?=$polic_acc_rep?>" id="" <?php if(isset($medical_bi) && $medical_bi=="n/a"){ echo "checked"; } ?>/>
        N/A </label>
      <label class="checkbox_label">
        <input type="radio" name="medical_bill" value="<?=$polic_acc_rep?>" id="" <?php if(isset($medical_bi) && $medical_bi=="will fax"){ echo "checked"; } ?> />
        Will Fax </label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="form_field_left">
      <label>Medical Records</label>
    </div>
  
    <div class="form_field_right">
      <label class="checkbox_label">
	 <?php 
		$medical_record = $row['medical_record']; 
		if($_SESSION['designation']=='8' ||$_SESSION['designation']=='7' || $_SESSION['designation']=='2')
		{
	?>
        <input type="radio" name="medical_records" onchange="window.open('<?php echo $path; ?>/upload-docs.php?fid=<?php echo $_REQUEST['fid']; ?>&uid=<?php echo $_REQUEST['uid']; ?>&mid=<?php echo $this->GetDetailsByUsername($_SESSION['username'],"id");?>&cid=2&name=mr')" value="<?=$polic_acc_rep?>" <?php if(isset($medical_record) && $medical_record=="download"){ echo "checked"; } ?> />
        Download </label>
	<?php
		}
		else
		{
	?>
		<input type="radio" name="medical_records" value="<?=$polic_acc_rep?>" <?php if(isset($medical_record) && $medical_record=="download"){ echo "checked"; } ?> />
        Download </label>
	<?php
		}
	?>
      <label class="checkbox_label">
        <input type="radio" name="medical_records" value="<?=$polic_acc_rep?>" <?php if(isset($medical_record) && $medical_record=="n/a"){ echo "checked"; } ?> />
        N/A </label>
      <label class="checkbox_label">
        <input type="radio" name="medical_records" value="<?=$polic_acc_rep?>" <?php if(isset($medical_record) && $medical_record=="will fax"){ echo "checked"; } ?> />
        Will Fax </label>
    </div>
  </div>
  <div class="view_client_row">
    <h1>Optional Documents</h1>
    <div class="form_field_left">
      <label>Travel Bills</label>
    </div>
    <div class="form_field_right">
      <label class="checkbox_label">
	  <?php 
		$travel_bill=$row['travel_bills']; 
		if($_SESSION['designation']=='8' ||$_SESSION['designation']=='7' || $_SESSION['designation']=='2')
		{
	?>
        <input type="radio" name="travel_bills" onchange="window.open('<?php echo $path; ?>/upload-docs.php?fid=<?php echo $_REQUEST['fid']; ?>&uid=<?php echo $_REQUEST['uid']; ?>&mid=<?php echo $this->GetDetailsByUsername($_SESSION['username'],"id");?>&cid=2&name=tb')" value="<?=$travel_bill?>" <?php if(isset($travel_bill) && $travel_bill=="download"){ echo "checked"; } ?> />
	<?php
		}
		else
		{
	?>
		<input type="radio" name="travel_bills" value="<?=$travel_bill?>" <?php if(isset($travel_bill) && $travel_bill=="download"){ echo "checked"; } ?> />
	<?php
		}
	?>
        Download </label>
      <label class="checkbox_label">
        <input type="radio" name="travel_bills" value="<?=$travel_bill?>" <?php if(isset($travel_bill) && $travel_bill=="n/a"){ echo "checked"; } ?> />
        N/A </label>
      <label class="checkbox_label">
        <input type="radio" name="travel_bills" value="<?=$travel_bill?>" <?php if(isset($travel_bill) && $travel_bill=="will fax"){ echo "checked"; } ?> />
        Will Fax </label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="form_field_left">
      <label>Other</label>
    </div>
   
    <div class="form_field_right">
      <label class="checkbox_label">
		 <?php 
			$other_bill = $row['other'];
			if($_SESSION['designation']=='8' ||$_SESSION['designation']=='7' || $_SESSION['designation']=='2')
			{
		?>
			<input type="radio" name="other_records" onchange="window.open('<?php echo $path; ?>/upload-docs.php?fid=<?php echo $_REQUEST['fid']; ?>&uid=<?php echo $_REQUEST['uid']; ?>&mid=<?php echo $this->GetDetailsByUsername($_SESSION['username'],"id");?>&cid=2&name=ob')" value="<?=$other_bill?>" <?php if(isset($travel_bill) && $travel_bill=="download"){ echo "checked"; } ?>/>
		<?php
			}
		?>
        Download </label>
      <label class="checkbox_label">
        <input type="radio" name="other_records" value="<?=$other_bill?>" <?php if(isset($travel_bill) && $travel_bill=="n/a"){ echo "checked"; } ?> />
        N/A </label>
      <label class="checkbox_label">
        <input type="radio" name="other_records" value="<?=$other_bill?>" <?php if(isset($travel_bill) && $travel_bill=="will fax"){ echo "checked"; } ?> />
        Will Fax </label>
    </div>
  </div>
</div>
<?php
	}
	
	/*ortho case for case_id=1,3,5*/
	
	function orthoView($row)
	{
?>
<div class="back_btn_area">
<a href="index.php"><input name="" type="button" class="back_btn" value="<<Back"/></a>
</div>
<div class="attorney_client_info">
  <h1>Client Information</h1>
  <div class="view_client_row">
    <div class="client_left">
      <label>Client Name</label>
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
    <div class="client_left">
    <label>Address</label>
    <label class="filled_label add_area"><?php echo $row['p_address']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="client_left">
      <label>State</label>
      <label class="filled_label">
        <?php 
					$o_state = $row['p_state']; 
					echo $statess = $this->GetStatebyStateCode($o_state);
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
  <div class="view_client_row">
    <div class="client_left">
    <label>Auto Insurance Carrier (Auto collision only)</label>
    <label class="filled_label"><?php echo $row['auto_insurance']; ?></label>
    </div>
  </div>
</div>
<!--attorney_client_info_end-->
<div class="attorney_client_info">
  <h1>Client Attorney’s Information</h1>
  <div class="view_client_row">
   <div class="client_left">
    <label>Firm</label>
    <label class="filled_label"><?php echo $row['att_firm']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="client_left">
    <label>Address</label>
    <label class="filled_label add_area"><?php echo $row['att_address']; ?></label>
    </div>
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
</div>
<!--attorney_client_info_end-->
<div class="attorney_client_info">
  <h1>Defendant Insurance Information ( information is neededwhether or not in suit)</h1>
  <div class="view_client_row">
    <div class="client_left">
    <label>Defendant Name</label>
    <label class="filled_label"><?php echo $row['defendant_name']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="client_left">
    <label>Insurance Company</label>
    <label class="filled_label"><?php echo $row['insurance_company']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="client_left">
      <label>Claim No</label>
      <label class="filled_label"><?php echo $row['claim_no']; ?></label>
    </div>
    <div class="client_right">
      <label>Bodily Injury Limits</label>
      <label class="filled_label"><?php echo $row['d_limits']; ?></label>
    </div>
  </div>
</div>
<!--attorney_client_info_end-->
<div class="attorney_client_info">
  <h1>Incident Information</h1>
  <div class="view_client_row">
    <div class="client_left">
    <label>Date of Injury</label>
    <label class="filled_label"><?php echo $row['date_injury']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
   <div class="client_left">
    <label>Location of Event</label>
    <label class="filled_label"><?php echo $row['location_of_event']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="client_left">
      <label>Description of the Event</label>
      <label class="filled_label"><?php echo $row['description_of_event']; ?></label>
    </div>
    <div class="client_right">
      <label>Specify Body Part to be Evaluated</label>
      <label class="filled_label"><?php echo $row['description_of_injury']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="attorney_left">
      <div class="form_field_left">
        <label>UM / UIM</label>
      </div>
      <?php $check = $row['um_uim']; ?>
      <div class="form_field_right">
        <label class="checkbox_label">
          <input type="radio" name="um_uim1" value="<?= $check ?>" <?php if(isset($check) && $check == "yes"){ echo "checked";} ?> />
          Yes </label>
        <label class="checkbox_label">
          <input type="radio" name="um_uim2" value="<?= $check ?>" <?php if(isset($check) && $check =="no") { echo "checked"; } ?> />
          No </label>
        <label class="checkbox_label">
          <input type="radio" name="um_uim3" <?php if(isset($check) && $check =="n/a") echo "checked"; ?> value="<?php echo $row['um_uim'];?>"   id="" />
          N/A </label>
      </div>
    </div>
  </div>
  <div class="view_client_row">
    <div class="attorney_left">
      <div class="form_field_left">
        <label>Client ever claim bankruptcy ?</label>
      </div>
      <?php
		$bankrupty = $row['client_bankrupty'];
	  ?>
      <div class="form_field_right">
        <label class="checkbox_label">
          <input type="radio" name="bankruptcy1" value="<?= $bankrupty ?>" <?php if(isset($bankrupty) && $bankrupty == "yes"){echo "checked";}?>  />
          Yes </label>
        <label class="checkbox_label">
          <input type="radio" name="bankruptcy2" value="<?= $bankrupty ?>" <?php if(isset($bankrupty) && $bankrupty == "no"){echo "checked";}?> />
          No </label>
        <label class="checkbox_label">
          <input type="radio" name="bankruptcy3" value="<?= $bankrupty ?>" <?php if(isset($bankrupty) && $bankrupty == "n/a"){echo "checked";}?> />
          N/A </label>
      </div>
    </div>
  </div>
</div>
<!--attorney_client_info_end-->
<div class="attorney_client_info">
  <h1>Please also provide the following, if Available</h1>
  <div class="view_client_row">
    <div class="form_field_left">
      <label>Signed Medical Records Release Form</label>
    </div>
    <div class="form_field_right">
      <label class="checkbox_label">
	  	<?php
			$signed_medical_records = $row['signed_medical_records'];
			if($_SESSION['designation']=='8' ||$_SESSION['designation']=='7' || $_SESSION['designation']=='2')
			{
		?>
			<input type="radio" name="signed_medical" onchange="window.open('<?php echo $path; ?>/upload-docs.php?fid=<?php echo $_REQUEST['fid']; ?>&uid=<?php echo $_REQUEST['uid']; ?>&mid=<?php echo $this->GetDetailsByUsername($_SESSION['username'],"id");?>&cid=2&name=sm')" value="<?=$signed_medical_records?>" <?php if(isset($signed_medical_records) && $signed_medical_records=="download"){ echo "checked"; } ?> />
		<?php 
			}
			else
			{ 
		?>
			<input type="radio" name="signed_medical" value="<?=$signed_medical_records?>" <?php if(isset($signed_medical_records) && $signed_medical_records=="download"){ echo "checked"; } ?> />
		<?php 
			} 
		?>
        Download </label>
      <label class="checkbox_label">
        <input type="radio" name="signed_medical" value="<?=$signed_medical_records?>" <?php if(isset($signed_medical_records) && $signed_medical_records=="n/a"){ echo "checked"; } ?> id=""/>
        N/A </label>
      <label class="checkbox_label">
        <input type="radio" name="signed_medical" value="<?=$signed_medical_records?>" <?php if(isset($signed_medical_records) && $signed_medical_records=="will fax"){ echo "checked"; } ?> id=""/>
        Will Fax </label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="form_field_left">
      <label>Police Report</label>
    </div>
    <?php $polic_acc_rep = $row['police_accident_report']; ?>
    <div class="form_field_right">
      <label class="checkbox_label">
	 <?php
	  	if($_SESSION['designation']=='8' ||$_SESSION['designation']=='7' || $_SESSION['designation']=='2')
		{
	 ?>
        <input type="radio" onchange="window.open('<?php echo $path; ?>/upload-docs.php?fid=<?php echo $_REQUEST['fid']; ?>&uid=<?php echo $_REQUEST['uid']; ?>&mid=<?php echo $this->GetDetailsByUsername($_SESSION['username'],"id");?>&cid=2&name=pr')" name="police_report" value="<?=$polic_acc_rep?>" id="" <?php if(isset($polic_acc_rep) && $polic_acc_rep=="download"){ echo "checked"; } ?> />
	<?php
		}
		else
		{
	?>
		<input type="radio" name="police_report" value="<?=$polic_acc_rep?>" id="" <?php if(isset($polic_acc_rep) && $polic_acc_rep=="download"){ echo "checked"; } ?> />
	<?php
		}
	?>
        Download </label>
      <label class="checkbox_label">
        <input type="radio" name="police_report" value="<?=$polic_acc_rep?>" id=""<?php if(isset($polic_acc_rep) && $polic_acc_rep=="n/a"){ echo "checked"; } ?> />
        N/A </label>
      <label class="checkbox_label">
        <input type="radio" name="police_report" value="<?=$polic_acc_rep?>" id="" <?php if(isset($polic_acc_rep) && $polic_acc_rep=="will fax"){ echo "checked"; } ?> />
        Will Fax </label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="form_field_left">
      <label>Medical Bill</label>
    </div>
    <?php $medical_bi = $row['medial_bill']; ?>
    <div class="form_field_right">
      <label class="checkbox_label">
	 <?php
	  	if($_SESSION['designation']=='8' ||$_SESSION['designation']=='7' || $_SESSION['designation']=='2')
		{
	 ?>
        <input type="radio" name="medical_bill" onchange="window.open('<?php echo $path; ?>/upload-docs.php?fid=<?php echo $_REQUEST['fid']; ?>&uid=<?php echo $_REQUEST['uid']; ?>&mid=<?php echo $this->GetDetailsByUsername($_SESSION['username'],"id");?>&cid=2&name=ml')" value="<?=$polic_acc_rep?>" id="" <?php if(isset($medical_bi) && $medical_bi=="download"){ echo "checked"; } ?> />
	<?php
		}
		else
		{
	?>
		<input type="radio" name="medical_bill" value="<?=$polic_acc_rep?>" id="" <?php if(isset($medical_bi) && $medical_bi=="download"){ echo "checked"; } ?> />
	<?php
		}
	?>
        Download </label>
      <label class="checkbox_label">
        <input type="radio" name="medical_bill" value="<?=$polic_acc_rep?>" id="" <?php if(isset($medical_bi) && $medical_bi=="n/a"){ echo "checked"; } ?>/>
        N/A </label>
      <label class="checkbox_label">
        <input type="radio" name="medical_bill" value="<?=$polic_acc_rep?>" id="" <?php if(isset($medical_bi) && $medical_bi=="will fax"){ echo "checked"; } ?> />
        Will Fax </label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="form_field_left">
      <label>Medical Records</label>
    </div>
    <?php $medical_record = $row['medical_record']; ?>
    <div class="form_field_right">
      <label class="checkbox_label">
	  <?php
	  	if($_SESSION['designation']=='8' ||$_SESSION['designation']=='7' || $_SESSION['designation']=='2')
		{
	 ?>
			<input type="radio" name="medical_records" onchange="window.open('<?php echo $path; ?>/upload-docs.php?fid=<?php echo $_REQUEST['fid']; ?>&uid=<?php echo $_REQUEST['uid']; ?>&mid=<?php echo $this->GetDetailsByUsername($_SESSION['username'],"id");?>&cid=2&name=mr')" value="<?=$polic_acc_rep?>" <?php if(isset($medical_record) && $medical_record=="download"){ echo "checked"; } ?> />
	<?php
		}
		else
		{
	?>
			<input type="radio" name="medical_records" value="<?=$polic_acc_rep?>" <?php if(isset($medical_record) && $medical_record=="download"){ echo "checked"; } ?> />
	<?php 
		} 
	?>
        Download </label>
      <label class="checkbox_label">
        <input type="radio" name="medical_records" value="<?=$polic_acc_rep?>" <?php if(isset($medical_record) && $medical_record=="n/a"){ echo "checked"; } ?> />
        N/A </label>
      <label class="checkbox_label">
        <input type="radio" name="medical_records" value="<?=$polic_acc_rep?>" <?php if(isset($medical_record) && $medical_record=="will fax"){ echo "checked"; } ?> />
        Will Fax </label>
    </div>
  </div>
</div>
<!--attorney_client_info_end-->
<div class="attorney_client_info">
  <div class="view_client_row">
    <h1>Optional Documents</h1>
    <div class="form_field_left">
      <label>Travel Bills</label>
    </div>
    <?php $travel_bill=$row['travel_bills']; ?>
    <div class="form_field_right">
      <label class="checkbox_label"> 
	 <?php
	  	if($_SESSION['designation']=='8' ||$_SESSION['designation']=='7' || $_SESSION['designation']=='2')
		{
	 ?>
        <input type="radio" name="travel_bills" onchange="window.open('<?php echo $path; ?>/upload-docs.php?fid=<?php echo $_REQUEST['fid']; ?>&uid=<?php echo $_REQUEST['uid']; ?>&mid=<?php echo $this->GetDetailsByUsername($_SESSION['username'],"id");?>&cid=2&name=tb')" value="<?=$travel_bill?>" <?php if(isset($travel_bill) && $travel_bill=="download"){ echo "checked"; } ?> />
	<?php
		}
		else
		{
	?>
		<input type="radio" name="travel_bills" value="<?=$travel_bill?>" <?php if(isset($travel_bill) && $travel_bill=="download"){ echo "checked"; } ?> />
	<?php
		}
	?>
        Download </label>
      <label class="checkbox_label">
        <input type="radio" name="travel_bills" value="<?=$travel_bill?>" <?php if(isset($travel_bill) && $travel_bill=="n/a"){ echo "checked"; } ?> />
        N/A </label>
      <label class="checkbox_label">
        <input type="radio" name="travel_bills" value="<?=$travel_bill?>" <?php if(isset($travel_bill) && $travel_bill=="will fax"){ echo "checked"; } ?> />
        Will Fax </label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="form_field_left">
      <label>Other</label>
    </div>
    <?php $other_bill = $row['other']; ?>
    <div class="form_field_right">
      <label class="checkbox_label">
	  <?php
	  	if($_SESSION['designation']=='8' ||$_SESSION['designation']=='7' || $_SESSION['designation']=='2')
		{
	 ?>
        <input type="radio" onchange="window.open('<?php echo $path; ?>/upload-docs.php?fid=<?php echo $_REQUEST['fid']; ?>&uid=<?php echo $_REQUEST['uid']; ?>&mid=<?php echo $this->GetDetailsByUsername($_SESSION['username'],"id");?>&cid=2&name=ob')" name="other_records" value="<?=$other_bill?>" <?php if(isset($travel_bill) && $travel_bill=="download"){ echo "checked"; } ?> />
	<?php
		}
		else
		{
	?>
		<input type="radio" name="other_records" value="<?=$other_bill?>" <?php if(isset($travel_bill) && $travel_bill=="download"){ echo "checked"; } ?> />
	<?php
		}
	?>
        Download </label>
      <label class="checkbox_label">
        <input type="radio" name="other_records" value="<?=$other_bill?>" <?php if(isset($travel_bill) && $travel_bill=="n/a"){ echo "checked"; } ?> />
        N/A </label>
      <label class="checkbox_label">
        <input type="radio" name="other_records" value="<?=$other_bill?>" <?php if(isset($travel_bill) && $travel_bill=="will fax"){ echo "checked"; } ?> />
        Will Fax </label>
    </div>
  </div>
</div>
<?php
}	
	/*Medical records Request case for case_id=6*/
	
	function medicalView($row)
	{
?>
<div class="back_btn_area">
<a href="index.php"><input name="" type="button" class="back_btn" value="<<Back"/></a>
</div>
<div class="attorney_client_info">
    <h1>Client Information</h1>
  <div class="view_client_row">
    <div class="client_left">
      <label>Client Name</label>
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
    <label class="filled_label add_area"><?php echo $row['p_address']; ?></label>
  </div>
  <div class="view_client_row">
    <div class="client_left">
      <label>State</label>
      <label class="filled_label">
        <?php 
						$m_state = $row['p_state']; 
						echo $state1 =$this->GetStatebyStateCode($m_state)
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
</div>
<!--attorney_client_info_end-->

<div class="attorney_client_info">
  <div class="view_client_row">
    <h1>Client Attorney’s Information</h1>
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
  </div>
</div>
<!--attorney_client_info_end-->
<div class="view_client_row">
<?php 
	$sql = mysql_query("SELECT * FROM `medial_records_request` WHERE `form_id`='$_REQUEST[fid]' && `user_id`='$_REQUEST[uid]'") or die(mysql_error());
	if(mysql_num_rows($sql)>0)
	{
		$i=1;
		while($data = mysql_fetch_object($sql))
		{
	?>
<h1>Start Date of Service Form (<?php echo $i; ?>)</h1>
<div class="view_client_row">
  <div class="client_left">
    <label>Start Date of Service</label>
    <label class="filled_label"><?php echo $data->s_date_service; ?></label>
  </div>
  <div class="client_right">
    <label>End Date of Service</label>
    <label class="filled_label"><?php echo $data->e_date_service; ?></label>
  </div>
</div>
<div class="view_client_row">
  <div class="client_left">
    <label>Facility or Physician's Name</label>
    <label class="filled_label">
      <?php $facility = $data->facility_name; echo ucwords($facility); ?>
    </label>
  </div>
  <div class="client_right">
    <label>Office No</label>
    <label class="filled_label"><?php echo $data->office_no; ?></label>
  </div>
</div>
<div class="view_client_row">
  <label>Address</label>
  <label class="filled_label add_area"><?php echo $data->address; ?></label>
</div>
<div class="view_client_row">
  <div class="client_left">
    <label>State</label>
    <label class="filled_label">
      <?php $state = $data->state; echo ucwords($state); ?>
    </label>
  </div>
  <div class="client_right">
    <label>City</label>
    <label class="filled_label">
      <?php $city = $data->city; echo ucwords($city); ?>
    </label>
  </div>
</div>
<div class="view_client_row">
  <div class="client_left">
    <label>Zip Code</label>
    <label class="filled_label"><?php echo $data->zip_code; ?></label>
  </div>
  <div class="client_left">
    <label>Notes- Type of Records to Order</label>
    <label class="filled_label"><?php echo $data->type_of_records_other; ?></label>
  </div>
</div>
<?php
	$i++;
	}
}
else
{
	echo "No Medical Record Found";
}
?>
<?php
	}
	public function searchFunction($case_t,$att_id,$array_p)
		{
			list($a,$b,$c) = $array_p;
			//echo $a;
			//echo $b;
			//echo $c;
?>
		
			<div class="anesth_dashbord_client">
				<h1>New Client Application</h1>
				<div class="anesth_box_bg">
					<div class="anesth_row_heading">
						<div class="client_row_heading">

						<div class="client_span_1">Client No.</div>

						<div class="client_span_2">Client Name</div>

						<div class="client_span_3">Email Address</div>

						<div class="client_span_4">State</div>

						<div class="client_span_5">Application Date</div>

						<div class="client_span_5">Check Status</div>

						<div class="client_span_6">Action</div>

						</div>
						
					</div>
					<?php
					$query = "SELECT a . * , b . * FROM plantiff_information AS a,  `plantiff_case_type_info` AS b
					WHERE a.form_id = b.form_id && a.id = b.id && b.case_type = '$case_t' && b.admin_approved =1 && b.attorney_id = '$att_id'";
					if($a!="")
					{
						$query .= "&& a.plantiff_name like '%".$a."%'";
					}
					elseif($b!="")
					{
						$query .= "&& b.p_email_address ='$b'";
					}
					elseif($c!="")
					{
						$query .= "&& b.p_d_o_b like '%".$c."%'";
					}
					//$query;
					
					
						$tempgetinfo = mysql_query($query."order by a.form_id desc") or die(mysql_error());
						if(mysql_num_rows($tempgetinfo)>0)
						{
						while($getinfo=mysql_fetch_object($tempgetinfo))
						{
							
							$client_id = $getinfo->id;
					?>
					<div class="client_row_content">

							<input type="hidden" name="form_di" value="<?php echo $getinfo->form_id; ?>">

							<div class="client_att_1"><?php echo $getinfo->form_id; ?></div>

							<div class="client_att_2">

								<?php 

									$firstname = $this->GetObjectById($client_id,"first_name");

									$lastname  = $this->GetobjectById($client_id,"last_name");

									echo ucwords($firstname)."&nbsp;".ucwords($lastname); 

								?>

							</div>

							<div class="client_att_3">

								<?php 

									echo $email_id = $this->GetObjectById($client_id,"email_id"); 

								?>

							</div>

							<div class="client_att_4">

								<?php 

									$state  = $getinfo->p_state;

									echo $this->GetStatebyStateCode($state);

								?>

								</div>

							<div class="client_att_5">

								<?php 

									echo date('Y-m-d',strtotime($getinfo->p_date)); 

								?>

							</div>

							

							

							

							<div class="client_att_6">

								<a href="messages.php?fid=<?php echo $getinfo->form_id; ?>&uid=<?php echo $getinfo->id; ?>&cid=<?php echo $getinfo->case_type; ?>">

									<span class="pending_status1">Messages</span>

								</a>

							</div>

				

								

							<div class="client_att_7">

								<a class="btn btn-default" href="check-status.php?fid=<?php echo $getinfo->form_id; ?>&uid=<?php echo $getinfo->id; ?>&cid=<?php echo $getinfo->case_type; ?>&action=upload">

									<span class="pending_status">Approve</span>

								</a>

							</div>

							

						</div>	
					<?php
							}
						}
						else
						{
							echo "<h1 style='text-align:center;'>There is no Record</h1>";
						}
					?>
				</div>
			</div>
		</div>			
<?php
	}
	}

?>