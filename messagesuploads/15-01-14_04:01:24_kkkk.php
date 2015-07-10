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
		<div class="dr_upload_doc_slide">
			<div class="dr_message_side_bg">
				<?php include('latestmessages.php');?>		
			</div>
		</div>
		<div class="slide_right">
			<div class="anesth_bg">
				<div class="view_application">
					<div class="dr_message_side_row">
						<h1>Message</h1>
						<?php
						$temp_message = mysql_query("SELECT * FROM `message_sent` WHERE `user_id`='$_REQUEST[uid]' &&`form_id`='$_REQUEST[fid]' order by message_id desc") or die(mysql_error());
						while($message= mysql_fetch_object($temp_message))
						{
							$getall_id  = $message->main_user_id;
							$getalldeta = explode(",",$getall_id);
							if(in_array($doctor_id,$getalldeta))
							{
					?>
						<form name="form1" method="post" action="">
							<div class="dr_message_side_row">
								<div class="dr_message_side_left">
									<label>
										<?php 
											$a_mess = $message->date_message;
											echo date('Y-M-d',strtotime($a_mess))."<br/>";
											echo date('h:i:s a',strtotime($a_mess));
										?>
									</label>
								</div>
								<div class="dr_message_side_right">
									<label>
										<?php 
											echo $tempmessages  = $message->message;
										?>
										<br/>
										<input type="text" name="message_id" value="<?php echo $message->message_id; ?>" />
										<div id="send_messages<?php echo $message->message_id;?>" style="display:none;">
											<textarea name="reply_message" placeholder="Send Reply"></textarea>
											<input id="send_messagess" type="submit" name="Reply" value="Reply" required />
										</div>
									</label>
								</div>
							</div>
						</form>
						<button id="send_message<?php echo $message->message_id;?>" href="">Reply</button>
						<script type="text/javascript">
						$(document).ready(function()
						{
							$("#send_message<?php echo $message->message_id;?>").click(function()
							{
								$("#send_messages<?php echo $message->message_id;?>").toggle('slow');
							})
						});
					</script>
					<?php
							}
							else
							{
								echo "There is no Message for You.";
							}
						}
						if(isset($_POST['Reply']))
						{
							$message_reply = mysql_query("INSERT INTO `message_reply` (`message_sent_id`,`form_id`,`user_id`,`main_user_id`,`message_reply`,`date_reply`) VALUES ('$_POST[message_id]','$_REQUEST[fid]','$_REQUEST[uid]','$doctor_id','$_POST[reply_message]',now())") or die(mysql_error());
							if($message_reply)
							{
								echo "Message Sent Successfully";
							}
							else
							{
								echo "There is something going wrong. Please Try again Later";
							}
						}
						
					?>
					</div>
					<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
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
