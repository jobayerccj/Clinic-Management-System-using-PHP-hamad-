<?php
ob_start();
ini_set('display_errors',1);  
error_reporting(E_ALL);
require_once('../../../includes/functions.php');
$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
include($config);
include '../../functions.php';
include '../classes/Cases.php';
$desg = new Cases();
$functions = $pathofmayo."/classes/functions.php";
require_once($functions);
$getinformation = new Allfunctions();
if(loggedin())
{
	$header_admin = $pathofmayo."/mayo-admin/welcome/header.php";
	require_once($header_admin);
?>
<script src="http://<?php echo $jqueryminjs; ?>"></script>
<script src="http://<?php echo $validateminjs; ?>"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script> 
<script type="text/javascript">
$(document).ready(function(){
$("#otho_group").validate({
	rules: {
		ctp_code:{
			required: true
			},
		physician:{
			required:true,
			number:true
			},
		facility:{
				required:true,
				number:true
			},
		other:{
			required:true,
			number:true
			}	
	},
	
	// Specify the validation error messages
	errorElement: "span",
	messages: {
		ctp_code:{
			required: "Please Select Atleast One Code"
		},
		physician:{
			required: "Please Enter the Amount",
			number: "Please Enter the Correct Format"
		},
		facility:{
			required:"Please Enter the Amount",
			number:"Please Enter the Correct Format"
		},
		other:{
			required:"Please Enter the Amont",
			number:"Please Enter the Correct Format"
			}
	},
	
	submitHandler: function(form) {
		form.submit();
	}
});
});

</script>
<section class="row">
	<div class="container">
		<div class="anesth_box_bg">
				<div class="billing_box_bg">
					<div class="view_client_row">
						<h1>Add Billing</h1>
					</div>
					<form name="addcpt" id="otho_group" method="post" action="">
						<?php
							$temp_billing = mysql_query("SELECT * FROM `billing_info` WHERE billing_id='$_REQUEST[billing_id]' && `form_id`='$_REQUEST[fid]' && `user_id`='$_REQUEST[uid]' ") or die(mysql_error());
							$billing      = mysql_fetch_object($temp_billing);
							$billing_code = $billing->cpt_code;
							$temp_cpt     = mysql_query("SELECT * FROM `cpt_codes`") or die(mysql_error());
						?>
						<select name="ctp_code" required />
							<option value="">...CPT Code...</option>
							<?php
								while($cpt= mysql_fetch_object($temp_cpt))
								{
									$cpt_code = $cpt->cpt_code;
									$billing_code = $billing->cpt_code;
							?>
								<option <?php if($cpt_code == $billing_code){echo "Selected='selected'";} ?> value='<?php echo $cpt->cpt_code; ?>'><?php echo $cpt->cpt_code; ?></option>';
							<?php
								}
							?>
							</select>

						<textarea name="description" placeholder="Description" required /><?=$billing->description?></textarea><br/>
						Physician Cost
						<input type="text" name="d_cost" value="<?=$billing->doctor_cost?>" placeholder="Physician Cost" required /><br/>
						Physician
						<input type="text" name="d_price" value="<?=$billing->doctor_price?>" placeholder="Physician" required /><br/>
						Facility Cost
						<input type="text" name="f_cost" value="<?=$billing->facility_cost?>" placeholder="Facility Cost" required /><br/>
						Facility
						<input type="text" name="f_price" value="<?=$billing->facility_price?>" placeholder="Facility" required /><br/>
						Anesthesiologist Cost
						<input type="text" name="a_cost" value="<?=$billing->anes_cost?>" placeholder="Anesthesiologist Cost" required /><br/>
						Anesthesiologist
						<input type="text" name="a_price" value="<?=$billing->anes_price?>" placeholder="Anesthesiologist" required /><br/>
						
						<input type="submit" name="add_cpt" value="Update Bill">
					</form>
					<?php
						if(isset($_POST['add_cpt']))
						{
							$ctp_code    = $_POST['ctp_code'];	
							$description = mysql_real_escape_string($_POST['description']);
							$d_cost   = mysql_real_escape_string($_POST['d_cost']);
							$d_price  =mysql_real_escape_string($_POST['d_price']);
							$f_cost         = mysql_real_escape_string($_POST['f_cost']);
							$f_price    = mysql_real_escape_string($_POST['f_price']);
							$a_cost       = mysql_real_escape_string($_POST['a_cost']);	
							$a_price       = mysql_real_escape_string($_POST['a_price']);
							$query_bill  = mysql_query("UPDATE `billing_info` SET `cpt_code`='$ctp_code',`description`='$description',`doctor_cost`='$d_cost',`doctor_price`='$d_price',`facility_cost`='$f_cost',`facility_price`='$f_price',`anes_cost`='$a_cost',`anes_price`='$a_price' WHERE 
							`billing_id`='$_REQUEST[billing_id]' && `form_id`='$_REQUEST[fid]' && `user_id`='$_REQUEST[uid]'")  or die(mysql_error());
							if($query_bill)
							{
								echo "<div class='thank_message'>Bill is Updated Successfully</div>";
								$page = "index.php?fid=".$_REQUEST['fid'].'&uid='.$_REQUEST['uid'];
								header("refresh:2;url=$page");
							}
							else
							{
								echo "<div class='thank_message'>There is something going wrong. Please try again Later</div>";
							}							
						}
					?>
				</div>
	</div>
</section>
<?php
require($get_footer);
?>
<?php 
}
else 
{ 
header('Location:../../login.php');
}
?>
