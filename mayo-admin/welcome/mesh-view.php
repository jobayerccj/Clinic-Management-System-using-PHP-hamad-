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
							<label>Preferred Choice of Doctor</label>
							<label class="filled_label"><?php echo $row['p_preferred_coice']; ?></label>
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
					<h1>Please also provide the following, if Available</h1>
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
					<div class="view_client_row">
						<div class="form_field_left">
							<label>Product Label</label>
						</div>
						<div class="form_field_right">
							<label class="filled_label">
							<?php
								if($row['product_label'] == "download")
								{
									echo '<input type="radio" value="'.$row['product_label'].'" name="um_uim2" checked> Yes';
								?>
									
								<?php
								}
								else if($row['product_label'] == "will fax")
								{
									echo '<input type="radio" value="'.$row['product_label'].'" name="um_uim2" checked> Will Fax';
								}
								else
								{
									echo '<input type="radio" value="'.$row['product_label'].'" name="um_uim2" checked> N/A';
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
									if($row['medical_record'] == "download")
									{
										echo '<input type="radio" value="'.$row['medical_record'].'" name="um_uim3" checked> Yes';
									?>
										
									<?php
									}
									else if($row['medical_record'] == "will fax")
									{
										echo '<input type="radio" value="'.$row['medical_record'].'" name="um_uim3" checked> Will Fax';
									}
									else
									{
										echo '<input type="radio" value="'.$row['medical_record'].'" name="um_uim3" checked> N/A';
									}
								?>
							</label>
						</div>
					</div>
					</div>
					<div class="client_3">
					<h1>Optional Documents</h1>
					<div class="view_client_row">
						<div class="form_field_left">
							<label>Medical Bills</label>
						</div>
						<div class="form_field_right">
							<label class="filled_label">
							<?php
								if($row['medial_bill'] == "download")
								{
									echo '<input type="radio" value="'.$row['medial_bill'].'" name="um_uim4" checked> Yes';
								}
								else if($row['medial_bill'] == "will fax")
								{
									echo '<input type="radio" value="'.$row['medial_bill'].'" name="um_uim4" checked> Will Fax';
								}
								else
								{
									echo '<input type="radio" value="'.$row['medial_bill'].'" name="um_uim4" checked> N/A';
								}
							?>
							</label>
						</div>
					</div>
					<div class="view_client_row">
						<div class="form_field_left">
							<label>Travel Bills</label>
						</div>
						<div class="form_field_right">
							<label class="filled_label">
							<?php
								if($row['travel_bills'] == "download")
								{
									echo '<input type="radio" value="'.$row['travel_bills'].'" name="um_uim4" checked> Yes';
								}
								else if($row['travel_bills'] == "will fax")
								{
									echo '<input type="radio" value="'.$row['travel_bills'].'" name="um_uim5" checked> Will Fax';
								}
								else
								{
									echo '<input type="radio" value="'.$row['travel_bills'].'" name="um_uim5" checked> N/A';
								}
							?>
							</label>
						</div>
					</div>
					<div class="view_client_row">
						<div class="form_field_left">
							<label>Other Documents</label>
						</div>
						<div class="form_field_right">
							<label class="filled_label">
							<?php
								if($row['other'] == "download")
								{
									echo '<input type="radio" value="'.$row['other'].'" name="um_uim6" checked> Yes';
								}
								else if($row['other'] == "will fax")
								{
									echo '<input type="radio" value="'.$row['other'].'" name="um_uim6" checked> Will Fax';
								}
								else
								{
									echo '<input type="radio" value="'.$row['other'].'" name="um_uim6" checked> N/A';
								}
							?>
							</label>
						</div>
					</div>
					</div>