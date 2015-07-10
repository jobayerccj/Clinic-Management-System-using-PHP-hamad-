<?php
session_start();
require_once('../../../includes/functions.php');
$path = $_SERVER['DOCUMENT_ROOT']."/rao/path.php";
require_once($path);
include($config);
include_once '../../functions.php';
include_once '../class.php';
include_once '../classes/plantiff.php';
include_once '../classes/plantiffinformation.php';
$user_id = $_GET['id'];
if(loggedin())
{
	include('../header.php');
?>
<link rel="stylesheet" href="../admin-style.css" type="text/css">
<link rel="stylesheet" href="<?php echo $appcss; ?>" type="text/css">
<section class="row">
	<div class="container">
		<form name="accept_plantiff_p" method="post" action="">
		<div class="button_bg">
			<ul>
				<li><div id="accept" class="accpet_button">Click Here to Accept</div></li>
				<li><div id="decline" class="accpet_button">Click Here to Decline</div></li>
				<li><div id="delete" class="accpet_button">Click Here to Delete</div></li>
			</ul>
			<!--Only accept is working-->
			<div id="accept_plantiff" style="display:none;">
				<!--Multiselect for Doctors-->
				<div class="accept_row">
					<h3>Case type:</h3>
					<label>Ortho</label>
					<input type="radio" name="case-type" value="Ortho">
					<label>Meshed-Case</label>
					<input type="radio" name="case-type" value="Meshed-Case">
				</div>
				<div class="accept_row">	
					<p>Choose Doctors:</p>
					<select name="choosedoctors[]" multiple="multiple">
						<?php
							$doctors = mysql_query("SELECT * FROM  `members` WHERE  `designation` !=  'Plaintiff (Injured Party)' &&  
							`designation` !=  'admin'") or die(mysql_error());
						    while($doctors_list = mysql_fetch_array($doctors))
						    {
						 ?>
						       <option value="<?php echo $doctors_list['id']; ?>">
									<?php echo ucwords($doctors_list['first_name'])." ".ucwords($doctors_list['last_name']); ?>
						       </option>
						<?php
							}
						?>
					</select>
					<div class="accept_row">	
					<p>Plantiff Status:</p>
					<textarea name="plantiff_status"></textarea>
				</div>
				</div>
				<div class="accept_row">	
					<p>Message to Doctor:</p>
					<textarea name="message_doctor"></textarea>
				</div>
				<div class="accept_row">				
					<p>Message to Plantiff:</p>
					<textarea name="message-plantiff"></textarea>
					<input type="submit" name="accept_button" value="Accept">
				</div>	
			</div>
			<!-- Accept ends here -->
			
			<!--Decline button for plantiff-->
			<div id="decline-plantiff" style="display:none;">
				Reason to Decline:<textarea name="message-doctor"></textarea>
				<input type="button" name="Decline" value="Decline">
			</div>
			<!-- Decline ends here -->
			
			<!--Delete button for plantiff-->
			<div id="delete-plantiff" style="display:none;">
				<input type="submit" name="Delete" value="Delete">
			</div>
			<!--Delete button ends here-->
		</div>
	</form>
		<?php
		$plantiff_doctorss = new Plantiffinformation();
		if(isset($_POST['accept_button']))
		{
			$case_type       = $_POST['case-type'];
			$choose_doctors  = $_POST['choosedoctors'];
			$message_doctor  = $_POST['message_doctor'];
			$message_plantiff= $_POST['message-plantiff'];
			$plantiff_status = $_POST['plantiff_status'];
			$data = $plantiff_doctorss->GetEmailId($choose_doctors,$case_type,$plantiff_status,$message_doctor,$message_plantiff);
			$data2= $plantiff_doctorss->GetUserEmail($user_id,$message_plantiff);
			//$email_send = $plantiff_doctorss->SendEmail($emails_users,$messages);
	
		}
		if(isset($_POST['Delete']))
		{
			$delete = $plantiff_doctorss->DeleteForm();
		}
	?>
</section>
<?php
include($get_footer);
}
else
{
header('Location:../../login.php');
}
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function()
			{
				$("#accept").click(function()
				{
					$("#accept_plantiff").toggle('slow');
					$("#decline-plantiff").hide();
					$("#delete-plantiff").hide();
				});
				$("#decline").click(function()
				{
					$("#decline-plantiff").toggle('slow');
					$("#accept_plantiff").hide();
					$("#delete-plantiff").hide();
				});
				$("#delete").click(function()
				{
					$("#delete-plantiff").toggle('slow');
					$("#accept_plantiff").hide();
					$("#decline-plantiff").hide();
				});
			});
		</script>
