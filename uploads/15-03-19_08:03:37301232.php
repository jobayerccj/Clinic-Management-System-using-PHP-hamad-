<?php
	define('SCRIPT_DEBUG', true);
	$admin    = $_SESSION['username'];
	$admin_id = $getdata->GetDetailsByUsername($admin,"id");
?>
<script type="text/javascript" src="<?php echo $sitepath; ?>/messages/common.js"></script>
<script type="text/javascript" src="<?php echo $sitepath; ?>/messages/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $sitepath; ?>/messages/animatedcollapse.js"></script>
<h2>Message</h2>
<div class="attorney_client_info">
	<h1>Message</h1>
</div>
<div class="dashbord_client">
	<div class="update_status_top">
    <div class="mess_msg_form">
			<div class="mess_msg_form_div">
				<div class="mess_msg_lft"><input type="checkbox" id="squaredFours" class="selectall" name="msgid" value="selectall"></div>
				<div class="mess_msg_rgt"><label>Select All</label></div>
           </div>

			<script type="text/javascript">
				/*
					Script to check all the ids of all the hired professionals
				*/
				$('.selectall').click(function()
				{
					if($(this).is(':checked'))
					{
						$('input:checkbox').attr('checked',true);
					}
					else
					{
						$('input:checkbox').attr('checked',false);
					}
				});
			</script>
             </div>
			 <script type="text/javascript">
				$(document).ready(function()
				{
					new multiple_file_uploader
					({
						form_id: "fileUpload", 
						autoSubmit: true,
						server_url: "../../../upload_messages.php" // PHP file for uploading the browsed files
					});
				});
			</script>
			<form id="fileUpload"  action="" enctype="multipart/form-data" name="update_status" method="post" action="" class="mess_msg_form">
				<?php
					$att = mysql_query("SELECT `attorney_id` FROM `plantiff_case_type_info` WHERE `form_id`='$_REQUEST[fid]' && id='$_REQUEST[uid]'") or die(mysql_error());
					$att_id = mysql_fetch_object($att);
					$first_name  = $getdata->GetObjectById($att_id->attorney_id,"first_name");
					$last_name   = $getdata->GetObjectById($att_id->attorney_id,"last_name");
					$designation = $getdata->GetObjectById($att_id->attorney_id,'designation');
					$desg_name   = $getdata->GetDesgBydesId($designation);
					
				?>
                <div class="mess_msg_form_div">
					<div class="mess_msg_lft">
						<input type="checkbox" class="checked_boxes" name="msgid[]" id="squaredFour" value="<?php echo $att_id->attorney_id; ?>" />
					</div>
					<div class="mess_msg_rgt">
						<label>
							<?php echo $desg_name; ?>(<?php echo $first_name."&nbsp;".$last_name; ?>)
						</label>
					</div>
				</div>
				<?php
				$sql = mysql_query("SELECT * FROM `hire_staff` WHERE `form_id`='$_REQUEST[fid]' && `user_id`='$_REQUEST[uid]'") or die(mysql_error());
					while($hires = mysql_fetch_object($sql))
					{
						$hire_staff  = $hires->hire_id;
						$first_name  = $getdata->GetObjectById($hire_staff,"first_name");
						$last_name   = $getdata->GetObjectById($hire_staff,"last_name");
						$designation = $getdata->GetObjectById($hire_staff,'designation');
						$desg_name   = $getdata->GetDesgBydesId($designation);
					?>
                    
					<div class="mess_msg_form_div">
						<div class="mess_msg_lft">
							<input type="checkbox" class="checked_boxes" name="msgid[]" id="squaredFour" value="<?php echo $hire_staff; ?>" />
						</div>
						<div class="mess_msg_rgt">
							<label>
								<?php echo $desg_name; ?>(<?php echo $first_name."&nbsp;".$last_name; ?>)
							</label>
						</div>
                    </div>
				<?php
				}
				?>
				<textarea name="send_message" id="message_data" placeholder="Send Message" required></textarea>
				<div class="error_message"></div>
				
				<div class="file_browser"><input type="file" name="multiple_files[]" id="_multiple_files" class="hide_broswe" multiple /></div>
<div class="file_boxes">



</div>

<span id="removed_files"></span>
				<input type="submit" name="send_mess_ad" id="send_messagee" value="Submit"/>
			</form>
			<div class="file_boxes"></div>
			<span id="removed_files"></span>
<?php
	if(isset($_POST['send_mess_ad']))
	{
		foreach($_POST['msgid'] as $sends)
		{	
			$collect_id[] = $sends;
		}
		$send_ids = implode(',',$collect_id);
		//$data = mysql_query("INSERT INTO (``,``,``,``,``,``,``) VALUES ()") or die(mysql_error());
		$send_message = mysql_real_escape_string($_POST['send_message']);
		$temp_name     = $_FILES["multiple_files"]["tmp_name"];
		foreach($_FILES["multiple_files"]["tmp_name"] as $key => $tempname)
		{
			
			$filename      = $_FILES["multiple_files"]["name"][$key];
			//$extension     = pathinfo($filename ,PATHINFO_EXTENSION);
			$add_name      = rand(000000,999999);
			$newfilename[]   = date("y-m-d_h:m:s").'_'.$filename;				
		}
		$a = count($newfilename);
		for($keys=0;$keys<$a;$keys++)
		{
			$upload_path   = $_SERVER['DOCUMENT_ROOT']."/rao/messagesuploads/".$newfilename[$keys];
			$move          = move_uploaded_file($_FILES["multiple_files"]["tmp_name"][$keys],$upload_path);
		}
		

		$imagesid = implode(',',$newfilename);
		
		$insertData = mysql_query("INSERT INTO `message_sent` (`form_id`,`user_id`,`sent_by`,`main_user_id`,`message`,`date_message`,`upload_path`) VALUES ('$_REQUEST[fid]','$_REQUEST[uid]','$admin_id','$send_ids','$send_message',now(),'$imagesid')") or die(mysql_error());
	}
?>
	
	
	</div>
	<div id="all_messages" style="width: 10%; margin: 0 auto;"></div>
	<div id="display_messages"></div>
		<?php
				$temp_message = mysql_query("SELECT * FROM `message_sent` WHERE `user_id`='$_REQUEST[uid]' &&`form_id`='$_REQUEST[fid]' order by message_id desc") or die(mysql_error());
				if(mysql_num_rows($temp_message)>0)
				{
				while($message = mysql_fetch_object($temp_message))
				{
		?>
				<div>
				  <div id="news_list">
					  <div class="rep_middle">
					  <div class="rep_tit"><a>
					  <?php 
							echo "<b>".$fname   = $getdata->GetObjectById($message->sent_by,"first_name")."</b>";
							echo "<b>".$lname   = $getdata->GetObjectById($message->sent_by,"last_name")."</b><br/>";
									   $desg    = $getdata->GetObjectById($message->sent_by,"designation");
							echo "<b>".$desgna  = $getdata->GetDesgBydesId($desg)."</b><br/>";
						?>
						</a></div>
                       <div class="rep_rep_tit"><?php  $a_mess = $message->date_message;
							echo date('Y-M-d',strtotime($a_mess))."<br/>";
							echo date('h:i:s a',strtotime($a_mess));
							?>
                            </div>
					  <div class="rep">
						<?php 
							echo $tempmessages  = $message->message;
						?>		
						   </div>
						   <?php 
								$attachments = $message->upload_path;
								$explodee    = explode(',',$attachments);
								$i=1;
								foreach($explodee as $dataa)
								{
							?>
								<a href="<?php $_SERVER['DOCUMENT_ROOT'];?>/rao/messagesuploads/<?php echo $dataa; ?>" target="_blank">Attachement-<?php echo $i; ?></a>
							<?php
								$i++;
								}
						   ?>
					  </div>
					  <div class = "clr" ></div>
					  <a href="#" id="<?php echo $message->message_id; ?>" class="reply_back">Reply</a>
				  </div>
				 </div>

				<div id="jasoncomment<?php echo $message->message_id; ?>"  style="width:460px; background:#f0f0f0; margin:5px; display:none; border:1px solid #cccccc;">
					<div style="font-size:11px; margin:10px 0 0 10px; font-family:latha;font-weight:bold;">Your Message 
						<form method="post" action="" >
							<div style=" padding-top:5px;">
								<textarea rows="3" cols="50" id ="message_reply_r<?php echo $message->message_id; ?>" name="reply-comment"></textarea>
							</div>
							<input type="text" name ="message_id_r" id="message_id_r<?php echo $message->message_id; ?>" value ="<?php echo $message->message_id; ?>"/>
							<input type="text" name="sent_by_r" id="sent_by_r<?php echo $message->message_id; ?>" value="<?php echo $message->sent_by; ?>">
							<input type="text" name="main_user_r" id="main_user_r<?php echo $message->message_id; ?>" value="<?php echo $message->main_user_id; ?>">
							<input onclick="" type="submit" class="reply_of_message" id="<?php echo $message->message_id; ?>" name="replyb" value="Enter Your Message" style="margin-top:5px; height:20px; border:1px solid #246d00; font-size:10px; font-weight:bold;" />
						</form>
					</div>
				</div>
				<div id="flash<?php echo $message->message_id; ?>"></div>
				<div  id="loadplace<?php echo $message->message_id; ?>" ></div>				
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
						  <div class="rep_middle" style="padding:<?php echo $i+10; ?>px; margin-left:<?php echo 5*$i; ?>px;">
							  <?php $count = count($data); ?>
								<div class="rep_tit">
									<a>
										<?php 
											echo "<b>".$fname = $getdata->GetObjectById($data->reply_by,"first_name")."</b>";
											echo "<b>".$lname = $getdata->GetObjectById($data->reply_by,"last_name")."</b><br/>";
											$desg    = $getdata->GetObjectById($data->reply_by,"designation");
											echo "<b>".$desgna  = $getdata->GetDesgBydesId($desg)."</b><br/>";
										?>
									</a>
								</div>
								<div class="rep_rep_tit">
									<?php  
										$a_mess = $data->date_reply;
										echo date('Y-M-d',strtotime($a_mess))."<br/>";
										echo date('h:i:s a',strtotime($a_mess));
									?>
								</div>
								<div class="rep">
									<?php 
										echo $tempmessages  = $data->message_reply;
									?><br />	
									<a onclick="" id="<?php echo $message->message_id; ?>" href="javascript:animatedcollapse.show('jasoncomment<?php echo $data->reply_id; ?>')">Reply Me</a>
								</div>
						  </div>
						  <div class = "clr" ></div>
					  </div>
					 </div>
					
					<?php
						$i++;
							}
						}/*end if from replies*/
					}/*end main while*/
				}
				else
				{
					echo "There is no Message for You.";	
				}
				/*if(isset($_POST['message_sent_t']))
				{
					$message = $_POST['send_message_r'];
					$msgid   = $_POST['msgid'];
					foreach($msgid as $sent_to_id)
					{
						$temp_id[] = $sent_to_id;
					}
					$temp_ids  = implode(',',$temp_id);							
					$message_reply = mysql_query("INSERT INTO `message_sent` (`form_id`,`user_id`,`sent_by`,`main_user_id`,`message`,`date_message`) VALUES ('$_REQUEST[fid]','$_REQUEST[uid]','$admin_id','$temp_ids','$message',now())") or die(mysql_error());
					if($message_reply)
					{
						echo "Message Sent Successfully";
					}
				}
				if(isset($_POST['replyb']))
				{
					$smessage      = mysql_real_escape_string($_POST['reply-comment']);
					$message_id    = $_POST['message_id'];
					$sent_by       = $_POST['sent_by']; 
					$main_user_id  = $_POST['main_user_id'];
					$sendmessage = mysql_query("INSERT INTO `message_reply`(`message_sent_id`,`form_id`,`user_id`,`main_user_id`,`reply_by`,`sent_by`,`message_reply`,`date_reply`) VALUES ('$message_id','$_REQUEST[fid]','$_REQUEST[uid]','$main_user_id','$admin_id','$sent_by','$smessage',now())") or die(mysql_error());
				}*/
				
			?>	


</div>