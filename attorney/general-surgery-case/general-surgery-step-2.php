<?php 
ob_start();
$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
$header = $pathofmayo."/attorney/header.php";
require($header);
require_once($config);
include('../../classes/login-functions.php');
@$emails        = $_SESSION['email'];
if(!isset($emails))
{
?>
<script>window.location="index.php";</script>
<?php
}
if(loggedin()) 
{
	if(isset($_SESSION['username']))
		$a             = $_SESSION['username'];
		
		$meshednew     = new Meshed();
		$att_id        = $meshednew->getIdByUname();
		$form_id       = $meshednew->getFormId($emails);
		$user_id       = $meshednew->UserId($emails);
?>
<!-- validation end -->
<style type="text/css">
.error
{
	color: #ff0000;
	font: 12px/4 open_sansregular;
	margin: 0 !important;
}
</style>
<section class="row">
	<div class="container client_application">
<?php
	if(isset($_REQUEST['send']))
	{
		$meshednew->firmname          = mysql_real_escape_string($_REQUEST['firm_name']); 
		$meshednew->address           = mysql_real_escape_string($_REQUEST['address']);
		$meshednew->phone             = mysql_real_escape_string($_REQUEST['p_phone']);
		$meshednew->fax               = mysql_real_escape_string($_REQUEST['p_fax']);
		$meshednew->contactp          = mysql_real_escape_string($_REQUEST['p_contact_person']);
		$meshednew->position          = mysql_real_escape_string($_REQUEST['p_position']);
		$meshednew->p_email        	  = mysql_real_escape_string($_REQUEST['p_email']);
		$meshednew->other_documents_m = $_POST['other_documents'];
		$meshednew->travel_m          = $_POST['travel_bills'];
		$meshednew->medical_bills_m   = $_POST['medical_bills'];
		$meshednew->medical_records_m = $_POST['medical_records'];
		$meshednew->product_label_m   = $_POST['product_label'];
		$meshednew->s_m_r_f_m         = $_POST['signed_medical_records'];
		$meshednew->user_email_m      = $_SESSION['email'];
		$case_type                    = "4";
		$final                        = $meshednew->MeshedStep($form_id,$user_id,$att_id,$case_type);
		if($final==1)
		{
			echo "<div class='thank_message'>Your Form is Submitted Successfully. You will get an email when form is accepted by Admin</div>";
			header("Refresh:3; url=index.php");
			unset($_SESSION['email']);
		}
	}
?>
		<h1>General Surgery Step-2 Form</h1>
			<form name="meshed" method="post" action="" id="registration">
			<div class="client_2">
				<h2>Attorney / Case Manager Information</h2>
				<?php
					$c_att_informaiton   = mysql_query("SELECT * FROM `members` where `id`= '$att_id'") or die(mysql_error());
					$get_att_information = mysql_fetch_object($c_att_informaiton);
				?>
				<div class="attorney_row">
					<label>Firm</label>
					<input type="text" name="firm_name" id="" value="<?php echo $get_att_information->organisation; ?>"/>
				</div>
				
				<div class="attorney_row">
					<label>Address</label>
					<input type="text" name="address" value="<?php echo $get_att_information->address; ?>" id="" value=""/>
				</div>
				
				<div class="attorney_row">
					<div class="attorney_left">
						<label>Phone</label>
						<input type="text" name="p_phone" value="<?php echo $get_att_information->contact_number; ?>" id="" value=""/>
					</div>
					
					<div class="attorney_right">
						<label>Fax</label>
						<input type="text" name="p_fax" id="" value=""/>
					</div>
					
				</div>
				<div class="attorney_row">
					<div class="attorney_left">
						<label>Firm Contact Person</label>
						<input type="text" name="p_contact_person"  id="" value="<?php echo ucwords($get_att_information->first_name)." ".ucwords($get_att_information->last_name); ?>"/>
						
					</div>
					<div class="attorney_right">
						<label>Position</label>
						<input type="text" name="p_position" id="" value="<?php $desid = $get_att_information->designation; echo $meshednew->GetDesgBydesId($desid); ?>"/>
						
					</div>
				</div>
				<div class="attorney_row">
					<div class="attorney_left">
						<label>Contact E-mail</label>
						<input type="text" name="p_email" id="" value="<?php echo $get_att_information->email_id; ?>"/>
						
					</div>
				</div>
			</div><!--client_2_end-->
			<div class="client_3">
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
							<input type="radio" name="signed_medical_records" value="download" onclick="window.open('<?php echo $sitepath; ?>/attorney/upload-documents.php?fid=<?php echo $form_id ; ?>&uid=<?php echo $user_id; ?>&att_id=<?php echo $att_id; ?>&cid=4')" id=""/>Upload 
						</label>
						<label class="checkbox_label">
							<input type="radio" name="signed_medical_records" value="n/a" id=""/>N/A
						</label>
						<label class="checkbox_label">
							<input type="radio" name="signed_medical_records" value="will fax" id="" checked />Will Fax
						</label>
					</div>
				</div>
				<div class="attorney_row">
					<div class="form_field_left">
						<label>Product Label</label>
					</div>
					
					<div class="form_field_right">
						<label class="checkbox_label">
							<input type="radio" name="product_label" value="download" onclick="window.open('<?php echo $sitepath; ?>/attorney/upload-documents.php?fid=<?php echo $form_id; ?>&uid=<?php echo $user_id; ?>&att_id=<?php echo $att_id; ?>&cid=4')" id=""/>Upload 
						</label>
						<label class="checkbox_label">
							<input type="radio" name="product_label" value="n/a" id=""/>N/A
						</label>
						<label class="checkbox_label">
							<input type="radio" name="product_label" value="will fax" id="" checked />Will Fax
						</label>
					</div>
				</div>
				<div class="attorney_row">
					<div class="form_field_left">
						<label>Medical Record</label>
					</div>
					
					<div class="form_field_right">
						<label class="checkbox_label">
							<input type="radio" name="medical_records" value="download" onclick="window.open('<?php echo $sitepath; ?>/attorney/upload-documents.php?fid=<?php echo $form_id; ?>&uid=<?php echo $user_id; ?>&att_id=<?php echo $att_id; ?>&cid=4')" id=""/>Upload 
						</label>
						<label class="checkbox_label">
							<input type="radio" name="medical_records" value="n/a"  id=""/>N/A
						</label>
						<label class="checkbox_label">
							<input type="radio" name="medical_records" value="will fax" id="" checked />Will Fax
						</label>
					</div>
				</div>
			</div><!--client_3_end-->
			
			
			
			
			<div class="client_3">
				<h2>Optional Documents</h2>
				<div class="attorney_row">
					<div class="form_field_left">
						<label>Medical Bills</label>
					</div>
					<div class="form_field_right">
						<label class="checkbox_label">
							<input type="radio" name="medical_bills" value="download" onclick="window.open('<?php echo $sitepath; ?>/attorney/upload-documents.php?fid=<?php echo $form_id ; ?>&uid=<?php echo $user_id; ?>&att_id=<?php echo $att_id; ?>&cid=4')" id=""/>Upload 
						</label>
						<label class="checkbox_label">
							<input type="radio" name="medical_bills" value="n/a" id=""/>N/A
						</label>
						<label class="checkbox_label">
							<input type="radio" name="medical_bills" value="will fax" id="" checked />Will Fax
						</label>
					</div>
				</div>
				<div class="attorney_row">
					<div class="form_field_left">
						<label>Travel Bills</label>
					</div>
					<div class="form_field_right">
						<label class="checkbox_label">
							<input type="radio" name="travel_bills" value="download" onclick="window.open('<?php echo $sitepath; ?>/attorney/upload-documents.php?fid=<?php echo $form_id; ?>&uid=<?php echo $user_id; ?>&att_id=<?php echo $att_id; ?>&cid=4')" id=""/>Upload 
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
						<label>Other Documents</label>
					</div>
					<div class="form_field_right">
						<label class="checkbox_label">
							<input type="radio" name="other_documents" value="download" onclick="window.open('<?php echo $sitepath; ?>/attorney/upload-documents.php?fid=<?php echo $form_id; ?>&uid=<?php echo $user_id; ?>&att_id=<?php echo $att_id; ?>&cid=4')" id=""/>Upload 
						</label>
						<label class="checkbox_label">
							<input type="radio" name="other_documents" value="n/a"  id=""/>N/A
						</label>
						<label class="checkbox_label">
							<input type="radio" name="other_documents" value="will fax" id="" checked />Will Fax
						</label>
					</div>
				</div>
			</div><!--client_3_end-->
			<div class="client_5">
				<div class="attorney_row">
					<input type="submit" name="send" id="" value="Submit"/>
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
