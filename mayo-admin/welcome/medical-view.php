<div class="view_client_row">
		<h1>Client Information</h1>
	</div>
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
		<label class="filled_label"><?php echo $row['p_address']; ?></label>
	</div>
	<div class="view_client_row">
		<div class="client_left">
			<label>State</label>
			<label class="filled_label"><?php echo $row['actstate']; ?></label>
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
			<label>Social Security Number</label>
			<label class="filled_label"><?php echo $row['ssn_no']; ?></label>
		</div>
	</div>
	<div class="client_2">
	<h1>Client’s Attorney Information</h1>
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
	<h1>Documents Required to Process Claim</h1>
	<div class="view_client_row">
		<div class="form_field_left">
			<label>Signed Medical Records Release Form</label>
		</div>
		<div class="form_field_right">
			<label class="filled_label">
			<?php
					if($row['signed_medical_records'] == "download")
					{
						echo '<input type="radio" value="'.$row['signed_medical_records'].'" name="um_uim1" checked> Yes';
					?>
						
					<?php
					}
					else if($row['signed_medical_records'] == "will fax")
					{
						echo '<input type="radio" value="'.$row['signed_medical_records'].'" name="um_uim1" checked> Will Fax';
					}
					else
					{
						echo '<input type="radio" value="'.$row['signed_medical_records'].'" name="um_uim1" checked> N/A';
					}
				?>
			</label>
		</div>
	</div>
</div>
<div class="client_2">
	<h1>Start Date of Service</h1>
<?php
$sql = mysql_query("SELECT * FROM `medial_records_request` WHERE `form_id`='$_REQUEST[id]' && `user_id`='$_REQUEST[uid]'") or die(mysql_error());
if(mysql_num_rows($sql)>0)
{
	while($data = mysql_fetch_object($sql))
	{
?>
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
			<label class="filled_label"><?php $facility = $data->facility_name; echo ucwords($facility); ?></label>
		</div>
		<div class="client_right">
			<label>Office No</label>
			<label class="filled_label"><?php echo $data->office_no; ?></label>
		</div>
	</div>
	<div class="view_client_row">
		<label>Address</label>
		<label class="filled_label"><?php echo $data->address; ?></label>
	</div>
	<div class="view_client_row">
		<div class="client_left">
			<label>State</label>
			<label class="filled_label"><?php $state = $data->state; echo ucwords($state); ?></label>
		</div>
		<div class="client_right">
			<label>City</label>
			<label class="filled_label"><?php $city = $data->city; echo ucwords($city); ?></label>
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
	}
}
else
{
	echo "No Medical Record Found";
}
?>
</div><!--client_2_end-->