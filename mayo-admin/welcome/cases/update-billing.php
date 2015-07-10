<?php
ob_start();
ini_set('display_errors',1);  
error_reporting(E_ALL);
require_once('../../../includes/functions.php');
$path = $_SERVER['DOCUMENT_ROOT']."/rao/path.php";
require_once($path);
include($config);
include '../../functions.php';
include '../classes/Cases.php';
$desg = new Cases();
$functions = $_SERVER['DOCUMENT_ROOT']."/rao/classes/functions.php";
require_once($functions);
$getinformation = new Allfunctions();
if(loggedin())
{
	$header_admin = $_SERVER['DOCUMENT_ROOT']."/rao/mayo-admin/welcome/header.php";
	require_once($header_admin);
?>
<section class="row">
	<div class="container">
		<div class="anesth_box_bg">
				<div class="billing_box_bg">
					<div class="view_client_row">
						<h1>Add Billing</h1>
					</div>
					<form name="addcpt" id="otho_group" method="post" action="">
						<?php
							$temp_billing = mysql_query("SELECT * FROM `billing_info` WHERE billing_id='$_REQUEST[billing_id]' && `form_id`='$_REQUEST[id]' && `user_id`='$_REQUEST[uid]' ") or die(mysql_error());
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

						<textarea name="description" placeholder="Description" required /><?=$billing->description?></textarea>
						<input type="text" name="physician" value="<?=$billing->physician?>" placeholder="Physician" required />
						<input type="text" name="loc" value="<?=$billing->loc?>" placeholder="Physician Cost" required />
						<input type="text" name="facility" value="<?=$billing->facility?>" placeholder="Facility" required />
						<input type="text" name="other" value="<?=$billing->other_total?>" placeholder="Other" required />
						<input type="submit" name="add_cpt" value="Add Bill">
					</form>
					<?php
						if(isset($_POST['add_cpt']))
						{
							$ctp_code    = $_POST['ctp_code'];	
							$description = mysql_real_escape_string($_POST['description']);
							$physician   = mysql_real_escape_string($_POST['physician']);
							$loc         = mysql_real_escape_string($_POST['loc']);
							$facility    = mysql_real_escape_string($_POST['facility']);
							$other       = mysql_real_escape_string($_POST['other']);	
							$query_bill  = mysql_query("UPDATE `billing_info` SET `cpt_code`='$ctp_code',`description`='$description',`physician`='$physician',`loc`='$loc',`facility`='$facility',`other_total`='$other' WHERE 
							`billing_id`='$_REQUEST[billing_id]' && `form_id`='$_REQUEST[id]' && `user_id`='$_REQUEST[uid]'")  or die(mysql_error());
							if($query_bill)
							{
								echo "<div class='thank_message'>Bill is Updated Successfully</div>";
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
