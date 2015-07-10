<?php 
ini_set('display_errors',1);  
error_reporting(E_ALL);
$path = $_SERVER['DOCUMENT_ROOT']."/rao/path.php";
require_once($path);
include('header.php');
require_once($config);
include('../classes/login-functions.php');

if(loggedin()) 
{
/*Class file to call the functions*/
$formid = $_REQUEST['fid'];
$userid = $_REQUEST['uid'];
?>
<section class="row">
	<div class="container dashboard_bg">
		<?php include('messages.php'); ?>
		<div class="slide_right">
			<div class="anesth_bg">
				<div class="view_application">
					<div class="anesth_dashbord_client">
						<div class="billing_box_bg">
							<div class="billing_box_bg_left">
								<h1>Add Billing</h1>
								<form name="addcpt" method="post" action="">
									<?php
										$temp_cpt = mysql_query("SELECT * FROM `cpt_codes`") or die(mysql_error());
										echo '<select name="CTP Code" required /><option value="">...Select...</option>';
										while($cpt= mysql_fetch_object($temp_cpt))
										{
											echo '<option value='.$cpt->cpt_code.'>'.$cpt->cpt_code.'</option>';
										}
										'</select>';
									?>
									<textarea name="description" placeholder="Description" required /></textarea>
									<input type="text" name="physician" placeholder="Physician" required />
									<input type="text" name="facility" placeholder="Facility" required />
									<input type="text" name="other" placeholder="Other" required />
									<input type="submit" name="add_cpt" value="Add Bill">
								</form>
								<?php
									if(isset($_POST['add_cpt']))
									{
										
									}
								?>
							</div>
							<div class="billing_box_bg_right">
								<h1>You can use this for billing also</h1>
								<?php
									$temp_code = mysql_query("SELECT * FROM `cpt_codes`") or die(mysql_error());
									while($code = mysql_fetch_object($temp_code))
									{
								?>
									<input type="checkbox" name="addbill[]" value="<?php echo $code->cpt_code; ?>"><?php echo $code->description; ?><br/>
								<?php
									}
								?>
								<input type="submit" name="adding_bill" value="Add Bill">
							</div>
						</div>
						<div class="anesth_box_bg">
							<div class="anesth_row_heading">
								<div class="anesth_span_date">Date</div>
								<div class="anesth_span_code">Code</div>
								<div class="anesth_span_desc">Description</div>
								<div class="anesth_span_phy">Physician</div>
								<div class="anesth_span_fac">Facility</div>
								<div class="anesth_span_oth">Other</div>
							</div>
							<?php
								$query = mysql_query("SELECT * FROM `appointment_doctor` where `form_id`='$_REQUEST[fid]' && `user_id`='$_REQUEST[uid]'") 
								or die(mysql_error());
								while($getapp = mysql_fetch_object($query))
								{
									$uid  = $_REQUEST['uid'];
									$f_id = $_REQUEST['fid']; 
							?>
									<div class="anesth_row_content">
										<div class="anesth_span_1"><?=$getapp->form_id?></div>
										<div class="anesth_span_2">
											<?php 
												$m_u_id = $getapp->main_user_id; 
												$fname = $functions->GetObjectById($m_u_id,"first_name");
												$lname = $functions->GetObjectById($m_u_id,"last_name");
												echo ucwords($fname);
												echo ucwords($lname);
											?>
										</div>
										<div class="anesth_span_3">
											
										</div>
										<div class="anesth_span_4">
											
										</div>
										<div class="anesth_span_4">
											<?php 
												$appt = $getapp->app_type; 
												echo $functions->GetAppById($appt);
											?>
										</div>
									</div>
								<?php
								 }
								?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo $sitepath; ?>/popup/featherlight.min.css" title="Featherlight Styles" />
<script src="<?php echo $sitepath; ?>/popup/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="<?php echo $sitepath; ?>/popup/style.css">
<?php
require($get_footer);
}
else
{
	
header('Location:../../login.php');
	
}
?>
