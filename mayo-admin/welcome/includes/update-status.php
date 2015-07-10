<!--Manage Work Flow Comment Starts over from here-->
<div class="back_btn_area">
	<a href="index.php"><input name="" type="button" class="back_btn" value="<<Back"/></a>
</div>
<div class="back_btn_area">
	<a href="#"><input name="" type="button" class="back_btn" value="<?php echo $getdata->GetInfoPlantiffInformation("plantiff_name",$_REQUEST['fid']); ?>"/></a>
</div>
<div class="attorney_client_info"><h1>Work Flow Comments</h1></div>
<div class="dashbord_client">
	<div class="update_status_top">
		<script type="text/javascript">
			$(document).ready(function()
			{
				$('.work_radio').click(function()
				{
					$('.work_notes').show();
				});
			});
		</script>
		<form name="update_status" method="post" action="">
		<?php
			/********************** Get Latest Work Flow Comment and get Update to this form *****************************/
			//echo $dat = "SELECT a. * , b. * FROM  `work_comments` AS a,  `members` AS b WHEREa.id = ( 						SELECT MAX( id ) FROM  `work_comments` WHEREform_id ='$_REQUEST[fid]') AND b.designation =8	AND a.main_user_id =b.id";
			$latestFlowTemp    = mysql_query("SELECT a. * , b. * 
						FROM  `work_comments` AS a,  `members` AS b
						WHERE a.id = ( 
						SELECT MAX( id ) 
						FROM  `work_comments` 
						WHERE form_id ='$_REQUEST[fid]') 
						AND b.designation =8
						AND a.main_user_id = b.id") or die(mysql_error());
			$latestFlow        = mysql_fetch_object($latestFlowTemp);
			
			$commentDataTemp   = mysql_query("SELECT * FROM `work_comments_data`") or die(mysql_error());
			while($commentData = mysql_fetch_object($commentDataTemp))
			{
		?>
			<div class="mess_msg_form_div">
				<div class     = "mess_msg_lft">
					<input type="radio" class="work_radio" id="work_comme" name="work_comments" value="<?php echo $commentData->comments_name; ?>" <?php if($commentData->comments_name == $latestFlow->work_comments){echo 'checked="checked"';}?> />
				</div>
				<div class="mess_msg_rgt">
					<label><?php echo $commentData->comments_name; ?></label>
				</div>
			</div>
		<?php
			}
		?>
		<div class="work_notes" style="display:none;">
			<textarea name="work_notes" id="work_notes_area"></textarea>
		</div>
			<input type="submit" name="send_work_comment" class="comment_update" value="Submit"/>
		</form>	
		<script type="text/javascript">
			$(function() {
			$(".comment_update").click(function() 
			{
				var element      = $(this);
				var workComments = $('input[name=work_comments]:checked').val();
				var formId       = <?php echo $_REQUEST['fid'] ?>;
				var workNotes    = $('#work_notes_area').val();
				var user_id      = <?php echo $_REQUEST['uid'] ?>;
				var commData     = 'commentData='+workComments+'&fid='+formId+'&uid='+user_id+'&notes='+workNotes;
					if(workComments=='')
					{
						alert("Please Check the Radio Box Button");
					}
					else
					{
							$("#status_show").show();
							$("#status_show").fadeIn(400).html('<img src="<?php echo $sitepath; ?>/images/loading.gif" align="absmiddle" style="height: 55px; width: 55px;">&nbsp;<span class="loading"></span>');
							$.ajax({
							type: "POST",
							url: "../includes/insert-workcomments.php",
							data: commData,
							cache: false,
							success: function(html){
							$("#comment_status").after(html);
							$("#comment_show").hide();
							$("#comment_statuss1").hide();
							document.getElementById('work_notes_area').value='';
							$("#work_notes_area").hide();
							$(".thank_message").fadeOut(4000);
							}
							});
				}
				return false;
				});
			});
		</script>
		<style type="text/css">
			@media all {
				.lightbox { display: none; }
				.fl-page h1,
				.fl-page h3,
				.fl-page h4 {
					font-family: 'HelveticaNeue-UltraLight', 'Helvetica Neue UltraLight', 'Helvetica Neue', Arial, Helvetica, sans-serif;
					font-weight: 100;
					letter-spacing: 1px;
				}
				.fl-page h1 { font-size: 110px; margin-bottom: 0.5em; }
				.fl-page h1 i { font-style: normal; color: #ddd; }
				.fl-page h1 span { font-size: 30px; color: #333;}
				.fl-page h3 { text-align: right; }
				.fl-page h3 { font-size: 15px; }
				.fl-page h4 { font-size: 2em; }
				.fl-page .jumbotron { margin-top: 2em; }
				.fl-page .doc { margin: 2em 0;}
				.fl-page .btn-download { float: right; }
				.fl-page .btn-default { vertical-align: bottom; }

				.fl-page .btn-lg span { font-size: 0.7em; }
				.fl-page .footer { margin-top: 3em; color: #aaa; font-size: 0.9em;}
				.fl-page .footer a { color: #999; text-decoration: none; margin-right: 0.75em;}
				.fl-page .github { margin: 2em 0; }
				.fl-page .github a { vertical-align: top; }
				.fl-page .marketing a { color: #999; }

				/* override default feather style... */
				.fixwidth {
					background: rgba(256,256,256, 0.8);
				}
				.fixwidth .featherlight-content {
					width: 500px;
					padding: 25px;
					color: #000;
					background: #111;
				}
				.fixwidth .featherlight-close {
					color: #fff;
					background: #333;
				}

			}
			@media(max-width: 768px){
				.fl-page h1 span { display: block; }
				.fl-page .btn-download { float: none; margin-bottom: 1em; }
			}
		</style>
		<script src="<?php //echo $sitepath; ?>/popup/jquery-1.7.0.min.js"></script>
		<script src="<?php //echo $sitepath; ?>/popup/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
		<link href="<?php //echo $sitepath; ?>/popup/featherlight.min.css" rel="stylesheet" type="text/css"/>
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//stats.g.doubleclick.net/dc.js','ga');
			ga('create', 'UA-5342062-6', 'noelboss.github.io');
			ga('send', 'pageview');
		</script>
		<div id="comment_show"></div>
			<div id="comment_statuss1">
				<div class="update_status_botom">
					<div class="update_status_row_heading">
						<div class="update_status_span_1">Date</div>
						<div class="update_status_span_2">Update By</div>
						<div class="update_status_span_3">Work Flow Comments</div>
					</div>
						<?php
							$count=0;
							$temp_getstatus = mysql_query("SELECT * FROM `work_comments` where `form_id`='$_REQUEST[fid]' order by id desc") or die(mysql_error());
							if(mysql_num_rows($temp_getstatus)>0)
							{
								while($getstatus= mysql_fetch_object($temp_getstatus))
								{
							?>
									<div class="update_status_row">
										<div class="update_status_span_1">
											<?php 
												$tempdate = $getstatus->work_comments_date;
												echo $date_time = date("m-d-Y",strtotime($tempdate))."<br/>"; 
												echo $datetime = date("H:m:s a",strtotime($tempdate));
											?>
										</div>
										<div class="update_status_span_2">
											<?php 
												$a_id = $getstatus->main_user_id;
												$fname = $getdata->GetObjectById($a_id,"first_name");
												$lname = $getdata->GetObjectById($a_id,"last_name");
												echo ucwords($fname)."&nbsp;";
												echo ucwords($lname);
												//echo $temdes= $getinformation->GetObjectById($a_id,"designation");									
											?>
										</div>
										<div class="update_status_span_3">
											<?php 
												echo $getstatus->work_comments; 
												if(!empty($getstatus->work_comments_area))
												{
													echo '<div class="btn-group">
															<a class="btn btn-default" href="#" data-featherlight="#fl'.$getstatus->id.'" data-featherlight-variant="fixwidth">See Notes</a>
														  </div>';
													echo '<div class="lightbox" id="fl'.$getstatus->id.'">
															<h2>Note</h2>
															<p>'.$getstatus->work_comments_area.'</p>
														  </div>';
												}
											?>
											
										</div>
									</div>
							<?php	
								}
						 }
						 else
						 {
						?>
							<div class="update_status_row">
								No Work Comments Till now.
							</div>
						<?php
						 }
						?>
				</div>
			</div>
			<div id="comment_status"></div>
	</div>
</div>
<!-- Update Status Form Begining -->
<!--<h2>Update Status</h2>
<div class="attorney_client_info"><h1>Update Status</h1></div>
<div class="dashbord_client">
	<div class="update_status_top">
		<form name="update_status" method="post" action="">
			<textarea name="status" id="status_message" placeholder="Update client status" required></textarea>
			<input type="submit" name="send_status" class="status_update" value="Submit"/>
		</form>	
		<script type="text/javascript">
			$(function() {
			$(".status_update").click(function() {
			var element = $(this);
			var status     = $("#status_message").val();
			var formId     = <?php //echo $_REQUEST['fid'] ?>;
			var userId     = <?php //echo $_REQUEST['uid'] ?>;
			var dataString = 'status='+status+'&fid='+formId+'&uid='+userId;
					if(status=='')
					{
						alert("Please Enter Some Text");
					}
					else
					{
							$("#status_show").show();
							$("#status_show").fadeIn(400).html('<img src="<?php //echo $sitepath; ?>/images/loading.gif" align="absmiddle" style="height: 55px; width: 55px;">&nbsp;<span class="loading"></span>');
							$.ajax({
							type: "POST",
							url: "../includes/insert-status.php",
							data: dataString,
							cache: false,
							success: function(html){
							$("#display_status").after(html);
							document.getElementById('status_message').value='';
							$("#status_show").hide();
							$("#display_status1").hide();
							$(".thank_message").fadeOut(4000);
							}
							});
				}
				return false;
				});
			});
		</script>
		<div id="status_show"></div>
			<div id="display_status1">
				<div class="update_status_botom">
					<div class="update_status_row_heading">
						<div class="update_status_span_1">Date</div>
						<div class="update_status_span_2">Update By</div>
						<div class="update_status_span_3">Status</div>
					</div>
						<?php
							////$count=0;
							//$temp_getstatus = mysql_query("SELECT * FROM `status_update` where `form_id`='$_REQUEST[fid]' && `user_id`='$_REQUEST[uid]' order by id desc") or die(mysql_error());
							//if(mysql_num_rows($temp_getstatus)>0)
							//{
							//	while($getstatus= mysql_fetch_object($temp_getstatus))
							//	{
							?>
									<div class="update_status_row">
										<div class="update_status_span_1">
											<?php 
												//$tempdate = $getstatus->date_status;
												//echo $date_time = date("Y-M-d",strtotime($tempdate))."<br/>"; 
												//echo $datetime = date("H:m:s a",strtotime($tempdate));
											?>
										</div>
										<div class="update_status_span_2">
											<?php 
												//$a_id = $getstatus->main_user_id;
												//$fname = $getdata->GetObjectById($a_id,"first_name");
												//$lname = $getdata->GetObjectById($a_id,"last_name");
												//echo ucwords($fname)."&nbsp;";
												//echo ucwords($lname);
												//echo $temdes= $getinformation->GetObjectById($a_id,"designation");	
											?>
										</div>
										<div class="update_status_span_3"><?php //echo $getstatus->status_messages; ?></div>
									</div>
							<?php	
								//}
						 //}
							//else
							//{
						?>
								<div class="update_status_row">
									No Status Update Till now.
								</div>
						<?php
							//}
						?>
				</div>
			</div>
			<div id="display_status"></div>
	</div>
</div>-->

<h2>Update Status</h2>
<div class="attorney_client_info"><h1>Update Status</h1></div>
<div class="dashbord_client">
	<div class="update_status_top">
		<form name="update_status" method="post" action="">
			<?php
				//$temp_getstatus = mysql_query("SELECT `status`, max(id) FROM `status_update` where `form_id`='$_REQUEST[fid]' && `user_id`='$_REQUEST[uid]' && main_user_id=''") or die(mysql_error());
				//$getstatus= mysql_fetch_object($temp_getstatus)
			?>
			<?php
				/********************** Get Latest Status and get Update from the update_status table for max(id) for role 8 it is admin role *****************************/

				$UpdateStatusTemp = mysql_query("SELECT a . * , b.id AS members_id, b.designation FROM status_update AS a, members AS b WHERE b.designation =8 AND a.main_user_id = b.id and a.form_id = '$_REQUEST[fid]' order by id desc limit 0,1") or die(mysql_error());
				$UpdateStatus    = mysql_fetch_object($UpdateStatusTemp);
				
				$commentDataTempp = mysql_query("SELECT * FROM `status_data`") or die(mysql_error());
				while($commentDataa = mysql_fetch_object($commentDataTempp))
				{
			?>
				<div class="mess_msg_form_div">
					<div class="mess_msg_lft">
						<input type="radio" id="work_comme" class="status_radio" name="status_val" value="<?php echo $commentDataa->statusdata; ?>" <?php if($commentDataa->statusdata==$UpdateStatus->status_messages){echo 'checked="checked"';} ?>/>
					</div>
					<div class="mess_msg_rgt">
						<label><?php echo $commentDataa->statusdata; ?></label>
					</div>
				</div>
			<?php
				}
			?>
			<div class="work_status" style="display:none;">
				<textarea name="work_status" id="work_status_area"></textarea>
			</div>
			<input type="submit" name="send_status" class="status_update" value="Submit"/>
		</form>	
		<script type="text/javascript">
			$(document).ready(function()
			{
				$('.status_radio').click(function()
				{
					$('.work_status').show();
				});
			});
			$(function() {
			$(".status_update").click(function() {
			var element    = $(this);
			var status     = $('input[name=status_val]:checked').val();
			var status_area= $("#work_status_area").val();
			var formId     = <?php echo $_REQUEST['fid'] ?>;
			var userId     = <?php echo $_REQUEST['uid'] ?>;
			var dataString = 'status='+status+'&fid='+formId+'&uid='+userId+'&statusComment='+status_area;
				if(status=='')
				{
					alert("Please Select the Item From Radio Box");
				}
				else
				{
						$("#status_show").show();
						$("#status_show").fadeIn(400).html('<img src="<?php echo $sitepath; ?>/images/loading.gif" align="absmiddle" style="height: 55px; width: 55px;">&nbsp;<span class="loading"></span>');
						$.ajax({
						type: "POST",
						url: "../includes/insert-status.php",
						data: dataString,
						cache: false,
						success: function(html){
						$("#display_status").after(html);
						$("#status_shows").hide();
						$("#display_status_s").hide();
						document.getElementById('work_status_area').value='';
						$(".work_status").hide();
						$(".thank_message").fadeOut(4000);
						}
						});
			}
			return false;
			});
		});
		</script>
		<div id="status_shows"></div>
			<div id="display_status_s">
				<div class="update_status_botom">
					<div class="update_status_row_heading">
						<div class="update_status_span_1">Date</div>
						<div class="update_status_span_2">Update By</div>
						<div class="update_status_span_3">Status</div>
					</div>
						<?php
							$count=0;
							$temp_getstatus = mysql_query("SELECT * FROM `status_update` where `form_id`='$_REQUEST[fid]' order by id desc") or die(mysql_error());
							if(mysql_num_rows($temp_getstatus)>0)
							{
								while($getstatus= mysql_fetch_object($temp_getstatus))
								{
							?>
									<div class="update_status_row">
										<div class="update_status_span_1">
											<?php 
												$tempdate = $getstatus->date_status;
												echo $date_time = date("m-d-Y",strtotime($tempdate))."<br/>"; 
												echo $datetime = date("H:m:s a",strtotime($tempdate));
											?>
										</div>
										<div class="update_status_span_2">
											<?php 
												$a_id = $getstatus->main_user_id;
												$fname = $getdata->GetObjectById($a_id,"first_name");
												$lname = $getdata->GetObjectById($a_id,"last_name");
												echo ucwords($fname)."&nbsp;";
												echo ucwords($lname);
												//echo $temdes= $getinformation->GetObjectById($a_id,"designation");	
											?>
										</div>
										<div class="update_status_span_3">
										<?php echo $getstatus->status_messages; ?>
										<?php 
												if(!empty($getstatus->status_notes))
												{
													echo '<div class="btn-group">
															<a class="btn btn-default" href="#" data-featherlight="#fla'.$getstatus->id.'" data-featherlight-variant="fixwidth">See Notes</a>
														  </div>';
													echo '<div class="lightbox" id="fla'.$getstatus->id.'">
															<h2>Note</h2>
															<p>'.$getstatus->status_notes.'</p>
														  </div>';
												}
											?>
										</div>
									</div>
							<?php	
								}
						 }
							else
							{
						?>
								<div class="update_status_row">
									No Status Update Till now.
								</div>
						<?php
							}
						?>
				</div>
			</div>
			<div id="display_status"></div>
	</div>
</div>
