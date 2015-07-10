<?php 
ob_start();
session_start();
$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
$header = $pathofmayo."/case-manager/header.php";
require($header);
require_once($config);
include('../../classes/login-functions.php');
@$data1 = $_SESSION['email'];
if(!isset($data1))
{
?>
<script>window.location="index.php";</script>
<?php
}
if(loggedin()) 
{
$a = $_SESSION['username'];

$meshednew     = new Meshed();
$att_id        = $meshednew->getIdByUname();
$form_id       = $meshednew->getFormId($data1);
$user_id       = $meshednew->UserId($data1);
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function()
			{
				var icount=0;
				$('#add_more').click(function()
					{
						if(icount<=3)
						{
							icount = icount+1;
							$('#add_more_div').append('<div id="vikas"'+icount+'><div class="attorney_row"><div class="attorney_left"><label>Start Date of Service</label><input type="text" required="required" placeholder="mm-dd-yyyy" name="start_service[]" id="firm"/><span class="error"></span></div><div class="attorney_right"><label>End Date of Service</label><input type="text" placeholder="mm-dd-yyyy" required="required" name="end_service[]" id="frm_address" /><span class="error"></span></div></div><div class="attorney_row"><div class="attorney_left"><label>Facility or Physicians Name</label><input type="text" required="required" name="facility_physician_name[]" id="phone"/><span class="error"></span></div><div class="attorney_right"><label>Office No</label><input type="text" required="required" name="office_no[]" id="fax"/><span class="error"></span></div></div><div class="attorney_row"><label>Address</label><input type="text" required="required" name="address[]" id="frm_contact" /><span class="error"></span></div><div class="attorney_row"><div class="attorney_left"><label>State</label><input type="text" required="required" name="state[]" id="position"  /><span class="error"></span></div><div class="attorney_right"><label>City</label><input type="text" required="required" name="city[]" id="position"  /><span class="error"></span></div></div><div class="attorney_row"><div class="attorney_left"><label>Zip Code</label><input type="text" required="required" name="zip_code[]" id="contct_email" /><span class="error"></span></div><div class="attorney_right"><label>Notes- Type of Records to Order</label><input type="text" name="records_to_other[]" id="contct_email" /><span class="error"></span></div></div></div>');
						}
						else
						{
							alert('Value cannot be more than '+icount+'');
						}
					});
					$('#remove_div').click(function()
					{
						if(icount!=0)
						{
							$('#vikas' +icount).remove();
							icount = icount-1;
						}
						else
						{
							$('#vikas').remove();
							$('#remove_div').removeAttr('disabled');
						}

					});
			});
		</script>

<section class="row">
<?php
if(isset($_POST['submit_t']))
{
	@$firm 					 = $_REQUEST['firm'];
	@$frm_address 			 = $_REQUEST['frm_address'];
	@$phone 					 = $_REQUEST['phone'];
	@$firm_contact_per 		 = $_REQUEST['frm_contact'];
	@$contactemail 			 = $_REQUEST['contct_email'];
	@$medical_release_form 	 = $_REQUEST['signed_medical'];
	@$fax                     = $_REQUEST['fax'];
	@$position 				 = $_REQUEST['position'];
	/*Array Starts*/
	@$start_service1 	     = $_REQUEST['start_service1'];
	@$end_service1			 = $_REQUEST['end_service1'];
	@$facility_physician_name1= $_REQUEST['facility_physician_name1'];
	@$office_no1   	 		 = $_REQUEST['office_no1'];
	@$address1 				 = $_REQUEST['address1'];
	@$state1  		 		 = $_REQUEST['state1'];
	@$city1			 		 = $_REQUEST['city1'];
	@$zip1                    = $_REQUEST['zip_code1'];
	@$records_to_other1		 = $_REQUEST['records_to_other1'];
	if(isset($_REQUEST['start_service']) && ($_REQUEST['start_service'])!="")
	{
		@$counts                  = count($_REQUEST['start_service']);
		@$start_service 		 = $_REQUEST['start_service'];
		@$end_service			 = $_REQUEST['end_service'];
		@$facility_physician_name = $_REQUEST['facility_physician_name'];
		@$office_no   	 		 = $_REQUEST['office_no'];
		@$address 				 = $_REQUEST['address'];
		@$state  		 		 = $_REQUEST['state'];
		@$city			 		 = $_REQUEST['city'];
		@$zip                     = $_REQUEST['zip_code'];
		@$records_to_other		 = $_REQUEST['records_to_other'];
	}
	$plantiff_case_info      = mysql_query("INSERT INTO `plantiff_case_type_info` 		     (`form_id`,`id`,`attorney_id`,`att_firm`,`att_address`,`att_phone`,`att_fax`,`att_contact_person`,`att_position`,`att_email`,`signed_medical_records`,`date_time`,`case_type`) VALUES ('$form_id','$user_id','$att_id','".mysql_real_escape_string($firm)."','".mysql_real_escape_string($frm_address )."','".mysql_real_escape_string($phone)."','".mysql_real_escape_string($fax)."','".mysql_real_escape_string($firm_contact_per)."','$position','".mysql_real_escape_string($contactemail)."','".mysql_real_escape_string($medical_release_form)."',now(),6)") or die(mysql_error());
	
	$query = "INSERT INTO `medial_records_request` (`form_id`,`user_id`,`att_id`,`s_date_service`,`e_date_service`,`facility_name`,`office_no`,`address`,`state`,`city`,`zip_code`,`type_of_records_other`) VALUES('$form_id','$user_id','$att_id','$start_service1','$end_service1','$facility_physician_name1','$office_no1','$address1','$state1','$city1','$zip1','$records_to_other1')";
				$medial_records_request  = mysql_query($query) or die(mysql_error());
	if(isset($_REQUEST['start_service']) && ($_REQUEST['start_service'])!="")
	{
	for($i=0;$i<$counts;$i++)
	{
		$query = "INSERT INTO `medial_records_request` (`form_id`,`user_id`,`att_id`,`s_date_service`,`e_date_service`,`facility_name`,`office_no`,`address`,`state`,`city`,`zip_code`,`type_of_records_other`) VALUES('$form_id','$user_id','$att_id','".mysql_real_escape_string($start_service[$i])."','".mysql_real_escape_string($end_service[$i])."','".mysql_real_escape_string($facility_physician_name[$i])."','".mysql_real_escape_string($office_no[$i])."','".mysql_real_escape_string($address[$i])."','".mysql_real_escape_string($state[$i])."','".mysql_real_escape_string($city[$i])."','".mysql_real_escape_string($zip[$i])."','".mysql_real_escape_string($records_to_other[$i])."')";
			$medial_records_request  = mysql_query($query) or die(mysql_error());
	}
	}
	if($plantiff_case_info && $medial_records_request)
	{
		echo "<div class='thank_message'>Your Form is Submitted Successfully. You will get an email when form is accepted by Mayo</div>";
		header("Refresh:2; url=index.php");
		unset($_SESSION['email']);
	}
	else
	{
		echo "<div class='thank_message'>There is some problem Please retry later</div>";
	}
}
?>
	<div class="container client_application">
		<h1>Medical Records Request Step-2 Form</h1>
		<form name="ortho" id="ortho" method="post" action="">
			<div class="attorney_row">
				<?php
					$c_att_informaiton   = mysql_query("SELECT * FROM `members` where `id`= '$att_id'") or die(mysql_error());
					$get_att_information = mysql_fetch_object($c_att_informaiton);
				?>
			</div>
			<div class="client_2">
				<h2>Case Manager Information</h2>
				<div class="attorney_row">
					<label>Firm</label>
					<input type="text" required="required" name="firm" id="firm" value="<?php echo $get_att_information->organisation; ?>"/>
					<span class="error"></span>	
				</div>
				
				<div class="attorney_row">
					<label>Address</label>
					<input type="text" required="required" name="frm_address" id="frm_address" value="<?php echo $get_att_information->address; ?>" />
					<span class="error"></span>
				</div>
				
				<div class="attorney_row">
					<div class="attorney_left">
						<label>Phone</label>
						<input type="text" required="required" name="phone"  value="<?php echo $get_att_information->contact_number; ?>" id="phone"/>
						<span class="error"></span>
					
					</div>
					<div class="attorney_right">
						<label>Fax</label>
						<input type="text"  name="fax" id="fax"/>
						<span class="error"></span>
					</div>
					
				</div>
				<div class="attorney_row">
					<div class="attorney_left">
						<label>Firm Contact Person</label>
						<input type="text" required="required" name="frm_contact" id="frm_contact" value="<?php echo ucwords($get_att_information->first_name)." ".ucwords($get_att_information->last_name); ?>" />
						<span class="error"></span>
					</div>
					
					<div class="attorney_right">
						<label>Position</label>
						<input type="text" required="required" name="position" id="position"  value="<?php $desid = $get_att_information->designation; echo $meshednew->GetDesgBydesId($desid); ?>"/>
						<span class="error"></span>
					</div>
				</div>
				<div class="attorney_row">
					<div class="attorney_left">
						<label>Contact E-mail</label>
						<input type="text" required="required" name="contct_email" id="contct_email" value="<?php echo $get_att_information->email_id; ?>" />
						<span class="error"></span>
					</div>
				</div>
			</div><!--client_2_end-->
			<div class="client_4">
				<h2>Documents Required to Process Claim</h2>
				<div class="attorney_row">
					<label>
						<a class="document_download_file" href="<?php echo $sitepath;?>/medical-release-form/medical-release-form.pdf" target="_blank">Download Signed Medical Records Request</a>
					</label>
				</div>
				<div class="attorney_row">
					<div class="form_field_left">
						<label>
							Signed Medical Records Request
						</label>
					</div>
					<div class="form_field_right">
						<label class="checkbox_label">
							<input type="radio" name="signed_medical" value="download" onclick="window.open('<?php echo $sitepath; ?>/case-manager/upload-documents.php?fid=<?php echo $form_id; ?>&uid=<?php echo $user_id; ?>&att_id=<?php echo $att_id; ?>&cid=6')" id=""/>Upload
						</label>
						<label class="checkbox_label">
							<input type="radio" name="signed_medical" value="n/a" id=""/>N/A
						</label>
						<label class="checkbox_label">
							<input type="radio" name="signed_medical" value="will fax" id=""/>Will Fax
						</label>
					</div>
				</div>
			</div><!--client_4_end-->
			<div class="client_2">
				<div class="add_row" id="add_more_div">
					<div class="attorney_row">
						<div class="attorney_left">
							<label>Start Date of Service</label>
							<input type="text" required="required" placeholder="mm-dd-yyyy" name="start_service1" id="firm"/>
							<span class="error"></span>	
							
						</div>
						<div class="attorney_right">
							<label>End Date of Service</label>
							<input type="text" required="required" placeholder="mm-dd-yyyy" name="end_service1" id="frm_address" />
							<span class="error"></span>
							
						</div>
					</div>
					<div class="attorney_row">
						<div class="attorney_left">
							<label>Facility or Physician's Name</label>
							<input type="text" required="required" name="facility_physician_name1" id="phone"/>
							<span class="error"></span>
							
						</div>
						<div class="attorney_right">
							<label>Office No</label>
							<input type="text" required="required" name="office_no1" id="fax"/>
							<span class="error"></span>
						</div>
						
					</div>
					<div class="attorney_row">
						<label>Address</label>
						<input type="text" required="required" name="address1" id="frm_contact" />
						<span class="error"></span>
					</div>
				
					<div class="attorney_row">
						<div class="attorney_left">
							<label>State</label>
							<input type="text" required="required" name="state1" id="position"  />
							<span class="error"></span>
						</div>
						
						<div class="attorney_right">
							<label>City</label>
							<input type="text" required="required" name="city1" id="position"  />
							<span class="error"></span>
						</div>
					</div>
				
					<div class="attorney_row">
						<div class="attorney_left">
							<label>Zip Code</label>
							<input type="text" required="required" name="zip_code1" id="contct_email" />
							<span class="error"></span>
						</div>
						<div class="attorney_right">
							<label>Notes- Type of Records to Order</label>
							<input type="text" name="records_to_other1" id="contct_email" />
							<span class="error"></span>
						</div>
					
					</div>
				</div><!--client_2_end-->
				<div class="client_5">
					<div class="attorney_row">
						<input type="button" name="add_more" id="add_more" value="Add Additional Facility or Physician"/>
						<input type="button" name="remove" value="Remove" id="remove_div" >
					</div>
					<div class="attorney_row">					
						
					</div>
				</div>			
				<div class="client_5">
					<div class="attorney_row">
						<input type="submit" name="submit_t" id="submit" value="Submit"/>
					</div>	
				</div>
			</div>
		</form>
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
