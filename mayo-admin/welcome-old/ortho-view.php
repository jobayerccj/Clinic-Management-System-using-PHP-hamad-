<div class="client_1">
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
										echo '<input type="radio" value="'.$row['um_uim'].'" name="um_uim" checked> Yes';
									?>
										
									<?php
									}
									else if($row['um_uim']== "no")
									{
										echo '<input type="radio" value="'.$row['um_uim'].'" name="um_uim" checked> No';
									}
									else
									{
										echo '<input type="radio" value="'.$row['um_uim'].'" name="um_uim" checked> N/A';
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
						<div class="client_left">
							<label>Date of Injury</label>
							<label class="filled_label"><?php echo $row['date_injury']; ?></label>
						</div>
						<div class="client_right">
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
							<label>Description of the Injury</label>
							<label class="filled_label"><?php echo $row['description_of_injury']; ?></label>
						</div>
					</div>
				</div><!--client_2_end-->
				<div class="client_3">
					<div class="view_client_row">
						<div class="form_field_left">
							<label>Was there a Police Report</label>
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
							<label>Other injured too?</label>
						</div>
						<div class="form_field_right">
							<label class="filled_label">
								<?php
									if($row['others_injured_too'] == "yes")
									{
										echo '<input type="radio" value="'.$row['others_injured_too'].'" name="other_injured" checked> Yes';
									}
									else
									{
										echo '<input type="radio" value="'.$row['others_injured_too'].'" name="other_injured" checked> No';
									}
								?>	
								</label>
						</div>
					</div>
					<div class="view_client_row">
						<div class="form_field_left">
							<label>Witness(es) ?</label>
						</div>
						<div class="form_field_right">
							<label class="filled_label">
								<?php
									if($row['witness'] == "yes")
									{
										echo '<input type="radio" value="'.$row['witness'].'" name="witness" checked> Yes';
									}
									else
									{
										echo '<input type="radio" value="'.$row['witness'].'" name="witness" checked> No';
									}
								?>	
								</label>
						</div>
					</div>
					<div class="view_client_row">
						<div class="form_field_left">
							<label>Signed Medical Records Release Form</label>
						</div>
						<div class="form_field_right">
							<label class="filled_label">
							<?php
									if($row['signed_medical_records'] == "download")
									{
										echo '<input type="radio" value="'.$row['signed_medical_records'].'" name="signed_medical_records" checked> Yes';
									?>
										
									<?php
									}
									else if($row['signed_medical_records'] == "will fax")
									{
										echo '<input type="radio" value="'.$row['signed_medical_records'].'" name="signed_medical_records" checked> Will Fax';
									}
									else
									{
										echo '<input type="radio" value="'.$row['signed_medical_records'].'" name="signed_medical_records" checked> N/A';
									}
								?>
							</label>
						</div>
					</div>
					
					<div class="view_client_row">
						<div class="form_field_left">
							<label>Police Report</label>
						</div>
						<div class="form_field_right">
							<label class="filled_label">
							<?php
									if($row['police_accident_report'] == "download")
									{
										echo '<input type="radio" value="'.$row['police_accident_report'].'" name="police_accident_report" checked> Yes';
									?>
										
									<?php
									}
									else if($row['police_accident_report'] == "will fax")
									{
										echo '<input type="radio" value="'.$row['police_accident_report'].'" name="police_accident_report" checked> Will Fax';
									}
									else
									{
										echo '<input type="radio" value="'.$row['police_accident_report'].'" name="police_accident_report" checked> N/A';
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
									if($row['medial_bill'] == "download")
									{
										echo '<input type="radio" value="'.$row['medial_bill'].'" name="medial_bill" checked> Yes';
									?>
										
									<?php
									}
									else if($row['medial_bill'] == "will fax")
									{
										echo '<input type="radio" value="'.$row['medial_bill'].'" name="medial_bill" checked> Will Fax';
									}
									else
									{
										echo '<input type="radio" value="'.$row['medial_bill'].'" name="medial_bill" checked> N/A';
									}
								?>
							</label>
						</div>
					</div>
					
					<div class="view_client_row">
						<div class="form_field_left">
							<label>Medical Records</label>
						</div>
						<div class="form_field_right">
							<label class="filled_label">
							<?php
									if($row['medical_record'] == "download")
									{
										echo '<input type="radio" value="'.$row['medical_record'].'" name="medical_record" checked> Yes';
									?>
										
									<?php
									}
									else if($row['medical_record'] == "will fax")
									{
										echo '<input type="radio" value="'.$row['medical_record'].'" name="medical_record" checked> Will Fax';
									}
									else
									{
										echo '<input type="radio" value="'.$row['medical_record'].'" name="medical_record" checked> N/A';
									}
								?>
							</label>
						</div>
					</div>
					
					<div class="view_client_row">
						<h1>Optional Documents</h1>
						<div class="form_field_left">
							<label>Travel Bills</label>
						</div>
						<div class="form_field_right">
							<label class="filled_label">
							<?php
									if($row['travel_bills'] == "download")
									{
										echo '<input type="radio" value="'.$row['travel_bills'].'" name="travel_bills" checked> Yes';
									?>
										
									<?php
									}
									else if($row['travel_bills'] == "will fax")
									{
										echo '<input type="radio" value="'.$row['travel_bills'].'" name="travel_bills" checked> Will Fax';
									}
									else
									{
										echo '<input type="radio" value="'.$row['travel_bills'].'" name="travel_bills" checked> N/A';
									}
								?>
							</label>
						</div>
					</div>
					
					<div class="view_client_row">
						<div class="form_field_left">
							<label>Other</label>
						</div>
						<div class="form_field_right">
							<label class="filled_label">
							<?php
									if($row['other'] == "download")
									{
										echo '<input type="radio" value="'.$row['other'].'" name="other" checked> Yes';
									?>
										
									<?php
									}
									else if($row['other'] == "will fax")
									{
										echo '<input type="radio" value="'.$row['other'].'" name="other" checked> Will Fax';
									}
									else
									{
										echo '<input type="radio" value="'.$row['other'].'" name="other" checked> N/A';
									}
								?>
							</label>
						</div>
					</div>
					
				</div>