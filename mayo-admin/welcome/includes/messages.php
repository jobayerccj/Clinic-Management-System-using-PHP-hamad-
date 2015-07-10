<?php
	define('SCRIPT_DEBUG', true);
	$admin    = $_SESSION['username'];
	$admin_id = $getdata->GetDetailsByUsername($admin,"id");
?>
<script type="text/javascript" src="<?php echo $sitepath; ?>/messages/common.js"></script>
<script type="text/javascript" src="<?php echo $sitepath; ?>/messages/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $sitepath; ?>/messages/animatedcollapse.js"></script>
<div class="back_btn_area">
	<a href="index.php"><input name="" type="button" class="back_btn" value="<<Back"/></a>
</div>
<div class="back_btn_area">
	<a href="#"><input name="" type="button" class="back_btn" value="<?php echo $getdata->GetInfoPlantiffInformation("plantiff_name",$_REQUEST['fid']); ?>"/></a>
</div>
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
			<form id="fileUpload"  action="" enctype="multipart/form-data" name="update_status" method="post" action="" class="mess_msg_form">
				<?php
					/*$att = mysql_query("SELECT `attorney_id` FROM `plantiff_case_type_info` WHERE `form_id`='$_REQUEST[fid]' && id='$_REQUEST[uid]'") or die(mysql_error());
					$att_id = mysql_fetch_object($att);
					$first_name  = $getdata->GetObjectById($att_id->attorney_id,"first_name");
					$last_name   = $getdata->GetObjectById($att_id->attorney_id,"last_name");
					$designationd = $getdata->GetObjectById($att_id->attorney_id,'designation');
					$desg_name   = $getdata->GetDesgBydesId($designationd);*/
					
				?>
                <!--<div class="mess_msg_form_div">
					<div class="mess_msg_lft">
						<input type="checkbox" class="checked_boxes" name="msgid[]" id="squaredFour" value="<?php //echo $att_id->attorney_id; ?>" />
					</div>
					<div class="mess_msg_rgt">
						<label>
							<?php //echo $desg_name; ?>(<?php echo $first_name."&nbsp;".$last_name; ?>)
						</label>
					</div>
				</div>-->
				<?php
				$sql = mysql_query("SELECT * FROM `hire_staff` WHERE `form_id`='$_REQUEST[fid]' && `user_id`='$_REQUEST[uid]'") or die(mysql_error());
					while($hires = mysql_fetch_object($sql))
					{
						$hire_staff  = $hires->hire_id;
						$first_name  = $getdata->GetObjectById($hire_staff,"first_name");
						$last_name   = $getdata->GetObjectById($hire_staff,"last_name");
						$designationw = $getdata->GetObjectById($hire_staff,'designation');
						$desg_name   = $getdata->GetDesgBydesId($designationw);
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
				<input type="submit" name="send_mess_ad" id="send_messagee" value="Submit"/>
			</form>

	</div>
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
		$size_sum = array_sum($_FILES['multiple_files']['size']);
		if($size_sum>0)
		{
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
				$upload_path   = $_SERVER['DOCUMENT_ROOT']."/messagesuploads/".$newfilename[$keys];
				$move          = move_uploaded_file($_FILES["multiple_files"]["tmp_name"][$keys],$upload_path);
			}
			$imagesid = implode(',',$newfilename);
		}
		else
		{
			$imagesid = "";
		}
		
		$insertData = mysql_query("INSERT INTO `message_sent` (`form_id`,`user_id`,`sent_by`,`main_user_id`,`message`,`date_message`,`upload_path`) VALUES ('$_REQUEST[fid]','$_REQUEST[uid]','$admin_id','$send_ids','$send_message',now(),'$imagesid')") or die(mysql_error());
	}
?>
		<?php
				$temp_message = mysql_query("SELECT * FROM `message_sent` WHERE `user_id`='$_REQUEST[uid]' &&`form_id`='$_REQUEST[fid]' order by message_id desc") or die(mysql_error());
				if(mysql_num_rows($temp_message)>0)
				{
				while($message = mysql_fetch_object($temp_message))
				{
					$getall_id  = $message->main_user_id;
					$getalldeta = explode(",",$getall_id);
					$countId    = count($getalldeta);
		?>
				<div>
				  <div id="news_list">
					  <div class="rep_middle">
					  <div class="rep_tit"><a>
					  <?php 
							echo "<b>".$fname   = $getdata->GetObjectById($message->sent_by,"first_name")."</b>&nbsp;";
							echo "<b>".$lname   = $getdata->GetObjectById($message->sent_by,"last_name")."</b><br/>";
									   $desgj    = $getdata->GetObjectById($message->sent_by,"designation");
							echo "<b>".$desgna  = $getdata->GetDesgBydesId($desgj)."</b><br/>";
						?>
						</a></div>
                       <div class="rep_rep_tit"><?php  $a_mess = $message->date_message;
							echo date('m-d-Y',strtotime($a_mess))."<br/>";
							echo date('h:i:s a',strtotime($a_mess));
							?>
                            </div>
					  <div class="rep">
						<?php 
							echo $tempmessages  = $message->message;
						?><br /> </div>
<?php 
							$attachments = $message->upload_path;
							if($attachments!="")
							{
								$explodee    = explode(',',$attachments);
								$countImages = count($explodee);
								$i=1;
								foreach($explodee as $dataa)
								{
							?>
									<a href="<?php $_SERVER['DOCUMENT_ROOT'];?>/messagesuploads/<?php echo $dataa; ?>" target="_blank">Attachement-<?php echo $i; ?></a>
							<?php
									$i++;
								}
							}
						   ?>						
					<a onclick="" id="<?php echo $message->message_id; ?>" href="javascript:animatedcollapse.show('jasoncomment<?php echo $message->message_id; ?>')">
					<?php if(($countId==1) && $admin_id){echo "Private Reply"; }else{ echo "Reply All"; } ?></a>
				
						  
					  </div>
					  <div class = "clr" ></div>
				  </div>
				 </div>
				<script type="text/javascript">
					animatedcollapse.addDiv('jason22', 'fade=1, speed=200');animatedcollapse.addDiv('jasoncomment<?php echo $message->message_id; ?>', 'fade=1, speed=200');
					animatedcollapse.ontoggle=function($, divobj, state){
					}
					animatedcollapse.init()
				</script>
				<div id="jasoncomment<?php echo $message->message_id; ?>"  style="background:#f0f0f0; display:none; border:1px solid #cccccc; position:relative;">
					<a id="close<?php echo $message->message_id; ?>" href="javascript:animatedcollapse.hide('jasoncomment<?php echo $message->message_id; ?>')" style="position:absolute; right:20px;">Close</a>
					<div style="font-size:15px; margin:10px 0 0 10px; font-family:latha;font-weight:bold;">Your Message 
						<form name="form2" method="post" action="" enctype="multipart/form-data">
							<div style=" padding-top:5px;">
								<textarea rows="3" cols="50" style="width:98%;" id ="message_reply_r<?php echo $message->message_id; ?>" name="reply-comment" required ></textarea>
							</div>
							<input type="hidden" name ="message_id_r" id="message_id_r<?php echo $message->message_id; ?>" value ="<?php echo $message->message_id; ?>"/>
							<input type="hidden" name="sent_by_r" id="sent_by_r<?php echo $message->message_id; ?>" value="<?php echo $message->sent_by; ?>">
							<input type="hidden" name="main_user_r" id="main_user_r<?php echo $message->message_id; ?>" value="<?php echo $message->main_user_id; ?>">
							<div class="file_browser">
								<input type="file" name="multipled_filess[]" id="_multiple_filess" class="hide_broswe" multiple />
							</div>
							<input onclick="" type="submit" class="reply_of_message" id="<?php echo $message->message_id; ?>" name="replyb" value="Submit" style="background:#FF6C12; padding:8px; color:#fff; font-size:14px; border:none; cursor:pointer; margin:5px 0px 0px 0px; border-radius:3px;"/>
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
							$getall_id  = $data->main_user_id;
							$getalldetas= explode(",",$getall_id);
							$countId    = count($getalldetas);
				?>
					<div style="">
					  <div id="news_list">
						  <div class="rep_middle" style="padding:<?php echo $i+10; ?>px; margin-left:<?php echo 5*$i; ?>px;">
							  <?php $count = count($data); ?>
								<div class="rep_tit">
									<a>
										<?php 
											echo "<b>".$fname = $getdata->GetObjectById($data->reply_by,"first_name")."</b>&nbsp;";
											echo "<b>".$lname = $getdata->GetObjectById($data->reply_by,"last_name")."</b><br/>";
											$desgt    = $getdata->GetObjectById($data->reply_by,"designation");
											echo "<b>".$desgna  = $getdata->GetDesgBydesId($desgt)."</b><br/>";
										?>
									</a>
								</div>
								<div class="rep_rep_tit">
									<?php  
										$a_mess = $data->date_reply;
										echo date('m-d-Y',strtotime($a_mess))."<br/>";
										echo date('h:i:s a',strtotime($a_mess));
									?>
								</div>
								<div class="rep">
									<?php 
										echo $tempmessages  = $data->message_reply;
									?><br />
								</div>
								<?php 
								$attachmentss = $data->attachments;
								if($attachmentss!="")
								{
									$explodee    = explode(',',$attachmentss);
									$i=1;
									foreach($explodee as $dataaa)
									{
							?>
									<a href="<?php $_SERVER['DOCUMENT_ROOT'];?>/messagesuploads/<?php echo $dataaa; ?>" target="_blank">Attachement-<?php echo $i; ?></a>
							<?php
									$i++;
									}
								}
						   ?>
									<a onclick="" id="<?php echo $message->message_id; ?>" href="javascript:animatedcollapse.show('jasoncomment<?php echo $data->reply_id; ?>')">
									<?php 
										//if($countId==1){ echo "Private Reply"; }else{ echo "Reply All"; }
										echo "Reply";
									?>
									</a>
						  </div>
						  <div class = "clr" ></div>
					  </div>
					 </div>
					<script type="text/javascript">
						animatedcollapse.addDiv('jason22', 'fade=1,speed=200');animatedcollapse.addDiv('jasoncomment<?php echo $data->reply_id; ?>', 'fade=1,speed=200');
						animatedcollapse.ontoggle=function($, divobj, state){
							}
						animatedcollapse.init()
					</script>
					<div id="jasoncomment<?php echo $data->reply_id; ?>"  style="background:#f0f0f0; display:none; border:1px solid #cccccc;">
						<a id="close<?php echo $message->message_id; ?>" href="javascript:animatedcollapse.hide('jasoncomment<?php echo $data->reply_id; ?>')">style="position:absolute; right:20px;">Close</a>
						<div style="font-size:11px; margin:10px 0 0 10px; font-family:latha;font-weight:bold;">Your Message 
							<form name="form3" method="post" action="" enctype="multipart/form-data">
								<div style=" padding-top:5px;">
									<textarea rows="3" cols="50" id="message_reply_r<?php echo $message->message_id; ?>" name="reply-comment" required></textarea>
								</div>
								<input type="hidden" name ="message_id_r" id="message_id_r<?php echo $message->message_id; ?>"  value ="<?php echo $message->message_id; ?>" />
								<input type="hidden" name="sent_by_r" id="sent_by_r<?php echo $message->message_id; ?>"  value="<?php echo $data->sent_by; ?>" />
								<input type="hidden" name="main_user_r" id="main_user_r<?php echo $message->message_id; ?>" value="<?php echo $data->main_user_id; ?>" />
								<div class="file_browser">
									<input type="file" name="multipled_filess[]" id="_multiple_filess" class="hide_broswe" multiple />
								</div>
								<input type="submit" name="replyb" id="<?php echo $message->message_id; ?>"  value="Submit" style="background:#FF6C12; padding:8px; color:#fff; font-size:14px; border:none; cursor:pointer; margin:5px 0px 0px 0px; border-radius:3px;" />
							</form>
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
				if(isset($_POST['replyb']))
				{
					$smessage      = mysql_real_escape_string($_POST['reply-comment']);
					$message_id    = $_POST['message_id_r'];
					$sent_by       = $_POST['sent_by_r']; 
					$main_user_id  = $_POST['main_user_r'];
					$size_sum = array_sum($_FILES['multiple_files']['size']);
					if($size_sum>0)
					{
						foreach($_FILES["multipled_filess"]["tmp_name"] as $key => $tempname)
						{
							
							$filenames      = $_FILES["multipled_filess"]["name"][$key];
							//$extension     = pathinfo($filename ,PATHINFO_EXTENSION);
							$add_names     = rand(000000,999999);
							$newfilenames[]   = date("y-m-d_h:m:s").'_'.$filenames;				
						}
						$a = count($newfilenames);
						for($keys=0;$keys<$a;$keys++)
						{
							$upload_path   = $_SERVER['DOCUMENT_ROOT']."/messagesuploads/".$newfilenames[$keys];
							$move          = move_uploaded_file($_FILES["multipled_filess"]["tmp_name"][$keys],$upload_path);
						}
						$imagesids = implode(',',$newfilenames);
					}
					else
					{
						$imagesids = "";
					}
					$quer = "INSERT INTO `message_reply`(`message_sent_id`,`form_id`,`user_id`,`main_user_id`,`reply_by`,`sent_by`,`message_reply`,`attachments`,`date_reply`) VALUES ('$message_id','$_REQUEST[fid]','$_REQUEST[uid]','$main_user_id','$admin_id','$sent_by','$smessage','$imagesids',now())";
					$sendmessage = mysql_query("INSERT INTO `message_reply`(`message_sent_id`,`form_id`,`user_id`,`main_user_id`,`reply_by`,`sent_by`,`message_reply`,`attachments`,`date_reply`) VALUES ('$message_id','$_REQUEST[fid]','$_REQUEST[uid]','$main_user_id','$admin_id','$sent_by','$smessage','$imagesids',now())") or die(mysql_error());
					if($sendmessage)
					{
						echo "Message Sent Successfully";
						header("refresh:1;url=index.php?fid=$_REQUEST[fid]&uid=$_REQUEST[uid]&cid=$_REQUEST[cid]");
					}
					else
					{
						echo "<h1>There is going something Wrong. Please try again Later Thanks.</h1>";
					}
				}
				
			?>	
<!--<script type="text/javascript">
	$(document).ready(function()
	{
		$(".reply_of_message").click(function()
		{
			var element 		= $(this);
			var Id 				= element.attr("id");
			var message_reply_r = $("#message_reply_r"+Id).val();
			var main_user_r     = $("#main_user_r"+Id).val();
			var message_id_r    = $("#message_id_r"+Id).val();
			alert('message_id_r'+message_id_r+'');
			var fid             = <?php //echo $_REQUEST['fid'] ?>;
			var uid             = <?php //echo $_REQUEST['uid'] ?>;
			var sent_by_r       = $("#sent_by_r"+Id).val();
			var dataString      = 'message_reply_r='+ message_reply_r+'&main_user_r='+main_user_r+'&sent_by_r='+sent_by_r+'&message_id_r='+message_id_r+'&fid='+fid+'&uid='+uid;
			if(message_reply_r  == '')
			{
				alert("Please Enter Some Text");
			}
			else
			{
				$("#flash"+Id).show();
				$("#flash"+Id).fadeIn(400).html('<img src="<?php //echo $sitepath; ?>/images/loading.gif" align="absmiddle" style="height: 55px; width: 55px;">&nbsp;<span class="loading"></span>');
				$.ajax({
				type: "POST",
				url: "../includes/insert-messages.php",
				data: dataString,
				cache: false,
				success: function(html){
				$("#loadplace"+Id).append(html);
				$("#flash"+Id).hide();
				$("#jasoncomment"+Id).hide();
					}
				});
			}
			return false;
		});
	});
</script>-->


</div>
