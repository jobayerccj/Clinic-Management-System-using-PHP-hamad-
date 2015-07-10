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
	/*
		Class file to call the functions
	*/
	$formid = $_REQUEST['fid'];
	$userid = $_REQUEST['uid'];
?>
<script type="text/javascript" src="<?php echo $sitepath; ?>/messages/common.js"></script>
<script type="text/javascript" src="<?php echo $sitepath; ?>/messages/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $sitepath; ?>/messages/animatedcollapse.js"></script>

<section class="row">
  <div class="container dashboard_bg">
    <div class="dr_upload_doc_slide">
      <div class="dr_message_side_bg">
        <div id="show_data">
			<div class="dr_message_side">
			  <script>
			 $(document).ready(function() {
				 $(".view").load("latestmessages.php?attorneys_id=<?php echo $attorneys_id; ?>");
			   var refreshId = setInterval(function() {
				  $(".view").load('latestmessages.php?attorneys_id=<?php echo $attorneys_id; ?>');
			   }, 5000);
			   $.ajaxSetup({ cache: false });
			});
		</script>
		<div class="view">
			</div>
			</div>
        </div>
      </div>
    </div>
    <div class="slide_right">
      <div class="anesth_bg">
        <div class="view_application">
		<div style="width:100%!important">
					<p class="plantiff_name">
						<?php 
							echo ucwords($temp_profile->GetInfoPlantiffInformation('plantiff_name',$_REQUEST['fid'])); 
						?>
					</p>
				</div>
          <div class="dr_message_side_row">
            <form name="send_message" method="post" enctype="multipart/form-data" action="">
              <div style="display:none;">
                <?php
						$sql = mysql_query("SELECT * FROM `hire_staff` WHERE `form_id`='$_REQUEST[fid]' && `user_id`='$_REQUEST[uid]'") or die(mysql_error());
						while($hires = mysql_fetch_object($sql))
						{
							$hire_staff  = $hires->hire_id;
							$first_name  = $temp_profile->GetObjectById($hire_staff,"first_name");
							$last_name   = $temp_profile->GetObjectById($hire_staff,"last_name");
							$designation = $temp_profile->GetObjectById($hire_staff,'designation');
							$desg_name   = $temp_profile->GetDesgBydesId($designation)."<br/>";
						?>
                <input type="checkbox" name="msgid[]" id="squaredFour" value="<?php echo $hire_staff; ?>" checked="checked" />
                <label> <?php echo $desg_name; ?>(<?php echo $first_name."&nbsp;".$last_name; ?>) </label>
                <?php
						}
						$k = "SELECT `attorney_id` FROM `plantiff_case_type_info` WHERE `form_id`='$_REQUEST[fid]' && `id`='$_REQUEST[uid]'";
						$attidTmep = mysql_query("SELECT `attorney_id` FROM `plantiff_case_type_info` WHERE `form_id`='$_REQUEST[fid]' && `id`='$_REQUEST[uid]'") or die(mysql_error());
						
						$attidPer = mysql_fetch_assoc($attidTmep);

				?>
					<input type="checkbox" name="msgid[]" id="squaredFour" value="<?php echo $attidPer['attorney_id']; ?>" checked="checked"/>
              </div>
					
              </div>
              <script type="text/javascript">
					animatedcollapse.addDiv('jason22', 'fade=1,height=150px,speed=200');animatedcollapse.addDiv('jasoncomment', 'fade=1,height=150px,speed=200');
					animatedcollapse.ontoggle=function($, divobj, state){
					}
					animatedcollapse.init()
				</script>
              <h1>Send New Message</h1>
              <div style="font-size:11px; margin:10px 0 0 10px; font-family:latha;font-weight:bold;">
              Your Message
              <div style=" padding-top:5px;">
                <textarea rows="3" cols="50" id ="comment" name="send_message_r" required></textarea>
              </div>
              <div class="file_upload">
                <input type="file" name="multiple_files[]" id="_multiple_files" class="hide_broswe" multiple />
              </div>
              <div style="margin-top:40px; width:100%;"> <input type="submit" onclick="TimedRefresh(3000);" name="message_sent_t" value="Submit" style="margin-top:5px; height:20px; border:1px solid #246d00; font-size:10px; font-weight:bold;" /></div>
            </form>
            <?php
				$temp_message = mysql_query("SELECT * FROM `message_sent` WHERE `user_id`='$_REQUEST[uid]' &&`form_id`='$_REQUEST[fid]' order by message_id desc") or die(mysql_error());
				if(mysql_num_rows($temp_message)>0)
				{
				while($message = mysql_fetch_object($temp_message))
				{
					$getall_id  = $message->main_user_id;
					$getalldeta = explode(",",$getall_id);
				//echo $a = in_array($attorneys_id,$getalldeta);
				//echo $getall_id;
				if(in_array($attorneys_id,$getalldeta))
				{
						?>
            <div>
              <div id="writer_list">
                <div class="writer_middle">
                  <div class="writer_tit"><a>
                    <?php 
							echo "<b>".$fname   = $temp_profile->GetObjectById($message->sent_by,"first_name")."</b>&nbsp;";
							echo "<b>".$lname   = $temp_profile->GetObjectById($message->sent_by,"last_name")."</b><br/>";
									   $desg    = $temp_profile->GetObjectById($message->sent_by,"designation");
							echo "<b>".$desgna  = $temp_profile->GetDesgBydesId($desg)."</b><br/>";?>
                    </a></div>
                  <div class="writer_rep_tit">
                    <?php
							$a_mess = $message->date_message;
							echo date('Y-M-d',strtotime($a_mess))."<br/>";
							echo date('h:i:s a',strtotime($a_mess));
						?>
                  </div>
                  <div class="writer-reply">
                    <?php 
							echo $tempmessages  = $message->message;
						?>
                    <?php 
								$attachmentss = $message->upload_path;
								$explodee    = explode(',',$attachmentss);
								$countedd = count($explodee);
								if($attachmentss!="")
								{
								$i=1;
								foreach($explodee as $dataaa)
								{
							?>
                    <div class="attmnt_div"><a href="<?php echo $sitepath;?>/messagesuploads/<?php echo $dataaa; ?>" target="_blank">Attachement-<?php echo $i; ?></a></div>
                    <?php
								$i++;
								}
								}
						   ?>
                    <br />
                  </div>
                  <div class="rep_div_area"><a href="javascript:animatedcollapse.show('jasoncomment<?php echo $message->message_id; ?>')"><?php if(count($getalldeta)==1){ echo "Private Reply"; }else{ echo "Reply All"; } ?> </a></div>
                </div>
              </div>
            </div>
            <script type="text/javascript">
					animatedcollapse.addDiv('jason22', 'fade=1,height=150px,speed=200');animatedcollapse.addDiv('jasoncomment<?php echo $message->message_id; ?>', 'fade=1,height=150px,speed=200');
					animatedcollapse.ontoggle=function($, divobj, state){
					}
					animatedcollapse.init()
				</script>
            <div id="jasoncomment<?php echo $message->message_id; ?>" class="rep_msg"> 
			<a href="javascript:animatedcollapse.hide('jasoncomment<?php echo $message->message_id; ?>')">Close</a>
              <div style="overflow:hidden">Your Message
                <form name="form3" method="post" action="" enctype="multipart/form-data">
                  <div style=" padding-top:5px;">
                    <textarea rows="3" cols="50" id ="comment<?php echo $data->reply_id; ?>" name="reply-comment" required></textarea>
                  </div>
                  <input type="hidden" name ="message_id" value ="<?php echo $message->message_id; ?>" />
                  <input type="hidden" name="sent_by" value="<?php echo $data->sent_by; ?>" />
                  <input type="hidden" name="main_user_id" value="<?php echo $data->main_user_id; ?>" />
                  <div class="file_upload">
                    <input type="file" name="multipled_filess[]" id="_multiple_filessdd" class="hide_broswe" multiple />
                  </div>
                 <div style="margin-top:40px; width:100%;">  <input type="submit" id="btReload" name="replyb" value="Submit" style="height:20px; border:1px solid #246d00; font-size:10px; font-weight:bold;" /></div>
                </form>
				 <div class="clr"></div>
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
            <div>
              <div id="writer_list">
                <div class="writer_middle" style="padding:<?php echo $i+10; ?>px; margin-left:<?php echo 5*$i; ?>px;">
                  <?php $count = count($data); ?>
             <div class="writer_tit"><a>
                    <?php 
							echo "<b>".$fname   = $temp_profile->GetObjectById($data->reply_by,"first_name")."</b>&nbsp;";
							echo "<b>".$lname   = $temp_profile->GetObjectById($data->reply_by,"last_name")."</b><br/>";
									   $desg    = $temp_profile->GetObjectById($data->reply_by,"designation");
							echo "<b>".$desgna  = $temp_profile->GetDesgBydesId($desg)."</b><br/>";?>
                    </a></div>
                  <div class="writer_rep_tit">
                    <?php
							$a_mess = $message->date_message;
							echo date('Y-M-d',strtotime($a_mess))."<br/>";
							echo date('h:i:s a',strtotime($a_mess));
						?>
                  </div>
                  <div class="writer-reply">
                    <?php 
								echo $tempmessages  = $data->message_reply;
							?>
                    <?php 
								$attachmentss = $data->attachments;
								$explodee    = explode(',',$attachmentss);
								$counted = count($explodee);
								if($counted>1)
								{
								$i=1;
								foreach($explodee as $dataaa)
								{
							?>
                    <div class="attmnt_div"><a href="<?php echo $sitepath;?>/messagesuploads/<?php echo $dataaa; ?>" target="_blank">Attachement-<?php echo $i; ?></a></div>
                    <?php
								$i++;
								}
								}
						   ?>
                  
                  </div>
				  <div class="rep_div_area"> <a href="javascript:animatedcollapse.show('jasoncomment<?php echo $data->reply_id; ?>')"><?php 
					//if(count($getalldeta)==1){ echo "Private Reply"; }else{ echo "Reply All"; } 
					echo "Reply";
					?> </a> </div>
                </div>
              </div>
            </div>
            <script type="text/javascript">
						animatedcollapse.addDiv('jason22', 'fade=1,height=150px,speed=200');animatedcollapse.addDiv('jasoncomment<?php echo $data->reply_id; ?>', 'fade=1,height=150px,speed=200');
						animatedcollapse.ontoggle=function($, divobj, state){
							}
						animatedcollapse.init()
					</script>
            <div id="jasoncomment<?php echo $data->reply_id; ?>"  class="rep_msg"> <a href="javascript:animatedcollapse.hide('jasoncomment<?php echo $data->reply_id; ?>')">Close</a>
              <div style="overflow:hidden">Your Message
                <form name="form3" method="post" action="" enctype="multipart/form-data">
                  <div style=" padding-top:5px;">
                    <textarea rows="3" cols="50" id ="comment<?php echo $data->reply_id; ?>" name="reply-comment" required></textarea>
                  </div>
                  <input type="hidden" name ="message_id" value ="<?php echo $message->message_id; ?>" />
                  <input type="hidden" name="sent_by" value="<?php echo $data->sent_by; ?>" />
                  <input type="hidden" name="main_user_id" value="<?php echo $data->main_user_id; ?>" />
                  <div class="file_upload">
                    <input type="file" name="multipled_filess[]" id="_multiple_filessdd" class="hide_broswe" multiple />
                  </div>
                 <div style="margin-top:40px; width:100%;"> <input type="submit" id="btReload" name="replyb" value="Submit" style="height:20px; border:1px solid #246d00; font-size:10px; font-weight:bold;" /></div>
                </form>
				 <div class="clr"></div>
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
							echo $upload_path   = $_SERVER['DOCUMENT_ROOT']."/messagesuploads/".$newfilename[$keys];
							echo $move          = move_uploaded_file($_FILES["multiple_files"]["tmp_name"][$keys],$upload_path);
						}
									
						$imagesid = implode(',',$newfilename);
				}
				else
				{
					$imagesid = "";
				}
				

					
					
					$message_reply = mysql_query("INSERT INTO `message_sent` (`form_id`,`user_id`,`sent_by`,`main_user_id`,`message`,`date_message`,`upload_path`) VALUES ('$_REQUEST[fid]','$_REQUEST[uid]','$attorneys_id','$temp_ids','$message',now(),'$imagesid')") or die(mysql_error());
					if($message_reply)
					{
						echo "Message Sent Successfully";
						header("refresh:1;url=$_SERVER[REQUEST_URI]");
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
					foreach($_FILES["multipled_filess"]["tmp_name"] as $key => $tempname)
					{
						
						echo $filenames      = $_FILES["multipled_filess"]["name"][$key];
						//$extension     = pathinfo($filename ,PATHINFO_EXTENSION);
						$add_names     = rand(000000,999999);
						$newfilenames[]   = date("y-m-d_h:m:s").'_'.$filenames;				
					}
					echo $b = count($filenames);
					for($keys=0;$keys<$b;$keys++)
					{
						echo $upload_path   = $_SERVER['DOCUMENT_ROOT']."/messagesuploads/".$newfilenames[$keys];
						echo $move          = move_uploaded_file($_FILES["multipled_filess"]["tmp_name"][$keys],$upload_path);
					}
					if($b>=1)
					{
						$imagesids = implode(',',$newfilenames);
					}
					$sendmessage = mysql_query("INSERT INTO `message_reply`(`message_sent_id`,`form_id`,`user_id`,`main_user_id`,`reply_by`,`sent_by`,`message_reply`,`attachments`,`date_reply`) VALUES ('$message_id','$_REQUEST[fid]','$_REQUEST[uid]','$main_user_id','$attorneys_id','$sent_by','$smessage','$imagesids',now())") or die(mysql_error());
					if($sendmessage)
					{
						echo "Message Sent Successfully";
						header("refresh:1;url=$_SERVER[REQUEST_URI]");
					}
				}
				
			?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</section>
<?php
require($get_footer);
}
else
{
	
header('Location:../../login.php');
	
}
?>
