<?php 
ini_set('display_errors',1);  
error_reporting(E_ALL);
$path = $_SERVER['DOCUMENT_ROOT']."/rao/path.php";
require_once($path);
$header = $_SERVER['DOCUMENT_ROOT']."/rao/attorney/header.php";
require($header);
require_once($config);
include('../../classes/login-functions.php');
include('../classes/meshed.php');
if(loggedin()) 
{
	if(isset($_SESSION['username']))
		$a      = $_SESSION['username'];
		$emails  = $_SESSION['email'];
		
		$meshednew     = new Meshed();
		$att_id        = $meshednew->getIdByUname();
		echo $form_id       = $meshednew->getFormId($emails);
		$user_id       = $meshednew->UserId($emails);
?>
<section class="row">
	<div class="container client_application">
		<h1>General Surgery Step-2 Form</h1>
		<form name="meshed" method="post" action="">
			<div class="client_2">
				<h2>Client Attorney’s Information</h2>
				<?php
					$c_att_informaiton   = mysql_query("SELECT * FROM `members` where `id`= '$att_id'") or die(mysql_error());
					$get_att_information = mysql_fetch_object($c_att_informaiton);
				?>
				<div class="attorney_row">
					<label>Firm</label>
					<input type="text" name="firm_name" id="" value=""/>
				</div>
				
				<div class="attorney_row">
					<label>Address</label>
					<input type="text" name="address" id="" value=""/>
				</div>
				
				<div class="attorney_row">
					<div class="attorney_left">
						<label>Phone</label>
						<input type="text" name="p_phone" id="" value=""/>
					</div>
					
					<div class="attorney_right">
						<label>Fax</label>
						<input type="text" name="p_fax" id="" value=""/>
					</div>
					
				</div>
				<div class="attorney_row">
					<div class="attorney_left">
						<label>Firm Contact Person</label>
						<input type="text" name="p_contact_person" id="" value=""/>
						
					</div>
					<div class="attorney_right">
						<label>Position</label>
						<input type="text" name="p_position" id="" value=""/>
						
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
				<h2>Please also provide the following, if Available</h2>
				<div class="attorney_row">
					<div class="form_field_left">
						<label>Signed Medical Records Release Form</label>
					</div>
					
					<div class="form_field_right">
						<label class="checkbox_label">
							<input type="checkbox" name="police_report" value="download" onclick="window.open('<?php echo $sitepath; ?>/attorney/upload-documents.php?fid=<?php echo $form_id ; ?>&u_id=<?php echo $user_id; ?>&att_id=<?php echo $att_id; ?>&case_id=2')" id=""/>Download 
						</label>
						<label class="checkbox_label">
							<input type="checkbox" name="police_report" value="n/a" id=""/>N/A
						</label>
						<label class="checkbox_label">
							<input type="checkbox" name="police_report" value="will fax" id=""/>Will Fax
						</label>
					</div>
				</div>
				<div class="attorney_row">
					<div class="form_field_left">
						<label>Product Label</label>
					</div>
					
					<div class="form_field_right">
						<label class="checkbox_label">
							<input type="checkbox" name="medical_record" value="download" onclick="window.open('<?php echo $sitepath; ?>/attorney/upload-documents.php?fid=<?php echo $form_id; ?>&u_id=<?php echo $user_id; ?>&att_id=<?php echo $att_id; ?>&case_id=2')" id=""/>Download 
						</label>
						<label class="checkbox_label">
							<input type="checkbox" name="medical_record" value="n/a" id=""/>N/A
						</label>
						<label class="checkbox_label">
							<input type="checkbox" name="medical_record" value="will fax" id=""/>Will Fax
						</label>
					</div>
				</div>
				<div class="attorney_row">
					<div class="form_field_left">
						<label>Medical Record</label>
					</div>
					
					<div class="form_field_right">
						<label class="checkbox_label">
							<input type="checkbox" name="medical_bill" value="download" onclick="window.open('<?php echo $sitepath; ?>/attorney/upload-documents.php?fid=<?php echo $form_id; ?>&u_id=<?php echo $user_id; ?>&att_id=<?php echo $att_id; ?>&case_id=2')" id=""/>Download 
						</label>
						<label class="checkbox_label">
							<input type="checkbox" name="medical_bill" value="n/a"  id=""/>N/A
						</label>
						<label class="checkbox_label">
							<input type="checkbox" name="medical_bill" value="will fax" id=""/>Will Fax
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
<?php
	if(isset($_REQUEST['send']))
	{
		$meshednew->firmname       = mysql_real_escape_string($_REQUEST['firm_name']); 
		$meshednew->address        = mysql_real_escape_string($_REQUEST['address']);
		$meshednew->phone          = mysql_real_escape_string($_REQUEST['p_phone']);
		$meshednew->fax            = mysql_real_escape_string($_REQUEST['p_fax']);
		$meshednew->contactp       = mysql_real_escape_string($_REQUEST['p_contact_person']);
		$meshednew->position       = mysql_real_escape_string($_REQUEST['p_position']);
		$meshednew->p_email        = mysql_real_escape_string($_REQUEST['p_email']);
		$meshednew->police_report  = $_REQUEST['police_report']; 
		$meshednew->medical_record = $_REQUEST['medical_record'];
		$meshednew->medical_bill   = $_REQUEST['medical_bill'];
		$meshednew->user_email     = $_SESSION['email'];
		$case_type      = "4";
		$meshednew->MeshedStep($form_id,$user_id,$att_id,$case_type);
	}
?>
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
