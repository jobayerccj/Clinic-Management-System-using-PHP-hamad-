<?php
ob_start();
ini_set('display_errors',1);  
error_reporting(E_ALL);
$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
include('header.php');
require_once($config);
include('../classes/login-functions.php');
if(loggedin()) 
{
/*Class file to call the functions*/
$a_username    = $_SESSION['username'];
		
$getfunction   = new Allfunctions();
$designationid = $getfunction->GetObjectByUsername("id",$a_username);
?>
<section class="row">
	<div class="container">
		<div class="search_bottom">
			<h1>Schedulling Post Consultation</h1>
			<div class="attorney_row">
				<div class="messages">
					<form name="form2" method="post" action="">
						<?php
							$docmessages = mysql_query("SELECT * FROM `bill_forward_doctor` WHERE `user_id`='$_REQUEST[uid]' && `form_id`='$_REQUEST[fid]'") or die(mysql_error());
							if(mysql_num_rows($docmessages)>0)
							{
								//echo $werrttt = "SELECT * FROM `message_doctor_billing` WHERE `user_id`='$_REQUEST[uid]' && `form_id`='$_REQUEST[fid]' && `id`='$_REQUEST[id]' and `main_id`='$doctor_id'";
								
								$wet = mysql_query("SELECT * FROM `message_doctor_billing` WHERE `user_id`='$_REQUEST[uid]' && `form_id`='$_REQUEST[fid]'") or die(mysql_error());
								
								while($message_docs = mysql_fetch_object($wet))
								{
									echo "<b>".$getfunction->GetObjectById($message_docs->sent_by,"first_name").'&nbsp</b>';
									echo "<b>".$getfunction->GetObjectById($message_docs->sent_by,"last_name").'&nbsp</b><br/>';
									echo "<b>".$message_docs->date_time.'&nbsp</b><br/>';
									echo "<textarea>".$message_docs->message."</textarea>";
								
						?>
									<input type="hidden" name="sentby" value="<?php echo $message_docs->sent_by; ?>"/>
						<?php
								}
							}
							else
							{	
								echo "error";
							}
						?>
						<div class="dashboard_row">
							<label>Message</label>
							<textarea name="message_doctor" required ></textarea>
						</div>
						<!--<textarea name="messagess" placeholder="Message/Mail" required /></textarea>-->
						<input type="submit" id="forward_bills" name="forward_bills" value="Send Reply">
					</form>
						</div>
					</div>
				<script>
					$(document).ready(function()
					{
						$("#forward_bills").click(function()
						{
							$(".thank_message").fadeOut(3000);
						});
					});
				</script>
				<?php
					if(isset($_POST['forward_bills']))
					{
						
						$clientfname = $getfunction->GetObjectById($_REQUEST['uid'],"first_name");
						$clientlname = $getfunction->GetObjectById($_REQUEST['uid'],"last_name");
						$dattime = date('d-M-Y h:i:s a');
						$user_id     = $_REQUEST['uid'];
						$form_id     = $_REQUEST['fid'];
						$m_ssage     = mysql_real_escape_string($_REQUEST['message_doctor']);
						
						$doc_id      = $_POST['sentby'];
						$email_id    = $getfunction->GetObjectById($doc_id,"email_id");
						
						$sql         = mysql_query("INSERT INTO `message_doctor_billing` (`main_id`,`form_id`,`user_id`,`sent_by`,`message`,`date_time`) VALUES ('$doc_id','$form_id','$user_id','$doctor_id','$m_ssage',now())") or die(mysql_error()); 
						
						$subject     = "New Message From Doctor for Funding On ".$dattime;
						$mfa         = "<html><body>".$m_ssage."</body><html>";
						$case 	     = $_REQUEST['fid'];
						$extravalues = array('Client Name'=>$clientfname,'Case No.'=>$case);
						$getfunction->SendEmail($email_id,$subject,$mfa,$extravalues);
						
						if($sql)
						{
							echo "<div class='thank_message'>Message Sent Successfully</div>";
							header("refresh:2;$_SERVER[REQUEST_URI]");
						}
						else
						{
							echo "<div class='thank_message'>There is something going Wrong</div>";
						}
					}
					else
					{
						echo "<h1>There is no Message.</h1>";
					}
				?>
					</div>
			</div>
		</div>
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