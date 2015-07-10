<?php
ob_start();
ini_set('display_errors',1);  
error_reporting(E_ALL);
$path = $_SERVER['DOCUMENT_ROOT']."/rao/path.php";
require_once($path);
require_once($config);
?>			
	<div class="anesth_bg">
		<div class="view_application">
			<div class="dr_message_side_row">
				<h1>Message</h1>
				<?php
				$temp_message = mysql_query("SELECT * FROM `message_sent` WHERE `user_id`='$_REQUEST[uid]' &&`form_id`='$_REQUEST[fid]' order by message_id desc") or die(mysql_error());
				if(mysql_num_rows($temp_message)>0)
				{
				while($message = mysql_fetch_object($temp_message))
				{
				$getall_id  = $message->main_user_id;
				$getalldeta = explode(",",$getall_id);
				$a = in_array($doctor_id,$getalldeta);
				//echo $getall_id;
				if(in_array($doctor_id,$getalldeta))
				{
						?>
				<div>
				  <div id="news_list">
					  <div class="rep_left"></div>
					  <div class="rep_middle">
					  <div class="rep_tit"><a>
					  <?php 
							echo "<b>".$fname   = $functions->GetObjectById($message->sent_by,"first_name")."</b>";
							echo "<b>".$lname   = $functions->GetObjectById($message->sent_by,"last_name")."</b><br/>";
									   $desg    = $functions->GetObjectById($message->sent_by,"designation");
							echo "<b>".$desgna  = $functions->GetDesgBydesId($desg)."</b><br/>";
							$a_mess = $message->date_message;
							echo date('Y-M-d',strtotime($a_mess))."<br/>";
							echo date('h:i:s a',strtotime($a_mess));
						?>
						</a></div>
					  <div class="rep">
						<?php 
							echo $tempmessages  = $message->message;
						?><br />	
					<a onclick="showmessages();" href="javascript:animatedcollapse.show('jasoncomment<?php echo $message->message_id; ?>')">Reply Me</a>
				
						   </div>
					  </div>
					  <div class = "clr" ></div>
				  </div>
				 </div>
				<script type="text/javascript">
					animatedcollapse.addDiv('jason22', 'fade=1,height=150px,speed=200');animatedcollapse.addDiv('jasoncomment<?php echo $message->message_id; ?>', 'fade=1,height=150px,speed=200');
					animatedcollapse.ontoggle=function($, divobj, state){
					}
					animatedcollapse.init()
				</script>
				<div id="jasoncomment<?php echo $message->message_id; ?>"  style="width:460px; background:#f0f0f0; margin:5px; display:none; border:1px solid #cccccc;">
					<a href="javascript:animatedcollapse.hide('jasoncomment<?php echo $message->message_id; ?>')">Close</a>
					<div style="font-size:11px; margin:10px 0 0 10px; font-family:latha;font-weight:bold;">Your Message 
						<form method="post" action="" >
							<div style=" padding-top:5px;">
								<textarea rows="3" cols="50" id ="comment<?php echo $message->message_id; ?>" name="reply-comment"></textarea>
							</div>
							<input type="text" name ="message_id" value ="<?php echo $message->message_id; ?>"/>
							<input type="text" name="sent_by" value="<?php echo $message->sent_by; ?>">
							<input type="text" name="main_user_id" value="<?php echo $message->main_user_id; ?>">
							<input onclick="showmessages();" type="submit" name="replyb" value="Enter Your Message" style="margin-top:5px; height:20px; border:1px solid #246d00; font-size:10px; font-weight:bold;" />
						</form>
					</div>
				</div>				
				<?php	
					$test = "SELECT a.* FROM  `message_reply` AS a, message_sent AS b WHERE a.message_sent_id = b.message_id && b.message_id='".$message->message_id."' && a.message_sent_id='".$message->message_id."'";
					$data1 = mysql_query("SELECT a .* , b .* FROM  `message_reply` AS a, message_sent AS b WHERE a.message_sent_id = b.message_id && b.message_id='".$message->message_id."' && a.message_sent_id='".$message->message_id."' ") or die(mysql_error());
					if(mysql_num_rows($data1)>0)
					{
						$i=1;
						while($data = mysql_fetch_object($data1))
						{
						$count = count($data);
				?>
					<div style="">
					  <div id="news_list">
						  <div class="rep_left"></div>
						  <div class="rep_middle" style="padding:<?php echo $i+10; ?>px; margin-left:<?php echo 5*$i; ?>px;">
						  <?php $count = count($data); ?>
							<div class="rep_tit">
								<a>
									<?php 
										echo "<b>".$fname = $functions->GetObjectById($data->reply_by,"first_name")."</b>";
										echo "<b>".$lname = $functions->GetObjectById($data->reply_by,"last_name")."</b><br/>";
												 $desg    = $functions->GetObjectById($data->reply_by,"designation");
										echo "<b>".$desgna  = $functions->GetDesgBydesId($desg)."</b><br/>";
										$a_mess = $data->date_reply;
										echo date('Y-M-d',strtotime($a_mess))."<br/>";
										echo date('h:i:s a',strtotime($a_mess));
									?>
								</a>
							</div>
							<div class="rep">
							<?php 
								echo $tempmessages  = $data->message_reply;
							?><br />	
							<a onclick="showmessages();" href="javascript:animatedcollapse.show('jasoncomment<?php echo $data->reply_id; ?>')">Reply Me</a>
							</div>
						  </div>
						  <div class = "clr" ></div>
					  </div>
					 </div>
					<script type="text/javascript">
						animatedcollapse.addDiv('jason22', 'fade=1,height=150px,speed=200');animatedcollapse.addDiv('jasoncomment<?php echo $data->reply_id; ?>', 'fade=1,height=150px,speed=200');
						animatedcollapse.ontoggle=function($, divobj, state){
							}
						animatedcollapse.init()
					</script>
					<div id="jasoncomment<?php echo $data->reply_id; ?>"  style="width:460px; background:#f0f0f0; margin:5px; display:none; border:1px solid #cccccc;">
						<a href="javascript:animatedcollapse.hide('jasoncomment<?php echo $data->reply_id; ?>')">Close</a>
						<div style="font-size:11px; margin:10px 0 0 10px; font-family:latha;font-weight:bold;">Your Message 
							<form method="post" action="" >
								<div style=" padding-top:5px;">
									<textarea rows="3" cols="50" id ="comment<?php echo $data->reply_id; ?>" name="reply-comment"></textarea>
								</div>
								<input type="text" name ="message_id" value ="<?php echo $message->message_id; ?>" />
								<input type="text" name="sent_by" value="<?php echo $data->sent_by; ?>" />
								<input type="text" name="main_user_id" value="<?php echo $data->main_user_id; ?>" />
								<input type="submit" name="replyb" value="Enter Your Message" style="margin-top:5px; height:20px; border:1px solid #246d00; font-size:10px; font-weight:bold;" />
							</form>
						</div>
					</div>
						<?php
									$i++;
										}
										/*end while*/
								}/*end if from replies*/
							}/*end main while*/
				}
				}
				else
				{
					echo "There is no Message for You.";
			?>
			<form name="send_message" method="post" action="">
				<div style="display:none;">
					<?php
						$sql = mysql_query("SELECT * FROM `hire_staff` WHERE `form_id`='$_REQUEST[fid]' && `user_id`='$_REQUEST[uid]'") or die(mysql_error());
						while($hires = mysql_fetch_object($sql))
						{
							echo $hire_staff  = $hires->hire_id;
							$first_name  = $functions->GetObjectById($hire_staff,"first_name");
							$last_name   = $functions->GetObjectById($hire_staff,"last_name");
							$designation = $functions->GetObjectById($hire_staff,'designation');
							$desg_name   = $functions->GetDesgBydesId($designation)."<br/>";
						?>
								<input type="checkbox" name="msgid[]" id="squaredFour" value="<?php echo $hire_staff; ?>" checked="checked" />
								<label>
									<?php echo $desg_name; ?>(<?php echo $first_name."&nbsp;".$last_name; ?>)
								</label>
					<?php
						}
					?>
				</div>
				<script type="text/javascript">
					animatedcollapse.addDiv('jason22', 'fade=1,height=150px,speed=200');animatedcollapse.addDiv('jasoncomment', 'fade=1,height=150px,speed=200');
					animatedcollapse.ontoggle=function($, divobj, state){
					}
					animatedcollapse.init()
				</script>
				<h1>Send New Message</h1>
				<div style="font-size:11px; margin:10px 0 0 10px; font-family:latha;font-weight:bold;">Your Message 
				<div style=" padding-top:5px;">
					<textarea rows="3" cols="50" id ="comment" name="send_message_r"></textarea>
				</div>
				<input type="submit" name="message_sent_t" value="Enter Your Message" style="margin-top:5px; height:20px; border:1px solid #246d00; font-size:10px; font-weight:bold;" />
			</form>
					
			<?php	
				}
				if(isset($_POST['message_sent_t']))
				{
					$message = $_POST['send_message_r'];
					$msgid   = $_POST['msgid'];
					foreach($msgid as $sent_to_id)
					{
						$temp_id[] = $sent_to_id;
					}
					$temp_ids  = implode(',',$temp_id);							
					$message_reply = mysql_query("INSERT INTO `message_sent` (`form_id`,`user_id`,`sent_by`,`main_user_id`,`message`,`date_message`) VALUES ('$_REQUEST[fid]','$_REQUEST[uid]','$doctor_id','$temp_ids','$message',now())") or die(mysql_error());
					if($message_reply)
					{
						echo "Message Sent Successfully";
					}
					else
					{
						echo "There is something going wrong. Please Try again Later";
					}
				}
				if(isset($_POST['replyb']))
				{
					$smessage      = mysql_real_escape_string($_POST['reply-comment']);
					$message_id    = $_POST['message_id'];
					$sent_by       = $_POST['sent_by']; 
					$main_user_id  = $_POST['main_user_id'];
					$sendmessage = mysql_query("INSERT INTO `message_reply`(`message_sent_id`,`form_id`,`user_id`,`main_user_id`,`reply_by`,`sent_by`,`message_reply`,`date_reply`) VALUES ('$message_id','$_REQUEST[fid]','$_REQUEST[uid]','$main_user_id','$doctor_id','$sent_by','$smessage',now())") or die(mysql_error());
				}
				
			?>
			</div>
		</div>
	</div>
</div>