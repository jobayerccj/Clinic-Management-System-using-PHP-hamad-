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
</style>
<section class="row">
	<div class="container client_application">
	<h1>Case Type - Meshed</h1>
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
					$qryuser = "SELECT * FROM `plantiff_information` WHERE case_type = 'meshed'";
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
					$qryuser = "SELECT * FROM `plantiff_information` WHERE case_type = 'meshed'";
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
				WHERE ( tableA.form_id = '".$_REQUEST['fid']."' AND tableB.case_type = 'meshed' ) ";
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
			</div><!--client_3_end-->
			<!--- <div class="client_5">
				<div class="client_row">
					<input type="submit" name="" id="" value="Submit"/>
				</div>	
			</div> --->
		</form>
		<?php }else{ ?>
			&nbsp;
		<?php } ?>
	</div>
</section>
<?php
	require($get_footer);
?>
