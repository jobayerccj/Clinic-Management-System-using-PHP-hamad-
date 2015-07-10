<?php
include_once("header.php");
include('../config/mayo-config.php');
?>
<style type="text/css">
	.users{
		width:100%;
		padding:10px;
	}
	.users table{
		padding: 5px;
		width: 100%;
	}
	.users table tr{
		font: 17px open_sansregular;
		padding: 20px;
	}
	.users table tr th{
		font: 17px open_sansregular;
		padding: 10px;
		background:none repeat scroll 0 0 #1b86e3;
		color:#fff;
	}
	.users table tr td{
		font: 17px open_sansregular;
		padding: 20px;
		text-align: center;
	}
	.users table tr td a{
		font: 17px open_sansregular;
		padding: 20px;
		text-align: center;
		text-decoration:none;
		color:#1b86e3;
	}
	.users table tr td a:hover{
		font: 17px open_sansregular;
		color:#000;
	}
	.users .odd{
		background: none repeat scroll 0 0 #eeeeee;
	}
	.users .even{
		background: none repeat scroll 0 0 #ffffff;
	}
	.hide{
		display:none;
	}
	.backbtn{
		background: none repeat scroll 0 0 rgba(0, 0, 0, 0);
		border: medium none;
		border-radius: 5px;
		color: #f6821f;
		cursor: pointer;
		font: 22px open_sansregular;
		padding: 5px 0;
	}
	.client_row textarea{
		background: none repeat scroll 0 0 #f9f9f9;
		border: medium none;
		border-radius: 5px;
		color: #1b86e3;
		padding: 15px;
		width: 57%;
	}.client_application h1 {
    color: #000000;
    font: 32px open_sansregular;
    padding: 30px 0;
    text-align: center;
}
.client_application h2 {
    color: #F6821F;
    font: 22px open_sansregular;
    padding: 0 0 5px;
    text-align: left;
}
.client_1 {
    border-bottom: 1px dashed #CCCCCC;
    display: inline-block;
    padding: 0 0 30px;
    position: relative;
    width: 100%;
}
.client_2 {
    border-bottom: 1px dashed #CCCCCC;
    display: inline-block;
    padding: 30px 0;
    position: relative;
    width: 100%;
}
.client_3 {
    border-bottom: 1px dashed #CCCCCC;
    display: inline-block;
    padding: 30px 0;
    position: relative;
    width: 100%;
}
.client_4 {
    border-bottom: 1px dashed #CCCCCC;
    display: inline-block;
    padding: 30px 0;
    position: relative;
    width: 100%;
}
.client_5 {
    display: inline-block;
    padding: 30px 0;
    position: relative;
    width: 100%;
}
.client_row {
    float: left;
    padding: 5px 0 10px;
    width: 100%;
}
.client_row h3 {
    color: #F6821F;
    font: 16px open_sansregular;
    padding: 10px 0;
    text-align: left;
}
.client_row label {
    display: inline-block;
    font: 14px open_sansregular;
    padding: 0 0 8px;
    width: 100%;
}
.client_row input[type="text"] {
    background: none repeat scroll 0 0 #F9F9F9;
    border: medium none;
    border-radius: 7px 7px 7px 7px;
    color: #1B86E3;
    display: inline-block;
    font: 15px open_sansregular;
    height: 35px;
    padding: 10px 0 10px 6px;
    text-align: center;
    width: 47%;
}
.client_row textarea {
    display: inline-block;
    font: 15px open_sansregular;
    height: 150px;
    margin: 0 0 10px;
    width: 100%;
}
.client_row input[type="submit"] {
    background: none repeat scroll 0 0 #F6821F;
    border: medium none;
    color: #FFFFFF;
    cursor: pointer;
    float: right;
    font-size: 18px;
    padding: 8px 15px;
}
.form_field_left {
    float: left;
    margin: auto;
    width: 40%;
}
.form_field_right {
    float: right;
    margin: auto;
    width: 59%;
}
.client_left {
    float: left;
    height: auto;
    margin: auto;
    width: 49%;
}
.client_right {
    float: right;
    height: auto;
    margin: auto;
    width: 49%;
}
.checkbox_label {
    margin: 0 15px 0 0 !important;
    width: auto !important;
}

</style>
<section class="row">
	<div class="container client_application">
	<h1>Case Type - Ortho</h1>
	<?php if(isset($_REQUEST['fid'])) { ?>
			<div class="hide">
				<table border="0">
						<tr>
							<th> Plantiff Name </th>
							<th> Email </th>
							<th> Case Type </th>
							<th> Action </th>
						</tr>
				<?php
					$qryuser = "SELECT * FROM `plantiff_information` WHERE case_type = 'ortho'";
					$sqlu = mysql_query($qryuser) or die(mysql_error());
					$rwclr = 0;
					while($rowu = mysql_fetch_array($sqlu)){
					$rwclr++;
					if ($rwclr % 2 == 1){
						$tr = 'odd';
					} else {
						$tr = 'even';
					}
				?>	
						<tr class="<?php echo $tr ;?>">
							<td> <?php echo $rowu['plantiff_name'] ?> </td>
							<td> <?php echo $rowu['p_email_address'] ?> </td>
							<td> <?php echo $rowu['case_type'] ?> </td>
							<td> <a href="?fid=<?=$rowu['form_id']?>"> View </a>  </td>
						</tr>

				<?php
					}
				?>
				</table>
			</div>
			
			<?php }else{ ?>
			
			<div class="users">
				<table border="0">
						<tr>
							<th> Plantiff Name </th>
							<th> Email </th>
							<th> Case Type </th>
							<th> Action </th>
						</tr>
				<?php
					$qryuser = "SELECT * FROM `plantiff_information` WHERE case_type = 'ortho'";
					$sqlu = mysql_query($qryuser) or die(mysql_error());
					$rwclr = 0;
					while($rowu = mysql_fetch_array($sqlu)){
					$rwclr++;
					if ($rwclr % 2 == 1){
						$tr = 'odd';
					} else {
						$tr = 'even';
					}
				?>	
						<tr class="<?php echo $tr ;?>">
							<td> <?php echo $rowu['plantiff_name'] ?> </td>
							<td> <?php echo $rowu['p_email_address'] ?> </td>
							<td> <?php echo $rowu['case_type'] ?> </td>
							<td> <a href="?fid=<?=$rowu['form_id']?>"> View </a>  </td>
						</tr>

				<?php
					}
				?>
				</table>
			</div>
			<?php } ?>
			
		<?php if(isset($_REQUEST['fid'])) { 
				$qry = " SELECT * FROM `plantiff_information` AS tableA, `plantiff_case_type_info` AS tableB 
				WHERE ( tableA.form_id = '".$_REQUEST['fid']."' AND tableB.case_type = 'ortho' ) ";
				$sql = mysql_query($qry) or die(mysql_error());
				$row = mysql_fetch_array($sql);
		?>
		
		<button class="backbtn" onclick="window.history.go(-1)"><img src="images/back-button.png" height="35px" width="110px"></button>
		
		<form>
			<div class="client_1">
				<div class="client_row">
					<h2>Plantiff Information</h2>
				</div>
				<div class="client_row">
					<div class="client_left">
						<label>Plantiff Name</label>
						<input type="text" name="" value="<?php echo $row['plantiff_name'];?>" id="" readonly />
					</div>
					<div class="client_right">
						<label>Date</label>
						<input type="text" value="<?php echo $row['p_date'];?>"  name="" id="" readonly />
					</div>
				</div>
				<div class="client_row">
					<div class="client_left">
						<label>Mobile No.</label>
						<input type="text" value="<?php echo $row['p_mob_no'];?>"  name="" id="" readonly />
					</div>
					<div class="client_right">
						<label>Home No.</label>
						<input type="text" value="<?php echo $row['p_home_no'];?>"  name="" id="" readonly />
					</div>
				</div>
				<div class="client_row">
					<div class="client_left">
						<label>Office No.</label>
						<input type="text" value="<?php echo $row['p_office_no'];?>"  name="" id="" readonly />
					</div>
					<div class="client_right">
						<label>Email Address</label>
						<input type="text" value="<?php echo $row['p_email_address'];?>"  name="" id="" readonly />
					</div>
				</div>
				<div class="client_row">
					<div class="client_left">
						<label>Date of Birth</label>
						<input type="text" value="<?php echo $row['p_d_o_b'];?>"  name="" id="" readonly />
					</div>
					<div class="client_right">
						<label>Driving License</label>
						<input type="text" value="<?php echo $row['p_driving_licence'];?>" name="" id="" readonly />
					</div>
				</div>
				<div class="client_row">
					<label>Address</label>
					<input type="text" value="<?php echo $row['p_address'];?>" name="" id="" readonly />
				</div>
				<div class="client_row">
					<div class="client_left">
						<label>State</label>
						<input type="text" value="<?php echo $row['p_state'];?>" name="" id="" readonly />
					</div>
					<div class="client_right">
						<label>City</label>
						<input type="text" value="<?php echo $row['p_city'];?>" name="" id="" readonly />
					</div>
				</div>
				<div class="client_row">
					<div class="client_left">
						<label>Zip Code</label>
						<input type="text" value="<?php echo $row['p_zip_code'];?>"  name="" id="" readonly />
					</div>
					<div class="client_right">
						<label>Preferred Choice of Doctor  *Not Requried</label>
						<input type="text" value="<?php echo $row['p_preferred_coice'];?>"  name="" id="" readonly />
					</div>
				</div>
				<div class="client_row">
					<label>Auto Insurance Carrier (Auto collision only)</label>
					<input type="text" value="<?php echo $row['auto_insurance'];?>"  name="" id="" readonly />
				</div>
				<div class="client_row">
					<div class="client_left">
						<div class="form_field_left">
							<label>UM / UIM</label>
						</div>
						<div class="form_field_right">
						<!---	<label class="checkbox_label">
								<input type="checkbox" name="" id=""/>Yes
							</label>
							<label class="checkbox_label">
								<input type="checkbox" name="" id=""/>No
							</label>
							<label class="checkbox_label">
								<input type="checkbox" name="" id=""/>N/A
							</label> --->
						<?php
							if($row['um_uim'] == "yes"){
						?>
							<label class="checkbox_label">
								<input type="checkbox" checked="checked" value="<?php echo $row['um_uim']?>" name="" id="" /> &nbsp; Yes
							</label>
						<?php
							}else if($row['um_uim'] == "no"){
						?>
							<label class="checkbox_label">
								<input type="checkbox" checked="checked" value="<?php echo $row['um_uim']?>" name="" id="" /> &nbsp; No
							</label>
						<?php
							}else{
						?>
							<label class="checkbox_label">
								<input type="checkbox" checked="checked" value="<?php echo $row['um_uim']?>" name="" id="" /> &nbsp; N/A
							</label>
						<?php } ?>
						</div>	
					</div>
				</div>
				<div class="client_row">
					<div class="client_left">
						<div class="form_field_left">
							<label>Client ever claim bankruptcy ?</label>
						</div>
						<div class="form_field_right">
						<!---	<label class="checkbox_label">
								<input type="checkbox" name="" id=""/>Yes
							</label>
							<label class="checkbox_label">
								<input type="checkbox" name="" id=""/>No
							</label>
							<label class="checkbox_label">
								<input type="checkbox" name="" id=""/>N/A
							</label> --->
						<?php
							if($row['client_bankrupty'] == "yes"){
						?>
							<label class="checkbox_label">
								<input type="checkbox"  checked="checked"  value="<?php echo $row['client_bankrupty']?>" name="" id="" /> &nbsp; Yes
							</label>
						<?php }else if($row['client_bankrupty'] == "no"){ ?>
							<label class="checkbox_label">
								<input type="checkbox"  checked="checked"  value="<?php echo $row['client_bankrupty']?>" name="" id="" /> &nbsp; No
							</label>
						<?php }else{ ?>
							<label class="checkbox_label">
								<input type="checkbox"  checked="checked"  value="<?php echo $row['client_bankrupty']?>" name="" id="" /> &nbsp; N/A
							</label>
						<?php } ?>
						</div>
					</div>
				</div>
			</div><!--client_1_end-->
			<div class="client_2">
				<h2>Plantiff’s Attorney’s Information</h2>
				<div class="client_row">
					<label>Firm</label>
					<input type="text" value="<?php echo $row['att_firm']?>" name="" id="" readonly />
				</div>
				<div class="client_row">
					<label>Address</label>
					<input type="text" value="<?php echo $row['att_address']?>" name="" id="" readonly />
				</div>
				<div class="client_row">
					<div class="client_left">
						<label>Phone</label>
						<input type="text" value="<?php echo $row['att_phone']?>" name="" id="" readonly />
					</div>
					<div class="client_right">
						<label>Fax</label>
						<input type="text" value="<?php echo $row['att_fax']?>" name="" id="" readonly />
					</div>
				</div>
				<div class="client_row">
					<div class="client_left">
						<label>Firm Contact Person</label>
						<input type="text" value="<?php echo $row['att_contact_person']?>" name="" id="" readonly />
					</div>
					<div class="client_right">
						<label>Position</label>
						<input type="text" value="<?php echo $row['att_position']?>" name="" id="" readonly />
					</div>
				</div>
				<div class="client_row">
					<div class="client_left">
						<label>Contact E-mail</label>
						<input type="text" value="<?php echo $row['att_email']?>" name="" id="" readonly />
					</div>
				</div>
			</div><!--client_2_end-->
			<div class="client_3">
				<h2>Defendant Infomation Insurance ( information is neededwhether or not in suit)</h2>
				<div class="client_row">
					<div class="client_left">
						<label>Defendent Name</label>
						<input type="text" value="<?php echo $row['defendant_name']?>" name="" id="" readonly />
					</div>
					<div class="client_right">
						<label>Insurance Company</label>
						<input type="text" value="<?php echo $row['insurance_company']?>"  name="" id="" readonly />
					</div>
				</div>
				<div class="client_row">
					<div class="client_left">
						<label>Claim No.</label>
						<input type="text" value="<?php echo $row['claim_no']?>"  name="" id="" readonly />
					</div>
					<div class="client_right">
						<label>Limits</label>
						<input type="text" value="<?php echo $row['d_limits']?>"  name="" id="" readonly />
					</div>
				</div>
			</div><!--client_2_end-->
			<div class="client_3">
				<h2>Incident Information</h2>
				<div class="client_row">
					<div class="client_left">
						<label>Date of Injury</label>
						<input type="text" value="<?php echo $row['date_injury']?>"  name="" id="" readonly />
					</div>
					<div class="client_right">
						<label>Location of Event</label>
						<input type="text" value="<?php echo $row['location_of_event']?>"  name="" id="" readonly />
					</div>
				</div>
				<div class="client_row">
					<label>Description of the Event</label>
					<textarea> <?php echo $row['description_of_event']?> </textarea>
				</div>
				<div class="client_row">
					<label>Description of the Injury</label>
					<textarea> <?php echo $row['description_of_injury']?> </textarea>
				</div>
				<div class="client_row">
					<div class="form_field_left">
						<label>Was there a Police Report</label>
					</div>
					<div class="form_field_right">
				<?php if($row['police_report'] == "yes"){ ?>
						<label class="checkbox_label">
							<input type="checkbox" checked="checked" value="<?php echo $row['police_report']?>" name="" id=""/>Yes
						</label>
				<?php }else{ ?>
						<label class="checkbox_label">
							<input type="checkbox" checked="checked" value="<?php echo $row['police_report']?>" name="" id=""/>No
						</label>
				<?php } ?>
					</div>
				</div>
				<div class="client_row">
					<div class="form_field_left">
						<label>Other injured too?</label>
					</div>
					<div class="form_field_right">
					<?php if($row['others_injured_too'] == "yes"){ ?>
						<label class="checkbox_label">
							<input type="checkbox" checked="checked" value="<?php echo $row['others_injured_too']?>" name="" id=""/>Yes
						</label>
					<?php }else{ ?>
						<label class="checkbox_label">
							<input type="checkbox" checked="checked" value="<?php echo $row['others_injured_too']?>" name="" id=""/>No
						</label>
					<?php } ?>
					</div>
				</div>
				<div class="client_row">
					<div class="form_field_left">
						<label>Witness(es) ?</label>
					</div>
					<div class="form_field_right">
					<?php if($row['witness'] == "yes"){ ?>
						<label class="checkbox_label">
							<input type="checkbox" checked="checked" value="<?php echo $row['witness']?>" name="" id=""/>Yes
						</label>
					<?php }else{ ?>
						<label class="checkbox_label">
							<input type="checkbox" checked="checked" value="<?php echo $row['witness']?>" name="" id=""/>No
						</label>
					<?php } ?>
					</div>
				</div>
			</div><!--client_3_end-->
			<div class="client_4">
				<h2>Please also provide the following, if Available</h2>
				<div class="client_row">
					<div class="form_field_left">
						<label>Police / Accident Report</label>
					</div>
					<div class="form_field_right">
					<!---	<label class="checkbox_label">
							<input type="checkbox" name="" id=""/>Download 
						</label>
						<label class="checkbox_label">
							<input type="checkbox" name="" id=""/>N/A
						</label>
						<label class="checkbox_label">
							<input type="checkbox" name="" id=""/>Will Fax
						</label>
					--->
					<?php
						if($row['police_report'] == "download"){
					?>
						<label class="checkbox_label">
							<input type="checkbox" checked="checked" value="<?php echo $row['police_report']?>" name="" id="" /> &nbsp; Download 
						</label>
					<?php
						}else if($row['police_report'] == "n/a"){
					?>
						<label class="checkbox_label">
							<input type="checkbox" checked="checked" value="<?php echo $row['police_report']?>" name="" id="" /> &nbsp; N/A
						</label>
					<?php
						}else{
					?>
						<label class="checkbox_label">
							<input type="checkbox" checked="checked" value="<?php echo $row['police_report']?>" name="" id="" /> &nbsp; Will Fax
						</label>
					<?php
					} ?>
					</div>
				</div>
				<div class="client_row">
					<div class="form_field_left">
						<label>Medical Record</label>
					</div>
					<div class="form_field_right">
					<!---		<label class="checkbox_label">
							<input type="checkbox" name="" id=""/>Download 
						</label>
						<label class="checkbox_label">
							<input type="checkbox" name="" id=""/>N/A
						</label>
						<label class="checkbox_label">
							<input type="checkbox" name="" id=""/>Will Fax
						</label>
					--->
					<?php
						if($row['medical_record'] == "download"){
					?>
						<label class="checkbox_label">
							<input type="checkbox" checked="checked" value="<?php echo $row['medical_record']?>" name="" id="" /> &nbsp; Download 
						</label>
					<?php }else if($row['medical_record'] == "n/a"){ ?>
						<label class="checkbox_label">
							<input type="checkbox" checked="checked" value="<?php echo $row['medical_record']?>" name="" id="" /> &nbsp; N/A
						</label>
					<?php }else{ ?>
						<label class="checkbox_label">
							<input type="checkbox" checked="checked" value="<?php echo $row['medical_record']?>" name="" id="" /> &nbsp; Will Fax
						</label>
					<?php } ?>
					</div>
				</div>
				<div class="client_row">
					<div class="form_field_left">
						<label>Medical Bill</label>
					</div>
					<div class="form_field_right">
					<!---	<label class="checkbox_label">
							<input type="checkbox" name="" id=""/>Download 
						</label>
						<label class="checkbox_label">
							<input type="checkbox" name="" id=""/>N/A
						</label>
						<label class="checkbox_label">
							<input type="checkbox" name="" id=""/>Will Fax
						</label>
					--->
					<?php if($row['medial_bill'] == "download"){ ?>
						<label class="checkbox_label">
							<input type="checkbox" checked="checked" value="<?php echo $row['medial_bill']?>" name="" id="" /> &nbsp; Download 
						</label>
					<?php }else if($row['medial_bill'] == "n/a"){ ?>
						<label class="checkbox_label">
							<input type="checkbox" checked="checked" value="<?php echo $row['medial_bill']?>" name="" id="" /> &nbsp; N/A
						</label>
					<?php }else{ ?>
						<label class="checkbox_label">
							<input type="checkbox" checked="checked" value="<?php echo $row['medial_bill']?>" name="" id="" /> &nbsp; Will Fax
						</label>
					<?php } ?>
					</div>
				</div>
		</form>
		<?php }else{ ?>
			&nbsp;
		<?php } ?>
	</div>
</section>
<?php
	require($get_footer);
?>
