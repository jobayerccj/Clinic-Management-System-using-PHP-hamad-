<?php 
ob_start();
session_start();
$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
$header = $pathofmayo."/attorney/header.php";
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
$a             = $_SESSION['username'];
$meshednew     = new Meshed();
$att_id        = $meshednew->getIdByUname();
$form_id       = $meshednew->getFormId($data1);
$user_id       = $meshednew->UserId($data1);
?>


<!-- For validations -->

<style type="text/css">
	.error{
		color: #ff0000;
		font: 12px/3 open_sansregular;
	}
</style>
<!-- jQuery Form Validation code -->
<section class="row">
	<div class="container client_application">
	<?php
		if(isset($_REQUEST['submit']))
		{
			$meshednew->um_uim_o                    = mysql_real_escape_string($_REQUEST['um_uim']);
			//@$meshednew->um_uim2_o                  = mysql_real_escape_string($_REQUEST['um_uim2']);
			$meshednew->bankruptcy_o                = mysql_real_escape_string($_REQUEST['bankruptcy']);
			$meshednew->firm_o                      = mysql_real_escape_string($_REQUEST['firm']);
			$meshednew->o_address_o                 = mysql_real_escape_string($_REQUEST['frm_address']);
			$meshednew->phone_o                     = mysql_real_escape_string($_REQUEST['phone']);
			$meshednew->fax_o                       = mysql_real_escape_string($_REQUEST['fax']);
			$meshednew->firm_contact_p_o            = mysql_real_escape_string($_REQUEST['frm_contact']);
			$meshednew->position_o                  = mysql_real_escape_string($_REQUEST['position']);
			$meshednew->contact_email_o             = mysql_real_escape_string($_REQUEST['contct_email']);
			$meshednew->defendent_name_o            = mysql_real_escape_string($_REQUEST['dfndr_name']);
			$meshednew->insurance_company_o         = mysql_real_escape_string($_REQUEST['insure_cmpny']);
			$meshednew->claim_no_o                  = mysql_real_escape_string($_REQUEST['claim_no']);
			$meshednew->limits_o					= mysql_real_escape_string($_REQUEST['limits']);
			$meshednew->date_of_injury_o            = mysql_real_escape_string($_REQUEST['injury_date']);
			$meshednew->desc_event_o                = mysql_real_escape_string($_REQUEST['event_desc']);
			$meshednew->location_event_o            = mysql_real_escape_string($_REQUEST['event_location']);
			$meshednew->desc_injury_o               = mysql_real_escape_string($_REQUEST['injury_desc']);
			$meshednew->police_report_o_o           = mysql_real_escape_string($_REQUEST['police_reportt']);
			$meshednew->others_injured_o             = mysql_real_escape_string($_REQUEST['other_injured']);
			$meshednew->witness_o                   = "";
			$meshednew->user_email_o                = mysql_real_escape_string($_SESSION['email']);
			
			$meshednew->s_m_r_r_f_o                 = mysql_real_escape_string($_POST['signed_medical']);
			$meshednew->other_records_o             = mysql_real_escape_string($_POST['other_records']);
			$meshednew->travel_bills_o              = mysql_real_escape_string($_POST['travel_bills']);
			$meshednew->medical_records_o           = mysql_real_escape_string($_POST['medical_records']);
			$meshednew->medial_bill_o               = mysql_real_escape_string($_POST['medical_bill']);
			$meshednew->police_report_oo            = mysql_real_escape_string($_POST['police_report']);
			$meshednew->user_email_o                = $_SESSION['email'];
			$case_type      = "3";
			$test = $meshednew->OrthoStep($form_id,$user_id,$att_id,$case_type);
			if($test=1)
			{
				echo "<div class='thank_message'>Your Form is Submitted Successfully. You will get an email when form is accepted by Admin</div>";
				header("Refresh:3; url=index.php");
				unset($_SESSION['email']);
				
			}
			else
			{
				echo "<div class='thank_message'>There is some problem Please retry later</div>";
			}
		} 
	?>
		<h1>Pain Management Step-2 Form</h1>
		<form name="ortho" id="ortho" method="post" action="">
			<div class="client_1">
				<div class="attorney_row">
					<h2>Client Information</h2>
				</div>
				<div class="attorney_row">
					<div class="attorney_left">
						<div class="form_field_left">
							<label>UM / UIM</label>
						</div>
						<div class="form_field_right">
							<label class="checkbox_label">
								<input type="radio" name="um_uim" value="yes" id="" checked />Yes
							</label>
							<label class="checkbox_label">
								<input type="radio" name="um_uim" value="no" id=""/>No
							</label>
							<label class="checkbox_label">
								<input type="radio" name="um_uim" value="n/a" id=""/>N/A
							</label>
						</div>	
					</div>
					<div class="attorney_right">
						<div class="form_field_left">
							<label>Client ever claim bankruptcy?</label>
						</div>
						<div class="form_field_right">
							<label class="checkbox_label">
								<input type="radio" name="bankruptcy" value="yes" id="" checked />Yes
							</label>
							<label class="checkbox_label">
								<input type="radio" name="bankruptcy" value="no" id=""/>No
							</label>
							<label class="checkbox_label">
								<input type="radio" name="bankruptcy" value="n/a" id=""/>N/A
							</label>
							
						</div>						
					</div>
				</div>
				<div class="attorney_row">
					<div class="attorney_left">
						
					</div>
				</div>
			</div><!--client_1_end-->
			<div class="client_2">
				<h2>Attorney / Case Manager Information</h2>
				<?php
					$c_att_informaiton   = mysql_query("SELECT * FROM `members` where `id`= '$att_id'") or die(mysql_error());
					$get_att_information = mysql_fetch_object($c_att_informaiton);
				?>
				<div class="attorney_row">
					<label>Firm</label>
					<input type="text" name="firm" id="firm" value="<?php echo $get_att_information->organisation; ?>"/>
					<span class="error"></span>
					
				</div>
				<div class="attorney_row">
					<label>Address</label>
					<input type="text" name="frm_address" value="<?php echo $get_att_information->address; ?>" id="frm_address"/>
					<span class="error"></span>
					
				</div>
				<div class="attorney_row">
					<div class="attorney_left">
						<label>Phone</label>
						<input type="text" name="phone" value="<?php echo $get_att_information->contact_number; ?>" id="phone"/>
						<span class="error"></span>
					
					</div>
					<div class="attorney_right">
						<label>Fax</label>
						<input type="text" name="fax" id="fax"/>
						<span class="error"></span>
					</div>
					
				</div>
				<div class="attorney_row">
					<div class="attorney_left">
						<label>Firm Contact Person</label>
						<input type="text" name="frm_contact" id="frm_contact" value="<?php echo ucwords($get_att_information->first_name)." ".ucwords($get_att_information->last_name); ?>"/>
						<span class="error"></span>
						
					</div>
					<div class="attorney_right">
						<label>Position</label>
						<input type="text" name="position" id="position" value="<?php $desid = $get_att_information->designation; echo $meshednew->GetDesgBydesId($desid); ?>"/>
						<span class="error"></span>
						
					</div>
				</div>
				<div class="attorney_row">
					<div class="attorney_left">
						<label>Contact E-mail</label>
						<input type="text" name="contct_email" value="<?php echo $get_att_information->email_id; ?>" id="contct_email"/>
						<span class="error"></span>
						
					</div>
				</div>
			</div><!--client_2_end-->
			<div class="client_3">
				<h2>Defendant Insurance Information ( information is needed whether or not in suit)</h2>
				<div class="attorney_row">
					<div class="attorney_left">
						<label>Defendent Name <span class="asterisk">(*)</span></label>
						<input type="text" name="dfndr_name" class="required_field" id="dfndr_name"/>
						<span class="error"></span>
						
					</div>
					<div class="attorney_right">
						<label>Insurance Company <span class="asterisk">(*)</span></label>
						
						<input type="text" name="insure_cmpny" class="required_field" id="insure_cmpny"/>
						<span class="error"></span>
						
					</div>
				</div>
				<div class="attorney_row">
					<div class="attorney_left">
						<label>Claim No.</label>
						<input type="text" name="claim_no" id="claim_no"/>
						<span class="error"></span>
						
					</div>
					<div class="attorney_right">
						<label>Bodily Injury Limits</label>
						<input type="text" name="limits" id="limits"/>
						<span class="error"></span>
						
					</div>
				</div>
			</div><!--client_2_end-->
			<div class="client_3">
				<h2>Incident Information</h2>
				<div class="attorney_row">
					<div class="attorney_left">
						<label>Date of Injury <span class="asterisk">(*)</span></label>
						<input type="text" placeholder="mm-dd-yyyy" class="required_field" name="injury_date" id="injury_date"/>
						<span class="error"></span>
					</div>
					<div class="attorney_right">
						<label>Location of Event</label>
						<input type="text" name="event_location" id="event_location"/>
						<span class="error"></span>
						
					</div>
				</div>
				<div class="attorney_row">
					<label>Description of the Event</label>
					<textarea name="event_desc" id="event_desc" ></textarea>
					
				</div>
				<div class="attorney_row">
					<label>Specify Body Part to be Evaluated <span class="asterisk">(*)</span></label>
					<textarea name="injury_desc" class="required_field  id="injury_desc"></textarea>
					
				</div>
				<div class="attorney_row">
					<div class="form_field_left">
						<label>Was there a Police Report</label>
					</div>
					<div class="form_field_right">
						<label class="checkbox_label">
							<input type="radio" name="police_reportt" value="yes" id="" checked />Yes
						</label>
						<label class="checkbox_label">
							<input type="radio" name="police_reportt" value="no" id=""/>No
						</label>
					
					</div>
				</div>
				<div class="attorney_row">
					<div class="form_field_left">
						<label>Others injured</label>
					</div>
					<div class="form_field_right">
						<label class="checkbox_label">
							<input type="radio" name="other_injured" value="yes" id="" checked />Yes
						</label>
						<label class="checkbox_label">
							<input type="radio" name="other_injured" value="no" id=""/>No
						</label>
					</div>
					
				</div>
				<div class="attorney_row">
					<!--<div class="form_field_left">
						<label>Witness(es) ?</label>
					</div>
					<div class="form_field_right">
						<label class="checkbox_label">
							<input type="radio" name="witnesses" value="yes" id="" checked />Yes
						</label>
						<label class="checkbox_label">
							<input type="radio" name="witnesses" value="no" id=""/>No
						</label>
						
					</div>-->
				</div>
			</div><!--client_3_end-->
			<div class="client_4">
				<h2>Documents Required to Process Claim</h2>
				<div class="attorney_row">
					<label><a class="document_download_file" href="<?php echo $sitepath;?>/medical-release-form/medical-release-form.pdf" target="_blank">Download Signed Medical Records Release Form</a></label>
				</div>
				<div class="attorney_row">
					<div class="form_field_left">
						<label>Signed Medical Records Release Form</label>
					</div>
					<div class="form_field_right">
						<label class="checkbox_label">
							<input type="radio" name="signed_medical" value="download" onclick="window.open('<?php echo $sitepath; ?>/attorney/upload-documents.php?fid=<?php echo $form_id; ?>&uid=<?php echo $user_id; ?>&att_id=<?php echo $att_id; ?>&cid=1')" id=""/>Upload 
						</label>
						<label class="checkbox_label">
							<input type="radio" name="signed_medical" value="n/a" id=""/>N/A
						</label>
						<label class="checkbox_label">
							<input type="radio" name="signed_medical" value="will fax" id="" checked />Will Fax
						</label>
						
					</div>
				</div>
				<div class="attorney_row">
					<div class="form_field_left">
						<label>Police Report</label>
					</div>
					<div class="form_field_right">
						<label class="checkbox_label">
							<input type="radio" name="police_report" value="download" onclick="window.open('<?php echo $sitepath; ?>/attorney/upload-documents.php?fid=<?php echo $form_id; ?>&uid=<?php echo $user_id; ?>&att_id=<?php echo $att_id; ?>&cid=1')" id=""/>Upload 
						</label>
						<label class="checkbox_label">
							<input type="radio" name="police_report" value="n/a" id=""/>N/A
						</label>
						<label class="checkbox_label">
							<input type="radio" name="police_report" value="will fax" id="" checked />Will Fax
						</label>
						
					</div>
				</div>
				<div class="attorney_row">
					<div class="form_field_left">
						<label>Medical Bill</label>
					</div>
					<div class="form_field_right">
						<label class="checkbox_label">
							<input type="radio" name="medical_bill" value="download" onclick="window.open('<?php echo $sitepath; ?>/attorney/upload-documents.php?fid=<?php echo $form_id; ?>&uid=<?php echo $user_id; ?>&att_id=<?php echo $att_id; ?>&cid=1')" id=""/>Upload 
						</label>
						<label class="checkbox_label">
							<input type="radio" name="medical_bill" value="n/a" id=""/>N/A
						</label>
						<label class="checkbox_label">
							<input type="radio" name="medical_bill" value="will fax" id="" checked />Will Fax
						</label>
						
					</div>
				</div>
			</div><!--client_4_end-->
			<div class="attorney_row">
					<div class="form_field_left">
						<label>Medical Records</label>
					</div>
					<div class="form_field_right">
						<label class="checkbox_label">
							<input type="radio" name="medical_records" value="download" onclick="window.open('<?php echo $sitepath; ?>/attorney/upload-documents.php?fid=<?php echo $form_id; ?>&uid=<?php echo $user_id; ?>&att_id=<?php echo $att_id; ?>&cid=1')" id=""/>Upload 
						</label>
						<label class="checkbox_label">
							<input type="radio" name="medical_records" value="n/a" id=""/>N/A
						</label>
						<label class="checkbox_label">
							<input type="radio" name="medical_records" value="will fax" id="" checked />Will Fax
						</label>
						
					</div>
				</div>
				<div class="attorney_row">
					<h2>Optional Documents</strong></h2>
					<div class="form_field_left">
						<label>Travel Bills</label>
					</div>
					<div class="form_field_right">
						<label class="checkbox_label">
							<input type="radio" name="travel_bills" value="download" onclick="window.open('<?php echo $sitepath; ?>/attorney/upload-documents.php?fid=<?php echo $form_id; ?>&uid=<?php echo $user_id; ?>&att_id=<?php echo $att_id; ?>&cid=1')" id=""/>Upload 
						</label>
						<label class="checkbox_label">
							<input type="radio" name="travel_bills" value="n/a" id=""/>N/A
						</label>
						<label class="checkbox_label">
							<input type="radio" name="travel_bills" value="will fax" id="" checked />Will Fax
						</label>
						
					</div>
				</div>
				<div class="attorney_row">
					<div class="form_field_left">
						<label>Other</label>
					</div>
					<div class="form_field_right">
						<label class="checkbox_label">
							<input type="radio" name="other_records" value="download" onclick="window.open('<?php echo $sitepath; ?>/attorney/upload-documents.php?fid=<?php echo $form_id; ?>&uid=<?php echo $user_id; ?>&att_id=<?php echo $att_id; ?>&cid=1')" id=""/>Upload 
						</label>
						<label class="checkbox_label">
							<input type="radio" name="other_records" value="n/a" id=""/>N/A
						</label>
						<label class="checkbox_label">
							<input type="radio" name="other_records" value="will fax" id="" checked />Will Fax
						</label>
						
					</div>
				</div>
				
			<div class="client_5">
				<div class="attorney_row">
					<input type="submit" name="submit" id="submit" value="Submit"/>
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
